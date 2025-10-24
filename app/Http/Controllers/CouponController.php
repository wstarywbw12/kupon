<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Peserta;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = \App\Models\Coupon::latest()->paginate(20);
        return view('coupons.index', compact('coupons'));
    }

    public function show(\App\Models\Coupon $coupon)
    {
        return view('coupons.show', compact('coupon'));
    }

    public function print(\App\Models\Coupon $coupon)
    {
        return view('coupons.print', compact('coupon'));
    }

    public function showScanForm()
    {
        return view('coupons.scan'); // form untuk scanner
    }

    public function registerScan(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $inputCode = trim($request->input('code'));

        // Hilangkan leading zero untuk perbandingan numerik
        $numericCode = ltrim($inputCode, '0');

        // Cari kupon di DB lokal (cocokkan dengan atau tanpa leading zero)
        $coupon = Coupon::where(function ($query) use ($inputCode, $numericCode) {
            $query->where('code', $inputCode)
                ->orWhere('code', str_pad($numericCode, 4, '0', STR_PAD_LEFT))
                ->orWhereRaw('CAST(code AS UNSIGNED) = ?', [$numericCode ?: 0]);
        })->first();

        if (! $coupon) {
            return back()->with('error', "Kupon {$inputCode} tidak ditemukan.");
        }

        if ($coupon->used) {
            return back()->with('error', "Kupon {$coupon->code} sudah terdaftar.");
        }

        // Tandai kupon sebagai sudah digunakan
        $coupon->update([
            'used' => true,
            'scanned_at' => now(),
            'scanned_by' => $request->user()?->id ? (string)$request->user()->id : $request->ip(),
        ]);

        // Tambahkan data ke tabel peserta di DB remote
        try {
            // Periksa apakah nomor sudah ada di tabel peserta
            $exists = Peserta::where('nomor', $coupon->code)->exists();

            if (! $exists) {
                Peserta::create([
                    'nomor' => $coupon->code,
                    'status' => 'belum',
                ]);
            }
        } catch (\Exception $e) {
            // Jika gagal insert ke DB remote, rollback update kupon
            $coupon->update([
                'used' => false,
                'scanned_at' => null,
                'scanned_by' => null,
            ]);

            return back()->with('error', 'Gagal menyimpan ke database peserta: ' . $e->getMessage());
        }

        return back()->with('success', "Kupon {$coupon->code} berhasil diregistrasi.");
    }



    public function printAll()
    {
        $coupons = \App\Models\Coupon::orderBy('id')->get();
        return view('coupons.print-all', compact('coupons'));
    }

    public function peserta()
    {
        $data = \App\Models\Peserta::all();
        return $data;
    }
}

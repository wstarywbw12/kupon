<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

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

        $code = $request->input('code');

        $coupon = Coupon::where('code', $code)->first();

        if (! $coupon) {
            return back()->with('error', 'Kupon tidak ditemukan.');
        }
        if ($coupon->used) {
            return back()->with('error', 'Kupon sudah terpakai.');
        }

        $coupon->update([
            'used' => true,
            'scanned_at' => now(),
            'scanned_by' => $request->user()?->id ? (string)$request->user()->id : $request->ip()
        ]);

        return back()->with('success', "Kupon {$code} berhasil didaftarkan.");
    }

    public function printAll()
    {
        $coupons = \App\Models\Coupon::orderBy('id')->get();
        return view('coupons.print-all', compact('coupons'));
    }
}

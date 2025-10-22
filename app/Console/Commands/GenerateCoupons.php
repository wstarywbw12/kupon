<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Coupon;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class GenerateCoupons extends Command
{
    protected $signature = 'coupons:generate {count=20}';
    protected $description = 'Generate kupon 4-digit dengan QR Code';

    public function handle()
    {
        $count = (int) $this->argument('count');

        for ($i = 0; $i < $count; $i++) {
            // Ambil kode terakhir dari database (default 0 kalau belum ada)
            $lastCoupon = Coupon::orderBy('id', 'desc')->first();
            $lastNumber = $lastCoupon ? intval($lastCoupon->code) : 0;
            // Nomor urut baru
            $newNumber = $lastNumber + 1;
            // Format jadi 4 digit (0001, 0002, dst)
            $code = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

            // generate kode unik 4 digit
            //do {
              //  $code = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            //} while (Coupon::where('code', $code)->exists());

            // buat QR code (isi = kode kupon)
            $qrSvg = QrCode::format('svg')
                ->size(250)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($code);

            $filename = 'qrcodes/' . now()->format('Ymd_His_') . "_{$code}.svg";
            Storage::disk('public')->put($filename, $qrSvg);

            // simpan ke database
            Coupon::create([
                'code' => $code,
                'barcode_path' => $filename,
            ]);

            $this->info("Generated QR kupon: {$code}");
        }


        $this->info("✅ Selesai: {$count} kupon dibuat.");
    }
}

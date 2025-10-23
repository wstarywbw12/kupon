<?php

use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/scan', [CouponController::class,'showScanForm'])->name('coupons.scan.form');
Route::post('/scan', [CouponController::class,'registerScan'])->name('coupons.scan');

Route::get('/coupons/{coupon}/print', function(\App\Models\Coupon $coupon){
    return view('coupons.print', compact('coupon'));
})->name('coupons.print');


Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
Route::get('/coupons/{coupon}', [CouponController::class, 'show'])->name('coupons.show');
Route::get('/coupons/{coupon}/print', [CouponController::class, 'print'])->name('coupons.print');

Route::get('/coupons/print/all', [CouponController::class, 'printAll'])->name('coupons.print.all');

Route::get('/peserta', [CouponController::class, 'peserta'])->name('peserta.index');

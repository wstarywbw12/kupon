<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'barcode_path', 'used', 'scanned_at', 'scanned_by'];
    protected $casts = [
        'used' => 'boolean',
        'scanned_at' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $connection = 'mysql_remote';
    protected $table = 'peserta';

    protected $fillable = [
        'nomor',
        'status',
    ];

    public $timestamps = false;
}

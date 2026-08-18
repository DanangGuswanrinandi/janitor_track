<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterRuangan extends Model
{
    protected $table = 'master_ruangan';


    protected $fillable = [
        'kode_ruangan',
        'qr_code',
        'nama_ruangan',
        'lokasi',
        'latitude',
        'longitude',
    ];


    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];
}
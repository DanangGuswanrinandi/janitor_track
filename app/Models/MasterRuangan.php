<?php

namespace App\Models;
use App\Models\LaporanJanitor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterRuangan extends Model
{
    protected $table = 'master_ruangan';

    public function laporanJanitor(): HasMany
    {
        return $this->hasMany(
            LaporanJanitor::class,
            'ruangan_id'
        );
    }

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

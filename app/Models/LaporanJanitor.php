<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MasterRuangan;
use App\Models\User;

class LaporanJanitor extends Model
{
    protected $table = 'laporan_janitor';

        protected $fillable = [
        'ruangan_id',
        'user_id',
        'foto_kondisi',
        'latitude',
        'longitude',
        'keterangan',
        'status',
    ];

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(
            MasterRuangan::class,
            'ruangan_id'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}

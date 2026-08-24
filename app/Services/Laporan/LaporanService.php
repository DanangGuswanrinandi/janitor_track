<?php

namespace App\Services\Laporan;

use App\Models\LaporanJanitor;
use App\Models\MasterRuangan;
use Illuminate\Http\Request;

class LaporanService
{
    /*
    |--------------------------------------------------------------------------
    | MENGAMBIL SELURUH LAPORAN
    |--------------------------------------------------------------------------
    */

    public function getReports()
    {
        return LaporanJanitor::query()
            ->with([
                'ruangan',
                'user',
            ])
            ->latest()
            ->paginate(20);
    }


    /*
    |--------------------------------------------------------------------------
    | MENGAMBIL RUANGAN BERDASARKAN KODE
    |--------------------------------------------------------------------------
    */

    public function getRoomByCode(
        string $kodeRuangan
    ): MasterRuangan {

        return MasterRuangan::where(
            'kode_ruangan',
            $kodeRuangan
        )->firstOrFail();

    }


    /*
    |--------------------------------------------------------------------------
    | MENYIMPAN LAPORAN
    |--------------------------------------------------------------------------
    */

    public function createReport(
        Request $request,
        string $kodeRuangan
    ): LaporanJanitor {

        /*
        |--------------------------------------------------------------------------
        | CARI RUANGAN
        |--------------------------------------------------------------------------
        */

        $ruangan = MasterRuangan::where(
            'kode_ruangan',
            $kodeRuangan
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'foto' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO
        |--------------------------------------------------------------------------
        */

        $fotoPath = $request
            ->file('foto')
            ->store(
                'laporan_janitor',
                'public'
            );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN LAPORAN
        |--------------------------------------------------------------------------
        */

        return LaporanJanitor::create([

            'ruangan_id' =>
                $ruangan->id,

            'user_id' =>
                auth()->id(),

            'foto_kondisi' =>
                $fotoPath,

            'latitude' =>
                $validated['latitude'],

            'longitude' =>
                $validated['longitude'],

            'keterangan' =>
                $validated['keterangan'] ?? null,

        ]);
    }
}

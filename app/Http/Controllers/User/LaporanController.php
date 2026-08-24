<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Laporan\LaporanService;

class LaporanController extends Controller
{
    public function __construct(
        protected LaporanService $laporanService
    ) {
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN LIHAT LAPORAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $laporans =
            $this->laporanService
                ->getReports();


        return view(
            'pages.users.lihat_laporan_page',
            compact('laporans')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN BUAT LAPORAN
    |--------------------------------------------------------------------------
    */

    public function create(
        string $kode_ruangan
    ) {

        $ruangan =
            $this->laporanService
                ->getRoomByCode(
                    $kode_ruangan
                );


        return view(
            'pages.users.laporan_page',
            compact('ruangan')
        );
    }
}

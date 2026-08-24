<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Laporan\LaporanService;
use Illuminate\Http\Request;

class LaporanJanitorController extends Controller
{
    public function __construct(
        protected LaporanService $laporanService
    ) {
    }


    /*
    |--------------------------------------------------------------------------
    | STORE LAPORAN
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        string $kode_ruangan
    ) {

        $this->laporanService
            ->createReport(
                $request,
                $kode_ruangan
            );


        return redirect()
            ->route('user.buat-laporan')
            ->with(
                'success',
                'Laporan kebersihan berhasil dikirim.'
            );
    }
}

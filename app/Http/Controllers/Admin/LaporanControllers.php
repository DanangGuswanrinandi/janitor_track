<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Laporan\LaporanService;
use App\Models\LaporanJanitor;
use Illuminate\Http\JsonResponse;

class LaporanControllers extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DEPENDENCY
    |--------------------------------------------------------------------------
    */

    public function __construct(
        protected LaporanService $laporanService
    ) {
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN KELOLA LAPORAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $laporans =
            $this->laporanService
                ->getAllReports();


        return view(
            'pages.admin.kelola_laporan_page',
            compact('laporans')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DATA APPROVE LAPORAN
    |--------------------------------------------------------------------------
    */
    
    public function approvalData(
        LaporanJanitor $laporan
    ): JsonResponse {
    
        $data =
            $this->laporanService
                ->getApprovalData(
                    $laporan->id
                );
    
    
        return response()->json(
            $data
        );
    
    }
}

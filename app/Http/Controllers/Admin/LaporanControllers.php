<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Laporan\LaporanService;
use App\Models\LaporanJanitor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    /*
    |--------------------------------------------------------------------------
    | APPROVE LAPORAN
    |--------------------------------------------------------------------------
    */

    public function approve(
        LaporanJanitor $laporan
    ): JsonResponse {

        $laporan =
            $this->laporanService
                ->approveReport(
                    $laporan->id
                );

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil diverifikasi.',
            'status' => $laporan->status,
        ]);

    }
   /*
|--------------------------------------------------------------------------
| SHOW LAPORAN
|--------------------------------------------------------------------------
*/

public function show(
    LaporanJanitor $laporan
): JsonResponse {

    return response()->json(
        $this->laporanService
            ->getReportDetail(
                $laporan->id
            )
    );
}


/*
|--------------------------------------------------------------------------
| UPDATE LAPORAN
|--------------------------------------------------------------------------
*/

public function update(
    Request $request,
    LaporanJanitor $laporan
) {

    $this->laporanService
        ->updateAdminReport(
            $request,
            $laporan->id
        );

    return redirect()
        ->route('admin.kelola-laporan')
        ->with(
            'success',
            'Laporan berhasil diperbarui.'
        );
}


/*
|--------------------------------------------------------------------------
| DELETE LAPORAN
|--------------------------------------------------------------------------
*/

public function destroy(
    LaporanJanitor $laporan
) {

    $this->laporanService
        ->deleteAdminReport(
            $laporan->id
        );

    return redirect()
        ->route('admin.kelola-laporan')
        ->with(
            'success',
            'Laporan berhasil dihapus.'
        );
}
}

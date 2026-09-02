<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Laporan\LaporanService;
use Illuminate\Http\Request;

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


    /*
    |--------------------------------------------------------------------------
    | DETAIL LAPORAN
    |--------------------------------------------------------------------------
    */

    public function show(
        int $id
    ) {

        $laporan =
            $this->laporanService
                ->getReportById($id);


        return response()->json([
            'success' => true,
            'data' => $laporan,
        ]);

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE LAPORAN
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        int $id
    ) {

        $laporan =
            $this->laporanService
                ->updateReport(
                    $request,
                    $id
                );


        return redirect()
            ->route(
                'user.lihat-laporan'
            )
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
        int $id
    ) {

        $this->laporanService
            ->deleteReport($id);


        return redirect()
            ->route(
                'user.lihat-laporan'
            )
            ->with(
                'success',
                'Laporan berhasil dihapus.'
            );

    }

    /*
    |--------------------------------------------------------------------------
    | BULK DELETE LAPORAN
    |--------------------------------------------------------------------------
    */

    public function bulkDestroy(
        Request $request
    ) {

        $validated = $request->validate([
            'laporan_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'laporan_ids.*' => [
                'integer',
                'exists:laporan_janitor,id',
            ],
        ]);


        $deletedCount =
            $this->laporanService
                ->deleteSelectedReports(
                    $validated['laporan_ids']
                );


        return redirect()
            ->route(
                'user.lihat-laporan'
            )
            ->with(
                'success',
                $deletedCount .
                ' laporan berhasil dihapus.'
            );

    }
}

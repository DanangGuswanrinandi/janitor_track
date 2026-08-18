<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MasterRuangan\MasterRuanganService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\MasterRuangan;

class MasterRuanganController extends Controller
{
    public function __construct(
        protected MasterRuanganService $masterRuanganService
    ) {
    }


    /**
     * Menampilkan halaman master ruangan.
     */
    public function index()
    {
        $rooms =
            $this->masterRuanganService
                ->getRooms();


        $nextRoomCode =
            $this->masterRuanganService
                ->getNextRoomCode();


        return view(
            'pages.admin.master_ruangan_page',
            compact(
                'rooms',
                'nextRoomCode'
            )
        );
    }


    /**
     * Menyimpan ruangan baru.
     */
    public function store(
        Request $request
    ): RedirectResponse {

        $this->masterRuanganService
            ->createRoom($request);


        return redirect()
        ->route('admin.master-ruangan')
        ->with(
            'success',
            'Ruangan berhasil ditambahkan.'
        );
    }

    /**
     * Menampilkan halaman edit ruangan.
     */
    public function update(
        Request $request,
        MasterRuangan $masterRuangan
    ): RedirectResponse {

        $this->masterRuanganService
            ->updateRoom(
                $masterRuangan,
                $request
            );


        return redirect()
            ->route('admin.master-ruangan')
            ->with(
                'success',
                'Ruangan berhasil diperbarui.'
            );

    }
    public function destroy(
        MasterRuangan $masterRuangan
    ): RedirectResponse {
    
        $this->masterRuanganService
            ->deleteRoom(
                $masterRuangan
            );
    
    
        return redirect()
            ->route('admin.master-ruangan')
            ->with(
                'success',
                'Ruangan berhasil dihapus.'
            );
    
    }
}
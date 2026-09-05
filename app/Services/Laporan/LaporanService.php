<?php

namespace App\Services\Laporan;

use App\Models\LaporanJanitor;
use App\Models\MasterRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanService
{
    /*
    |--------------------------------------------------------------------------
    | MENGAMBIL SELURUH LAPORAN USER
    |--------------------------------------------------------------------------
    */

    public function getReports()
    {
        return LaporanJanitor::query()
            ->with([
                'ruangan',
            ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->paginate(25);
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

        $ruangan = MasterRuangan::where(
            'kode_ruangan',
            $kodeRuangan
        )->firstOrFail();


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


        $fotoPath = $request
            ->file('foto')
            ->store(
                'laporan_janitor',
                'public'
            );


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


    /*
    |--------------------------------------------------------------------------
    | MENGAMBIL DETAIL LAPORAN USER
    |--------------------------------------------------------------------------
    */

    public function getReportById(
        int $id
    ): LaporanJanitor {

        return LaporanJanitor::query()
            ->with([
                'ruangan',
            ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->findOrFail($id);

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE LAPORAN
    |--------------------------------------------------------------------------
    */

    public function updateReport(
        Request $request,
        int $id
    ): LaporanJanitor {

        $laporan = $this
            ->getReportById($id);


        /*
        |--------------------------------------------------------------------------
        | CEK STATUS
        |--------------------------------------------------------------------------
        */

        abort_if(
            $laporan->status !== 'menunggu',
            403,
            'Laporan yang sudah terverifikasi tidak dapat diubah.'
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'foto' => [
                'nullable',
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
        | UPDATE FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            if (
                $laporan->foto_kondisi &&
                Storage::disk('public')
                    ->exists($laporan->foto_kondisi)
            ) {

                Storage::disk('public')
                    ->delete(
                        $laporan->foto_kondisi
                    );

            }


            $laporan->foto_kondisi =
                $request
                    ->file('foto')
                    ->store(
                        'laporan_janitor',
                        'public'
                    );

        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $laporan->latitude =
            $validated['latitude'];

        $laporan->longitude =
            $validated['longitude'];

        $laporan->keterangan =
            $validated['keterangan'] ?? null;


        $laporan->save();


        return $laporan->fresh([
            'ruangan',
        ]);

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE LAPORAN
    |--------------------------------------------------------------------------
    */

    public function deleteReport(
        int $id
    ): void {

        $laporan = $this
            ->getReportById($id);


        /*
        |--------------------------------------------------------------------------
        | CEK STATUS
        |--------------------------------------------------------------------------
        */

        abort_if(
            $laporan->status !== 'menunggu',
            403,
            'Laporan yang sudah terverifikasi tidak dapat dihapus.'
        );


        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO
        |--------------------------------------------------------------------------
        */

        if (
            $laporan->foto_kondisi &&
            Storage::disk('public')
                ->exists($laporan->foto_kondisi)
        ) {

            Storage::disk('public')
                ->delete(
                    $laporan->foto_kondisi
                );

        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS LAPORAN
        |--------------------------------------------------------------------------
        */

        $laporan->delete();

    }

    /*
    |--------------------------------------------------------------------------
    | BULK DELETE LAPORAN
    |--------------------------------------------------------------------------
    */

    public function deleteSelectedReports(
        array $ids
    ): int {

        $laporans =
            LaporanJanitor::query()
                ->where(
                    'user_id',
                    auth()->id()
                )
                ->whereIn(
                    'id',
                    $ids
                )
                ->where(
                    'status',
                    'menunggu'
                )
                ->get();


        $deletedCount = 0;


        foreach ($laporans as $laporan) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS FOTO
            |--------------------------------------------------------------------------
            */

            if (
                $laporan->foto_kondisi &&
                Storage::disk('public')
                    ->exists(
                        $laporan->foto_kondisi
                    )
            ) {

                Storage::disk('public')
                    ->delete(
                        $laporan->foto_kondisi
                    );

            }


            /*
            |--------------------------------------------------------------------------
            | HAPUS LAPORAN
            |--------------------------------------------------------------------------
            */

            $laporan->delete();


            $deletedCount++;

        }


        return $deletedCount;

    }

    /*
    |--------------------------------------------------------------------------
    | MENGAMBIL SELURUH LAPORAN UNTUK ADMIN
    |--------------------------------------------------------------------------
    */

    public function getAllReports()
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
    | MENGAMBIL DETAIL LAPORAN UNTUK APPROVE
    |--------------------------------------------------------------------------
    */

    public function getApprovalData(
        int $laporanId
    ): array {

        $laporan = LaporanJanitor::query()
            ->with([
                'user',
                'ruangan',
            ])
            ->findOrFail($laporanId);


        /*
        |--------------------------------------------------------------------------
        | KOORDINAT LAPORAN
        |--------------------------------------------------------------------------
        */

        $latitudeLaporan =
            (float) $laporan->latitude;

        $longitudeLaporan =
            (float) $laporan->longitude;


        /*
        |--------------------------------------------------------------------------
        | KOORDINAT MASTER RUANGAN
        |--------------------------------------------------------------------------
        */

        $latitudeRuangan =
            (float) $laporan->ruangan->latitude;

        $longitudeRuangan =
            (float) $laporan->ruangan->longitude;


        /*
        |--------------------------------------------------------------------------
        | HITUNG JARAK
        |--------------------------------------------------------------------------
        */

        $distance =
            $this->calculateDistance(
                $latitudeLaporan,
                $longitudeLaporan,
                $latitudeRuangan,
                $longitudeRuangan
            );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI RADIUS
        |--------------------------------------------------------------------------
        */

        $isValid =
            $distance <= 3;


        return [

            'id' =>
                $laporan->id,

            'user' =>
                $laporan->user->username ?? '-',

            'created_at' =>
                $laporan->created_at?->format(
                    'd M Y H:i'
                ),

            'updated_at' =>
                $laporan->updated_at?->format(
                    'd M Y H:i'
                ),

            'foto' =>
                $laporan->foto_kondisi,

            'ruangan' =>
                $laporan->ruangan->nama_ruangan ?? '-',

            'kode_ruangan' =>
                $laporan->ruangan->kode_ruangan ?? '-',

            'latitude_laporan' =>
                $latitudeLaporan,

            'longitude_laporan' =>
                $longitudeLaporan,

            'latitude_ruangan' =>
                $latitudeRuangan,

            'longitude_ruangan' =>
                $longitudeRuangan,

            'distance' =>
                round(
                    $distance,
                    2
                ),

            'is_valid' =>
                $isValid,

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | MENGHITUNG JARAK ANTAR KOORDINAT
    |--------------------------------------------------------------------------
    */

    private function calculateDistance(
        float $latitude1,
        float $longitude1,
        float $latitude2,
        float $longitude2
    ): float {

        $earthRadius = 6371000;


        $latitudeDifference =
            deg2rad(
                $latitude2 - $latitude1
            );


        $longitudeDifference =
            deg2rad(
                $longitude2 - $longitude1
            );


        $a =
            sin(
                $latitudeDifference / 2
            ) ** 2
            +
            cos(
                deg2rad($latitude1)
            )
            *
            cos(
                deg2rad($latitude2)
            )
            *
            sin(
                $longitudeDifference / 2
            ) ** 2;


        $c =
            2 *
            atan2(
                sqrt($a),
                sqrt(1 - $a)
            );


        return
            $earthRadius * $c;

    }

    /*
    |--------------------------------------------------------------------------
    | APPROVE LAPORAN
    |--------------------------------------------------------------------------
    */

    public function approveReport(
        int $laporanId
    ): LaporanJanitor {

        $laporan = LaporanJanitor::findOrFail(
            $laporanId
        );

        $laporan->status = 'terverifikasi';

        $laporan->save();

        return $laporan->fresh([
            'ruangan',
            'user',
        ]);
    }

    public function getReportDetail(
    int $laporanId
    ): array {

        $laporan =
            LaporanJanitor::with([
                'ruangan',
                'user',
            ])->findOrFail(
                $laporanId
            );


        return [

            'id' =>
                $laporan->id,

            'user' =>
                $laporan->user->username ?? '-',

            'ruangan' =>
                $laporan->ruangan->nama_ruangan ?? '-',

            'kode_ruangan' =>
                $laporan->ruangan->kode_ruangan ?? '-',

            'foto' =>
                $laporan->foto_kondisi,

            'latitude' =>
                $laporan->latitude,

            'longitude' =>
                $laporan->longitude,

            'keterangan' =>
                $laporan->keterangan,

            'status' =>
                $laporan->status,

            'created_at' =>
                $laporan->created_at
                    ->format('d M Y H:i'),

            'updated_at' =>
                $laporan->updated_at
                    ->format('d M Y H:i'),

        ];

    }
    /*
    |--------------------------------------------------------------------------
    | UPDATE LAPORAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function updateAdminReport(
        Request $request,
        int $laporanId
    ): LaporanJanitor {

        $laporan = LaporanJanitor::findOrFail($laporanId);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'foto' => [
                'nullable',
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

            'status' => [
                'required',
                'in:menunggu,terverifikasi',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            if (
                $laporan->foto_kondisi &&
                Storage::disk('public')
                    ->exists($laporan->foto_kondisi)
            ) {

                Storage::disk('public')
                    ->delete($laporan->foto_kondisi);
            }

            $laporan->foto_kondisi =
                $request
                    ->file('foto')
                    ->store(
                        'laporan_janitor',
                        'public'
                    );
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $laporan->latitude =
            $validated['latitude'];

        $laporan->longitude =
            $validated['longitude'];

        $laporan->status =
            $validated['status'];

        $laporan->keterangan =
            $validated['keterangan'] ?? null;

        $laporan->save();

        return $laporan->fresh([
            'ruangan',
            'user',
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | DELETE LAPORAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function deleteAdminReport(
        int $laporanId
    ): void {

        $laporan = LaporanJanitor::findOrFail($laporanId);

        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO
        |--------------------------------------------------------------------------
        */

        if (
            $laporan->foto_kondisi &&
            Storage::disk('public')
                ->exists($laporan->foto_kondisi)
        ) {

            Storage::disk('public')
                ->delete($laporan->foto_kondisi);
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS LAPORAN
        |--------------------------------------------------------------------------
        */

        $laporan->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | BULK DELETE LAPORAN ADMIN
    |--------------------------------------------------------------------------
    */
    
    public function deleteSelectedAdminReports(
        Request $request
    ): int {
    
        $validated =
            $request->validate([
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
    
    
        $laporans =
            LaporanJanitor::query()
                ->whereIn(
                    'id',
                    $validated['laporan_ids']
                )
                ->get();
    
    
        $deletedCount = 0;
    
    
        foreach ($laporans as $laporan) {
    
            /*
            |--------------------------------------------------------------------------
            | HAPUS FOTO
            |--------------------------------------------------------------------------
            */
    
            if (
                $laporan->foto_kondisi &&
                Storage::disk('public')
                    ->exists(
                        $laporan->foto_kondisi
                    )
            ) {
    
                Storage::disk('public')
                    ->delete(
                        $laporan->foto_kondisi
                    );
    
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | HAPUS LAPORAN
            |--------------------------------------------------------------------------
            */
    
            $laporan->delete();
    
    
            $deletedCount++;
    
        }
    
    
        return $deletedCount;
    
    }
}

<?php

namespace App\Services\MasterRuangan;

use App\Models\MasterRuangan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MasterRuanganService
{
    /**
     * Mengambil seluruh data ruangan.
     */
    public function getRooms()
    {
        return MasterRuangan::query()
            ->orderBy('id')
            ->paginate(20);
    }

    /**
     * Mengambil kode ruangan berikutnya.
     */
    public function getNextRoomCode(): string
    {
        $lastRoom =
            MasterRuangan::query()
                ->orderByDesc('id')
                ->first();


        if (!$lastRoom) {

            $nextNumber = 1;

        } else {

            $lastNumber =
                (int) str_replace(
                    'RNG-',
                    '',
                    $lastRoom->kode_ruangan
                );

            $nextNumber =
                $lastNumber + 1;

        }


        return 'RNG-' .
            str_pad(
                $nextNumber,
                3,
                '0',
                STR_PAD_LEFT
            );
    }


    /**
     * Menambahkan ruangan baru.
     */
    public function createRoom(Request $request): MasterRuangan
    {
        $validated = $request->validate(
            [

                'nama_ruangan' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'lokasi' => [
                    'required',
                    'string',
                    'max:150',
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

            ],
            [

                'nama_ruangan.required' =>
                    'Nama ruangan wajib diisi.',

                'nama_ruangan.max' =>
                    'Nama ruangan maksimal 150 karakter.',

                'lokasi.required' =>
                    'Lokasi ruangan wajib diisi.',

                'lokasi.max' =>
                    'Lokasi maksimal 150 karakter.',

                'latitude.required' =>
                    'Latitude wajib ditentukan.',

                'latitude.numeric' =>
                    'Latitude harus berupa angka.',

                'latitude.between' =>
                    'Latitude tidak valid.',

                'longitude.required' =>
                    'Longitude wajib ditentukan.',

                'longitude.numeric' =>
                    'Longitude harus berupa angka.',

                'longitude.between' =>
                    'Longitude tidak valid.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | GENERATE KODE RUANGAN
        |--------------------------------------------------------------------------
        */

        $lastRoom =
            MasterRuangan::query()
                ->orderByDesc('id')
                ->first();


        if (!$lastRoom) {

            $nextNumber = 1;

        } else {

            $lastNumber =
                (int) str_replace(
                    'RNG-',
                    '',
                    $lastRoom->kode_ruangan
                );

            $nextNumber =
                $lastNumber + 1;

        }


        $kodeRuangan =
            'RNG-' .
            str_pad(
                $nextNumber,
                3,
                '0',
                STR_PAD_LEFT
            );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA
        |--------------------------------------------------------------------------
        */

        return MasterRuangan::create([

            'kode_ruangan' =>
                $kodeRuangan,

            'qr_code' =>
                $kodeRuangan,

            'nama_ruangan' =>
                $validated['nama_ruangan'],

            'lokasi' =>
                $validated['lokasi'],

            'latitude' =>
                $validated['latitude'],

            'longitude' =>
                $validated['longitude'],

        ]);
    }

    /**
     * Mengupdate data ruangan.
     */
    public function updateRoom(
        MasterRuangan $room,
        Request $request
    ): MasterRuangan {

        $validated =
            $request->validate(
                [

                    'nama_ruangan' => [
                        'required',
                        'string',
                        'max:150',
                    ],

                    'lokasi' => [
                        'required',
                        'string',
                        'max:150',
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

                ]
            );


        $room->update([

            'nama_ruangan' =>
                $validated['nama_ruangan'],

            'lokasi' =>
                $validated['lokasi'],

            'latitude' =>
                $validated['latitude'],

            'longitude' =>
                $validated['longitude'],

        ]);


        return $room;

    }

    /**
     * Menghapus data ruangan.
     */
    public function deleteRoom(
        MasterRuangan $room
    ): void {

        $room->delete();

    }
}
{{-- =========================================================
     RUANGAN TABLE
========================================================== --}}

@php

    $roomData = collect([

        (object) [
            'id' => 1,
            'kode_ruangan' => 'RNG-001',
            'nama_ruangan' => 'Ruang Kepala Sekolah',
            'lokasi' => 'Lantai 1',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        (object) [
            'id' => 2,
            'kode_ruangan' => 'RNG-002',
            'nama_ruangan' => 'Ruang Guru',
            'lokasi' => 'Lantai 1',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        (object) [
            'id' => 3,
            'kode_ruangan' => 'RNG-003',
            'nama_ruangan' => 'Laboratorium Komputer',
            'lokasi' => 'Lantai 1',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        (object) [
            'id' => 4,
            'kode_ruangan' => 'RNG-004',
            'nama_ruangan' => 'Ruang Kelas 1A',
            'lokasi' => 'Lantai 2',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        (object) [
            'id' => 5,
            'kode_ruangan' => 'RNG-005',
            'nama_ruangan' => 'Ruang Kelas 1B',
            'lokasi' => 'Lantai 2',
            'created_at' => now(),
            'updated_at' => now(),
        ],

    ]);


    $rooms = new \Illuminate\Pagination\LengthAwarePaginator(
        $roomData,
        $roomData->count(),
        20,
        1,
        [
            'path' => request()->url(),
            'query' => request()->query(),
        ]
    );

@endphp


{{-- =========================================================
     REUSABLE TABLE
========================================================== --}}

<x-admin.table
    :items="$rooms"
    storage-key="cleantrack_selected_room_ids"
    checkbox-class="room-checkbox"
    select-all-id="selectAllRooms"
    delete-button-id="deleteSelectedRoomsButton"
    delete-modal-id=""
    total-label="ruangan"
    min-width="820px"
>


    {{-- =====================================================
         TABLE HEADER
    ====================================================== --}}

    <x-slot:head>


        {{-- =================================================
             KODE RUANGAN
        ================================================== --}}

        <th
            class="fw-semibold"
            style="
                min-width: 130px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Kode Ruangan
        </th>


        {{-- =================================================
             NAMA RUANGAN
        ================================================== --}}

        <th
            class="fw-semibold"
            style="
                min-width: 220px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Nama Ruangan
        </th>


        {{-- =================================================
             LOKASI
        ================================================== --}}

        <th
            class="fw-semibold"
            style="
                min-width: 140px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Lokasi
        </th>


        {{-- =================================================
             CREATED AT
        ================================================== --}}

        <th
            class="fw-semibold"
            style="
                min-width: 160px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Created At
        </th>


        {{-- =================================================
             UPDATED AT
        ================================================== --}}

        <th
            class="fw-semibold"
            style="
                min-width: 160px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Updated At
        </th>


        {{-- =================================================
             AKSI
        ================================================== --}}

        <th
            class="fw-semibold text-end"
            style="
                width: 120px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Aksi
        </th>

    </x-slot:head>


    {{-- =====================================================
         TABLE BODY
    ====================================================== --}}

    <x-slot:body>

        @forelse ($rooms as $index => $room)

            <tr>


                {{-- =================================================
                     CHECKBOX
                ================================================== --}}

                <td class="text-center">

                    <input
                        type="checkbox"
                        value="{{ $room->id }}"
                        class="form-check-input room-checkbox m-0"
                        style="
                            width: 16px;
                            height: 16px;
                            cursor: pointer;
                        "
                        aria-label="Pilih {{ $room->nama_ruangan }}"
                    >

                </td>


                {{-- =================================================
                     NO
                ================================================== --}}

                <td
                    style="
                        color: #6c7583;
                        font-size: 13px;
                    "
                >
                    {{ $index + 1 }}
                </td>


                {{-- =================================================
                     KODE RUANGAN
                ================================================== --}}

                <td>

                    <span
                        class="fw-semibold"
                        style="
                            color: #252a31;
                            font-size: 13px;
                        "
                    >
                        {{ $room->kode_ruangan }}
                    </span>

                </td>


                {{-- =================================================
                     NAMA RUANGAN
                ================================================== --}}

                <td>

                    <span
                        style="
                            color: #252a31;
                            font-size: 13px;
                        "
                    >
                        {{ $room->nama_ruangan }}
                    </span>

                </td>


                {{-- =================================================
                     LOKASI
                ================================================== --}}

                <td
                    style="
                        color: #6c7583;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >
                    {{ $room->lokasi }}
                </td>


                {{-- =================================================
                     CREATED AT
                ================================================== --}}

                <td
                    style="
                        color: #6c7583;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >
                    {{ $room->created_at->format('d M Y, H:i') }}
                </td>


                {{-- =================================================
                     UPDATED AT
                ================================================== --}}

                <td
                    style="
                        color: #6c7583;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >
                    {{ $room->updated_at->format('d M Y, H:i') }}
                </td>


                {{-- =================================================
                     AKSI
                ================================================== --}}

                <td class="text-end">

                    <div
                        class="d-inline-flex align-items-center gap-2"
                    >

                        {{-- EDIT --}}

                        <button
                            type="button"
                            class="btn btn-sm d-inline-flex align-items-center justify-content-center room-action-edit"
                            title="Edit ruangan"
                            aria-label="Edit ruangan"
                            style="
                                width: 34px;
                                height: 34px;
                                padding: 0;
                                border: 1px solid #dfe5ee;
                                border-radius: 8px;
                                background: #ffffff;
                                color: #3478f6;
                                font-size: 14px;
                            "
                        >
                            <i class="bi bi-pencil"></i>
                        </button>


                        {{-- DELETE --}}

                        <button
                            type="button"
                            class="btn btn-sm d-inline-flex align-items-center justify-content-center room-action-delete"
                            title="Hapus ruangan"
                            aria-label="Hapus ruangan"
                            style="
                                width: 34px;
                                height: 34px;
                                padding: 0;
                                border: 1px solid #f1d9dc;
                                border-radius: 8px;
                                background: #ffffff;
                                color: #dc3545;
                                font-size: 14px;
                            "
                        >
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td
                    colspan="8"
                    class="text-center"
                    style="
                        padding: 40px 20px;
                        color: #98a1b2;
                        font-size: 13px;
                    "
                >
                    Belum ada ruangan.
                </td>

            </tr>

        @endforelse

    </x-slot:body>

</x-admin.table>


{{-- =========================================================
     STYLE
========================================================== --}}

<style>

    .room-action-edit:hover {
        background: #f5f8ff !important;
        border-color: #cbdcff !important;
    }


    .room-action-delete:hover {
        background: #fff5f5 !important;
        border-color: #f1c5ca !important;
    }

</style>
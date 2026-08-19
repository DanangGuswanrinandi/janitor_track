{{-- =========================================================
     REUSABLE TABLE
========================================================== --}}

<x-admin.table
    :items="$rooms"
    storage-key="cleantrack_selected_room_ids"
    checkbox-class="room-checkbox"
    select-all-id="selectAllRooms"
    delete-button-id="deleteSelectedRoomsButton"
    delete-modal-id="deleteSelectedRoomsModal"
    total-label="ruangan"
    min-width="1100px"
>


    {{-- =====================================================
         TABLE HEADER
    ====================================================== --}}

    <x-slot:head>


        {{-- =================================================
             NO
        ================================================== --}}

        <th
            class="fw-semibold"
            style="
                width: 60px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            No
        </th>


        {{-- =================================================
             KODE RUANGAN
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
             KOORDINAT
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
            Koordinat
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

            <tr data-room-id="{{ $room->id }}">

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
                    {{ $rooms->firstItem() + $index }}
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
                     KOORDINAT
                ================================================== --}}

                <td
                    style="
                        color: #6c7583;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >

                    {{ $room->latitude }},
                    {{ $room->longitude }}

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
                    {{ $room->created_at?->format('d M Y, H:i') }}
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
                    {{ $room->updated_at?->format('d M Y, H:i') }}
                </td>


                {{-- =================================================
                     AKSI
                ================================================== --}}

                <td class="text-end">

                    <div
                        class="d-inline-flex align-items-center gap-2"
                    >

                        {{-- =================================================
                             EDIT
                        ================================================== --}}

                        <button
                            type="button"
                            class="
                                btn
                                btn-sm
                                d-inline-flex
                                align-items-center
                                justify-content-center
                                room-action-edit
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#editRoomModal"

                            data-room-id="{{ $room->id }}"
                            data-kode-ruangan="{{ $room->kode_ruangan }}"
                            data-nama-ruangan="{{ $room->nama_ruangan }}"
                            data-lokasi="{{ $room->lokasi }}"
                            data-latitude="{{ $room->latitude }}"
                            data-longitude="{{ $room->longitude }}"

                            title="Edit ruangan"
                            aria-label="Edit ruangan"

                            style="
                                width: 34px;
                                height: 34px;
                                padding: 0;
                                border: 1px solid #dfe5ee;
                                border-radius: 8px;
                                background: #ffffff;
                                color: #f5c542;
                                font-size: 14px;
                            "
                        >
                            <i class="bi bi-pencil"></i>
                        </button>


                        {{-- =================================================
                             DELETE
                        ================================================== --}}

                        <button
                            type="button"
                            class="
                                btn
                                btn-sm
                                d-inline-flex
                                align-items-center
                                justify-content-center
                                room-action-delete
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#deleteRoomModal"

                            data-room-id="{{ $room->id }}"
                            data-nama-ruangan="{{ $room->nama_ruangan }}"
                            data-kode-ruangan="{{ $room->kode_ruangan }}"

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

                        {{-- =================================================
                                VIEW
                        ================================================== --}}

                        <button
                            type="button"
                            class="
                                btn
                                btn-sm
                                d-inline-flex
                                align-items-center
                                justify-content-center
                                room-action-view
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#viewRoomModal"

                            data-room-id="{{ $room->id }}"
                            data-kode-ruangan="{{ $room->kode_ruangan }}"
                            data-qr-code="{{ $room->qr_code }}"
                            data-nama-ruangan="{{ $room->nama_ruangan }}"
                            data-lokasi="{{ $room->lokasi }}"
                            data-latitude="{{ $room->latitude }}"
                            data-longitude="{{ $room->longitude }}"
                            data-created-at="{{ $room->created_at?->format('d M Y, H:i') }}"
                            data-updated-at="{{ $room->updated_at?->format('d M Y, H:i') }}"

                            title="Lihat ruangan"
                            aria-label="Lihat ruangan"

                            style="
                                width: 34px;
                                height: 34px;
                                padding: 0;
                                border: 1px solid #f1d9dc;
                                border-radius: 8px;
                                background: #ffffff;
                                color: #2e39db;
                                font-size: 14px;
                            "
                        >
                            <i class="bi bi-eye"></i>
                        </button>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td
                    colspan="9"
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

    /*
    |--------------------------------------------------------------------------
    | EDIT BUTTON
    |--------------------------------------------------------------------------
    */

    .room-action-edit:hover {
        background: #fff9e6 !important;
        border-color: #f5df9a !important;
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE BUTTON
    |--------------------------------------------------------------------------
    */

    .room-action-delete:hover {
        background: #fff5f5 !important;
        border-color: #f1c5ca !important;
    }

    /*
    |--------------------------------------------------------------------------
    | VIEW BUTTON
    |--------------------------------------------------------------------------
    */

    .room-action-view:hover {
        background: #f5f8ff !important;
        border-color: #cbdcff !important;
    }

</style>

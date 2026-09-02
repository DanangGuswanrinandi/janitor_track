{{-- =========================================================
     KELOLA LAPORAN TABLE
========================================================== --}}

<x-admin.table
    :items="$laporans"
    storage-key="cleantrack_kelola_laporan"
    checkbox-class="kelola-laporan-checkbox"
    select-all-id="selectAllKelolaLaporan"
    delete-button-id="deleteSelectedKelolaLaporanButton"
    delete-modal-id="deleteSelectedKelolaLaporanModal"
    total-label="laporan"
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
             NAMA USER
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
            Nama User
        </th>


        {{-- =================================================
             RUANGAN
        ================================================== --}}

        <th
            class="fw-semibold"
            style="
                min-width: 180px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Ruangan
        </th>


        {{-- =================================================
             FOTO
        ================================================== --}}

        <th
            class="fw-semibold"
            style="
                min-width: 120px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Foto
        </th>


        {{-- =================================================
             TANGGAL
        ================================================== --}}

        <th
            class="fw-semibold"
            style="
                min-width: 180px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Tanggal
        </th>


        {{-- =================================================
             STATUS
        ================================================== --}}

        <th
            class="fw-semibold text-center"
            style="
                min-width: 130px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Status
        </th>


        {{-- =================================================
             AKSI
        ================================================== --}}

        <th
            class="fw-semibold text-center"
            style="
                width: 140px;
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


        @forelse ($laporans as $index => $laporan)

            <tr>


                {{-- =================================================
                     CHECKBOX
                ================================================== --}}

                <td
                    class="text-center"
                    style="
                        width: 50px;
                    "
                >

                    <input
                        type="checkbox"
                        value="{{ $laporan->id }}"
                        class="form-check-input kelola-laporan-checkbox m-0"
                        style="
                            width: 16px;
                            height: 16px;
                            cursor: pointer;
                        "
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

                    {{ $laporans->firstItem() + $index }}

                </td>


                {{-- =================================================
                     NAMA USER
                ================================================== --}}

                <td>

                    <div
                        class="fw-semibold"
                        style="
                            color: #252a31;
                            font-size: 13px;
                        "
                    >

                        {{ $laporan->user->username ?? '-' }}

                    </div>

                </td>


                {{-- =================================================
                     RUANGAN
                ================================================== --}}

                <td>

                    <div
                        class="fw-semibold"
                        style="
                            color: #252a31;
                            font-size: 13px;
                        "
                    >

                        {{ $laporan->ruangan->nama_ruangan ?? '-' }}

                    </div>


                    <div
                        class="mt-1"
                        style="
                            color: #98a1b2;
                            font-size: 11px;
                        "
                    >

                        {{ $laporan->ruangan->kode_ruangan ?? '-' }}

                    </div>

                </td>


                {{-- =================================================
                     FOTO
                ================================================== --}}

                <td>

                    @if ($laporan->foto_kondisi)

                        <img
                            src="{{ asset('storage/' . $laporan->foto_kondisi) }}"
                            alt="Foto kondisi laporan"
                            style="
                                width: 70px;
                                height: 55px;
                                object-fit: cover;
                                border-radius: 8px;
                                border: 1px solid #dfe5ee;
                            "
                        >

                    @else

                        <span
                            style="
                                color: #98a1b2;
                                font-size: 12px;
                            "
                        >
                            Tidak ada foto
                        </span>

                    @endif

                </td>


                {{-- =================================================
                     TANGGAL
                ================================================== --}}

                <td>

                    <div
                        style="
                            color: #5f6875;
                            font-size: 12px;
                            white-space: nowrap;
                        "
                    >

                        <strong>
                            Dibuat:
                        </strong>

                        {{ $laporan->created_at->format('d M Y H:i') }}

                    </div>


                    <div
                        class="mt-1"
                        style="
                            color: #98a1b2;
                            font-size: 11px;
                            white-space: nowrap;
                        "
                    >

                        <strong>
                            Diubah:
                        </strong>

                        {{ $laporan->updated_at->format('d M Y H:i') }}

                    </div>

                </td>


                {{-- =================================================
                     STATUS
                ================================================== --}}
                            
                <td class="text-center">
                
                    @if ($laporan->status === 'menunggu')
                
                        <button
                            type="button"
                            class="
                                btn
                                btn-sm
                                d-inline-flex
                                align-items-center
                                justify-content-center
                                kelola-laporan-action-approve
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#approveLaporanModal"
                            data-laporan-id="{{ $laporan->id }}"
                            title="Approve laporan"
                            aria-label="Approve laporan"
                            style="
                                min-width: 82px;
                                min-height: 32px;
                                padding: 6px 12px;
                                border: 0;
                                border-radius: 8px;
                                background: #3478f6;
                                color: #ffffff;
                                font-size: 12px;
                                font-weight: 600;
                            "
                        >
                
                            <i class="bi bi-check-circle me-1"></i>
                
                            Approve
                
                        </button>
                    
                    @else
                    
                        <span
                            class="d-inline-flex align-items-center"
                            style="
                                min-height: 28px;
                                padding: 5px 10px;
                                border-radius: 7px;
                                background: #eaf8ef;
                                color: #218838;
                                font-size: 11px;
                                font-weight: 600;
                                white-space: nowrap;
                            "
                        >
                    
                            <i class="bi bi-check-circle me-1"></i>
                    
                            Terverifikasi
                    
                        </span>
                    
                    @endif
                    
                </td>


                {{-- =================================================
                     AKSI
                ================================================== --}}

                <td class="text-center">

                    <div
                        class="d-inline-flex align-items-center gap-2"
                    >


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
                                kelola-laporan-action-view
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#viewKelolaLaporanModal"
                            data-laporan-id="{{ $laporan->id }}"
                            title="Lihat laporan"
                            aria-label="Lihat laporan"
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

                            <i class="bi bi-eye"></i>

                        </button>


                        {{-- =================================================
                             UPDATE
                        ================================================== --}}

                        <button
                            type="button"
                            class="
                                btn
                                btn-sm
                                d-inline-flex
                                align-items-center
                                justify-content-center
                                kelola-laporan-action-edit
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#editKelolaLaporanModal"
                            data-laporan-id="{{ $laporan->id }}"
                            title="Edit laporan"
                            aria-label="Edit laporan"
                            style="
                                width: 34px;
                                height: 34px;
                                padding: 0;
                                border: 1px solid #dfe5ee;
                                border-radius: 8px;
                                background: #ffffff;
                                color: #f5a623;
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
                                kelola-laporan-action-delete
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#deleteKelolaLaporanModal"
                            data-laporan-id="{{ $laporan->id }}"
                            title="Hapus laporan"
                            aria-label="Hapus laporan"
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

                    Belum ada laporan.

                </td>

            </tr>


        @endforelse


    </x-slot:body>


</x-admin.table>

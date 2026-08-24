{{-- =========================================================
     LAPORAN TABLE
========================================================== --}}

<x-admin.table
    :items="$laporans"
    storage-key="cleantrack_laporan"
    checkbox-class="laporan-checkbox"
    select-all-id="selectAllLaporan"
    delete-button-id="deleteSelectedLaporanButton"
    delete-modal-id=""
    total-label="laporan"
    min-width="1100px"
>

    {{-- =====================================================
         TABLE HEADER
    ====================================================== --}}

    <x-slot:head>

        {{-- NO --}}

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


        {{-- RUANGAN --}}

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


        {{-- PELAPOR --}}

        <th
            class="fw-semibold"
            style="
                min-width: 150px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Pelapor
        </th>


        {{-- FOTO --}}

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


        {{-- LOKASI --}}

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


        {{-- KETERANGAN --}}

        <th
            class="fw-semibold"
            style="
                min-width: 220px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Keterangan
        </th>


        {{-- WAKTU --}}

        <th
            class="fw-semibold"
            style="
                min-width: 160px;
                color: #5f6875;
                font-size: 13px;
                white-space: nowrap;
            "
        >
            Waktu
        </th>

    </x-slot:head>


    {{-- =====================================================
         TABLE BODY
    ====================================================== --}}

    <x-slot:body>

        @forelse ($laporans as $index => $laporan)

            <tr>

                 {{-- CHECKBOX --}}

                <td
                    style="
                        width: 50px;
                        text-align: center;
                    "
                >
                    
                    <input
                        type="checkbox"
                        class="form-check-input laporan-checkbox"
                        value="{{ $laporan->id }}"
                    >
                    
                </td>

                {{-- NO --}}

                <td
                    style="
                        color: #6c7583;
                        font-size: 13px;
                    "
                >
                    {{ $laporans->firstItem() + $index }}
                </td>


                {{-- RUANGAN --}}

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


                {{-- PELAPOR --}}

                <td>

                    <span
                        class="fw-semibold"
                        style="
                            color: #252a31;
                            font-size: 13px;
                        "
                    >
                        {{ $laporan->user->username ?? '-' }}
                    </span>

                </td>


                {{-- FOTO --}}

                <td>

                    @if ($laporan->foto_kondisi)

                        <img
                            src="{{ asset('storage/' . $laporan->foto_kondisi) }}"
                            alt="Foto kondisi ruangan"
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


                {{-- KOORDINAT --}}

                <td>

                    <div
                        style="
                            color: #5f6875;
                            font-size: 12px;
                        "
                    >
                        <strong>
                            Lat:
                        </strong>
                        {{ $laporan->latitude }}
                    </div>


                    <div
                        class="mt-1"
                        style="
                            color: #5f6875;
                            font-size: 12px;
                        "
                    >
                        <strong>
                            Long:
                        </strong>
                        {{ $laporan->longitude }}
                    </div>

                </td>


                {{-- KETERANGAN --}}

                <td>

                    @if ($laporan->keterangan)

                        <span
                            style="
                                color: #5f6875;
                                font-size: 12px;
                            "
                        >
                            {{ $laporan->keterangan }}
                        </span>

                    @else

                        <span
                            style="
                                color: #98a1b2;
                                font-size: 12px;
                            "
                        >
                            Tidak ada keterangan
                        </span>

                    @endif

                </td>


                {{-- WAKTU --}}

                <td>

                    <div
                        style="
                            color: #5f6875;
                            font-size: 12px;
                        "
                    >
                        {{ $laporan->created_at->format('d M Y') }}
                    </div>


                    <div
                        class="mt-1"
                        style="
                            color: #98a1b2;
                            font-size: 11px;
                        "
                    >
                        {{ $laporan->created_at->format('H:i') }}
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

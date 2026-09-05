{{-- =========================================================
     VERIFIKASI LAPORAN TABLE
========================================================== --}}

<x-admin.table
    :items="$laporans"
    :show-selection="false"
    total-label="laporan"
    min-width="900px"
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


        {{-- NAMA USER --}}
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


        {{-- TANGGAL --}}
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


        {{-- STATUS --}}
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

    </x-slot:head>


    {{-- =====================================================
         TABLE BODY
    ====================================================== --}}

    <x-slot:body>

        @forelse ($laporans as $index => $laporan)

            <tr>

                {{-- NO --}}
                <td
                    style="
                        color: #6c7583;
                        font-size: 13px;
                    "
                >
                    {{ $laporans->firstItem() + $index }}
                </td>


                {{-- NAMA USER --}}
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


                {{-- FOTO --}}
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


                {{-- TANGGAL --}}
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


                {{-- STATUS --}}
                <td class="text-center">

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

                </td>

            </tr>

        @empty

            <tr>

                <td
                    colspan="6"
                    class="text-center py-5"
                >

                    <div
                        style="
                            color: #98a1b2;
                            font-size: 13px;
                        "
                    >

                        <i
                            class="bi bi-check-circle d-block mb-2"
                            style="font-size: 28px;"
                        ></i>

                        Tidak ada laporan yang menunggu verifikasi.

                    </div>

                </td>

            </tr>

        @endforelse

    </x-slot:body>

</x-admin.table>

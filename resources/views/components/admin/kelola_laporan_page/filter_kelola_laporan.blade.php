{{-- =========================================================
     FILTER KELOLA LAPORAN
========================================================= --}}

<form
    method="GET"
    action="{{ route('admin.kelola-laporan') }}"
    id="filterKelolaLaporanForm"
>

    <div
        class="w-100 p-3 mb-4 bg-white"
        style="
            border: 1px solid #edf0f5;
            border-radius: 12px;

        "
    >

        <div
            class="d-flex align-items-center justify-content-between gap-3 flex-wrap"
        >

            {{-- =================================================
                 MENU FILTER
            ================================================== --}}

            <div
                class="d-flex align-items-center gap-3 flex-wrap"
                style="flex: 1;"
            >

                {{-- =================================================
                     NAMA USER
                ================================================== --}}

                <div class="filter-item">

                    <label
                        class="d-flex align-items-center gap-2 mb-0"
                        style="
                            color: #5f6875;
                            font-size: 13px;
                            cursor: pointer;
                        "
                    >

                        <input
                            type="checkbox"
                            class="form-check-input filter-checkbox m-0"
                            data-target="filterUser"
                            style="
                                width: 16px;
                                height: 16px;
                                cursor: pointer;
                            "
                            @checked(request()->filled('user_id'))
                        >

                        <span>
                            Nama User
                        </span>

                    </label>


                    <div
                        id="filterUser"
                        class="filter-input-wrapper mt-2"
                        style="
                            display: none;
                            min-width: 180px;
                        "
                    >

                        <select
                            name="user_id"
                            class="form-select form-select-sm"
                            style="
                                font-size: 12px;
                                border-radius: 8px;
                            "
                        >

                            <option value="">
                                Pilih Nama User
                            </option>

                            @foreach ($users as $user)

                                <option
                                    value="{{ $user->id }}"
                                    @selected(
                                        (string) request('user_id') ===
                                        (string) $user->id
                                    )
                                >
                                    {{ $user->username }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- =================================================
                     NAMA RUANGAN
                ================================================== --}}

                <div class="filter-item">

                    <label
                        class="d-flex align-items-center gap-2 mb-0"
                        style="
                            color: #5f6875;
                            font-size: 13px;
                            cursor: pointer;
                        "
                    >

                        <input
                            type="checkbox"
                            class="form-check-input filter-checkbox m-0"
                            data-target="filterRuangan"
                            style="
                                width: 16px;
                                height: 16px;
                                cursor: pointer;
                            "
                            @checked(request()->filled('ruangan_id'))
                        >

                        <span>
                            Nama Ruangan
                        </span>

                    </label>


                    <div
                        id="filterRuangan"
                        class="filter-input-wrapper mt-2"
                        style="
                            display: none;
                            min-width: 180px;
                        "
                    >

                        <select
                            name="ruangan_id"
                            class="form-select form-select-sm"
                            style="
                                font-size: 12px;
                                border-radius: 8px;
                            "
                        >

                            <option value="">
                                Pilih Nama Ruangan
                            </option>

                            @foreach ($ruangans as $ruangan)

                                <option
                                    value="{{ $ruangan->id }}"
                                    @selected(
                                        (string) request('ruangan_id') ===
                                        (string) $ruangan->id
                                    )
                                >
                                    {{ $ruangan->nama_ruangan }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- =================================================
                     BULAN
                ================================================== --}}

                <div class="filter-item">

                    <label
                        class="d-flex align-items-center gap-2 mb-0"
                        style="
                            color: #5f6875;
                            font-size: 13px;
                            cursor: pointer;
                        "
                    >

                        <input
                            type="checkbox"
                            class="form-check-input filter-checkbox m-0"
                            data-target="filterBulan"
                            style="
                                width: 16px;
                                height: 16px;
                                cursor: pointer;
                            "
                            @checked(request()->filled('bulan'))
                        >

                        <span>
                            Bulan
                        </span>

                    </label>


                    <div
                        id="filterBulan"
                        class="filter-input-wrapper mt-2"
                        style="
                            display: none;
                            min-width: 150px;
                        "
                    >

                        <select
                            name="bulan"
                            class="form-select form-select-sm"
                            style="
                                font-size: 12px;
                                border-radius: 8px;
                            "
                        >

                            <option value="">
                                Pilih Bulan
                            </option>

                            @php
                                $bulanList = [
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember',
                                ];
                            @endphp

                            @foreach ($bulanList as $nomor => $nama)

                                <option
                                    value="{{ $nomor }}"
                                    @selected(
                                        (string) request('bulan') ===
                                        (string) $nomor
                                    )
                                >
                                    {{ $nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- =================================================
                     TAHUN
                ================================================== --}}

                <div class="filter-item">

                    <label
                        class="d-flex align-items-center gap-2 mb-0"
                        style="
                            color: #5f6875;
                            font-size: 13px;
                            cursor: pointer;
                        "
                    >

                        <input
                            type="checkbox"
                            class="form-check-input filter-checkbox m-0"
                            data-target="filterTahun"
                            style="
                                width: 16px;
                                height: 16px;
                                cursor: pointer;
                            "
                            @checked(request()->filled('tahun'))
                        >

                        <span>
                            Tahun
                        </span>

                    </label>


                    <div
                        id="filterTahun"
                        class="filter-input-wrapper mt-2"
                        style="
                            display: none;
                            min-width: 120px;
                        "
                    >

                        <select
                            name="tahun"
                            class="form-select form-select-sm"
                            style="
                                font-size: 12px;
                                border-radius: 8px;
                            "
                        >

                            <option value="">
                                Pilih Tahun
                            </option>

                            @foreach ($years as $year)

                                <option
                                    value="{{ $year }}"
                                    @selected(
                                        (string) request('tahun') ===
                                        (string) $year
                                    )
                                >
                                    {{ $year }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- =================================================
                     TANGGAL
                ================================================== --}}

                <div class="filter-item">

                    <label
                        class="d-flex align-items-center gap-2 mb-0"
                        style="
                            color: #5f6875;
                            font-size: 13px;
                            cursor: pointer;
                        "
                    >

                        <input
                            type="checkbox"
                            class="form-check-input filter-checkbox m-0"
                            data-target="filterTanggal"
                            style="
                                width: 16px;
                                height: 16px;
                                cursor: pointer;
                            "
                            @checked(request()->filled('tanggal'))
                        >

                        <span>
                            Tanggal
                        </span>

                    </label>


                    <div
                        id="filterTanggal"
                        class="filter-input-wrapper mt-2"
                        style="
                            display: none;
                            min-width: 150px;
                        "
                    >

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ request('tanggal') }}"
                            class="form-control form-control-sm"
                            style="
                                font-size: 12px;
                                border-radius: 8px;
                            "
                        >

                    </div>

                </div>


                {{-- =================================================
                     STATUS
                ================================================== --}}

                <div class="filter-item">

                    <label
                        class="d-flex align-items-center gap-2 mb-0"
                        style="
                            color: #5f6875;
                            font-size: 13px;
                            cursor: pointer;
                        "
                    >

                        <input
                            type="checkbox"
                            class="form-check-input filter-checkbox m-0"
                            data-target="filterStatus"
                            style="
                                width: 16px;
                                height: 16px;
                                cursor: pointer;
                            "
                            @checked(request()->filled('status'))
                        >

                        <span>
                            Status
                        </span>

                    </label>


                    <div
                        id="filterStatus"
                        class="filter-input-wrapper mt-2"
                        style="
                            display: none;
                            min-width: 150px;
                        "
                    >

                        <select
                            name="status"
                            class="form-select form-select-sm"
                            style="
                                font-size: 12px;
                                border-radius: 8px;
                            "
                        >

                            <option value="">
                                Pilih Status
                            </option>

                            <option
                                value="menunggu"
                                @selected(
                                    request('status') === 'menunggu'
                                )
                            >
                                Menunggu
                            </option>

                            <option
                                value="terverifikasi"
                                @selected(
                                    request('status') === 'terverifikasi'
                                )
                            >
                                Terverifikasi
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 TOMBOL FILTER
            ================================================== --}}

            <div class="flex-shrink-0">

                <button
                    type="submit"
                    class="btn text-white fw-semibold d-inline-flex align-items-center gap-2"
                    style="
                        min-height: 38px;
                        padding: 8px 16px;
                        border: 0;
                        border-radius: 8px;
                        background: #3478f6;
                        font-size: 12px;
                    "
                >

                    <i class="bi bi-funnel"></i>

                    <span>
                        Filter
                    </span>

                </button>

            </div>

        </div>

    </div>

</form>


{{-- =========================================================
     FILTER SCRIPT
========================================================= --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const checkboxes =
                document.querySelectorAll(
                    '.filter-checkbox'
                );


            checkboxes.forEach(
                function (checkbox) {

                    const targetId =
                        checkbox.dataset.target;

                    const target =
                        document.getElementById(
                            targetId
                        );


                    if (!target) {
                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Tampilkan input jika checkbox aktif
                    |--------------------------------------------------------------------------
                    */

                    function updateFilterVisibility() {

                        target.style.display =
                            checkbox.checked
                                ? 'block'
                                : 'none';


                        /*
                        |--------------------------------------------------------------------------
                        | Jika checkbox dibatalkan,
                        | kosongkan nilai filter
                        |--------------------------------------------------------------------------
                        */

                        if (!checkbox.checked) {

                            const input =
                                target.querySelector(
                                    'input, select'
                                );


                            if (input) {
                                input.value = '';
                            }

                        }

                    }


                    checkbox.addEventListener(
                        'change',
                        updateFilterVisibility
                    );


                    updateFilterVisibility();

                }
            );

        }
    );

</script>

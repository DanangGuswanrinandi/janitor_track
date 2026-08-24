@extends('layouts.user.app')

@section(
    'title',
    'Laporan - ' . $ruangan->nama_ruangan
)

@section(
    'navbar-title',
    'Laporan - ' . $ruangan->nama_ruangan
)

@section(
    'navbar-subtitle',
    'Buat laporan kebersihan ruangan.'
)

@section('content')

    <div class="w-100">

        {{-- =====================================================
             BREADCRUMBS
        ====================================================== --}}

        <nav
            aria-label="breadcrumb"
            style="
                --bs-breadcrumb-divider: '>';
            "
        >

            <ol
                class="breadcrumb mb-3"
                style="
                    font-size: 13px;
                "
            >

                <li class="breadcrumb-item">

                    <a
                        href="{{ route('user.buat-laporan') }}"
                        class="text-decoration-none"
                        style="
                            color: #3478f6;
                        "
                    >
                        Buat Laporan
                    </a>

                </li>

                <li
                    class="breadcrumb-item active"
                    aria-current="page"
                    style="
                        color: #98a1b2;
                    "
                >
                    {{ $ruangan->nama_ruangan }}

                </li>

            </ol>

        </nav>


        {{-- =====================================================
             PAGE CARD
        ====================================================== --}}

        <div
            class="p-4 bg-white"
            style="
                border: 1px solid #edf0f5;
                border-radius: 14px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            "
        >

            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div>

                <h2
                    class="m-0 fw-bold"
                    style="
                        color: #20252b;
                        font-size: 24px;
                    "
                >
                    Laporan
                </h2>


                <p
                    class="mt-2 mb-0"
                    style="
                        color: #98a1b2;
                        font-size: 13px;
                    "
                >
                    Ruangan:
                    {{ $ruangan->nama_ruangan }}
                </p>


                <div
                    class="mt-2"
                    style="
                        color: #6c7583;
                        font-size: 13px;
                    "
                >

                    Kode Ruangan:

                    <strong>
                        {{ $ruangan->kode_ruangan }}
                    </strong>

                </div>

            </div>


            <hr
                class="my-4"
                style="
                    border-color: #edf0f5;
                    opacity: 1;
                "
            >


            {{-- =================================================
                 FORM
            ================================================== --}}

            <form
                id="reportForm"
                method="POST"
                action="{{ route('user.laporan.store', $ruangan->kode_ruangan) }}"
                enctype="multipart/form-data"
            >

            @csrf

                {{-- =================================================
                     FOTO
                ================================================== --}}

                <div class="mb-4">

                    <label
                        for="reportPhoto"
                        class="form-label mb-2 fw-semibold"
                        style="
                            color: #3c4450;
                            font-size: 13px;
                        "
                    >
                        Foto Kondisi Ruangan
                    </label>


                    {{-- =================================================
                         UPLOAD AREA
                    ================================================== --}}

                    <label
                        for="reportPhoto"
                        class="d-flex flex-column align-items-center justify-content-center text-center"
                        style="
                            width: 100%;
                            min-height: 150px;
                            padding: 20px;
                            border: 1px dashed #cfd7e3;
                            border-radius: 10px;
                            background: #fafbfd;
                            cursor: pointer;
                        "
                    >

                        <i
                            class="bi bi-camera"
                            style="
                                color: #3478f6;
                                font-size: 28px;
                            "
                        ></i>


                        <span
                            class="mt-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Pilih Foto
                        </span>


                        <span
                            class="mt-1"
                            style="
                                color: #98a1b2;
                                font-size: 11px;
                            "
                        >
                            Ambil atau pilih foto kondisi ruangan.
                        </span>

                    </label>


                    <input
                        type="file"
                        id="reportPhoto"
                        name="foto"
                        class="d-none"
                        accept="image/*"
                    >


                    {{-- =================================================
                         PHOTO PREVIEW
                    ================================================== --}}

                    <div
                        id="reportPhotoPreviewContainer"
                        class="mt-3 d-none"
                    >

                        <div
                            class="mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 12px;
                            "
                        >
                            Preview Foto
                        </div>


                        <img
                            id="reportPhotoPreview"
                            src=""
                            alt="Preview foto laporan"
                            style="
                                display: block;
                                width: 220px;
                                height: 160px;
                                object-fit: cover;
                                border-radius: 10px;
                                border: 1px solid #dfe5ee;
                            "
                        >

                    </div>

                </div>


                {{-- =================================================
                     LOKASI
                ================================================== --}}

                <div class="mb-4">

                    <label
                        class="form-label mb-2 fw-semibold"
                        style="
                            color: #3c4450;
                            font-size: 13px;
                        "
                    >
                        Lokasi Saat Membuat Laporan
                    </label>


                    <div class="row g-3">

                        {{-- =================================================
                             LATITUDE
                        ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="reportLatitude"
                                class="form-label mb-1"
                                style="
                                    color: #6c7583;
                                    font-size: 11px;
                                "
                            >
                                Latitude
                            </label>


                            <input
                                type="text"
                                id="reportLatitude"
                                name="latitude"
                                class="form-control"
                                placeholder="Mengambil lokasi..."
                                readonly
                                style="
                                    min-height: 44px;
                                    border-radius: 9px;
                                    background: #f5f7fa;
                                    color: #667080;
                                    font-size: 12px;
                                "
                            >

                        </div>


                        {{-- =================================================
                             LONGITUDE
                        ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="reportLongitude"
                                class="form-label mb-1"
                                style="
                                    color: #6c7583;
                                    font-size: 11px;
                                "
                            >
                                Longitude
                            </label>


                            <input
                                type="text"
                                id="reportLongitude"
                                name="longitude"
                                class="form-control"
                                placeholder="Mengambil lokasi..."
                                readonly
                                style="
                                    min-height: 44px;
                                    border-radius: 9px;
                                    background: #f5f7fa;
                                    color: #667080;
                                    font-size: 12px;
                                "
                            >

                        </div>

                    </div>


                    {{-- =================================================
                         CURRENT LOCATION BUTTON
                    ================================================== --}}

                    <button
                        type="button"
                        id="useCurrentReportLocation"
                        class="btn mt-3 fw-semibold d-flex align-items-center justify-content-center gap-2"
                        style="
                            min-height: 40px;
                            padding: 8px 15px;
                            border: 1px solid #cfe2ff;
                            border-radius: 9px;
                            background: #ffffff;
                            color: #3478f6;
                            font-size: 12px;
                        "
                    >

                        <i class="bi bi-geo-alt"></i>

                        <span>
                            Gunakan Lokasi Saya
                        </span>

                    </button>


                    <div
                        id="reportLocationStatus"
                        class="mt-2"
                        style="
                            color: #98a1b2;
                            font-size: 11px;
                        "
                    >
                        Mengambil lokasi saat ini...
                    </div>

                </div>


                {{-- =================================================
                     KETERANGAN
                ================================================== --}}

                <div class="mb-4">

                    <label
                        for="reportDescription"
                        class="form-label mb-2 fw-semibold"
                        style="
                            color: #3c4450;
                            font-size: 13px;
                        "
                    >
                        Keterangan Tambahan
                        <span
                            class="fw-normal"
                            style="
                                color: #98a1b2;
                                font-size: 11px;
                            "
                        >
                            (Opsional)
                        </span>
                    </label>


                    <textarea
                        id="reportDescription"
                        name="keterangan"
                        class="form-control"
                        rows="4"
                        placeholder="Tambahkan keterangan jika diperlukan..."
                        style="
                            resize: vertical;
                            border-radius: 9px;
                            padding: 11px 13px;
                            color: #252a31;
                            font-size: 13px;
                            box-shadow: none;
                        "
                    ></textarea>

                </div>


                {{-- =================================================
                     SUBMIT
                ================================================== --}}

                <div
                    class="d-flex justify-content-end"
                >

                    <button
                        type="submit"
                        class="btn fw-semibold text-white d-flex align-items-center justify-content-center gap-2"
                        style="
                            min-height: 42px;
                            padding: 9px 18px;
                            border: 0;
                            border-radius: 9px;
                            background: #3478f6;
                            font-size: 13px;
                        "
                    >

                        <i class="bi bi-send"></i>

                        <span>
                            Kirim Laporan
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection

@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
        |--------------------------------------------------------------------------
        | ELEMENT
        |--------------------------------------------------------------------------
        */

        const reportPhoto =
            document.getElementById(
                'reportPhoto'
            );

        const reportPhotoPreviewContainer =
            document.getElementById(
                'reportPhotoPreviewContainer'
            );

        const reportPhotoPreview =
            document.getElementById(
                'reportPhotoPreview'
            );

        const reportLatitude =
            document.getElementById(
                'reportLatitude'
            );

        const reportLongitude =
            document.getElementById(
                'reportLongitude'
            );

        const useCurrentReportLocation =
            document.getElementById(
                'useCurrentReportLocation'
            );

        const reportLocationStatus =
            document.getElementById(
                'reportLocationStatus'
            );


        /*
        |--------------------------------------------------------------------------
        | PHOTO PREVIEW
        |--------------------------------------------------------------------------
        */

        if (reportPhoto) {

            reportPhoto.addEventListener(
                'change',
                function () {

                    const file =
                        this.files[0];


                    if (!file) {

                        reportPhotoPreviewContainer
                            .classList.add('d-none');

                        reportPhotoPreview
                            .removeAttribute('src');

                        return;

                    }


                    /*
                    |----------------------------------------------------------------------
                    | VALIDASI TIPE FILE
                    |----------------------------------------------------------------------
                    */

                    if (
                        !file.type.startsWith(
                            'image/'
                        )
                    ) {

                        reportPhoto.value = '';

                        reportPhotoPreviewContainer
                            .classList.add('d-none');

                        alert(
                            'File yang dipilih harus berupa gambar.'
                        );

                        return;

                    }


                    /*
                    |----------------------------------------------------------------------
                    | PREVIEW
                    |----------------------------------------------------------------------
                    */

                    const imageUrl =
                        URL.createObjectURL(
                            file
                        );


                    reportPhotoPreview.src =
                        imageUrl;


                    reportPhotoPreviewContainer
                        .classList.remove('d-none');

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | GET CURRENT LOCATION
        |--------------------------------------------------------------------------
        */

        function getCurrentLocation() {

            /*
            |----------------------------------------------------------------------
            | CHECK BROWSER SUPPORT
            |----------------------------------------------------------------------
            */

            if (
                !navigator.geolocation
            ) {

                reportLocationStatus.textContent =
                    'Browser tidak mendukung fitur lokasi.';

                reportLocationStatus.style.color =
                    '#dc3545';

                return;

            }


            /*
            |----------------------------------------------------------------------
            | STATUS
            |----------------------------------------------------------------------
            */

            reportLocationStatus.innerHTML =
                `
                    <i class="bi bi-hourglass-split me-1"></i>
                    Mengambil lokasi saat ini...
                `;

            reportLocationStatus.style.color =
                '#98a1b2';


            /*
            |----------------------------------------------------------------------
            | GET LOCATION
            |----------------------------------------------------------------------
            */

            navigator.geolocation.getCurrentPosition(

                function (position) {

                    const latitude =
                        position.coords.latitude;

                    const longitude =
                        position.coords.longitude;


                    /*
                    |----------------------------------------------------------------------
                    | ISI INPUT
                    |----------------------------------------------------------------------
                    */

                    reportLatitude.value =
                        latitude.toFixed(7);

                    reportLongitude.value =
                        longitude.toFixed(7);


                    /*
                    |----------------------------------------------------------------------
                    | STATUS BERHASIL
                    |----------------------------------------------------------------------
                    */

                    reportLocationStatus.innerHTML =
                        `
                            <i
                                class="bi bi-check-circle-fill me-1"
                                style="color: #198754;"
                            ></i>

                            Lokasi berhasil diperoleh.
                        `;

                    reportLocationStatus.style.color =
                        '#198754';

                },

                function (error) {

                    console.error(
                        'Gagal mengambil lokasi:',
                        error
                    );


                    /*
                    |----------------------------------------------------------------------
                    | ERROR STATUS
                    |----------------------------------------------------------------------
                    */

                    let message =
                        'Lokasi tidak dapat diperoleh.';


                    if (
                        error.code ===
                        error.PERMISSION_DENIED
                    ) {

                        message =
                            'Izin lokasi ditolak. Silakan izinkan akses lokasi pada browser.';

                    }

                    else if (
                        error.code ===
                        error.POSITION_UNAVAILABLE
                    ) {

                        message =
                            'Lokasi tidak tersedia. Pastikan GPS/lokasi perangkat aktif.';

                    }

                    else if (
                        error.code ===
                        error.TIMEOUT
                    ) {

                        message =
                            'Pengambilan lokasi terlalu lama. Silakan coba lagi.';

                    }


                    reportLocationStatus.innerHTML =
                        `
                            <i
                                class="bi bi-exclamation-circle-fill me-1"
                                style="color: #dc3545;"
                            ></i>

                            ${message}
                        `;

                    reportLocationStatus.style.color =
                        '#dc3545';

                },

                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }

            );

        }


        /*
        |--------------------------------------------------------------------------
        | AUTOMATIC LOCATION
        |--------------------------------------------------------------------------
        */

        getCurrentLocation();


        /*
        |--------------------------------------------------------------------------
        | USE CURRENT LOCATION BUTTON
        |--------------------------------------------------------------------------
        */

        if (
            useCurrentReportLocation
        ) {

            useCurrentReportLocation.addEventListener(
                'click',
                function () {

                    getCurrentLocation();

                }
            );

        }

    }

);

</script>

@endpush

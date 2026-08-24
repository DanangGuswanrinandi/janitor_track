@extends('layouts.user.app')

@section('title', 'Buat Laporan')

@section('navbar-title', 'Buat Laporan')

@section('navbar-subtitle', 'Selamat datang di CleanTrack.')

@section('content')

    <div class="w-100">

         {{-- =====================================================
             SUCCESS ALERT
        ====================================================== --}}

        <x-alert.success />

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

            <div
                class="d-flex align-items-center justify-content-between gap-3"
                style="
                    flex-wrap: wrap;
                "
            >

                {{-- =================================================
                     TITLE
                ================================================== --}}

                <div>

                    <h2
                        class="m-0 fw-bold"
                        style="
                            color: #20252b;
                            font-size: 24px;
                        "
                    >
                        Buat Laporan
                    </h2>

                    <p
                        class="mt-2 mb-0"
                        style="
                            color: #98a1b2;
                            font-size: 13px;
                        "
                    >
                        Buat laporan kebersihan dan lihat laporan yang telah dibuat.
                    </p>

                </div>

                {{-- =================================================
                     BUAT LAPORAN
                ================================================== --}}

                <button
                    type="button"
                    class="btn fw-semibold text-white d-flex align-items-center gap-2"
                    data-bs-toggle="modal"
                    data-bs-target="#qrAddModal"
                    style="
                        min-height: 40px;
                        padding: 9px 16px;
                        border: 0;
                        border-radius: 9px;
                        background: #3478f6;
                        font-size: 13px;
                    "
                >

                    <i class="bi bi-plus-lg"></i>

                    <span>
                        Buat Laporan
                    </span>

                </button>

            </div>

        </div>


        {{-- =====================================================
             LIHAT LAPORAN
        ====================================================== --}}

        <a
            href="{{ route('user.lihat-laporan') }}"
            class="btn w-100 mt-3 fw-semibold d-flex align-items-center justify-content-center gap-2 text-decoration-none"
            style="
                min-height: 46px;
                padding: 10px 16px;
                border: 1px solid #dfe5ee;
                border-radius: 10px;
                background: #ffffff;
                color: #3478f6;
                font-size: 13px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
            "
        >

            <i class="bi bi-file-earmark-text"></i>

            <span>
                Lihat Laporan
            </span>

        </a>

    </div>

    {{-- =====================================================
         QR ADD MODAL
    ====================================================== --}}

    <x-user.buat_laporan_page.qr_add_modal />

    {{-- =====================================================
         QR SCANNER SCRIPT
    ====================================================== --}}

    @push('scripts')

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    const modalElement =
                        document.getElementById(
                            'qrAddModal'
                        );


                    const scannerElement =
                        document.getElementById(
                            'qrScanner'
                        );


                    const statusElement =
                        document.getElementById(
                            'qrScannerStatus'
                        );


                    const resultElement =
                        document.getElementById(
                            'qrScanResult'
                        );


                    const resultValueElement =
                        document.getElementById(
                            'qrScanValue'
                        );


                    if (
                        !modalElement ||
                        !scannerElement
                    ) {
                        return;
                    }


                    let qrScanner = null;


                    async function startScanner() {

                        if (qrScanner) {
                            return;
                        }


                        try {

                            qrScanner =
                                new Html5Qrcode(
                                    'qrScanner'
                                );


                            await qrScanner.start(

                                {
                                    facingMode: 'environment'
                                },

                                {
                                    fps: 10,

                                    qrbox: function (
                                        viewfinderWidth,
                                        viewfinderHeight
                                    ) {

                                        const size =
                                            Math.floor(
                                                Math.min(
                                                    viewfinderWidth,
                                                    viewfinderHeight
                                                ) * 0.8
                                            );

                                        return {
                                            width: size,
                                            height: size
                                        };

                                    }

                                },

                                function (decodedText) {

                                    console.log(
                                        'QR Code:',
                                        decodedText
                                    );


                                    const kodeRuangan =
                                        decodedText.trim();


                                    /*
                                    |--------------------------------------------------------------------------
                                    | VALIDASI FORMAT QR
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        !/^RNG-\d{3}$/.test(
                                            kodeRuangan
                                        )
                                    ) {

                                        statusElement.innerHTML =
                                            `
                                                <i
                                                    class="bi bi-exclamation-circle-fill"
                                                    style="color: #dc3545;"
                                                ></i>

                                                <span
                                                    style="color: #dc3545;"
                                                >
                                                    QR Code ruangan tidak valid.
                                                </span>
                                            `;

                                        return;

                                    }


                                    /*
                                    |--------------------------------------------------------------------------
                                    | STOP CAMERA
                                    |--------------------------------------------------------------------------
                                    */

                                    stopScanner();


                                    /*
                                    |--------------------------------------------------------------------------
                                    | REDIRECT
                                    |--------------------------------------------------------------------------
                                    */

                                    window.location.href =
                                        "{{ url('/user/laporan') }}/" +
                                        encodeURIComponent(
                                            kodeRuangan
                                        );

                                },

                                function () {

                                    // QR belum ditemukan.

                                }

                            );

                            statusElement.innerHTML =
                            `
                                <i
                                    class="bi bi-check-circle-fill"
                                    style="color: #28a745;"
                                ></i>

                                <span
                                    style="color: #28a745;"
                                >
                                    Kamera aktif
                                </span>
                            `;

                        } catch (error) {

                            console.error(
                                'Gagal mengaktifkan kamera:',
                                error
                            );


                            statusElement.innerHTML =
                                `
                                    <i class="bi bi-exclamation-circle"></i>
                                    <span>
                                        Kamera tidak dapat digunakan.
                                    </span>
                                `;

                        }

                    }


                    async function stopScanner() {

                        if (!qrScanner) {
                            return;
                        }


                        try {

                            await qrScanner.stop();

                            qrScanner.clear();

                        } catch (error) {

                            console.warn(
                                'Scanner gagal dihentikan:',
                                error
                            );

                        }


                        qrScanner = null;

                    }


                    modalElement.addEventListener(
                        'shown.bs.modal',
                        function () {

                            resultElement.classList.add(
                                'd-none'
                            );


                            resultValueElement.textContent =
                                '';


                            statusElement.innerHTML =
                                `
                                    <i class="bi bi-camera"></i>
                                    <span>Mengaktifkan kamera...</span>
                                `;


                            startScanner();

                        }
                    );


                    modalElement.addEventListener(
                        'hidden.bs.modal',
                        function () {

                            stopScanner();

                        }
                    );

                }
            );

        </script>

    @endpush

@endsection

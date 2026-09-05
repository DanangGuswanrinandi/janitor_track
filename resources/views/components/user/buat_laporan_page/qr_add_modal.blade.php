{{-- =========================================================
     QR ADD MODAL
========================================================== --}}

<div
    class="modal fade"
    id="qrAddModal"
    tabindex="-1"
    aria-labelledby="qrAddModalLabel"
    aria-hidden="true"
>

    <div
        class="modal-dialog modal-dialog-centered"
        style="
            max-width: 500px;
        "
    >

        <div
            class="modal-content border-0"
            style="
                border-radius: 14px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
                overflow: hidden;
            "
        >

            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div
                class="modal-header"
                style="
                    padding: 20px 22px;
                    border-bottom: 1px solid #edf0f5;
                "
            >

                <div>

                    <h5
                        id="qrAddModalLabel"
                        class="m-0 fw-semibold"
                        style="
                            color: #20252b;
                            font-size: 18px;
                        "
                    >
                        Scan QR Ruangan
                    </h5>

                    <p
                        class="mt-1 mb-0"
                        style="
                            color: #98a1b2;
                            font-size: 12px;
                        "
                    >
                        Arahkan kamera ke QR Code ruangan untuk membuat laporan.
                    </p>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Tutup"
                ></button>

            </div>


            {{-- =================================================
                 BODY
            ================================================== --}}

            <div
                class="modal-body"
                style="
                    padding: 22px;
                "
            >

                {{-- =================================================
                     CAMERA AREA
                ================================================== --}}

                <div
                    id="qrScanner"
                    style="
                        width: min(100%, 320px);
                        aspect-ratio: 1 / 1;
                        margin: 0 auto;
                        border: 1px solid #dfe5ee;
                        border-radius: 12px;
                        overflow: hidden;
                        background: #111827;
                    "
                ></div>


                {{-- =================================================
                     CAMERA SELECTOR
                ================================================== --}}

                <div
                    id="qrCameraSelectorWrapper"
                    class="mt-3"
                    style="
                        display: none;
                    "
                >

                    <label
                        for="qrCameraSelect"
                        class="form-label mb-1 fw-semibold"
                        style="
                            color: #5f6875;
                            font-size: 12px;
                        "
                    >
                        Pilih Kamera
                    </label>


                    <select
                        id="qrCameraSelect"
                        class="form-select"
                        style="
                            min-height: 40px;
                            border: 1px solid #dfe4ec;
                            border-radius: 9px;
                            color: #5f6875;
                            font-size: 13px;
                        "
                    >

                        <option value="">
                            Memuat kamera...
                        </option>

                    </select>

                </div>


                {{-- =================================================
                     STATUS
                ================================================== --}}

                <div
                    id="qrScannerStatus"
                    class="d-flex align-items-center justify-content-center gap-2 mt-3"
                    style="
                        color: #98a1b2;
                        font-size: 12px;
                        text-align: center;
                    "
                >

                    <i class="bi bi-camera"></i>

                    <span>
                        Mengaktifkan kamera...
                    </span>

                </div>


                {{-- =================================================
                     RESULT
                ================================================== --}}

                <div
                    id="qrScanResult"
                    class="mt-3 d-none"
                    style="
                        padding: 12px 14px;
                        border: 1px solid #cfe2ff;
                        border-radius: 9px;
                        background: #eaf1ff;
                        color: #3478f6;
                        font-size: 13px;
                    "
                >

                    <div class="fw-semibold">
                        QR Code terdeteksi
                    </div>


                    <div
                        id="qrScanValue"
                        class="mt-1"
                    ></div>

                </div>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div
                class="modal-footer"
                style="
                    padding: 16px 22px;
                    border-top: 1px solid #edf0f5;
                "
            >

                <button
                    type="button"
                    class="btn fw-semibold"
                    data-bs-dismiss="modal"
                    style="
                        min-height: 40px;
                        padding: 8px 16px;
                        border: 1px solid #dfe4ec;
                        border-radius: 9px;
                        background: #ffffff;
                        color: #5f6875;
                        font-size: 13px;
                    "
                >
                    Batal
                </button>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     QR SCANNER STYLE
========================================================== --}}

<style>

    /*
    |--------------------------------------------------------------------------
    | QR SCANNER RESPONSIVE
    |--------------------------------------------------------------------------
    */

    #qrScanner {
        width: min(100%, 320px) !important;
        aspect-ratio: 1 / 1 !important;
        margin: 0 auto;
        overflow: hidden !important;
        position: relative;
    }


    /*
    |--------------------------------------------------------------------------
    | CAMERA VIDEO
    |--------------------------------------------------------------------------
    */

    #qrScanner video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
    }


/*
|--------------------------------------------------------------------------
| SCANNER REGION
|--------------------------------------------------------------------------
*/

#qrScanner #qr-shaded-region {
    position: absolute !important;

    /* Hilangkan shading/bingkai abu-abu bawaan */
    border: none !important;
    background: transparent !important;
    box-shadow: none !important;
}

/* Pertahankan corner scanner bawaan */
#qrScanner #qr-shaded-region > div {
    display: block !important;
}


    /*
    |--------------------------------------------------------------------------
    | CAMERA SELECT
    |--------------------------------------------------------------------------
    */

    #qrCameraSelect {
        outline: none;
        box-shadow: none;
    }


    #qrCameraSelect:focus {
        border-color: #3478f6;
        box-shadow: 0 0 0 3px rgba(52, 120, 246, 0.10);
    }

</style>


{{-- =========================================================
     QR SCANNER SCRIPT
========================================================== --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
        |--------------------------------------------------------------------------
        | ELEMENT
        |--------------------------------------------------------------------------
        */

        const modalElement =
            document.getElementById(
                'qrAddModal'
            );


        const scannerElement =
            document.getElementById(
                'qrScanner'
            );


        const cameraSelectorWrapper =
            document.getElementById(
                'qrCameraSelectorWrapper'
            );


        const cameraSelect =
            document.getElementById(
                'qrCameraSelect'
            );


        const scannerStatus =
            document.getElementById(
                'qrScannerStatus'
            );


        const scanResult =
            document.getElementById(
                'qrScanResult'
            );


        const scanValue =
            document.getElementById(
                'qrScanValue'
            );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI ELEMENT
        |--------------------------------------------------------------------------
        */

        if (
            !modalElement ||
            !scannerElement
        ) {

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | SCANNER INSTANCE
        |--------------------------------------------------------------------------
        */

        if (
            typeof Html5Qrcode ===
            'undefined'
        ) {

            console.error(
                'Html5Qrcode belum tersedia.'
            );

            return;

        }


        const qrScanner =
            new Html5Qrcode(
                'qrScanner'
            );


        /*
        |--------------------------------------------------------------------------
        | STATE
        |--------------------------------------------------------------------------
        */

        let scannerRunning =
            false;


        let qrDetected =
            false;


        /*
        |--------------------------------------------------------------------------
        | QR BOX
        |--------------------------------------------------------------------------
        */

        function getQrBox(
            viewfinderWidth,
            viewfinderHeight
        ) {

            const size =
                Math.floor(
                    Math.min(
                        viewfinderWidth,
                        viewfinderHeight
                    ) * 0.70
                );


            return {
                width: size,
                height: size
            };

        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        function setStatus(
            icon,
            message,
            color = '#98a1b2'
        ) {

            if (!scannerStatus) {
                return;
            }


            scannerStatus.innerHTML = `

                <i
                    class="bi ${icon}"
                    style="
                        color: ${color};
                    "
                ></i>

                <span
                    style="
                        color: ${color};
                    "
                >
                    ${message}
                </span>

            `;

        }


        /*
        |--------------------------------------------------------------------------
        | RESET RESULT
        |--------------------------------------------------------------------------
        */

        function resetResult() {

            qrDetected =
                false;


            if (scanResult) {

                scanResult.classList.add(
                    'd-none'
                );

            }


            if (scanValue) {

                scanValue.textContent =
                    '';

            }

        }


        /*
        |--------------------------------------------------------------------------
        | START CAMERA
        |--------------------------------------------------------------------------
        */

        async function startCamera(
            cameraId
        ) {

            if (!cameraId) {
                return;
            }


            try {

                /*
                |------------------------------------------------------------------
                | STOP CAMERA SEBELUM SWITCH
                |------------------------------------------------------------------
                */

                if (
                    scannerRunning
                ) {

                    setStatus(
                        'bi-arrow-repeat',
                        'Mengganti kamera...'
                    );


                    await qrScanner.stop();


                    scannerRunning =
                        false;

                }


                /*
                |------------------------------------------------------------------
                | RESET HASIL
                |------------------------------------------------------------------
                */

                resetResult();


                /*
                |------------------------------------------------------------------
                | START CAMERA
                |------------------------------------------------------------------
                */

                await qrScanner.start(

                cameraId,

                {
                    fps: 10,

                    qrbox:
                        getQrBox,

                    aspectRatio: 1.0,

                    disableFlip: false
                },

                    function (
                        decodedText
                    ) {

                        handleQrSuccess(
                            decodedText
                        );

                    },

                    function (
                        errorMessage
                    ) {

                        /*
                        |----------------------------------------------------------
                        | Error scanning normal.
                        | Tidak perlu ditampilkan ke user.
                        |----------------------------------------------------------
                        */

                    }

                );


                scannerRunning =
                    true;


                setStatus(
                    'bi-camera-fill',
                    'Kamera aktif',
                    '#3478f6'
                );


            } catch (error) {

                console.error(
                    'Start Camera Error:',
                    error
                );


                scannerRunning =
                    false;


                setStatus(
                    'bi-camera-video-off',
                    'Gagal mengaktifkan kamera',
                    '#dc3545'
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | QR SUCCESS
        |--------------------------------------------------------------------------
        */

        async function handleQrSuccess(
            decodedText
        ) {

            /*
            |------------------------------------------------------------------
            | MENCEGAH CALLBACK BERULANG
            |------------------------------------------------------------------
            */

            if (qrDetected) {
                return;
            }


            qrDetected =
                true;


            console.log(
                'QR Code:',
                decodedText
            );


            /*
            |------------------------------------------------------------------
            | TAMPILKAN HASIL
            |------------------------------------------------------------------
            */

            if (scanResult) {

                scanResult.classList.remove(
                    'd-none'
                );

            }


            if (scanValue) {

                scanValue.textContent =
                    decodedText;

            }


            setStatus(
                'bi-check-circle-fill',
                'QR Code berhasil dipindai',
                '#3478f6'
            );


            /*
            |------------------------------------------------------------------
            | STOP CAMERA
            |------------------------------------------------------------------
            */

            try {

                if (
                    scannerRunning
                ) {

                    await qrScanner.stop();

                    scannerRunning =
                        false;

                }

            } catch (error) {

                console.error(
                    'Stop Camera Error:',
                    error
                );

            }


            /*
            |------------------------------------------------------------------
            | REDIRECT
            |------------------------------------------------------------------
            */

            setTimeout(
                function () {

                    window.location.href =
                        `/user/laporan/${encodeURIComponent(decodedText)}`;

                },
                500
            );

        }


        /*
        |--------------------------------------------------------------------------
        | LOAD CAMERA LIST
        |--------------------------------------------------------------------------
        */

        async function loadCameras() {

            try {

                setStatus(
                    'bi-camera',
                    'Memuat daftar kamera...'
                );


                /*
                |------------------------------------------------------------------
                | GET CAMERA
                |------------------------------------------------------------------
                */

                const cameras =
                    await Html5Qrcode.getCameras();


                if (
                    !cameras ||
                    cameras.length === 0
                ) {

                    cameraSelectorWrapper.style.display =
                        'none';


                    setStatus(
                        'bi-camera-video-off',
                        'Kamera tidak ditemukan',
                        '#dc3545'
                    );


                    return;

                }


                /*
                |------------------------------------------------------------------
                | RESET SELECT
                |------------------------------------------------------------------
                */

                cameraSelect.innerHTML =
                    '';


                /*
                |------------------------------------------------------------------
                | TAMBAHKAN CAMERA
                |------------------------------------------------------------------
                */

                cameras.forEach(
                    function (
                        camera,
                        index
                    ) {

                        const option =
                            document.createElement(
                                'option'
                            );


                        option.value =
                            camera.id;


                        option.textContent =
                            camera.label ||
                            `Kamera ${index + 1}`;


                        cameraSelect.appendChild(
                            option
                        );

                    }
                );


                /*
                |------------------------------------------------------------------
                | TAMPILKAN SELECTOR
                |------------------------------------------------------------------
                */

                if (
                    cameras.length > 1
                ) {

                    cameraSelectorWrapper.style.display =
                        'block';

                } else {

                    cameraSelectorWrapper.style.display =
                        'none';

                }


                /*
                |------------------------------------------------------------------
                | CARI KAMERA BELAKANG
                |------------------------------------------------------------------
                */

                let defaultCamera =
                    cameras[0];


                const backCamera =
                    cameras.find(
                        function (
                            camera
                        ) {

                            const label =
                                (
                                    camera.label ||
                                    ''
                                ).toLowerCase();


                            return (
                                label.includes('back') ||
                                label.includes('rear') ||
                                label.includes('environment') ||
                                label.includes('belakang')
                            );

                        }
                    );


                /*
                |------------------------------------------------------------------
                | GUNAKAN KAMERA BELAKANG
                |------------------------------------------------------------------
                */

                if (
                    backCamera
                ) {

                    defaultCamera =
                        backCamera;

                }


                cameraSelect.value =
                    defaultCamera.id;


                /*
                |------------------------------------------------------------------
                | START DEFAULT CAMERA
                |------------------------------------------------------------------
                */

                await startCamera(
                    defaultCamera.id
                );

            } catch (error) {

                console.error(
                    'Load Camera Error:',
                    error
                );


                cameraSelectorWrapper.style.display =
                    'none';


                setStatus(
                    'bi-camera-video-off',
                    'Tidak dapat mengakses kamera',
                    '#dc3545'
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | SWITCH CAMERA
        |--------------------------------------------------------------------------
        */

        if (cameraSelect) {

            cameraSelect.addEventListener(
                'change',
                async function () {

                    const cameraId =
                        this.value;


                    if (!cameraId) {
                        return;
                    }


                    await startCamera(
                        cameraId
                    );

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | MODAL OPEN
        |--------------------------------------------------------------------------
        */

        modalElement.addEventListener(
            'shown.bs.modal',
            async function () {

                /*
                |------------------------------------------------------------------
                | RESET
                |------------------------------------------------------------------
                */

                resetResult();


                setStatus(
                    'bi-camera',
                    'Mengaktifkan kamera...'
                );


                /*
                |------------------------------------------------------------------
                | LOAD CAMERA
                |------------------------------------------------------------------
                */

                await loadCameras();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | MODAL CLOSE
        |--------------------------------------------------------------------------
        */

        modalElement.addEventListener(
            'hidden.bs.modal',
            async function () {

                try {

                    /*
                    |------------------------------------------------------------------
                    | STOP CAMERA
                    |------------------------------------------------------------------
                    */

                    if (
                        scannerRunning
                    ) {

                        await qrScanner.stop();

                        scannerRunning =
                            false;

                    }

                } catch (error) {

                    console.error(
                        'Close Camera Error:',
                        error
                    );

                }


                /*
                |------------------------------------------------------------------
                | RESET
                |------------------------------------------------------------------
                */

                resetResult();


                cameraSelect.innerHTML = `
                    <option value="">
                        Memuat kamera...
                    </option>
                `;


                cameraSelectorWrapper.style.display =
                    'none';


                setStatus(
                    'bi-camera',
                    'Mengaktifkan kamera...'
                );

            }
        );

    }

);

</script>

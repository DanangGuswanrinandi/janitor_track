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
    }

</style>

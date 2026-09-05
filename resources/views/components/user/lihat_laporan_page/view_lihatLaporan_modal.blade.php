{{-- =========================================================
     MODAL VIEW LAPORAN
========================================================== --}}

<div
    class="modal fade"
    id="viewLaporanModal"
    tabindex="-1"
    aria-labelledby="viewLaporanModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div class="modal-header">

                <h5
                    class="modal-title fw-semibold"
                    id="viewLaporanModalLabel"
                >
                    Detail Laporan
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- =================================================
                 BODY
            ================================================== --}}

            <div class="modal-body">

                {{-- STATUS --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <div id="viewLaporanStatus">
                        -
                    </div>

                </div>


                {{-- RUANGAN --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Ruangan
                    </label>

                    <div id="viewLaporanRuangan">
                        -
                    </div>

                </div>


                {{-- FOTO --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Foto Kondisi
                    </label>

                    <div>

                        <img
                            id="viewLaporanFoto"
                            src=""
                            alt="Foto kondisi ruangan"
                            style="
                                display: none;
                                width: 220px;
                                height: 160px;
                                object-fit: cover;
                                border-radius: 10px;
                                border: 1px solid #dfe5ee;
                                cursor: pointer;
                            "
                        >

                        <span
                            id="viewLaporanNoFoto"
                            style="
                                color: #98a1b2;
                                font-size: 13px;
                            "
                        >
                            Tidak ada foto
                        </span>

                    </div>

                </div>


                {{-- KOORDINAT --}}

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Latitude
                        </label>

                        <div id="viewLaporanLatitude">
                            -
                        </div>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Longitude
                        </label>

                        <div id="viewLaporanLongitude">
                            -
                        </div>

                    </div>

                </div>


                {{-- KETERANGAN --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Keterangan
                    </label>

                    <div id="viewLaporanKeterangan">
                        -
                    </div>

                </div>


                {{-- WAKTU --}}

                <div>

                    <label class="form-label fw-semibold">
                        Waktu Laporan
                    </label>

                    <div id="viewLaporanWaktu">
                        -
                    </div>

                </div>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Tutup
                </button>

            </div>

        </div>

    </div>

</div>

<style>
.view-laporan-photo-popup {
    max-width: 90vw !important;
}

.view-laporan-photo-image {
    max-width: 85vw !important;
    max-height: 80vh !important;
    width: auto !important;
    height: auto !important;
    object-fit: contain !important;
    border-radius: 8px;
}
</style>

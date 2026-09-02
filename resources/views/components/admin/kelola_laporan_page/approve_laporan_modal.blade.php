{{-- =========================================================
     APPROVE LAPORAN MODAL
========================================================== --}}

<div
    class="modal fade"
    id="approveLaporanModal"
    tabindex="-1"
    aria-labelledby="approveLaporanModalLabel"
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
                    id="approveLaporanModalLabel"
                >
                    Approve Laporan
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

                {{-- =================================================
                     USER
                ================================================== --}}

                <div class="mb-4">

                    <div
                        class="fw-semibold mb-1"
                        style="
                            color: #3c4450;
                            font-size: 13px;
                        "
                    >
                        Nama User
                    </div>

                    <div
                        id="approveLaporanUser"
                        style="
                            color: #252a31;
                            font-size: 13px;
                        "
                    >
                        -
                    </div>

                </div>


                {{-- =================================================
                     WAKTU
                ================================================== --}}

                <div class="row g-3 mb-4">

                    <div class="col-md-6">

                        <div
                            class="fw-semibold mb-1"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Dibuat
                        </div>

                        <div
                            id="approveLaporanCreatedAt"
                            style="
                                color: #5f6875;
                                font-size: 12px;
                            "
                        >
                            -
                        </div>

                    </div>


                    <div class="col-md-6">

                        <div
                            class="fw-semibold mb-1"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Diubah
                        </div>

                        <div
                            id="approveLaporanUpdatedAt"
                            style="
                                color: #5f6875;
                                font-size: 12px;
                            "
                        >
                            -
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     FOTO
                ================================================== --}}

                <div class="mb-4">

                    <div
                        class="fw-semibold mb-2"
                        style="
                            color: #3c4450;
                            font-size: 13px;
                        "
                    >
                        Foto Laporan
                    </div>

                    <img
                        id="approveLaporanFoto"
                        src=""
                        alt="Foto laporan"
                        style="
                            display: none;
                            width: 240px;
                            height: 170px;
                            object-fit: cover;
                            border-radius: 10px;
                            border: 1px solid #dfe5ee;
                        "
                    >

                    <div
                        id="approveLaporanFotoEmpty"
                        style="
                            color: #98a1b2;
                            font-size: 12px;
                        "
                    >
                        Tidak ada foto.
                    </div>

                </div>


                {{-- =================================================
                     RUANGAN
                ================================================== --}}

                <div class="mb-4">

                    <div
                        class="fw-semibold mb-1"
                        style="
                            color: #3c4450;
                            font-size: 13px;
                        "
                    >
                        Ruangan
                    </div>

                    <div
                        id="approveLaporanRuangan"
                        style="
                            color: #252a31;
                            font-size: 13px;
                        "
                    >
                        -
                    </div>

                    <div
                        id="approveLaporanKodeRuangan"
                        class="mt-1"
                        style="
                            color: #98a1b2;
                            font-size: 11px;
                        "
                    >
                        -
                    </div>

                </div>


                {{-- =================================================
                     KOORDINAT LAPORAN
                ================================================== --}}

                <div class="mb-4">

                    <div
                        class="fw-semibold mb-2"
                        style="
                            color: #3c4450;
                            font-size: 13px;
                        "
                    >
                        Koordinat Laporan
                    </div>

                    <div
                        style="
                            color: #5f6875;
                            font-size: 12px;
                        "
                    >

                        <div>
                            <strong>Latitude:</strong>

                            <span id="approveLaporanLatitude">
                                -
                            </span>
                        </div>

                        <div class="mt-1">
                            <strong>Longitude:</strong>

                            <span id="approveLaporanLongitude">
                                -
                            </span>
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     KOORDINAT MASTER RUANGAN
                ================================================== --}}

                <div class="mb-4">

                    <div
                        class="fw-semibold mb-2"
                        style="
                            color: #3c4450;
                            font-size: 13px;
                        "
                    >
                        Koordinat Master Ruangan
                    </div>

                    <div
                        style="
                            color: #5f6875;
                            font-size: 12px;
                        "
                    >

                        <div>
                            <strong>Latitude:</strong>

                            <span id="approveRuanganLatitude">
                                -
                            </span>
                        </div>

                        <div class="mt-1">
                            <strong>Longitude:</strong>

                            <span id="approveRuanganLongitude">
                                -
                            </span>
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     HASIL VALIDASI
                ================================================== --}}

                <div
                    id="approveLaporanValidation"
                    class="p-3"
                    style="
                        border-radius: 10px;
                        background: #f5f7fa;
                    "
                >

                    <div
                        id="approveLaporanValidationText"
                        class="fw-semibold"
                        style="
                            color: #5f6875;
                            font-size: 13px;
                        "
                    >
                        Memeriksa koordinat...
                    </div>

                    <div
                        id="approveLaporanDistance"
                        class="mt-1"
                        style="
                            color: #98a1b2;
                            font-size: 11px;
                        "
                    >
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
                    Batal
                </button>

                <button
                    type="button"
                    id="approveLaporanButton"
                    class="btn btn-primary"
                    disabled
                >

                    <i class="bi bi-check-circle me-1"></i>

                    Approve Laporan

                </button>

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
     VIEW KELola LAPORAN MODAL
========================================================== --}}

<div
    class="modal fade"
    id="viewKelolaLaporanModal"
    tabindex="-1"
    aria-labelledby="viewKelolaLaporanModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}

            <div class="modal-header">

                <h5
                    class="modal-title fw-semibold"
                    id="viewKelolaLaporanModalLabel"
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


            {{-- BODY --}}

            <div class="modal-body">

                {{-- USER --}}

                <div class="mb-4">

                    <div class="fw-semibold mb-1">
                        Nama User
                    </div>

                    <div
                        id="viewKelolaLaporanUser"
                        class="text-muted"
                    >
                        -
                    </div>

                </div>


                {{-- RUANGAN --}}

                <div class="mb-4">

                    <div class="fw-semibold mb-1">
                        Ruangan
                    </div>

                    <div id="viewKelolaLaporanRuangan">
                        -
                    </div>

                    <div
                        id="viewKelolaLaporanKodeRuangan"
                        class="text-muted"
                        style="font-size: 12px;"
                    >
                        -
                    </div>

                </div>


                {{-- FOTO --}}

                <div class="mb-4">

                    <div class="fw-semibold mb-2">
                        Foto Laporan
                    </div>

                    <img
                        id="viewKelolaLaporanFoto"
                        src=""
                        alt="Foto laporan"
                        style="
                            display: none;
                            width: 240px;
                            height: 170px;
                            object-fit: cover;
                            border-radius: 10px;
                            border: 1px solid #dfe5ee;
                            cursor: pointer;
                        "
                    >

                    <div
                        id="viewKelolaLaporanFotoEmpty"
                        class="text-muted"
                        style="font-size: 12px;"
                    >
                        Tidak ada foto.
                    </div>

                </div>


                {{-- KOORDINAT --}}

                <div class="mb-4">

                    <div class="fw-semibold mb-2">
                        Koordinat
                    </div>

                    <div
                        style="
                            color: #5f6875;
                            font-size: 12px;
                        "
                    >

                        <div>
                            <strong>Latitude:</strong>

                            <span id="viewKelolaLaporanLatitude">
                                -
                            </span>
                        </div>

                        <div class="mt-1">
                            <strong>Longitude:</strong>

                            <span id="viewKelolaLaporanLongitude">
                                -
                            </span>
                        </div>

                    </div>

                </div>


                {{-- KETERANGAN --}}

                <div class="mb-4">

                    <div class="fw-semibold mb-2">
                        Keterangan
                    </div>

                    <div
                        id="viewKelolaLaporanKeterangan"
                        style="
                            color: #5f6875;
                            font-size: 13px;
                        "
                    >
                        -
                    </div>

                </div>


                {{-- WAKTU --}}

                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="fw-semibold mb-1">
                            Dibuat
                        </div>

                        <div
                            id="viewKelolaLaporanCreatedAt"
                            class="text-muted"
                            style="font-size: 12px;"
                        >
                            -
                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="fw-semibold mb-1">
                            Diubah
                        </div>

                        <div
                            id="viewKelolaLaporanUpdatedAt"
                            class="text-muted"
                            style="font-size: 12px;"
                        >
                            -
                        </div>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}

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
.view-kelola-laporan-photo-popup {
    max-width: 90vw !important;
}

.view-kelola-laporan-photo-image {
    max-width: 85vw !important;
    max-height: 80vh !important;
    width: auto !important;
    height: auto !important;
    object-fit: contain !important;
    border-radius: 8px;
}
</style>

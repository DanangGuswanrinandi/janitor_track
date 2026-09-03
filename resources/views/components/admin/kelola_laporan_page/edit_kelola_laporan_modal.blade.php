<div
    class="modal fade"
    id="editKelolaLaporanModal"
    tabindex="-1"
    aria-labelledby="editKelolaLaporanModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form
                id="editKelolaLaporanForm"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                <div class="modal-header">

                    <h5
                        class="modal-title fw-semibold"
                        id="editKelolaLaporanModalLabel"
                    >
                        Edit Laporan
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">

                    {{-- USER --}}

                    <div class="mb-3">

                        <label
                            class="form-label fw-semibold"
                        >
                            Nama User
                        </label>

                        <input
                            type="text"
                            id="editKelolaLaporanUser"
                            class="form-control"
                            readonly
                        >

                    </div>


                    {{-- RUANGAN --}}

                    <div class="mb-3">

                        <label
                            class="form-label fw-semibold"
                        >
                            Ruangan
                        </label>

                        <input
                            type="text"
                            id="editKelolaLaporanRuangan"
                            class="form-control"
                            readonly
                        >

                    </div>


                    {{-- FOTO LAMA --}}

                    <div class="mb-3">

                        <label
                            class="form-label fw-semibold"
                        >
                            Foto Saat Ini
                        </label>

                        <div>

                            <img
                                id="editKelolaLaporanFotoPreview"
                                src=""
                                alt="Foto laporan"
                                style="
                                    display: none;
                                    width: 180px;
                                    height: 130px;
                                    object-fit: cover;
                                    border-radius: 10px;
                                    border: 1px solid #dfe5ee;
                                "
                            >

                        </div>

                    </div>


                    {{-- FOTO BARU --}}

                    <div class="mb-3">

                        <label
                            for="editKelolaLaporanFoto"
                            class="form-label fw-semibold"
                        >
                            Ganti Foto
                        </label>

                        <input
                            type="file"
                            name="foto"
                            id="editKelolaLaporanFoto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto.
                        </small>

                    </div>


                    {{-- LATITUDE --}}

                    <div class="mb-3">

                        <label
                            class="form-label fw-semibold"
                        >
                            Latitude
                        </label>

                        <input
                            type="number"
                            step="any"
                            name="latitude"
                            id="editKelolaLaporanLatitude"
                            class="form-control"
                            readonly
                            required
                        >

                    </div>


                    {{-- LONGITUDE --}}

                    <div class="mb-3">

                        <label
                            class="form-label fw-semibold"
                        >
                            Longitude
                        </label>

                        <input
                            type="number"
                            step="any"
                            name="longitude"
                            id="editKelolaLaporanLongitude"
                            class="form-control"
                            readonly
                            required
                        >

                    </div>


                    {{-- KETERANGAN --}}

                    <div class="mb-3">

                        <label
                            for="editKelolaLaporanKeterangan"
                            class="form-label fw-semibold"
                        >
                            Keterangan
                        </label>

                        <textarea
                            name="keterangan"
                            id="editKelolaLaporanKeterangan"
                            class="form-control"
                            rows="4"
                            maxlength="1000"
                        ></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- =========================================================
     MODAL EDIT LAPORAN
========================================================== --}}

<div
    class="modal fade"
    id="editLaporanModal"
    tabindex="-1"
    aria-labelledby="editLaporanModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form
                id="editLaporanForm"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                {{-- =================================================
                     HEADER
                ================================================== --}}

                <div class="modal-header">

                    <h5
                        class="modal-title fw-semibold"
                        id="editLaporanModalLabel"
                    >
                        Edit Laporan
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

                    {{-- RUANGAN --}}

                    <div class="mb-3">

                        <label
                            for="editRuangan"
                            class="form-label fw-semibold"
                        >
                            Ruangan
                        </label>

                        <input
                            type="text"
                            id="editRuangan"
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
                                id="editLaporanFotoPreview"
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
                            for="editFoto"
                            class="form-label fw-semibold"
                        >
                            Ganti Foto
                        </label>

                        <input
                            type="file"
                            name="foto"
                            id="editFoto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto.
                        </small>

                    </div>


                    {{-- =================================================
                         LOKASI
                    ================================================== --}}
                                    
                    <div class="mb-3">
                    
                        <label
                            class="form-label fw-semibold"
                        >
                            Lokasi Saat Membuat Laporan
                        </label>
                    
                    
                        <div class="row g-3">
                        
                            {{-- =================================================
                                 LATITUDE
                            ================================================== --}}
                        
                            <div class="col-md-6">
                            
                                <label
                                    for="editLatitude"
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
                                    name="latitude"
                                    id="editLatitude"
                                    class="form-control"
                                    placeholder="Lokasi belum tersedia"
                                    readonly
                                    required
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
                                    for="editLongitude"
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
                                    name="longitude"
                                    id="editLongitude"
                                    class="form-control"
                                    placeholder="Lokasi belum tersedia"
                                    readonly
                                    required
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
                             GUNAKAN LOKASI SEKARANG
                        ================================================== --}}
                    
                        <button
                            type="button"
                            id="useCurrentEditLocation"
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
                    
                    
                        {{-- STATUS LOKASI --}}
                    
                        <div
                            id="editLocationStatus"
                            class="mt-2"
                            style="
                                color: #98a1b2;
                                font-size: 11px;
                            "
                        >
                            Lokasi laporan saat ini.
                        </div>
                    
                    </div>


                    {{-- KETERANGAN --}}

                    <div class="mb-3">

                        <label
                            for="editKeterangan"
                            class="form-label fw-semibold"
                        >
                            Keterangan
                        </label>

                        <textarea
                            name="keterangan"
                            id="editKeterangan"
                            class="form-control"
                            rows="4"
                            maxlength="1000"
                        ></textarea>

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

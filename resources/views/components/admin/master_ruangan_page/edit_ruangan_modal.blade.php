{{-- =========================================================
     EDIT RUANGAN MODAL
========================================================== --}}

<div
    class="modal fade"
    id="editRoomModal"
    tabindex="-1"
    aria-labelledby="editRoomModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div
            class="modal-content border-0"
            style="
                border-radius: 14px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
                overflow: hidden;
            "
        >

            <form
                id="editRoomForm"
                method="POST"
            >

                @csrf

                @method('PUT')


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
                            id="editRoomModalLabel"
                            class="m-0 fw-semibold"
                            style="
                                color: #20252b;
                                font-size: 18px;
                            "
                        >
                            Edit Ruangan
                        </h5>

                        <p
                            class="mt-1 mb-0"
                            style="
                                color: #98a1b2;
                                font-size: 12px;
                            "
                        >
                            Perbarui data ruangan dan lokasi ruangan.
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
                         KODE RUANGAN
                    ================================================== --}}

                    <div class="mb-3">

                        <label
                            for="editRoomCode"
                            class="form-label mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Kode Ruangan
                        </label>

                        <input
                            type="text"
                            id="editRoomCode"
                            class="form-control"
                            readonly
                            style="
                                min-height: 46px;
                                padding: 10px 13px;
                                border-radius: 9px;
                                color: #667080;
                                background: #f5f7fa;
                                font-size: 13px;
                                box-shadow: none;
                                cursor: not-allowed;
                            "
                        >

                        <div
                            class="mt-1"
                            style="
                                color: #98a1b2;
                                font-size: 11px;
                            "
                        >
                            Kode ruangan tidak dapat diubah.
                        </div>

                    </div>


                    {{-- =================================================
                         NAMA RUANGAN
                    ================================================== --}}

                    <div class="mb-3">

                        <label
                            for="editRoomName"
                            class="form-label mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Nama Ruangan
                        </label>

                        <input
                            type="text"
                            id="editRoomName"
                            name="nama_ruangan"
                            class="form-control"
                            placeholder="Masukkan nama ruangan"
                            autocomplete="off"
                            required
                            style="
                                min-height: 46px;
                                padding: 10px 13px;
                                border-radius: 9px;
                                color: #252a31;
                                font-size: 13px;
                                box-shadow: none;
                            "
                        >

                    </div>


                    {{-- =================================================
                         LOKASI
                    ================================================== --}}

                    <div class="mb-3">

                        <label
                            for="editRoomLocation"
                            class="form-label mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Lokasi
                        </label>

                        <input
                            type="text"
                            id="editRoomLocation"
                            name="lokasi"
                            class="form-control"
                            placeholder="Contoh: Lantai 1"
                            autocomplete="off"
                            required
                            style="
                                min-height: 46px;
                                padding: 10px 13px;
                                border-radius: 9px;
                                color: #252a31;
                                font-size: 13px;
                                box-shadow: none;
                            "
                        >

                    </div>


                    {{-- =================================================
                         KOORDINAT
                    ================================================== --}}

                    <div class="mb-1">

                        <label
                            class="form-label mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Koordinat Ruangan
                        </label>


                        {{-- =================================================
                             MAP
                        ================================================== --}}

                        <div
                            id="editRoomMap"
                            style="
                                width: 100%;
                                height: 320px;
                                border-radius: 10px;
                                overflow: hidden;
                                border: 1px solid #dfe5ee;
                            "
                        ></div>


                        {{-- =================================================
                             USE CURRENT LOCATION BUTTON
                        ================================================== --}}

                        <div
                            class="d-flex justify-content-end mt-2"
                        >

                            <button
                                type="button"
                                id="useCurrentEditRoomLocation"
                                class="btn d-inline-flex align-items-center gap-2 fw-semibold"
                                style="
                                    min-height: 38px;
                                    padding: 7px 13px;
                                    border: 1px solid #d7e2f8;
                                    border-radius: 8px;
                                    background: #f5f8ff;
                                    color: #3478f6;
                                    font-size: 12px;
                                "
                            >

                                <i class="bi bi-crosshair"></i>

                                <span>
                                    Gunakan Lokasi Saya Sekarang
                                </span>

                            </button>

                        </div>


                        {{-- =================================================
                             KOORDINAT INPUT
                        ================================================== --}}

                        <div class="row g-2 mt-2">

                            <div class="col-md-6">

                                <label
                                    for="editRoomLatitude"
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
                                    id="editRoomLatitude"
                                    name="latitude"
                                    class="form-control"
                                    readonly
                                    required
                                    style="
                                        min-height: 42px;
                                        border-radius: 8px;
                                        background: #f5f7fa;
                                        font-size: 12px;
                                    "
                                >

                            </div>


                            <div class="col-md-6">

                                <label
                                    for="editRoomLongitude"
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
                                    id="editRoomLongitude"
                                    name="longitude"
                                    class="form-control"
                                    readonly
                                    required
                                    style="
                                        min-height: 42px;
                                        border-radius: 8px;
                                        background: #f5f7fa;
                                        font-size: 12px;
                                    "
                                >

                            </div>

                        </div>


                        <div
                            class="mt-2"
                            style="
                                color: #98a1b2;
                                font-size: 11px;
                            "
                        >
                            Geser marker pada peta atau klik lokasi pada peta untuk mengubah titik lokasi ruangan.
                        </div>

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


                    <button
                        type="submit"
                        class="btn fw-semibold text-white"
                        style="
                            min-height: 40px;
                            padding: 8px 16px;
                            border: 0;
                            border-radius: 9px;
                            background: #3478f6;
                            font-size: 13px;
                        "
                    >

                        <i class="bi bi-check-lg me-1"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
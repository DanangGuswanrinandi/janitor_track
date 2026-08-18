<div
    class="modal fade"
    id="viewRoomModal"
    tabindex="-1"
    aria-labelledby="viewRoomModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div
            class="modal-content border-0"
            style="
                border-radius: 14px;
                overflow: hidden;
                box-shadow: 0 15px 40px rgba(0,0,0,.12);
            "
        >

            <div
                class="modal-header"
                style="
                    padding: 20px 22px;
                    border-bottom: 1px solid #edf0f5;
                "
            >

                <div>

                    <h5
                        id="viewRoomModalLabel"
                        class="m-0 fw-semibold"
                        style="
                            color: #20252b;
                            font-size: 18px;
                        "
                    >
                        Detail Ruangan
                    </h5>

                    <p
                        class="mt-1 mb-0"
                        style="
                            color: #98a1b2;
                            font-size: 12px;
                        "
                    >
                        Informasi detail ruangan.
                    </p>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div
                class="modal-body"
                style="padding: 22px;"
            >

                <div class="row g-4">

                    {{-- QR --}}

                    <div
                        class="col-md-5 text-center"
                    >

                        <div
                            style="
                                padding: 20px;
                                border: 1px solid #edf0f5;
                                border-radius: 12px;
                            "
                        >

                            <div
                                id="viewRoomQrCode"
                                class="d-flex justify-content-center"
                            ></div>


                            <div
                                id="viewRoomQrCodeText"
                                class="mt-3 fw-semibold"
                                style="
                                    color: #252a31;
                                    font-size: 13px;
                                "
                            ></div>


                            <button
                                type="button"
                                id="downloadRoomQrButton"
                                class="btn mt-3 fw-semibold d-inline-flex align-items-center gap-2"
                                style="
                                    border: 1px solid #d7e2f8;
                                    border-radius: 9px;
                                    background: #f5f8ff;
                                    color: #3478f6;
                                    font-size: 12px;
                                "
                            >

                                <i class="bi bi-download"></i>

                                Unduh QR JPG

                            </button>

                        </div>

                    </div>


                    {{-- DATA --}}

                    <div class="col-md-7">

                        <div class="mb-3">

                            <div
                                style="
                                    color: #98a1b2;
                                    font-size: 11px;
                                "
                            >
                                Kode Ruangan
                            </div>

                            <div
                                id="viewRoomCode"
                                class="fw-semibold mt-1"
                                style="
                                    color: #252a31;
                                    font-size: 14px;
                                "
                            ></div>

                        </div>


                        <div class="mb-3">

                            <div
                                style="
                                    color: #98a1b2;
                                    font-size: 11px;
                                "
                            >
                                Nama Ruangan
                            </div>

                            <div
                                id="viewRoomName"
                                class="fw-semibold mt-1"
                                style="
                                    color: #252a31;
                                    font-size: 14px;
                                "
                            ></div>

                        </div>


                        <div class="mb-3">

                            <div
                                style="
                                    color: #98a1b2;
                                    font-size: 11px;
                                "
                            >
                                Lokasi
                            </div>

                            <div
                                id="viewRoomLocation"
                                class="mt-1"
                                style="
                                    color: #6c7583;
                                    font-size: 13px;
                                "
                            ></div>

                        </div>


                        <div class="mb-3">

                            <div
                                style="
                                    color: #98a1b2;
                                    font-size: 11px;
                                "
                            >
                                Koordinat
                            </div>

                            <div
                                id="viewRoomCoordinate"
                                class="mt-1"
                                style="
                                    color: #6c7583;
                                    font-size: 13px;
                                "
                            ></div>

                        </div>


                        <div class="row g-3">

                            <div class="col-md-6">

                                <div
                                    style="
                                        color: #98a1b2;
                                        font-size: 11px;
                                    "
                                >
                                    Created At
                                </div>

                                <div
                                    id="viewRoomCreatedAt"
                                    class="mt-1"
                                    style="
                                        color: #6c7583;
                                        font-size: 12px;
                                    "
                                ></div>

                            </div>


                            <div class="col-md-6">

                                <div
                                    style="
                                        color: #98a1b2;
                                        font-size: 11px;
                                    "
                                >
                                    Updated At
                                </div>

                                <div
                                    id="viewRoomUpdatedAt"
                                    class="mt-1"
                                    style="
                                        color: #6c7583;
                                        font-size: 12px;
                                    "
                                ></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


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
                        border: 1px solid #dfe4ec;
                        border-radius: 9px;
                        background: #ffffff;
                        color: #5f6875;
                    "
                >
                    Tutup
                </button>

            </div>

        </div>

    </div>

</div>
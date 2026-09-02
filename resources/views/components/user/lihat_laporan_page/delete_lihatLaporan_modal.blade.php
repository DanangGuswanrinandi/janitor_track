{{-- =========================================================
     MODAL DELETE LAPORAN
========================================================== --}}

<div
    class="modal fade"
    id="deleteLaporanModal"
    tabindex="-1"
    aria-labelledby="deleteLaporanModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                id="deleteLaporanForm"
                method="POST"
            >

                @csrf

                @method('DELETE')


                {{-- =================================================
                     HEADER
                ================================================== --}}

                <div class="modal-header">

                    <h5
                        class="modal-title fw-semibold"
                        id="deleteLaporanModalLabel"
                    >
                        Hapus Laporan
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

                    <div
                        class="text-center"
                        style="
                            padding: 10px 10px 20px;
                        "
                    >

                        <div
                            class="d-inline-flex align-items-center justify-content-center"
                            style="
                                width: 54px;
                                height: 54px;
                                border-radius: 50%;
                                background: #fff1f2;
                                color: #dc3545;
                                font-size: 24px;
                                margin-bottom: 16px;
                            "
                        >

                            <i class="bi bi-trash"></i>

                        </div>


                        <h5
                            class="fw-semibold"
                            style="
                                color: #252a31;
                            "
                        >
                            Hapus laporan ini?
                        </h5>


                        <p
                            class="mb-0"
                            style="
                                color: #98a1b2;
                                font-size: 13px;
                            "
                        >
                            Laporan yang dihapus tidak dapat dikembalikan.
                        </p>

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
                        class="btn btn-danger"
                    >

                        <i class="bi bi-trash me-1"></i>

                        Hapus

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

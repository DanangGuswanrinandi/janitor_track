<div
    class="modal fade"
    id="deleteKelolaLaporanModal"
    tabindex="-1"
    aria-labelledby="deleteKelolaLaporanModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                id="deleteKelolaLaporanForm"
                method="POST"
            >

                @csrf

                @method('DELETE')


                <div class="modal-header">

                    <h5
                        class="modal-title fw-semibold"
                        id="deleteKelolaLaporanModalLabel"
                    >
                        Hapus Laporan
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body text-center">

                    <div
                        class="mb-3"
                        style="
                            font-size: 42px;
                            color: #dc3545;
                        "
                    >
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>


                    <div
                        class="fw-semibold mb-2"
                        style="font-size: 15px;"
                    >
                        Apakah Anda yakin?
                    </div>


                    <div
                        style="
                            color: #6c7583;
                            font-size: 13px;
                        "
                    >
                        Laporan yang dihapus tidak dapat
                        dikembalikan.
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
                        class="btn btn-danger"
                    >
                        <i class="bi bi-trash me-1"></i>
                        Hapus Laporan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

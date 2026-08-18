<div
    class="modal fade"
    id="deleteRoomModal"
    tabindex="-1"
    aria-labelledby="deleteRoomModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div
            class="modal-content border-0"
            style="
                border-radius: 14px;
                box-shadow: 0 15px 40px rgba(0,0,0,.12);
            "
        >

            <form
                id="deleteRoomForm"
                method="POST"
            >

                @csrf
                @method('DELETE')


                <div
                    class="modal-header"
                    style="
                        border-bottom: 1px solid #edf0f5;
                        padding: 20px 22px;
                    "
                >

                    <h5
                        id="deleteRoomModalLabel"
                        class="m-0 fw-semibold"
                        style="
                            color: #20252b;
                            font-size: 17px;
                        "
                    >
                        Hapus Ruangan
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div
                    class="modal-body"
                    style="
                        padding: 22px;
                        color: #6c7583;
                        font-size: 13px;
                    "
                >

                    Apakah Anda yakin ingin menghapus
                    ruangan

                    <strong
                        id="deleteRoomName"
                        style="color: #252a31;"
                    ></strong>

                    ?

                    <div
                        class="mt-2"
                        style="
                            color: #98a1b2;
                            font-size: 12px;
                        "
                    >
                        Data ruangan yang dihapus tidak dapat
                        dikembalikan.
                    </div>

                </div>


                <div
                    class="modal-footer"
                    style="
                        border-top: 1px solid #edf0f5;
                        padding: 16px 22px;
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
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn fw-semibold text-white"
                        style="
                            border: 0;
                            border-radius: 9px;
                            background: #dc3545;
                        "
                    >
                        <i class="bi bi-trash me-1"></i>
                        Hapus Ruangan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
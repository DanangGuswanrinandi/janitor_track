{{-- =========================================================
     DELETE USER MODAL
========================================================== --}}

<div
    class="modal fade"
    id="deleteUserModal"
    tabindex="-1"
    aria-labelledby="deleteUserModalLabel"
    aria-hidden="true"
>

    <div
        class="modal-dialog modal-dialog-centered modal-sm"
    >

        <div
            class="modal-content border-0"
            style="
                border-radius: 14px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            "
        >

            <form
                id="deleteUserForm"
                method="POST"
                action="#"
            >

                @csrf

                @method('DELETE')


                {{-- =================================================
                     BODY
                ================================================== --}}

                <div
                    class="modal-body text-center"
                    style="
                        padding: 28px 24px 22px;
                    "
                >

                    {{-- ICON --}}

                    <div
                        class="d-flex align-items-center justify-content-center mx-auto"
                        style="
                            width: 52px;
                            height: 52px;
                            margin-bottom: 16px;
                            border-radius: 50%;
                            background: #fff5f5;
                            color: #dc3545;
                            font-size: 22px;
                        "
                    >

                        <i class="bi bi-trash"></i>

                    </div>


                    {{-- TITLE --}}

                    <h5
                        id="deleteUserModalLabel"
                        class="m-0 fw-semibold"
                        style="
                            color: #20252b;
                            font-size: 17px;
                        "
                    >
                        Hapus Pengguna
                    </h5>


                    {{-- MESSAGE --}}

                    <p
                        class="mt-2 mb-0"
                        style="
                            color: #6c7583;
                            font-size: 13px;
                            line-height: 1.6;
                        "
                    >

                        Apakah Anda yakin ingin menghapus pengguna

                        <strong
                            id="deleteUsername"
                            style="
                                color: #252a31;
                            "
                        >
                        </strong>

                        ?

                    </p>

                    <p
                        class="mt-2 mb-0"
                        style="
                            color: #98a1b2;
                            font-size: 12px;
                        "
                    >
                        Data pengguna yang dihapus tidak dapat dikembalikan.
                    </p>

                </div>


                {{-- =================================================
                     FOOTER
                ================================================== --}}

                <div
                    class="d-flex justify-content-center gap-2"
                    style="
                        padding: 0 24px 22px;
                    "
                >

                    {{-- BATAL --}}

                    <button
                        type="button"
                        class="btn fw-semibold"
                        data-bs-dismiss="modal"
                        style="
                            min-height: 40px;
                            padding: 8px 18px;
                            border: 1px solid #dfe4ec;
                            border-radius: 9px;
                            background: #ffffff;
                            color: #5f6875;
                            font-size: 13px;
                        "
                    >
                        Batal
                    </button>


                    {{-- HAPUS --}}

                    <button
                        type="submit"
                        class="btn fw-semibold text-white"
                        style="
                            min-height: 40px;
                            padding: 8px 18px;
                            border: 0;
                            border-radius: 9px;
                            background: #dc3545;
                            font-size: 13px;
                        "
                    >
                        Ya, Hapus
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     DELETE MODAL SCRIPT
========================================================== --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const form =
                document.getElementById(
                    'deleteUserForm'
                );

            const username =
                document.getElementById(
                    'deleteUsername'
                );


            if (
                !form ||
                !username
            ) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | DELETE BUTTON
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll(
                    '.user-action-delete'
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            'click',
                            function () {

                                const id =
                                    button.dataset.userId;

                                const name =
                                    button.dataset.username;


                                username.textContent =
                                    name;


                                form.action =
                                    `/admin/users/${id}`;

                            }
                        );

                    }
                );

        }
    );

</script>
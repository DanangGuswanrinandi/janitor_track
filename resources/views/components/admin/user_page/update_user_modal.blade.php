{{-- =========================================================
     UPDATE USER MODAL
========================================================== --}}

<div
    class="modal fade"
    id="updateUserModal"
    tabindex="-1"
    aria-labelledby="updateUserModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div
            class="modal-content border-0"
            style="
                border-radius: 14px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            "
        >

            <form
                id="updateUserForm"
                method="POST"
                action="#"
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
                            id="updateUserModalLabel"
                            class="m-0 fw-semibold"
                            style="
                                color: #20252b;
                                font-size: 18px;
                            "
                        >
                            Edit Pengguna
                        </h5>

                        <p
                            class="mt-1 mb-0"
                            style="
                                color: #98a1b2;
                                font-size: 12px;
                            "
                        >
                            Perbarui informasi pengguna.
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

                    {{-- USER ID --}}

                    <input
                        type="hidden"
                        id="updateUserId"
                        name="user_id"
                        value="{{ old('user_id') }}"
                    >


                    {{-- USERNAME --}}

                    <div class="mb-3">

                        <label
                            for="updateUsername"
                            class="form-label mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Username
                        </label>

                        <input
                            type="text"
                            id="updateUsername"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-control @error('username', 'userUpdate') is-invalid @enderror"
                            placeholder="Masukkan username"
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

                        @error('username', 'userUpdate')

                            <div
                                class="mt-1"
                                style="
                                    color: #dc3545;
                                    font-size: 12px;
                                "
                            >
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- PASSWORD BARU --}}

                    <div class="mb-3">

                        <label
                            for="updatePassword"
                            class="form-label mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Password Baru
                        </label>

                        <input
                            type="password"
                            id="updatePassword"
                            name="password"
                            class="form-control @error('password', 'userUpdate') is-invalid @enderror"
                            placeholder="Kosongkan jika tidak ingin mengubah password"
                            autocomplete="new-password"
                            minlength="8"
                            style="
                                min-height: 46px;
                                padding: 10px 13px;
                                border-radius: 9px;
                                color: #252a31;
                                font-size: 13px;
                                box-shadow: none;
                            "
                        >

                        @error('password', 'userUpdate')

                            <div
                                class="mt-1"
                                style="
                                    color: #dc3545;
                                    font-size: 12px;
                                "
                            >
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- ROLE --}}

                    <div class="mb-1">

                        <label
                            for="updateRole"
                            class="form-label mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Role
                        </label>

                        <select
                            id="updateRole"
                            name="role"
                            class="form-select @error('role', 'userUpdate') is-invalid @enderror"
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

                            <option
                                value="user"
                                @selected(old('role', 'user') === 'user')
                            >
                                User
                            </option>

                            <option
                                value="admin"
                                @selected(old('role') === 'admin')
                            >
                                Admin
                            </option>

                        </select>

                        @error('role', 'userUpdate')

                            <div
                                class="mt-1"
                                style="
                                    color: #dc3545;
                                    font-size: 12px;
                                "
                            >
                                {{ $message }}
                            </div>

                        @enderror

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
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     UPDATE MODAL SCRIPT
========================================================== --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const modalElement =
                document.getElementById(
                    'updateUserModal'
                );

            const form =
                document.getElementById(
                    'updateUserForm'
                );

            const userIdInput =
                document.getElementById(
                    'updateUserId'
                );

            const usernameInput =
                document.getElementById(
                    'updateUsername'
                );

            const passwordInput =
                document.getElementById(
                    'updatePassword'
                );

            const roleInput =
                document.getElementById(
                    'updateRole'
                );


            if (
                !modalElement ||
                !form
            ) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | EDIT BUTTON
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll(
                    '.user-action-edit'
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            'click',
                            function () {

                                const id =
                                    button.dataset.userId;

                                const username =
                                    button.dataset.username;

                                const role =
                                    button.dataset.role;


                                userIdInput.value =
                                    id;

                                usernameInput.value =
                                    username;

                                passwordInput.value =
                                    '';

                                roleInput.value =
                                    role;


                                form.action =
                                    `/admin/users/${id}`;

                            }
                        );

                    }
                );


            /*
            |--------------------------------------------------------------------------
            | VALIDATION ERROR
            |--------------------------------------------------------------------------
            */

            @if ($errors->userUpdate->any())

                const errorUserId =
                    @json(old('user_id'));

                if (errorUserId) {

                    form.action =
                        `/admin/users/${errorUserId}`;

                }


                if (
                    typeof bootstrap !==
                    'undefined' &&
                    bootstrap.Modal
                ) {

                    const modal =
                        bootstrap.Modal
                            .getOrCreateInstance(
                                modalElement
                            );

                    modal.show();

                }

            @endif

        }
    );

</script>
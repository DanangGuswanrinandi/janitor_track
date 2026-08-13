{{-- =========================================================
     ADD USER MODAL
========================================================== --}}

<div
    class="modal fade"
    id="addUserModal"
    tabindex="-1"
    aria-labelledby="addUserModalLabel"
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
                method="POST"
                action="{{ route('admin.users.store') }}"
            >

                @csrf


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
                            id="addUserModalLabel"
                            class="m-0 fw-semibold"
                            style="
                                color: #20252b;
                                font-size: 18px;
                            "
                        >
                            Tambah Pengguna
                        </h5>

                        <p
                            class="mt-1 mb-0"
                            style="
                                color: #98a1b2;
                                font-size: 12px;
                            "
                        >
                            Tambahkan akun pengguna baru ke sistem.
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

                    {{-- USERNAME --}}

                    <div class="mb-3">

                        <label
                            for="addUsername"
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
                            id="addUsername"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-control @error('username', 'userCreate') is-invalid @enderror"
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

                        @error('username', 'userCreate')

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


                    {{-- PASSWORD --}}

                    <div class="mb-3">

                        <label
                            for="addPassword"
                            class="form-label mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Password
                        </label>

                        <input
                            type="password"
                                id="addPassword"
                                name="password"
                                class="form-control @error('password', 'userCreate') is-invalid @enderror"
                                placeholder="Masukkan password"
                                autocomplete="new-password"
                                minlength="8"
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

                        @error('password', 'userCreate')

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
                            for="addRole"
                            class="form-label mb-2 fw-semibold"
                            style="
                                color: #3c4450;
                                font-size: 13px;
                            "
                        >
                            Role
                        </label>

                        <select
                            id="addRole"
                            name="role"
                            class="form-select @error('role', 'userCreate') is-invalid @enderror"
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

                            <option value="user" @selected(old('role', 'user') === 'user')>
                                User
                            </option>

                            <option value="admin" @selected(old('role') === 'admin')>
                                Admin
                            </option>

                        </select>

                        @error('role', 'userCreate')

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
                        Tambah Pengguna
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     OPEN MODAL AFTER VALIDATION ERROR
========================================================== --}}

@if ($errors->userCreate->any())

    @push('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const modalElement =
                    document.getElementById('addUserModal');

                if (!modalElement) {
                    return;
                }

                if (
                    typeof bootstrap === 'undefined' ||
                    !bootstrap.Modal
                ) {
                    return;
                }

                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        modalElement
                    );

                modal.show();

            });
        </script>

    @endpush

@endif
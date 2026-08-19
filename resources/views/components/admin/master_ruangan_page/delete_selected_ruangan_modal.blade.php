{{-- =========================================================
     DELETE SELECTED RUANGAN MODAL
========================================================== --}}

<div
    class="modal fade"
    id="deleteSelectedRoomsModal"
    tabindex="-1"
    aria-labelledby="deleteSelectedRoomsModalLabel"
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
                id="deleteSelectedRoomsForm"
                method="POST"
                action="{{ route('admin.master-ruangan.bulk-destroy') }}"
            >

                @csrf

                @method('DELETE')


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
                            id="deleteSelectedRoomsModalLabel"
                            class="m-0 fw-semibold"
                            style="
                                color: #20252b;
                                font-size: 18px;
                            "
                        >
                            Hapus Ruangan
                        </h5>

                        <p
                            class="mt-1 mb-0"
                            style="
                                color: #98a1b2;
                                font-size: 12px;
                            "
                        >
                            Ruangan yang dipilih akan dihapus dari sistem.
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

                    <div
                        class="d-flex align-items-start gap-3"
                        style="
                            padding: 14px;
                            border-radius: 10px;
                            background: #fff5f5;
                        "
                    >

                        <i
                            class="bi bi-exclamation-triangle-fill flex-shrink-0"
                            style="
                                margin-top: 2px;
                                color: #dc3545;
                                font-size: 18px;
                            "
                        ></i>


                        <div>

                            <p
                                class="m-0 fw-semibold"
                                style="
                                    color: #3c4450;
                                    font-size: 13px;
                                "
                            >

                                Apakah Anda yakin ingin menghapus

                                <span id="selectedRoomsCount">
                                    0
                                </span>

                                ruangan yang dipilih?

                            </p>


                            <p
                                class="mt-1 mb-0"
                                style="
                                    color: #98a1b2;
                                    font-size: 12px;
                                "
                            >
                                Tindakan ini tidak dapat dibatalkan.
                            </p>

                        </div>

                    </div>


                    {{-- Hidden inputs dibuat oleh JavaScript --}}

                    <div
                        id="selectedRoomsInputs"
                    ></div>

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
                        class="btn fw-semibold text-white d-inline-flex align-items-center gap-2"
                        style="
                            min-height: 40px;
                            padding: 8px 16px;
                            border: 0;
                            border-radius: 9px;
                            background: #dc3545;
                            font-size: 13px;
                        "
                    >

                        <i class="bi bi-trash"></i>

                        <span>
                            Ya, Hapus
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     BULK DELETE RUANGAN SCRIPT
========================================================== --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const deleteButton =
                document.querySelector(
                    '.admin-table-delete-selected'
                );


            const form =
                document.getElementById(
                    'deleteSelectedRoomsForm'
                );


            const inputsContainer =
                document.getElementById(
                    'selectedRoomsInputs'
                );


            const selectedCount =
                document.getElementById(
                    'selectedRoomsCount'
                );


            if (
                !deleteButton ||
                !form ||
                !inputsContainer ||
                !selectedCount
            ) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | STORAGE KEY
            |--------------------------------------------------------------------------
            */

            const storageKey =
                'cleantrack_selected_room_ids';


            /*
            |--------------------------------------------------------------------------
            | PREPARE SELECTED ROOMS
            |--------------------------------------------------------------------------
            */

            function prepareSelectedRooms() {

                const selectedRoomIds =
                    JSON.parse(
                        sessionStorage.getItem(
                            storageKey
                        ) || '[]'
                    );


                /*
                |--------------------------------------------------------------------------
                | BERSIHKAN INPUT LAMA
                |--------------------------------------------------------------------------
                */

                inputsContainer.innerHTML =
                    '';


                /*
                |--------------------------------------------------------------------------
                | UPDATE JUMLAH
                |--------------------------------------------------------------------------
                */

                selectedCount.textContent =
                    selectedRoomIds.length;


                /*
                |--------------------------------------------------------------------------
                | BUAT HIDDEN INPUT
                |--------------------------------------------------------------------------
                */

                selectedRoomIds.forEach(
                    function (roomId) {

                        const input =
                            document.createElement(
                                'input'
                            );


                        input.type =
                            'hidden';


                        input.name =
                            'room_ids[]';


                        input.value =
                            roomId;


                        inputsContainer.appendChild(
                            input
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | SAAT MODAL DIBUKA
            |--------------------------------------------------------------------------
            */

            deleteButton.addEventListener(
                'click',
                function () {

                    prepareSelectedRooms();

                }
            );


            /*
            |--------------------------------------------------------------------------
            | SEBELUM FORM DIKIRIM
            |--------------------------------------------------------------------------
            */

            form.addEventListener(
                'submit',
                function () {

                    prepareSelectedRooms();

                }
            );

        }
    );

</script>

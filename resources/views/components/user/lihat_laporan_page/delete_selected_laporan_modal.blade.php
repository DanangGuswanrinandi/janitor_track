{{-- =========================================================
     DELETE SELECTED LAPORAN MODAL
========================================================== --}}

<div
    class="modal fade"
    id="deleteSelectedLaporanModal"
    tabindex="-1"
    aria-labelledby="deleteSelectedLaporanModalLabel"
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
                id="deleteSelectedLaporanForm"
                method="POST"
                action="{{ route('user.laporan.bulk-destroy') }}"
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
                            id="deleteSelectedLaporanModalLabel"
                            class="m-0 fw-semibold"
                            style="
                                color: #20252b;
                                font-size: 18px;
                            "
                        >
                            Hapus Laporan
                        </h5>


                        <p
                            class="mt-1 mb-0"
                            style="
                                color: #98a1b2;
                                font-size: 12px;
                            "
                        >
                            Laporan yang dipilih akan dihapus dari sistem.
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

                                <span id="selectedLaporanCount">
                                    0
                                </span>

                                laporan yang dipilih?

                            </p>


                            <p
                                class="mt-1 mb-0"
                                style="
                                    color: #98a1b2;
                                    font-size: 12px;
                                "
                            >
                                Laporan yang sudah terverifikasi tidak dapat
                                dihapus.
                            </p>

                        </div>

                    </div>


                    {{-- Hidden inputs dibuat oleh JavaScript --}}

                    <div
                        id="selectedLaporanInputs"
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
     BULK DELETE LAPORAN SCRIPT
========================================================== --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            /*
            |--------------------------------------------------------------------------
            | ELEMENT
            |--------------------------------------------------------------------------
            */

            const deleteButton =
                document.getElementById(
                    'deleteSelectedLaporanButton'
                );


            const form =
                document.getElementById(
                    'deleteSelectedLaporanForm'
                );


            const inputsContainer =
                document.getElementById(
                    'selectedLaporanInputs'
                );


            const selectedCount =
                document.getElementById(
                    'selectedLaporanCount'
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
                'cleantrack_laporan';


            /*
            |--------------------------------------------------------------------------
            | PREPARE SELECTED LAPORAN
            |--------------------------------------------------------------------------
            */

            function prepareSelectedLaporan() {

                let selectedLaporanIds =
                    JSON.parse(
                        sessionStorage.getItem(
                            storageKey
                        ) || '[]'
                    );


                /*
                |--------------------------------------------------------------------------
                | AMBIL ID LAPORAN YANG SUDAH TERVERIFIKASI
                |--------------------------------------------------------------------------
                */

                const disabledLaporanIds =
                    Array.from(
                        document.querySelectorAll(
                            '.laporan-checkbox:disabled'
                        )
                    ).map(
                        function (checkbox) {
                            return String(
                                checkbox.value
                            );
                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | HAPUS LAPORAN TERVERIFIKASI DARI SELECTION
                |--------------------------------------------------------------------------
                */

                selectedLaporanIds =
                    selectedLaporanIds
                        .map(String)
                        .filter(
                            function (laporanId) {

                                return !disabledLaporanIds.includes(
                                    laporanId
                                );

                            }
                        );


                /*
                |--------------------------------------------------------------------------
                | BERSIHKAN ID DUPLIKAT
                |--------------------------------------------------------------------------
                */

                selectedLaporanIds =
                    [
                        ...new Set(
                            selectedLaporanIds
                        )
                    ];


                /*
                |--------------------------------------------------------------------------
                | SIMPAN KEMBALI SELECTION
                |--------------------------------------------------------------------------
                */

                sessionStorage.setItem(
                    storageKey,
                    JSON.stringify(
                        selectedLaporanIds
                    )
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
                    selectedLaporanIds.length;


                /*
                |--------------------------------------------------------------------------
                | BUAT HIDDEN INPUT
                |--------------------------------------------------------------------------
                */

                selectedLaporanIds.forEach(
                    function (laporanId) {

                        const input =
                            document.createElement(
                                'input'
                            );


                        input.type =
                            'hidden';


                        input.name =
                            'laporan_ids[]';


                        input.value =
                            laporanId;


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

                    prepareSelectedLaporan();

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

                    prepareSelectedLaporan();

                    /*
                    |--------------------------------------------------------------
                    | HAPUS SELECTION SETELAH SUBMIT
                    |--------------------------------------------------------------
                    */

                    sessionStorage.removeItem(
                        storageKey
                    );

                }
            );

        }
    );

</script>

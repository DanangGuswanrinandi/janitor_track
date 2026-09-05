{{-- =========================================================
     ADMIN REUSABLE TABLE
========================================================== --}}

@props([
    'items',
    'storageKey' => null,
    'checkboxClass' => 'admin-table-checkbox',
    'selectAllId' => 'adminTableSelectAll',
    'deleteButtonId' => 'adminTableDeleteButton',
    'deleteModalId' => null,
    'emptyMessage' => 'Belum ada data.',
    'totalLabel' => 'data',
    'minWidth' => '760px',
    'showSelection' => true,
])


{{-- =========================================================
     TABLE CONTAINER
========================================================== --}}

<div class="w-100">


    {{-- =====================================================
         TABLE HORIZONTAL SCROLL
    ====================================================== --}}

    <div
        class="w-100 overflow-auto"
    >

        <table
            class="table align-middle mb-0"
            style="
                min-width: {{ $minWidth }};
            "
        >

            {{-- =================================================
                 TABLE HEADER
            ================================================== --}}

            <thead>

                <tr>

                    @if ($showSelection)

                        {{-- =================================================
                             CHECKBOX SELECT ALL
                        ================================================== --}}

                        <th
                            class="fw-semibold text-center"
                            style="
                                width: 50px;
                                color: #5f6875;
                                font-size: 13px;
                                white-space: nowrap;
                            "
                        >

                            <input
                                type="checkbox"
                                id="{{ $selectAllId }}"
                                class="form-check-input m-0"
                                style="
                                    width: 16px;
                                    height: 16px;
                                    cursor: pointer;
                                "
                                aria-label="Pilih semua"
                            >

                        </th>

                    @endif


                    {{-- =================================================
                         CUSTOM HEADER
                    ================================================== --}}

                    {{ $head }}

                </tr>

            </thead>


            {{-- =================================================
                 TABLE BODY
            ================================================== --}}

            <tbody>

                {{ $body }}

            </tbody>

        </table>

    </div>


    {{-- =========================================================
         PAGINATION
    ========================================================== --}}

    @if ($items->hasPages())

        <div
            class="d-flex align-items-center justify-content-between gap-3 mt-3"
            style="
                flex-wrap: wrap;
            "
        >

            {{-- =================================================
                 PAGINATION INFO
            ================================================== --}}

            <div
                class="flex-shrink-0"
                style="
                    color: #98a1b2;
                    font-size: 12px;
                    white-space: nowrap;
                "
            >

                Menampilkan

                <span
                    class="fw-semibold"
                    style="
                        color: #5f6875;
                    "
                >
                    {{ $items->firstItem() }}
                </span>

                -

                <span
                    class="fw-semibold"
                    style="
                        color: #5f6875;
                    "
                >
                    {{ $items->lastItem() }}
                </span>

                dari

                <span
                    class="fw-semibold"
                    style="
                        color: #5f6875;
                    "
                >
                    {{ $items->total() }}
                </span>

                {{ $totalLabel }}

            </div>


            {{-- =================================================
                 PAGINATION BUTTON
            ================================================== --}}

            <nav
                aria-label="Navigasi halaman"
                class="flex-shrink-0"
            >

                <ul
                    class="pagination mb-0"
                >

                    {{-- =================================================
                         PREVIOUS
                    ================================================== --}}

                    <li
                        class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}"
                    >

                        @if ($items->onFirstPage())

                            <span
                                class="page-link d-flex align-items-center justify-content-center"
                                aria-hidden="true"
                                style="
                                    width: 42px;
                                    height: 42px;
                                    color: #98a1b2;
                                    background: #f1f3f6;
                                "
                            >
                                &lsaquo;
                            </span>

                        @else

                            <a
                                class="page-link d-flex align-items-center justify-content-center"
                                href="{{ $items->previousPageUrl() }}"
                                aria-label="Halaman sebelumnya"
                                style="
                                    width: 42px;
                                    height: 42px;
                                    color: #3478f6;
                                "
                            >
                                &lsaquo;
                            </a>

                        @endif

                    </li>


                    {{-- =================================================
                         PAGE NUMBER
                    ================================================== --}}

                    @foreach (
                        $items->getUrlRange(
                            max(1, $items->currentPage() - 1),
                            min($items->lastPage(), $items->currentPage() + 1)
                        )
                        as $page => $url
                    )

                        <li
                            class="page-item {{ $page == $items->currentPage() ? 'active' : '' }}"
                        >

                            <a
                                class="page-link d-flex align-items-center justify-content-center"
                                href="{{ $url }}"
                                style="
                                    width: 42px;
                                    height: 42px;

                                    {{
                                        $page == $items->currentPage()
                                            ? 'background: #3478f6; border-color: #3478f6; color: #ffffff;'
                                            : 'color: #3478f6;'
                                    }}
                                "
                            >
                                {{ $page }}
                            </a>

                        </li>

                    @endforeach


                    {{-- =================================================
                         NEXT
                    ================================================== --}}

                    <li
                        class="page-item {{ $items->hasMorePages() ? '' : 'disabled' }}"
                    >

                        @if ($items->hasMorePages())

                            <a
                                class="page-link d-flex align-items-center justify-content-center"
                                href="{{ $items->nextPageUrl() }}"
                                aria-label="Halaman berikutnya"
                                style="
                                    width: 42px;
                                    height: 42px;
                                    color: #3478f6;
                                "
                            >
                                &rsaquo;
                            </a>

                        @else

                            <span
                                class="page-link d-flex align-items-center justify-content-center"
                                aria-hidden="true"
                                style="
                                    width: 42px;
                                    height: 42px;
                                    color: #98a1b2;
                                "
                            >
                                &rsaquo;
                            </span>

                        @endif

                    </li>

                </ul>

            </nav>

        </div>

    @endif


    @if ($showSelection)

        {{-- =================================================
             BULK DELETE BUTTON
        ================================================== --}}
        
        <div
            class="d-flex align-items-center justify-content-end mt-3"
        >
        
            <button
                type="button"
                id="{{ $deleteButtonId }}"
                class="btn fw-semibold d-inline-flex align-items-center gap-2 admin-table-delete-selected"
                @if ($deleteModalId)
                    data-bs-toggle="modal"
                    data-bs-target="#{{ $deleteModalId }}"
                @endif
                disabled
                style="
                    min-height: 40px;
                    padding: 8px 14px;
                    border: 1px solid #f1d9dc;
                    border-radius: 9px;
                    background: #ffffff;
                    color: #dc3545;
                    font-size: 13px;
                    opacity: 0.55;
                    cursor: not-allowed;
                "
            >
        
                <i class="bi bi-trash"></i>
        
                <span>
                    Hapus Pilihan
                </span>
            
            </button>
        
        </div>
    
    @endif
    
    </div>


{{-- =========================================================
     GENERIC BULK SELECT SCRIPT
========================================================== --}}
@if ($showSelection)
<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            /*
            |--------------------------------------------------------------------------
            | ELEMENT
            |--------------------------------------------------------------------------
            */

            const selectAll =
                document.getElementById(
                    @json($selectAllId)
                );


            const checkboxes =
                document.querySelectorAll(
                    '.{{ $checkboxClass }}'
                );


            const deleteButton =
                document.getElementById(
                    @json($deleteButtonId)
                );


            /*
            |--------------------------------------------------------------------------
            | STORAGE KEY
            |--------------------------------------------------------------------------
            */

            const storageKey =
                @json($storageKey);


            /*
            |--------------------------------------------------------------------------
            | AMBIL DATA SELECTION
            |--------------------------------------------------------------------------
            */

            let selectedIds =
                new Set(
                    JSON.parse(
                        sessionStorage.getItem(
                            storageKey
                        ) || '[]'
                    ).map(String)
                );


            /*
            |--------------------------------------------------------------------------
            | SIMPAN SELECTION
            |--------------------------------------------------------------------------
            */

            function saveSelection() {

                sessionStorage.setItem(
                    storageKey,
                    JSON.stringify(
                        [...selectedIds]
                    )
                );

            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE DELETE BUTTON
            |--------------------------------------------------------------------------
            */

            function updateDeleteButton() {

                if (!deleteButton) {
                    return;
                }


                const hasSelection =
                    selectedIds.size > 0;


                deleteButton.disabled =
                    !hasSelection;


                if (hasSelection) {

                    deleteButton.style.opacity =
                        '1';

                    deleteButton.style.cursor =
                        'pointer';

                } else {

                    deleteButton.style.opacity =
                        '0.55';

                    deleteButton.style.cursor =
                        'not-allowed';

                }

            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE SELECT ALL
            |--------------------------------------------------------------------------
            */

            function updateSelectAll() {

                if (!selectAll) {
                    return;
                }


                const total =
                    checkboxes.length;


                const selectedOnPage =
                    Array.from(
                        checkboxes
                    ).filter(
                        function (checkbox) {

                            return selectedIds.has(
                                String(
                                    checkbox.value
                                )
                            );

                        }
                    ).length;


                /*
                |--------------------------------------------------------------------------
                | TIDAK ADA DATA
                |--------------------------------------------------------------------------
                */

                if (total === 0) {

                    selectAll.checked =
                        false;

                    selectAll.indeterminate =
                        false;

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | SEMUA DATA DI HALAMAN TERPILIH
                |--------------------------------------------------------------------------
                */

                if (
                    selectedOnPage === total
                ) {

                    selectAll.checked =
                        true;

                    selectAll.indeterminate =
                        false;

                }


                /*
                |--------------------------------------------------------------------------
                | SEBAGIAN DATA DI HALAMAN TERPILIH
                |--------------------------------------------------------------------------
                */

                else if (
                    selectedOnPage > 0
                ) {

                    selectAll.checked =
                        false;

                    selectAll.indeterminate =
                        true;

                }


                /*
                |--------------------------------------------------------------------------
                | TIDAK ADA DATA YANG TERPILIH
                |--------------------------------------------------------------------------
                */

                else {

                    selectAll.checked =
                        false;

                    selectAll.indeterminate =
                        false;

                }

            }


            /*
            |--------------------------------------------------------------------------
            | RESTORE CHECKBOX
            |--------------------------------------------------------------------------
            */

            function restoreSelection() {

                checkboxes.forEach(
                    function (checkbox) {

                        checkbox.checked =
                            selectedIds.has(
                                String(
                                    checkbox.value
                                )
                            );

                    }
                );


                updateSelectAll();

                updateDeleteButton();

            }


            /*
            |--------------------------------------------------------------------------
            | SELECT ALL
            |--------------------------------------------------------------------------
            */

            if (selectAll) {

                selectAll.addEventListener(
                    'change',
                    function () {

                        checkboxes.forEach(
                            function (checkbox) {

                                const id =
                                    String(
                                        checkbox.value
                                    );


                                if (
                                    selectAll.checked
                                ) {

                                    selectedIds.add(
                                        id
                                    );

                                } else {

                                    selectedIds.delete(
                                        id
                                    );

                                }


                                checkbox.checked =
                                    selectAll.checked;

                            }
                        );


                        saveSelection();

                        updateSelectAll();

                        updateDeleteButton();

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | INDIVIDUAL CHECKBOX
            |--------------------------------------------------------------------------
            */

            checkboxes.forEach(
                function (checkbox) {

                    checkbox.addEventListener(
                        'change',
                        function () {

                            const id =
                                String(
                                    checkbox.value
                                );


                            if (
                                checkbox.checked
                            ) {

                                selectedIds.add(
                                    id
                                );

                            } else {

                                selectedIds.delete(
                                    id
                                );

                            }


                            saveSelection();

                            updateSelectAll();

                            updateDeleteButton();

                        }
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | INITIALIZE
            |--------------------------------------------------------------------------
            */

            restoreSelection();

        }
    );

</script>

@endif

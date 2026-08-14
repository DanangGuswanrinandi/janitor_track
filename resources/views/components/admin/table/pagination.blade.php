{{-- =========================================================
     PAGINATION
========================================================== --}}

@if ($data->hasPages())

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
                {{ $data->firstItem() }}
            </span>

            -

            <span
                class="fw-semibold"
                style="
                    color: #5f6875;
                "
            >
                {{ $data->lastItem() }}
            </span>

            dari

            <span
                class="fw-semibold"
                style="
                    color: #5f6875;
                "
            >
                {{ $data->total() }}
            </span>

            data

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
                    class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}"
                >

                    @if ($data->onFirstPage())

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
                            href="{{ $data->previousPageUrl() }}"
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

                @foreach ($data->getUrlRange(
                    max(1, $data->currentPage() - 1),
                    min($data->lastPage(), $data->currentPage() + 1)
                ) as $page => $url)

                    <li
                        class="page-item {{ $page == $data->currentPage() ? 'active' : '' }}"
                    >

                        <a
                            class="page-link d-flex align-items-center justify-content-center"
                            href="{{ $url }}"
                            style="
                                width: 42px;
                                height: 42px;
                                {{ $page == $data->currentPage()
                                    ? 'background: #3478f6; border-color: #3478f6; color: #ffffff;'
                                    : 'color: #3478f6;' }}
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
                    class="page-item {{ $data->hasMorePages() ? '' : 'disabled' }}"
                >

                    @if ($data->hasMorePages())

                        <a
                            class="page-link d-flex align-items-center justify-content-center"
                            href="{{ $data->nextPageUrl() }}"
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
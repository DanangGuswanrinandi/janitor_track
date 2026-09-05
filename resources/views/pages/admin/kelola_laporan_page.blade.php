@extends('layouts.admin.app')

@section('title', 'Kelola Laporan')

@section('navbar-title', 'Kelola Laporan')

@section('navbar-subtitle', 'Selamat datang di CleanTrack.')

@section('content')

    <div class="w-100">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="mb-4">

            <h2
                class="m-0 fw-bold"
                style="
                    color: #20252b;
                    font-size: 24px;
                "
            >
                Kelola Laporan
            </h2>

            <p
                class="mt-1 mb-0"
                style="
                    color: #98a1b2;
                    font-size: 13px;
                "
            >
                Kelola laporan kebersihan ruangan yang telah dikirim oleh pengguna.
            </p>

        </div>

        {{-- =====================================================
             SUCCESS ALERT
        ====================================================== --}}

        <x-alert.success />

        <div
            class="p-4 bg-white"
            style="
                border: 1px solid #edf0f5;
                border-radius: 14px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            "
        >

            <h3
                class="m-0 fw-semibold mb-3"
                style="
                    color: #252a31;
                    font-size: 17px;
                "
            >
                Kelola Laporan
            </h3>

            {{-- =====================================================
                 FILTER LAPORAN
            ====================================================== --}}

            <x-admin.kelola_laporan_page.filter_kelola_laporan
                :users="$users"
                :ruangans="$ruangans"
                :years="$years"
            />

            {{-- =====================================================
             TABEL LAPORAN
            ====================================================== --}}

            <div class="mt-4">

                <x-admin.kelola_laporan_page.kelola_laporan_table
                    :laporans="$laporans"
                />

            </div>


            {{-- =====================================================
                 MODAL APPROVE LAPORAN
            ====================================================== --}}

            <x-admin.kelola_laporan_page.approve_laporan_modal />

            {{-- =====================================================
                 SCRIPT APPROVE LAPORAN
            ====================================================== --}}

            <x-admin.kelola_laporan_page.approve_laporan_script />

            {{-- =========================================================
                 MODAL VIEW
            ========================================================== --}}

            <x-admin.kelola_laporan_page.view_kelola_laporan_modal />


            {{-- =========================================================
                 MODAL EDIT
            ========================================================== --}}

            <x-admin.kelola_laporan_page.edit_kelola_laporan_modal />


            {{-- =========================================================
                 MODAL DELETE
            ========================================================== --}}

            <x-admin.kelola_laporan_page.delete_kelola_laporan_modal />


            {{-- =========================================================
                 MODAL APPROVE
            ========================================================== --}}

            <x-admin.kelola_laporan_page.approve_laporan_modal />

            {{-- =========================================================
                 SCRIPT APPROVE
            ========================================================== --}}

            <x-admin.kelola_laporan_page.kelola_laporan_modal_script />

            {{-- =========================================================
                 MODAL DELETE SELECTED
            ========================================================== --}}
            <x-admin.kelola_laporan_page.delete_selected_kelola_laporan_modal />

            {{-- =========================================================
                 CLEAR SELECTED LAPORAN AFTER SUCCESS
            ========================================================= --}}

            @if (session('success'))

                @push('scripts')

                    <script>

                        sessionStorage.removeItem(
                            'cleantrack_kelola_laporan'
                        );

                    </script>

                @endpush

            @endif


            {{-- =========================================================
                 KELOLA LAPORAN SELECTION PAGE STATE
            ========================================================= --}}

            @push('scripts')

                <script>

                    document.addEventListener(
                        'DOMContentLoaded',
                        function () {

                            const storageKey =
                                'cleantrack_kelola_laporan';


                            const previousPage =
                                sessionStorage.getItem(
                                    'cleantrack_previous_page'
                                );


                            /*
                            |--------------------------------------------------------------------------
                            | Jika sebelumnya berasal dari halaman selain kelola laporan
                            |--------------------------------------------------------------------------
                            */

                            if (
                                previousPage &&
                                previousPage !== 'kelola-laporan'
                            ) {

                                sessionStorage.removeItem(
                                    storageKey
                                );

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | Tandai halaman saat ini
                            |--------------------------------------------------------------------------
                            */

                            sessionStorage.setItem(
                                'cleantrack_previous_page',
                                'kelola-laporan'
                            );

                        }
                    );

                </script>

            @endpush


        </div>

    </div>

@endsection

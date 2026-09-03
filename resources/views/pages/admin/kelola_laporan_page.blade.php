@extends('layouts.admin.app')

@section('title', 'Kelola Laporan')

@section('navbar-title', 'Kelola Laporan')

@section('navbar-subtitle', 'Selamat datang di CleanTrack.')

@section('content')

    <div class="w-100">

        <div
            class="p-4 bg-white"
            style="
                border: 1px solid #edf0f5;
                border-radius: 14px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            "
        >

            <h2
                class="m-0 fw-bold"
                style="
                    color: #20252b;
                    font-size: 24px;
                "
            >
                Kelola Laporan
            </h2>

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


        </div>

    </div>

@endsection

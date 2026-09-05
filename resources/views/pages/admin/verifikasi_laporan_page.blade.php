@extends('layouts.admin.app')

@section('title', 'Verifikasi Laporan')

@section('navbar-title', 'Verifikasi Laporan')

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
                Verifikasi Laporan
            </h2>

            <p
                class="mt-1 mb-0"
                style="
                    color: #98a1b2;
                    font-size: 13px;
                "
            >
                Verifikasi laporan kebersihan ruangan yang
                masih menunggu persetujuan.
            </p>

        </div>


        {{-- =====================================================
             SUCCESS ALERT
        ====================================================== --}}

        <x-alert.success />


        {{-- =====================================================
             TABLE CARD
        ====================================================== --}}

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
                Laporan Menunggu Verifikasi
            </h3>


            {{-- =================================================
                 TABEL VERIFIKASI
            ================================================== --}}

            <div class="mt-4">

                <x-admin.verifikasi_laporan_page.verifikasi_laporan_table
                    :laporans="$laporans"
                />

            </div>


            {{-- =================================================
                 MODAL APPROVE LAPORAN
            ================================================== --}}

            <x-admin.kelola_laporan_page.approve_laporan_modal />


            {{-- =================================================
                 SCRIPT APPROVE LAPORAN
            ================================================== --}}

            <x-admin.kelola_laporan_page.approve_laporan_script />

        </div>

    </div>

@endsection

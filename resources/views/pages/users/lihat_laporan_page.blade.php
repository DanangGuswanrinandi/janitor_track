@extends('layouts.user.app')

@section('title', 'Lihat Laporan')

@section('navbar-title', 'Lihat Laporan')

@section('navbar-subtitle', 'Daftar laporan kebersihan ruangan.')

@section('content')

    <div class="w-100">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div
            style="
                margin-bottom: 24px;
            "
        >

            <h2
                style="
                    margin: 0;
                    color: #20252b;
                    font-size: 24px;
                    font-weight: 700;
                "
            >
                Lihat Laporan
            </h2>


            <p
                style="
                    margin: 6px 0 0;
                    color: #98a1b2;
                    font-size: 13px;
                "
            >
                Daftar laporan kebersihan ruangan yang telah dikirim.
            </p>

        </div>


        {{-- =====================================================
             PAGE CARD
        ====================================================== --}}

        <div
            class="w-100 p-4 bg-white"
            style="
                box-sizing: border-box;
                border: 1px solid #edf0f5;
                border-radius: 14px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            "
        >

            {{-- =================================================
                 CARD HEADER
            ================================================== --}}

            <div
                class="mb-4"
            >

                <h3
                    class="m-0 fw-semibold"
                    style="
                        color: #252a31;
                        font-size: 17px;
                    "
                >
                    Daftar Laporan
                </h3>


                <p
                    class="mt-1 mb-0"
                    style="
                        color: #98a1b2;
                        font-size: 12px;
                    "
                >
                    Riwayat laporan kebersihan yang telah dibuat.
                </p>

            </div>


            {{-- =================================================
                 LAPORAN TABLE
            ================================================== --}}

            @include(
                'components.user.lihat_laporan_page.laporan_table'
            )

            {{-- MODAL VIEW --}}

            @include(
                'components.user.lihat_laporan_page.view_lihatLaporan_modal'
            )


            {{-- MODAL EDIT --}}

            @include(
                'components.user.lihat_laporan_page.edit_lihatLaporan_modal'
            )


            {{-- MODAL DELETE --}}

            @include(
                'components.user.lihat_laporan_page.delete_lihatLaporan_modal'
            )

            @include(
                'components.user.lihat_laporan_page.laporan_modal_script'
            )

            {{-- MODAL BULK DELETE --}}

            @include(
                'components.user.lihat_laporan_page.delete_selected_laporan_modal'
            )

        </div>

    </div>

@endsection

@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('navbar-title', 'Dashboard')

@section(
    'navbar-subtitle',
    'Selamat datang kembali di CleanTrack.'
)

@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="mb-4">

        <h2 class="m-0 fw-bold" style="color: #20252b; font-size: 24px;">
            Dashboard
        </h2>

        <p class="m-0" style="margin-top: 6px !important; color: #8b95a5; font-size: 14px;">
            Ringkasan aktivitas sistem CleanTrack.
        </p>

    </div>

    {{-- =====================================================
         STAT CARDS
    ====================================================== --}}

    <div class="dashboard-stat-grid"
        style="
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        ">

        @foreach ([
            [
                'title' => 'Total Laporan',
                'value' => '0',
                'icon' => 'bi-clipboard2-data',
            ],
            [
                'title' => 'Laporan Hari Ini',
                'value' => '0',
                'icon' => 'bi-calendar-check',
            ],
            [
                'title' => 'Total Janitor',
                'value' => '0',
                'icon' => 'bi-person-badge',
            ],
            [
                'title' => 'Laporan Pending',
                'value' => '0',
                'icon' => 'bi-clock-history',
            ],
        ] as $stat)

            <div class="border rounded-3 bg-white"
                style="
                    padding: 20px;
                    border-color: #edf0f5 !important;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
                ">

                <div class="d-flex align-items-center justify-content-between">

                    <div class="d-flex align-items-center justify-content-center"
                        style="
                            width: 42px;
                            height: 42px;
                            border-radius: 11px;
                            background: #eaf1ff;
                            color: #3478f6;
                            font-size: 18px;
                        ">

                        <i class="bi {{ $stat['icon'] }}"></i>

                    </div>

                </div>

                <p class="m-0" style="margin-top: 18px !important; margin-bottom: 5px !important; color: #8b95a5; font-size: 13px;">
                    {{ $stat['title'] }}
                </p>

                <h3 class="m-0 fw-bold" style="color: #20252b; font-size: 25px;">
                    {{ $stat['value'] }}
                </h3>

            </div>

        @endforeach

    </div>

    {{-- =====================================================
         CONTENT CARD
    ====================================================== --}}

    <div class="border rounded-3 bg-white mt-4"
        style="
            padding: 24px;
            border-color: #edf0f5 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        ">

        <h3 class="m-0 fw-semibold" style="color: #20252b; font-size: 17px;">
            Aktivitas Terbaru
        </h3>

        <p class="m-0" style="margin-top: 8px !important; color: #98a1b2; font-size: 13px;">
            Belum ada aktivitas yang tercatat.
        </p>

    </div>

    <style>
        /* =========================================================
           RESPONSIVE GRID
        ========================================================== */

        @media (max-width: 1100px) {
            .dashboard-stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }
        }

        @media (max-width: 575.98px) {
            .dashboard-stat-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>

@endsection
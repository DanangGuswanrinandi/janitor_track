@extends('layouts.admin.app')

@section('title', 'Master Ruangan')

@section('navbar-title', 'Master Ruangan')

@section('navbar-subtitle', 'Kelola data ruangan sistem CleanTrack.')

@section('content')

    <div
        style="
            width: 100%;
        "
    >

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
                Data Master Ruangan
            </h2>

            <p
                style="
                    margin: 6px 0 0;
                    color: #98a1b2;
                    font-size: 13px;
                "
            >
                Kelola data ruangan dalam sistem CleanTrack.
            </p>

        </div>

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
                class="d-flex align-items-center justify-content-between gap-3 mb-4"
            >

                {{-- TITLE --}}

                <div>

                    <h3
                        class="m-0 fw-semibold"
                        style="
                            color: #252a31;
                            font-size: 17px;
                        "
                    >
                        Daftar Pengguna
                    </h3>

                </div>


                {{-- =================================================
                     ADD USER BUTTON
                ================================================== --}}

                <button
                    type="button"
                    class="btn fw-semibold text-white d-flex align-items-center gap-2"
                    data-bs-toggle="modal"
                    data-bs-target=""
                    style="
                        padding: 9px 16px;
                        border: 0;
                        border-radius: 9px;
                        background: #3478f6;
                        font-size: 13px;
                    "
                >

                    <i class="bi bi-plus-lg"></i>

                    <span>
                        Tambah Pengguna
                    </span>
                
                </button>

            </div>

    {{-- =====================================================
             RUANGAN TABLE
        ====================================================== --}}

        @include('components.admin.master_ruangan_page.ruangan_table')
    
    </div>


        

    </div>

@endsection
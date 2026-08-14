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

    </div>

@endsection
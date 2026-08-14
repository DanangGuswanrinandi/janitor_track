@extends('layouts.user.app')

@section('title', 'Dashboard')

@section('navbar-title', 'Dashboard')

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
                Dashboard User
            </h2>

            <p
                class="mt-2 mb-0"
                style="
                    color: #98a1b2;
                    font-size: 13px;
                "
            >
                Selamat datang,
                {{ auth()->user()->username }}.
            </p>

        </div>

    </div>

@endsection
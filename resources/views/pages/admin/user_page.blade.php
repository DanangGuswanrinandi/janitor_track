@extends('layouts.admin.app')

@section('title', 'Pengguna')

@section('navbar-title', 'Pengguna')

@section('navbar-subtitle', 'Kelola pengguna sistem CleanTrack.')

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
                Data Pengguna
            </h2>

            <p
                class="mt-1 mb-0"
                style="
                    color: #98a1b2;
                    font-size: 13px;
                "
            >
                Kelola akun dan role pengguna CleanTrack.
            </p>

        </div>

        @if (session('success'))

            <div
                class="alert d-flex align-items-center gap-2 mb-4"
                style="
                    border: 1px solid #cfe2ff;
                    border-radius: 10px;
                    background: #eaf1ff;
                    color: #3478f6;
                    font-size: 13px;
                "
            >

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>
            
            </div>
        
        @endif
        
        
        {{-- =====================================================
             CLEAR SELECTED USERS AFTER SUCCESS
        ====================================================== --}}
        
        @if (session('success'))
        
            @push('scripts')
        
                <script>
                
                    sessionStorage.removeItem(
                        'cleantrack_selected_user_ids'
                    );
                
                </script>

            @endpush
            
        @endif


        {{-- =====================================================
             CONTENT CARD
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
                    data-bs-target="#addUserModal"
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


            {{-- =================================================
                 USER TABLE
            ================================================== --}}

            @include('components.admin.user_page.user_table')

            {{-- =================================================
                 ADD USER MODAL
            ================================================== --}}

            @include('components.admin.user_page.add_user_modal')

            {{-- =====================================================
                 UPDATE USER MODAL
            ====================================================== --}}

            @include(
                'components.admin.user_page.update_user_modal'
            )


            {{-- =====================================================
                 DELETE USER MODAL
            ====================================================== --}}

            @include(
                'components.admin.user_page.delete_user_modal'
            )

            @include('components.admin.user_page.delete_selected_users_modal')

        </div>

    </div>

    {{-- =====================================================
         USER SELECTION PAGE STATE
    ====================================================== --}}
    
    @push('scripts')
    
        <script>
        
            document.addEventListener(
                'DOMContentLoaded',
                function () {
                
                    const storageKey =
                        'cleantrack_selected_user_ids';
                
                
                    const previousPage =
                        sessionStorage.getItem(
                            'cleantrack_previous_page'
                        );
                
                
                    /*
                    |--------------------------------------------------------------------------
                    | Jika sebelumnya berasal dari halaman selain users
                    |--------------------------------------------------------------------------
                    */
                
                    if (
                        previousPage &&
                        previousPage !== 'users'
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
                        'users'
                    );
                
                }
            );
            
        </script>
    
    @endpush

@endsection
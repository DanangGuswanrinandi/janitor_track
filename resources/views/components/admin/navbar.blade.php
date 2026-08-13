{{-- =========================================================
     ADMIN NAVBAR
========================================================== --}}

<header class="sticky-top d-flex align-items-center justify-content-between border-bottom bg-white"
    style="z-index: 1000; height: 74px; padding: 0 28px; border-color: #edf0f5 !important;">

    {{-- =====================================================
         LEFT
    ====================================================== --}}

    <div class="d-flex align-items-center gap-2" style="min-width: 0; gap: 15px !important;">

        {{-- Mobile Menu Button --}}

        <button type="button" id="sidebarToggle" aria-label="Buka menu"
            class="d-none align-items-center justify-content-center border rounded"
            style="width: 38px; height: 38px; padding: 0; border-color: #e9edf3 !important; background: #ffffff; color: #3478f6; font-size: 18px; cursor: pointer;">

            <i class="bi bi-list"></i>
        </button>

        {{-- Page Title --}}

        <div style="min-width: 0;">

            <h1 class="m-0 fw-semibold" style="color: #20252b; font-size: 18px; line-height: 1.3;">
                @yield('navbar-title', 'Dashboard')
            </h1>

            <p class="m-0" style="margin-top: 3px !important; color: #98a1b2; font-size: 12px;">
                @yield('navbar-subtitle', 'Selamat datang kembali di CleanTrack.')
            </p>

        </div>

    </div>

    {{-- =====================================================
         RIGHT - USER
    ====================================================== --}}

    <div class="position-relative flex-shrink-0">

        <button type="button" id="userDropdownToggle" aria-label="Menu pengguna"
            class="d-flex align-items-center border-0 rounded-3"
            style="gap: 10px; padding: 6px 8px 6px 6px; background: transparent; color: #20252b; cursor: pointer;">

            {{-- Avatar --}}

            <div class="d-flex align-items-center justify-content-center rounded-circle"
                style="width: 38px; height: 38px; background: #eaf1ff; color: #3478f6; font-size: 15px; font-weight: 700;">
                {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
            </div>

            {{-- Username --}}

            <div class="navbar-user-info d-flex flex-column align-items-start">

                <span class="fw-semibold text-truncate"
                    style="max-width: 140px; color: #252a31; font-size: 13px;">
                    {{ auth()->user()->username }}
                </span>

                <span class="text-capitalize" style="color: #98a1b2; font-size: 11px;">
                    {{ auth()->user()->role }}
                </span>

            </div>

            {{-- Arrow --}}

            <i class="bi bi-chevron-down" style="margin-left: 3px; color: #8d96a5; font-size: 11px;"></i>

        </button>

        {{-- =================================================
             DROPDOWN
        ================================================== --}}

        <div id="userDropdownMenu"
            class="position-absolute border rounded-3 bg-white"
            style="
                top: calc(100% + 8px);
                right: 0;
                z-index: 1100;
                width: 190px;
                padding: 7px;
                border-color: #edf0f5 !important;
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.10);
                opacity: 0;
                visibility: hidden;
                transform: translateY(-5px);
                transition: opacity 0.15s ease, visibility 0.15s ease, transform 0.15s ease;
            ">

            {{-- Profil --}}

            <a href="#" class="user-dropdown-item d-flex align-items-center text-decoration-none"
                style="gap: 11px; min-height: 40px; padding: 0 11px; border-radius: 8px; color: #3c4450; font-size: 13px;">

                <i class="bi bi-person" style="color: #3478f6; font-size: 16px;"></i>

                <span>Profil</span>

            </a>

            {{-- Divider --}}

            <div class="my-1" style="height: 1px; margin: 6px 4px !important; background: #edf0f5;"></div>

            {{-- Logout --}}

            <form method="POST" action="{{ route('logout') }}" class="m-0">

                @csrf

                <button type="submit" class="user-dropdown-item d-flex align-items-center w-100 border-0 bg-transparent"
                    style="gap: 11px; min-height: 40px; padding: 0 11px; border-radius: 8px; color: #dc3545; font-size: 13px; text-align: left; cursor: pointer;">

                    <i class="bi bi-box-arrow-right" style="font-size: 16px;"></i>

                    <span>Logout</span>

                </button>

            </form>

        </div>

    </div>

</header>

<style>
    /* =========================================================
       USER BUTTON
    ========================================================== */

    #userDropdownToggle:hover {
        background: #f6f8fc !important;
    }

    /* =========================================================
       DROPDOWN
    ========================================================== */

    #userDropdownMenu.show {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) !important;
    }

    .user-dropdown-item:hover {
        background: #f5f7fb !important;
    }

    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 991.98px) {
        #sidebarToggle {
            display: flex !important;
        }
    }

    @media (max-width: 575.98px) {
        header {
            height: 66px !important;
            padding-left: 16px !important;
            padding-right: 16px !important;
        }

        .navbar-user-info {
            display: none !important;
        }
    }
</style>
{{-- =========================================================
     ADMIN SIDEBAR
========================================================== --}}

<aside
    id="adminSidebar"
    class="position-fixed top-0 start-0 d-flex flex-column"
    style="
        z-index: 1050;
        width: 250px;
        height: 100vh;
        background: #3478f6;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.06);
        transition: transform 0.25s ease;
    "
>

    {{-- =====================================================
         BRAND
    ====================================================== --}}

    <div
        class="d-flex align-items-center flex-shrink-0"
        style="
            height: 78px;
            padding: 0 24px;
            box-sizing: border-box;
        "
    >

        <div
            class="d-flex align-items-center gap-2 text-white"
        >

            {{-- Logo --}}
            <div
                class="d-flex align-items-center justify-content-center overflow-hidden"
                style="
                    width: 38px;
                    height: 38px;
                    border-radius: 10px;
                    background: rgba(255, 255, 255, 0.14);
                    border: 1px solid rgba(255, 255, 255, 0.18);
                "
            >

                <img
                    src="{{ asset('images/cleantrack-logo.png') }}"
                    alt="CleanTrack"
                    class="w-100 h-100"
                    style="
                        object-fit: contain;
                    "
                >

            </div>


            {{-- Name --}}
            <span
                class="fw-bold text-white"
                style="
                    font-size: 19px;
                    letter-spacing: -0.3px;
                "
            >
                CleanTrack
            </span>

        </div>


        {{-- =================================================
             MOBILE CLOSE BUTTON
        ================================================== --}}

        <button
            type="button"
            id="sidebarClose"
            class="d-none"
            aria-label="Tutup menu"
            style="
                margin-left: auto;
                padding: 6px;
                border: 0;
                background: transparent;
                color: #ffffff;
                font-size: 20px;
                cursor: pointer;
            "
        >
            <i class="bi bi-x-lg"></i>
        </button>

    </div>


    {{-- =====================================================
         MENU
    ====================================================== --}}

    <nav
        class="flex-grow-1 overflow-auto"
        style="
            padding: 14px 14px 20px;
            box-sizing: border-box;
        "
    >

        {{-- =================================================
             DASHBOARD
        ================================================== --}}

        <a
            href="{{ route('dashboard') }}"
            class="
                admin-menu-item
                d-flex
                align-items-center
                gap-2
                w-100
                text-decoration-none
                {{ request()->routeIs('dashboard') ? 'active' : '' }}
            "
            style="
                min-height: 46px;
                margin-bottom: 7px;
                padding: 0 14px;
                box-sizing: border-box;
                border-radius: 10px;
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
                transition:
                    background 0.2s ease,
                    color 0.2s ease;
            "
        >

            <i
                class="bi bi-grid-1x2-fill flex-shrink-0"
                style="
                    width: 20px;
                    font-size: 16px;
                "
            ></i>

            <span>
                Dashboard
            </span>

        </a>


        {{-- =================================================
             LAPORAN
        ================================================== --}}

        <a
            href="#"
            class="
                admin-menu-item
                d-flex
                align-items-center
                gap-2
                w-100
                text-decoration-none
            "
            style="
                min-height: 46px;
                margin-bottom: 7px;
                padding: 0 14px;
                box-sizing: border-box;
                border-radius: 10px;
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
                transition:
                    background 0.2s ease,
                    color 0.2s ease;
            "
        >

            <i
                class="bi bi-clipboard2-data flex-shrink-0"
                style="
                    width: 20px;
                    font-size: 16px;
                "
            ></i>

            <span>
                Laporan
            </span>

        </a>


        {{-- =================================================
             JANITOR
        ================================================== --}}

        <a
            href="#"
            class="
                admin-menu-item
                d-flex
                align-items-center
                gap-2
                w-100
                text-decoration-none
            "
            style="
                min-height: 46px;
                margin-bottom: 7px;
                padding: 0 14px;
                box-sizing: border-box;
                border-radius: 10px;
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
                transition:
                    background 0.2s ease,
                    color 0.2s ease;
            "
        >

            <i
                class="bi bi-person-badge flex-shrink-0"
                style="
                    width: 20px;
                    font-size: 16px;
                "
            ></i>

            <span>
                Janitor
            </span>

        </a>


        {{-- =================================================
             JADWAL
        ================================================== --}}

        <a
            href="#"
            class="
                admin-menu-item
                d-flex
                align-items-center
                gap-2
                w-100
                text-decoration-none
            "
            style="
                min-height: 46px;
                margin-bottom: 7px;
                padding: 0 14px;
                box-sizing: border-box;
                border-radius: 10px;
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
                transition:
                    background 0.2s ease,
                    color 0.2s ease;
            "
        >

            <i
                class="bi bi-calendar3 flex-shrink-0"
                style="
                    width: 20px;
                    font-size: 16px;
                "
            ></i>

            <span>
                Jadwal
            </span>

        </a>


        {{-- =================================================
             PENGGUNA
        ================================================== --}}

        <a
            href="{{ route('admin.users.index') }}"
            class="
                admin-menu-item
                d-flex
                align-items-center
                gap-2
                w-100
                text-decoration-none
                {{ request()->routeIs('admin.users.*') ? 'active' : '' }}
            "
            style="
                min-height: 46px;
                margin-bottom: 7px;
                padding: 0 14px;
                box-sizing: border-box;
                border-radius: 10px;
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
                transition:
                    background 0.2s ease,
                    color 0.2s ease;
            "
        >

            <i
                class="bi bi-people flex-shrink-0"
                style="
                    width: 20px;
                    font-size: 16px;
                "
            ></i>

            <span>
                Pengguna
            </span>
        
        </a>


        {{-- =================================================
             PENGATURAN
        ================================================== --}}

        <a
            href="#"
            class="
                admin-menu-item
                d-flex
                align-items-center
                gap-2
                w-100
                text-decoration-none
            "
            style="
                min-height: 46px;
                margin-bottom: 7px;
                padding: 0 14px;
                box-sizing: border-box;
                border-radius: 10px;
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
                transition:
                    background 0.2s ease,
                    color 0.2s ease;
            "
        >

            <i
                class="bi bi-gear flex-shrink-0"
                style="
                    width: 20px;
                    font-size: 16px;
                "
            ></i>

            <span>
                Pengaturan
            </span>

        </a>

    </nav>


    {{-- =====================================================
         SIDEBAR FOOTER
    ====================================================== --}}

    <div
        class="flex-shrink-0"
        style="
            padding: 14px 18px 18px;
        "
    >

        <div
            class="text-center"
            style="
                padding: 12px 14px;
                border-radius: 10px;
                background: rgba(255, 255, 255, 0.10);
                color: rgba(255, 255, 255, 0.72);
                font-size: 11px;
                line-height: 1.5;
            "
        >

            CleanTrack

            <br>

            <span
                style="
                    color: rgba(255, 255, 255, 0.5);
                "
            >
                Sistem Pelaporan Janitor
            </span>

        </div>

    </div>

</aside>


{{-- =========================================================
     SIDEBAR STYLE
========================================================== --}}

<style>

    /* =========================================================
       MENU HOVER
    ========================================================== */

    .admin-menu-item:hover {
        background: rgba(255, 255, 255, 0.14);
        color: #ffffff !important;
    }


    /* =========================================================
       ACTIVE MENU
    ========================================================== */

    .admin-menu-item.active {
        background: #ffffff !important;
        color: #3478f6 !important;
        box-shadow:
            0 4px 12px rgba(0, 0, 0, 0.08);
    }


    .admin-menu-item.active:hover {
        background: #ffffff !important;
        color: #3478f6 !important;
    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 991.98px) {

        #adminSidebar {
            transform: translateX(-100%);
            box-shadow: 8px 0 30px rgba(0, 0, 0, 0.15);
        }


        #adminSidebar.mobile-open {
            transform: translateX(0);
        }


        #sidebarClose {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

    }

</style>
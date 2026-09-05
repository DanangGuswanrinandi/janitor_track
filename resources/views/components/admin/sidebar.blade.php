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

        @php

            $adminMenus = [

                [
                    'label' => 'Dashboard',
                    'icon' => 'bi-grid-1x2-fill',
                    'route' => 'admin.dashboard',
                    'active' => 'admin.dashboard',
                ],

                [
                    'label' => 'Kelola Laporan',
                    'icon' => 'bi-clipboard2-data',
                    'route' => 'admin.kelola-laporan',
                    'active' => 'admin.kelola-laporan',
                ],

                [
                    'label' => 'Verifikasi Laporan',
                    'icon' => 'bi bi-clipboard2-check',
                    'route' => 'admin.verifikasi_laporan',
                    'active' => 'admin.verifikasi_laporan',
                ],

                [
                    'label' => 'Master Ruangan',
                    'icon' => 'bi bi-bar-chart-steps',
                    'route' => 'admin.master-ruangan',
                    'active' => 'admin.master-ruangan',
                ],

                [
                    'label' => 'Pengguna',
                    'icon' => 'bi-people',
                    'route' => 'admin.users.index',
                    'active' => 'admin.users.*',
                ],

                [
                    'label' => 'Pengaturan',
                    'icon' => 'bi-gear',
                    'route' => '#',
                    'active' => null,
                ],

            ];

        @endphp


        @foreach ($adminMenus as $menu)

            @php

                $isActive =
                    $menu['active']
                        ? request()->routeIs($menu['active'])
                        : false;

            @endphp


            <a
                href="{{ $menu['route'] === '#'
                    ? '#'
                    : route($menu['route']) }}"
                class="
                    admin-menu-item
                    d-flex
                    align-items-center
                    gap-2
                    w-100
                    text-decoration-none
                    {{ $isActive ? 'active' : '' }}
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
                    class="bi {{ $menu['icon'] }} flex-shrink-0"
                    style="
                        width: 20px;
                        font-size: 16px;
                    "
                ></i>


                <span>
                    {{ $menu['label'] }}
                </span>

            </a>

        @endforeach

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

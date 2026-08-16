<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Dashboard') - CleanTrack
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
   
    <style>

        /* =========================================================
           GLOBAL
        ========================================================== */

        html,
        body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background: #f5f7fb;
            font-family:
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }


        /* =========================================================
           ADMIN LAYOUT
        ========================================================== */

        .admin-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }


        .admin-main {
            flex: 1;
            min-width: 0;
            min-height: 100vh;
            margin-left: 250px;
            background: #f5f7fb;
        }


        .admin-content {
            width: 100%;
            padding: 28px;
            box-sizing: border-box;
        }


        /* =========================================================
           MOBILE SIDEBAR
        ========================================================== */

        .sidebar-overlay {
            display: none;
        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 991.98px) {

            .admin-main {
                margin-left: 0;
            }

            .admin-content {
                padding: 20px;
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 1040;
                background: rgba(0, 0, 0, 0.35);
            }

            .sidebar-overlay.active {
                display: block;
            }

        }


        @media (max-width: 575.98px) {

            .admin-content {
                padding: 16px;
            }

        }

    </style>

    @stack('styles')

</head>


<body>

    <div class="admin-wrapper">

        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        @include('components.admin.sidebar')


        {{-- =====================================================
             SIDEBAR OVERLAY MOBILE
        ====================================================== --}}

        <div
            id="sidebarOverlay"
            class="sidebar-overlay"
        ></div>


        {{-- =====================================================
             MAIN
        ====================================================== --}}

        <div class="admin-main">

            {{-- Navbar --}}
            @include('components.navbar')


            {{-- Page Content --}}
            <main class="admin-content">

                @yield('content')

            </main>

        </div>

    </div>


    {{-- =========================================================
         SIDEBAR TOGGLE
    ========================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const sidebar =
                    document.getElementById('adminSidebar');

                const overlay =
                    document.getElementById('sidebarOverlay');

                const toggleButton =
                    document.getElementById('sidebarToggle');

                const closeButton =
                    document.getElementById('sidebarClose');


                function openSidebar() {

                    if (!sidebar) {
                        return;
                    }

                    sidebar.classList.add('mobile-open');

                    if (overlay) {
                        overlay.classList.add('active');
                    }

                    document.body.style.overflow = 'hidden';
                }


                function closeSidebar() {

                    if (!sidebar) {
                        return;
                    }

                    sidebar.classList.remove('mobile-open');

                    if (overlay) {
                        overlay.classList.remove('active');
                    }

                    document.body.style.overflow = '';
                }


                if (toggleButton) {

                    toggleButton.addEventListener(
                        'click',
                        openSidebar
                    );

                }


                if (closeButton) {

                    closeButton.addEventListener(
                        'click',
                        closeSidebar
                    );

                }


                if (overlay) {

                    overlay.addEventListener(
                        'click',
                        closeSidebar
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Close sidebar after clicking menu on mobile
                |--------------------------------------------------------------------------
                */

                if (sidebar) {

                    const sidebarLinks =
                        sidebar.querySelectorAll('a');

                    sidebarLinks.forEach(function (link) {

                        link.addEventListener(
                            'click',
                            function () {

                                if (
                                    window.innerWidth <= 991.98
                                ) {
                                    closeSidebar();
                                }

                            }
                        );

                    });

                }


                /*
                |--------------------------------------------------------------------------
                | Dropdown User
                |--------------------------------------------------------------------------
                */

                const userToggle =
                    document.getElementById('userDropdownToggle');

                const userDropdown =
                    document.getElementById('userDropdownMenu');


                if (userToggle && userDropdown) {

                    userToggle.addEventListener(
                        'click',
                        function (event) {

                            event.stopPropagation();

                            userDropdown.classList.toggle(
                                'show'
                            );

                        }
                    );


                    document.addEventListener(
                        'click',
                        function () {

                            userDropdown.classList.remove(
                                'show'
                            );

                        }
                    );

                }

            }
        );

    </script>

    {{-- =========================================================
         CLEAR USER SELECTION WHEN LEAVING USER PAGE
    ========================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const userPagePath =
                    "{{ parse_url(route('admin.users.index'), PHP_URL_PATH) }}";

                const currentPath =
                    window.location.pathname;


                /*
                |--------------------------------------------------------------------------
                | Semua link navigasi sidebar
                |--------------------------------------------------------------------------
                */

                const sidebar =
                    document.getElementById('adminSidebar');


                if (!sidebar) {
                    return;
                }


                const sidebarLinks =
                    sidebar.querySelectorAll('a[href]');


                sidebarLinks.forEach(
                    function (link) {

                        link.addEventListener(
                            'click',
                            function () {

                                const targetUrl =
                                    new URL(
                                        link.href,
                                        window.location.origin
                                    );


                                /*
                                |--------------------------------------------------------------------------
                                | Jika sedang berada di halaman Users
                                | dan pindah ke halaman lain
                                |--------------------------------------------------------------------------
                                */

                                if (
                                    currentPath === userPagePath &&
                                    targetUrl.pathname !== userPagePath
                                ) {

                                    sessionStorage.removeItem(
                                        'cleantrack_selected_user_ids'
                                    );

                                }

                            }
                        );

                    }
                );

            }
        );

    </script>


    @stack('scripts')

</body>

</html>
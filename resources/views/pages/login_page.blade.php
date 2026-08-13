<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - CleanTrack</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* =========================================================
           INPUT
        ========================================================== */

        .login-input::placeholder {
            color: rgba(255, 255, 255, 0.75) !important;
            opacity: 1 !important;
        }

        .login-input:focus::placeholder {
            color: rgba(255, 255, 255, 0.75) !important;
            opacity: 1 !important;
        }

        .password-toggle:hover {
            color: #ffffff !important;
        }

        .login-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.16) !important;
        }


        /* =========================================================
           MAIN LOGIN LAYOUT
        ========================================================== */

        .login-layout {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1100px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 80px;
            padding: 50px 70px;
            box-sizing: border-box;
        }


        /* =========================================================
           BRAND / IMAGE LEFT
        ========================================================== */

        .login-brand {
            flex: 1;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .brand-logo {
            width: 360px;
            height: 230px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .brand-title {
            margin: 0;
            color: #ffffff;
            font-size: 42px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .brand-description {
            max-width: 430px;
            margin: 12px auto 0;
            color: rgba(255, 255, 255, 0.78);
            font-size: 15px;
            line-height: 1.6;
        }


        /* =========================================================
           LOGIN FORM RIGHT
        ========================================================== */

        .login-form-container {
            flex: 1;
            width: 100%;
            max-width: 440px;
        }

        .login-form {
            width: 100%;
            margin-top: 0 !important;
            text-align: left;
        }


        /* =========================================================
           FOOTER
        ========================================================== */

        .login-footer {
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.55);
            font-size: 12px;
            text-align: center;
        }


        /* =========================================================
           DESKTOP
        ========================================================== */

        @media (min-width: 768px) {

            .login-layout {
                min-height: 100vh;
            }

            .login-input {
                min-height: 54px !important;
            }

            .login-button {
                min-height: 54px !important;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 767.98px) {

            .login-layout {
                min-height: 100vh;
                flex-direction: column;
                gap: 0;
                padding: 42px 26px 32px;
                justify-content: center;
            }

            .login-brand {
                width: 100%;
                max-width: 380px;
            }

            .brand-logo {
                width: 210px !important;
                height: 125px !important;
                margin-bottom: 8px;
            }

            .brand-title {
                font-size: 28px !important;
            }

            .brand-description {
                max-width: 290px !important;
                font-size: 13px !important;
            }

            .login-form-container {
                width: 100%;
                max-width: 380px;
                margin-top: 30px;
            }

            .login-input {
                min-height: 50px !important;
                border-radius: 25px !important;
            }

            .login-button {
                min-height: 50px !important;
                border-radius: 25px !important;
            }

            .login-footer {
                margin-top: 24px;
            }
        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 380px) {

            .login-layout {
                padding-left: 20px;
                padding-right: 20px;
            }

            .brand-title {
                font-size: 25px !important;
            }
        }
    </style>
</head>


<body
    style="
        min-height: 100vh;
        width: 100%;
        margin: 0;
        background: #3478f6;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    "
>

    {{-- =========================================================
         FULL SCREEN LOGIN PAGE
    ========================================================== --}}

    <div
        class="login-page"
        style="
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: linear-gradient(
                160deg,
                #3478f6 0%,
                #2868dc 100%
            );
        "
    >

        {{-- =====================================================
             DECORATIVE CIRCLE - TOP RIGHT
        ====================================================== --}}

        <div
            style="
                position: absolute;
                width: 420px;
                height: 420px;
                top: -250px;
                right: -130px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.07);
                pointer-events: none;
            "
        ></div>


        {{-- =====================================================
             DECORATIVE CIRCLE - BOTTOM LEFT
        ====================================================== --}}

        <div
            style="
                position: absolute;
                width: 360px;
                height: 360px;
                bottom: -230px;
                left: -130px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.08);
                pointer-events: none;
            "
        ></div>


        {{-- =====================================================
             DECORATIVE CIRCLE - SMALL
        ====================================================== --}}

        <div
            style="
                position: absolute;
                width: 90px;
                height: 90px;
                top: 16%;
                left: 12%;
                border-radius: 50%;
                border: 1px solid rgba(255, 255, 255, 0.08);
                pointer-events: none;
            "
        ></div>


        {{-- =========================================================
             MAIN LOGIN LAYOUT
        ========================================================== --}}
        
        <main class="login-layout">
        
            {{-- =====================================================
                 LEFT SIDE - BRAND / ILLUSTRATION
            ====================================================== --}}
        
            <section
                class="login-brand"
            >
        
                {{-- Illustration --}}
                <div
                    class="brand-logo"
                >
                    <img
                        src="{{ asset('images/cleantrack-logo.png') }}"
                        alt="Ilustrasi CleanTrack"
                    >
                </div>
            
            
                {{-- Brand --}}
                <h1
                    class="brand-title"
                >
                    CleanTrack
                </h1>
            
            
                {{-- Description --}}
                <p
                    class="brand-description"
                >
                    Sistem pelaporan dan monitoring
                    kebersihan secara terstruktur.
                </p>
            
            </section>
        
        
            {{-- =====================================================
                 RIGHT SIDE - LOGIN FORM
            ====================================================== --}}
        
            <section
                class="login-form-container"
            >
        
                <div
                    class="login-form"
                >
        
                    @include('components.auth.login_form')
        
                </div>
            
            
                {{-- Footer --}}
                <div
                    class="login-footer"
                >
                    © {{ date('Y') }} CleanTrack
                </div>
            
            </section>
        
        </main>

    </div>

</body>

</html>

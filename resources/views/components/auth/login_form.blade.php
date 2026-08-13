<form
    method="POST"
    action="{{ url('/login') }}"
>
    @csrf

    {{-- =========================================================
         USERNAME
    ========================================================== --}}

    <div
        style="
            margin-bottom: 20px;
        "
    >

        <label
            for="username"
            style="
                display: block;
                margin-bottom: 8px;
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
            "
        >
            Username
        </label>

        <input
            type="text"
            id="username"
            name="username"
            value="{{ old('username') }}"
            placeholder="Masukkan username"
            autocomplete="username"
            required
            autofocus
            class="form-control login-input @error('username') is-invalid @enderror"
            style="
                width: 100%;
                min-height: 50px;
                padding: 12px 16px;
                border: 1px solid rgba(255, 255, 255, 0.35);
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
                font-size: 14px;
                box-shadow: none;
                transition:
                    border-color 0.2s ease,
                    box-shadow 0.2s ease,
                    background 0.2s ease;
            "
        >

        @error('username')
            <div
                style="
                    margin-top: 6px;
                    color: #ffe0e0;
                    font-size: 12px;
                "
            >
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =========================================================
         PASSWORD
    ========================================================== --}}

    <div
        style="
            margin-bottom: 20px;
        "
    >

        <label
            for="password"
            style="
                display: block;
                margin-bottom: 8px;
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
            "
        >
            Password
        </label>

        <div
            style="
                position: relative;
            "
        >

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                autocomplete="current-password"
                required
                class="form-control login-input @error('password') is-invalid @enderror"
                style="
                    width: 100%;
                    min-height: 50px;
                    padding: 12px 50px 12px 16px;
                    border: 1px solid rgba(255, 255, 255, 0.35);
                    border-radius: 12px;
                    background: rgba(255, 255, 255, 0.12);
                    color: #ffffff;
                    font-size: 14px;
                    box-shadow: none;
                    transition:
                        border-color 0.2s ease,
                        box-shadow 0.2s ease,
                        background 0.2s ease;
                "
            >

            <button
                type="button"
                id="togglePassword"
                aria-label="Tampilkan password"
                class="password-toggle"
                style="
                    position: absolute;
                    top: 50%;
                    right: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 34px;
                    height: 34px;
                    padding: 0;
                    border: 0;
                    background: transparent;
                    color: rgba(255, 255, 255, 0.7);
                    font-size: 16px;
                    cursor: pointer;
                    transform: translateY(-50%);
                    transition: color 0.2s ease;
                "
            >
                <i class="bi bi-eye"></i>
            </button>

        </div>

        @error('password')
            <div
                style="
                    margin-top: 6px;
                    color: #ffe0e0;
                    font-size: 12px;
                "
            >
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =========================================================
         GENERAL LOGIN ERROR
    ========================================================== --}}

    @if ($errors->has('login'))

        <div
            role="alert"
            style="
                margin-bottom: 20px;
                padding: 11px 14px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 10px;
                background: rgba(220, 53, 69, 0.9);
                color: #ffffff;
                font-size: 13px;
                line-height: 1.5;
            "
        >
            {{ $errors->first('login') }}
        </div>

    @endif


    {{-- =========================================================
         LOGIN BUTTON
    ========================================================== --}}

    <button
        type="submit"
        class="login-button"
        style="
            width: 100%;
            min-height: 50px;
            margin-top: 6px;
            padding: 12px 20px;
            border: 0;
            border-radius: 12px;
            background: #ffffff;
            color: #3478f6;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        "
    >
        Login
    </button>

</form>


{{-- =============================================================
     PASSWORD TOGGLE
============================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const passwordIcon = togglePassword?.querySelector('i');

        if (!togglePassword || !passwordInput || !passwordIcon) {
            return;
        }

        togglePassword.addEventListener('click', function () {

            const isPassword =
                passwordInput.getAttribute('type') === 'password';

            passwordInput.setAttribute(
                'type',
                isPassword ? 'text' : 'password'
            );

            // Ubah icon Bootstrap
            passwordIcon.classList.toggle('bi-eye', !isPassword);
            passwordIcon.classList.toggle('bi-eye-slash', isPassword);

            togglePassword.setAttribute(
                'aria-label',
                isPassword
                    ? 'Sembunyikan password'
                    : 'Tampilkan password'
            );

        });

    });
</script>

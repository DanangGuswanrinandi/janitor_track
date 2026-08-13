<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function login(Request $request): void
    {
        $credentials = $request->validate([
            'username' => [
                'required',
                'string',
                'max:100',
            ],
            'password' => [
                'required',
                'string',
            ],
        ]);

        $username = $credentials['username'];

        /*
        |--------------------------------------------------------------------------
        | Rate Limiting
        |--------------------------------------------------------------------------
        */

        $rateLimitKey = 'login:' .
            strtolower($username) .
            '|' .
            $request->ip();

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {

            $seconds = RateLimiter::availableIn($rateLimitKey);

            throw ValidationException::withMessages([
                'login' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik.",
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        */

        $authenticated = Auth::attempt([
            'username' => $username,
            'password' => $credentials['password'],
        ]);

        if (! $authenticated) {

    
            RateLimiter::increment($rateLimitKey, 60);
    
        
    
            throw ValidationException::withMessages([
    
                'login' => 'Username atau password yang Anda masukkan salah.',
    
            ]);
    
        }

        /*
        |--------------------------------------------------------------------------
        | Successful Login
        |--------------------------------------------------------------------------
        */

        RateLimiter::clear($rateLimitKey);

        $request->session()->regenerate();
    }


    public function logout(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
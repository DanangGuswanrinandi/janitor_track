<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {
    }


    /**
     * Menampilkan halaman login.
     */
    public function showLogin(): View
    {
        return view('pages.login_page');
    }


    /**
     * Memproses login.
     */
    public function login(Request $request): RedirectResponse
    {
        $user =
            $this->authService->login(
                $request
            );  
    

        /*
        |--------------------------------------------------------------------------
        | Redirect Berdasarkan Role
        |--------------------------------------------------------------------------
        */  

        if ($user->role === 'admin') {  

            return redirect()
                ->intended(
                    route('admin.dashboard')
                )
                ->with(
                    'success',
                    'Login berhasil.'
                );  

        }   
    

        return redirect()
            ->intended(
                route('user.dashboard')
            )
            ->with(
                'success',
                'Login berhasil.'
            );
    }


    /**
     * Logout user.
     */
    public function logout(Request $request): RedirectResponse
    {
        $this->authService->logout($request);

        return redirect()
            ->route('login')
            ->with('success', 'Anda telah logout.');
    }
}
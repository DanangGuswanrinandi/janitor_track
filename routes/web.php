<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;



/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Area
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */

    Route::get('/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::post('/users', [UserController::class, 'store'])
        ->name('admin.users.store');
        
    Route::patch('/users/{id}/role', [UserController::class, 'updateRole'])
        ->name('admin.users.role.update');

});
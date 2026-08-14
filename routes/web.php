<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


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


/*
    |--------------------------------------------------------------------------
    | User Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/user/dashboard', function () {

        return view(
            'pages.users.dashboard'
        );

    })->name('user.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', function () {

        return view(
            'pages.admin.dashboard'
        );

    })->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/users',
        [UserController::class, 'index']
    )->name('admin.users.index');


    Route::post(
        '/users',
        [UserController::class, 'store']
    )->name('admin.users.store');


    Route::put(
        '/users/{user}',
        [UserController::class, 'update']
    )->name('admin.users.update');


    Route::patch(
        '/users/{user}/role',
        [UserController::class, 'updateRole']
    )->name('admin.users.role.update');


    Route::delete(
        '/users/bulk-destroy',
        [UserController::class, 'bulkDestroy']
    )->name('admin.users.bulk-destroy');


    Route::delete(
        '/users/{user}',
        [UserController::class, 'destroy']
    )->name('admin.users.destroy');

});
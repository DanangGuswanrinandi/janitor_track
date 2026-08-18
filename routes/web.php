<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MasterRuanganController;


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
    | Master Ruangan
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/master-ruangan',
        [
            MasterRuanganController::class,
            'index'
        ]
    )->name(
        'admin.master-ruangan'
    );


    Route::post(
        '/admin/master-ruangan',
        [
            MasterRuanganController::class,
            'store'
        ]
    )->name(
        'admin.master-ruangan.store'
    );
    
    Route::put(
        '/admin/master-ruangan/{masterRuangan}',
        [
            MasterRuanganController::class,
            'update'
        ]
    )->name(
        'admin.master-ruangan.update'
    );

    Route::delete(
        '/admin/master-ruangan/{masterRuangan}',
        [
            MasterRuanganController::class,
            'destroy'
        ]
    )->name(
        'admin.master-ruangan.destroy'
    );

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/users',
        [UserController::class, 'index']
    )->name('admin.users.index');


    Route::post(
        '/admin/users',
        [UserController::class, 'store']
    )->name('admin.users.store');


    Route::put(
        '/admin/users/{user}',
        [UserController::class, 'update']
    )->name('admin.users.update');


    Route::patch(
        '/admin/users/{user}/role',
        [UserController::class, 'updateRole']
    )->name('admin.users.role.update');


    Route::delete(
        '/admin/users/bulk-destroy',
        [UserController::class, 'bulkDestroy']
    )->name('admin.users.bulk-destroy');


    Route::delete(
        '/admin/users/{user}',
        [UserController::class, 'destroy']
    )->name('admin.users.destroy');

});
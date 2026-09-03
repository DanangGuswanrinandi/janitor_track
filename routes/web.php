<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MasterRuanganController;
use App\Http\Controllers\User\LaporanController;
use App\Http\Controllers\User\LaporanJanitorController;
use App\Http\Controllers\Admin\LaporanControllers;


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
    | Lihat Laporan
    |--------------------------------------------------------------------------
    */

    Route::get(
    '/user/lihat_laporan',
        [
            LaporanController::class,
            'index'
        ]
    )->name(
        'user.lihat-laporan'
    );


    Route::get(
        '/user/laporan/detail/{id}',
        [
            LaporanController::class,
            'show'
        ]
    )->name(
        'user.laporan.show'
    );


    Route::put(
        '/user/laporan/{id}',
        [
            LaporanController::class,
            'update'
        ]
    )->name(
        'user.laporan.update'
    );

    Route::delete(
        '/user/laporan/bulk-destroy',
        [
            LaporanController::class,
            'bulkDestroy'
        ]
    )->name(
        'user.laporan.bulk-destroy'
    );


    Route::delete(
        '/user/laporan/{id}',
        [
            LaporanController::class,
            'destroy'
        ]
    )->name(
        'user.laporan.destroy'
    );

    /*
    |--------------------------------------------------------------------------
    | Buat Laporan
    |--------------------------------------------------------------------------
    */

    Route::get('/user/buat-laporan', function () {

        return view(
            'pages.users.buat_laporan_page'
        );

    })->name('user.buat-laporan');

    /*
    |--------------------------------------------------------------------------
    | Laporan
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/user/laporan/{kode_ruangan}',
        [
            LaporanController::class,
            'create'
        ]
    )->name(
        'user.laporan.create'
    );


    Route::post(
        '/user/laporan/{kode_ruangan}',
        [
            LaporanJanitorController::class,
            'store'
        ]
    )->name(
        'user.laporan.store'
    );

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
    | Admin Kelola Laporan
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/kelola_laporan',
        [
            LaporanControllers::class,
            'index'
        ]
    )->name(
        'admin.kelola-laporan'
    );


    /*
    |--------------------------------------------------------------------------
    | View Laporan
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/kelola_laporan/{laporan}',
        [
            LaporanControllers::class,
            'show'
        ]
    )->name(
        'admin.kelola-laporan.show'
    );


    /*
    |--------------------------------------------------------------------------
    | Data Approve Laporan
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/kelola_laporan/{laporan}/approval-data',
        [
            LaporanControllers::class,
            'approvalData'
        ]
    )->name(
        'admin.kelola-laporan.approval-data'
    );


    /*
    |--------------------------------------------------------------------------
    | Approve Laporan
    |--------------------------------------------------------------------------
    */

    Route::put(
        '/admin/kelola_laporan/{laporan}/approve',
        [
            LaporanControllers::class,
            'approve'
        ]
    )->name(
        'admin.kelola-laporan.approve'
    );


    /*
    |--------------------------------------------------------------------------
    | Update Laporan
    |--------------------------------------------------------------------------
    */

    Route::put(
        '/admin/kelola_laporan/{laporan}',
        [
            LaporanControllers::class,
            'update'
        ]
    )->name(
        'admin.kelola-laporan.update'
    );


    /*
    |--------------------------------------------------------------------------
    | Delete Laporan
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/admin/kelola_laporan/{laporan}',
        [
            LaporanControllers::class,
            'destroy'
        ]
    )->name(
        'admin.kelola-laporan.destroy'
    );

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
        '/admin/master-ruangan/bulk-destroy',
        [
            MasterRuanganController::class,
            'bulkDestroy'
        ]
    )->name(
        'admin.master-ruangan.bulk-destroy'
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

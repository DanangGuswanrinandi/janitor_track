<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;


    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $users = $this->userService->getUsers();

        return view('pages.admin.user_page', compact('users'));
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $this->userService->createUser($request);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Pengguna berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        User $user
    ) {
        $this->userService->updateUser(
            $request,
            $user
        );

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Pengguna berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE ROLE
    |--------------------------------------------------------------------------
    */

    public function updateRole(
        Request $request,
        User $user
    ) {
        $updatedUser =
            $this->userService->updateRole(
                $request,
                $user
            );

        return response()->json([
            'success' => true,
            'message' => 'Role pengguna berhasil diperbarui.',
            'data' => [
                'id' => $updatedUser->id,
                'role' => $updatedUser->role,
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Pengguna berhasil dihapus.'
            );
    }

    /**
    * Menghapus beberapa pengguna sekaligus.
    */
    public function bulkDestroy(Request $request)
    {
        $deletedCount =
            $this->userService->deleteUsers(
                $request
            );


        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                $deletedCount . ' pengguna berhasil dihapus.'
            );
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }


    /**
     * Menampilkan halaman pengguna.
     */
    public function index(): View
    {
        $users = $this->userService->getUsers();

        return view('pages.admin.user_page', [
            'users' => $users,
        ]);
    }


    /**
     * Menyimpan pengguna baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->userService->createUser($request);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function updateRole(Request $request, int $id)
    {
        $user = $this->userService->updateRole(
            $id,
            $request->input('role')
        );
    
    
        return response()->json([
            'success' => true,
            'message' => 'Role pengguna berhasil diperbarui.',
            'data' => [
                'id' => $user->id,
                'role' => $user->role,
            ],
        ]);
    }
}
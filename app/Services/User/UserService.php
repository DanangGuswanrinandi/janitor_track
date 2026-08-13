<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserService
{
    /**
     * Mengambil seluruh pengguna.
     */
    public function getUsers()
    {
        return User::query()
            ->select([
                'id',
                'username',
                'role',
                'created_at',
                'updated_at',
            ])
            ->orderBy('id')
            ->get();
    }


    /**
     * Menambahkan pengguna baru.
     */
    public function createUser(Request $request): User
    {
        $validated = $request->validateWithBag('userCreate', [

            'username' => [
                'required',
                'string',
                'max:100',
                'unique:users,username',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
            ],

            'role' => [
                'required',
                Rule::in([
                    'user',
                    'admin',
                ]),
            ],

        ], [

            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username maksimal 100 karakter.',
            'username.unique' => 'Username tersebut sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',

            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role yang dipilih tidak valid.',

        ]);


        return User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);
    }

    /**
     * Mengubah role pengguna.
     */
    public function updateRole(int $userId, string $role): User
    {
        if (! in_array($role, ['user', 'admin'], true)) {

            throw ValidationException::withMessages([
                'role' => 'Role yang dipilih tidak valid.',
            ]);

        }


        $user = User::query()
            ->findOrFail($userId);


        $user->update([
            'role' => $role,
        ]);


        return $user->fresh();
    }
}
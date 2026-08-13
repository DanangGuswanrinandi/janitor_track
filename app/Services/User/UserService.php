<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $validated = $request->validateWithBag(
            'userCreate',
            [

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

            ],
            [

                'username.required' =>
                    'Username wajib diisi.',

                'username.max' =>
                    'Username maksimal 100 karakter.',

                'username.unique' =>
                    'Username tersebut sudah digunakan.',

                'password.required' =>
                    'Password wajib diisi.',

                'password.min' =>
                    'Password minimal 8 karakter.',

                'role.required' =>
                    'Role wajib dipilih.',

                'role.in' =>
                    'Role yang dipilih tidak valid.',

            ]
        );


        return User::create([

            'username' =>
                $validated['username'],

            'password' =>
                Hash::make($validated['password']),

            'role' =>
                $validated['role'],

        ]);
    }


    /**
     * Mengubah data pengguna.
     */
    public function updateUser(
        Request $request,
        User $user
    ): User {

        $validated = $request->validateWithBag(
            'userUpdate',
            [

                'user_id' => [
                    'required',
                    'integer',
                    'exists:users,id',
                ],

                'username' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique('users', 'username')
                        ->ignore($user->id),
                ],

                'password' => [
                    'nullable',
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

            ],
            [

                'username.required' =>
                    'Username wajib diisi.',

                'username.max' =>
                    'Username maksimal 100 karakter.',

                'username.unique' =>
                    'Username tersebut sudah digunakan.',

                'password.min' =>
                    'Password baru minimal 8 karakter.',

                'role.required' =>
                    'Role wajib dipilih.',

                'role.in' =>
                    'Role yang dipilih tidak valid.',

            ]
        );


        $user->username =
            $validated['username'];

        $user->role =
            $validated['role'];


        /*
        |--------------------------------------------------------------------------
        | Password hanya diubah jika diisi
        |--------------------------------------------------------------------------
        */

        if (
            !empty($validated['password'])
        ) {

            $user->password =
                Hash::make(
                    $validated['password']
                );

        }


        $user->save();


        return $user->fresh();
    }


    /**
     * Mengubah role pengguna.
     */
    public function updateRole(
        Request $request,
        User $user
    ): User {

        $validated = $request->validate([

            'role' => [
                'required',
                Rule::in([
                    'user',
                    'admin',
                ]),
            ],

        ]);


        $user->role =
            $validated['role'];

        $user->save();


        return $user->fresh();
    }


    /**
     * Menghapus pengguna.
     */
    public function deleteUser(User $user): void
    {
        $user->delete();
    }

    /**
     * Menghapus beberapa pengguna sekaligus.
     */
    public function deleteUsers(Request $request): int
    {
        $validated =
            $request->validate([
                'user_ids' => [
                    'required',
                    'array',
                    'min:1',
                ],
    
                'user_ids.*' => [
                    'required',
                    'integer',
                    'exists:users,id',
                ],
    
            ], [
    
                'user_ids.required' =>
                    'Tidak ada pengguna yang dipilih.',
    
                'user_ids.array' =>
                    'Data pengguna yang dipilih tidak valid.',
    
                'user_ids.min' =>
                    'Pilih minimal satu pengguna.',
    
                'user_ids.*.exists' =>
                    'Pengguna yang dipilih tidak ditemukan.',
    
            ]);
    
    
        return User::query()
            ->whereIn(
                'id',
                $validated['user_ids'],
                'and',
                false
            )
            ->delete();
    }
}
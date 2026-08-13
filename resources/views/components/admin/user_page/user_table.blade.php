{{-- =========================================================
     USER TABLE
========================================================== --}}

<div class="w-100 overflow-auto">

    <table
        class="table align-middle mb-0"
        style="
            min-width: 760px;
        "
    >

        {{-- =================================================
             TABLE HEADER
        ================================================== --}}

        <thead>

            <tr>

                {{-- NO --}}

                <th
                    class="fw-semibold"
                    style="
                        width: 60px;
                        color: #5f6875;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >
                    No
                </th>


                {{-- USERNAME --}}

                <th
                    class="fw-semibold"
                    style="
                        min-width: 160px;
                        color: #5f6875;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >
                    Username
                </th>


                {{-- ROLE --}}

                <th
                    class="fw-semibold"
                    style="
                        width: 150px;
                        color: #5f6875;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >
                    Role
                </th>


                {{-- CREATED AT --}}

                <th
                    class="fw-semibold"
                    style="
                        min-width: 160px;
                        color: #5f6875;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >
                    Created At
                </th>


                {{-- UPDATED AT --}}

                <th
                    class="fw-semibold"
                    style="
                        min-width: 160px;
                        color: #5f6875;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >
                    Updated At
                </th>


                {{-- AKSI --}}

                <th
                    class="fw-semibold text-end"
                    style="
                        width: 120px;
                        color: #5f6875;
                        font-size: 13px;
                        white-space: nowrap;
                    "
                >
                    Aksi
                </th>

            </tr>

        </thead>


        {{-- =================================================
             TABLE BODY
        ================================================== --}}

        <tbody>

            @forelse ($users as $index => $user)

                <tr>
                
                    {{-- NO --}}
                
                    <td
                        style="
                            color: #6c7583;
                            font-size: 13px;
                        "
                    >
                        {{ $index + 1 }}
                    </td>
                
                
                    {{-- USERNAME --}}
                
                    <td>
                    
                        <span
                            class="fw-semibold"
                            style="
                                color: #252a31;
                                font-size: 13px;
                            "
                        >
                            {{ $user->username }}
                        </span>
                    
                    </td>
                
                
                    {{-- ROLE --}}
                
                    <td>
                    
                        <button
                            type="button"
                            class="role-switch d-inline-flex align-items-center"
                            data-role="{{ $user->role }}"
                            data-user-id="{{ $user->id }}"
                            data-role-url="{{ route('admin.users.role.update', $user->id) }}"
                            aria-label="Ubah role {{ $user->role }}"
                            style="
                                position: relative;
                                width: 116px;
                                height: 42px;
                                padding: 4px;
                                border: 0;
                                border-radius: 22px;
                                background: {{ $user->role === 'admin' ? '#eaf1ff' : '#edf0f5' }};
                                color: {{ $user->role === 'admin' ? '#3478f6' : '#667080' }};
                                cursor: pointer;
                                transition:
                                    background 0.2s ease,
                                    color 0.2s ease;
                            "
                        >
                    
                            {{-- Circle --}}
                    
                            <span
                                class="role-switch-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                style="
                                    width: 34px;
                                    height: 34px;
                                    border-radius: 50%;
                                    background: #ffffff;
                                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.10);
                                    transform: translateX({{ $user->role === 'admin' ? '74px' : '0' }});
                                    transition: transform 0.2s ease;
                                "
                            >
                    
                                <span
                                    class="role-switch-dot"
                                    style="
                                        width: 10px;
                                        height: 10px;
                                        border-radius: 50%;
                                        background: {{ $user->role === 'admin' ? '#3478f6' : '#adb5bd' }};
                                    "
                                ></span>
                    
                            </span>
                        
                        
                            {{-- Text --}}
                        
                            <span
                                class="role-switch-text position-absolute fw-semibold"
                                style="
                                    {{ $user->role === 'admin'
                                        ? 'left: 12px; color: #3478f6;'
                                        : 'right: 12px; color: #667080;' }}
                                    font-size: 12px;
                                    line-height: 1;
                                "
                            >
                                {{ ucfirst($user->role) }}
                            </span>
                        
                        </button>
                    
                    </td>
                
                
                    {{-- CREATED AT --}}
                
                    <td
                        style="
                            color: #6c7583;
                            font-size: 13px;
                            white-space: nowrap;
                        "
                    >
                        {{ $user->created_at?->format('d M Y, H:i') }}
                    </td>
                
                
                    {{-- UPDATED AT --}}
                
                    <td
                        style="
                            color: #6c7583;
                            font-size: 13px;
                            white-space: nowrap;
                        "
                    >
                        {{ $user->updated_at?->format('d M Y, H:i') }}
                    </td>
                
                
                    {{-- AKSI --}}
                
                    <td class="text-end">
                    
                        <div
                            class="d-inline-flex align-items-center gap-2"
                        >
                    
                            {{-- EDIT --}}
                    
                            <button
                                type="button"
                                class="btn btn-sm d-inline-flex align-items-center justify-content-center user-action-edit"
                                title="Edit pengguna"
                                aria-label="Edit pengguna"
                                style="
                                    width: 34px;
                                    height: 34px;
                                    padding: 0;
                                    border: 1px solid #dfe5ee;
                                    border-radius: 8px;
                                    background: #ffffff;
                                    color: #3478f6;
                                    font-size: 14px;
                                "
                            >
                                <i class="bi bi-pencil"></i>
                            </button>
                        
                        
                            {{-- DELETE --}}
                        
                            <button
                                type="button"
                                class="btn btn-sm d-inline-flex align-items-center justify-content-center user-action-delete"
                                title="Hapus pengguna"
                                aria-label="Hapus pengguna"
                                style="
                                    width: 34px;
                                    height: 34px;
                                    padding: 0;
                                    border: 1px solid #f1d9dc;
                                    border-radius: 8px;
                                    background: #ffffff;
                                    color: #dc3545;
                                    font-size: 14px;
                                "
                            >
                                <i class="bi bi-trash"></i>
                            </button>
                        
                        </div>
                    
                    </td>
                
                </tr>
            
            @empty
            
                <tr>
                
                    <td
                        colspan="6"
                        class="text-center"
                        style="
                            padding: 40px 20px;
                            color: #98a1b2;
                            font-size: 13px;
                        "
                    >
                        Belum ada pengguna.
                
                    </td>
                
                </tr>
            
            @endforelse
            
        </tbody>

    </table>

</div>


{{-- =========================================================
     ROLE SWITCH STYLE
========================================================== --}}

<style>

    /*
    |--------------------------------------------------------------------------
    | ROLE SWITCH HOVER
    |--------------------------------------------------------------------------
    */

    .role-switch:hover {
        filter: brightness(0.98);
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT BUTTON HOVER
    |--------------------------------------------------------------------------
    */

    .user-action-edit:hover {
        background: #f5f8ff !important;
        border-color: #cbdcff !important;
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE BUTTON HOVER
    |--------------------------------------------------------------------------
    */

    .user-action-delete:hover {
        background: #fff5f5 !important;
        border-color: #f1c5ca !important;
    }

</style>


{{-- =========================================================
     ROLE SWITCH SCRIPT
========================================================== --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const roleSwitches =
            document.querySelectorAll('.role-switch');


        roleSwitches.forEach(function (switchButton) {

            switchButton.addEventListener(
                'click',
                async function () {

                    /*
                    |--------------------------------------------------------------------------
                    | Hindari klik ganda saat request berjalan
                    |--------------------------------------------------------------------------
                    */

                    if (switchButton.dataset.loading === 'true') {
                        return;
                    }


                    const currentRole =
                        switchButton.dataset.role;


                    const newRole =
                        currentRole === 'user'
                            ? 'admin'
                            : 'user';


                    const url =
                        switchButton.dataset.roleUrl;


                    if (!url) {
                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Simpan kondisi sebelumnya
                    |--------------------------------------------------------------------------
                    */

                    const circle =
                        switchButton.querySelector(
                            '.role-switch-circle'
                        );

                    const text =
                        switchButton.querySelector(
                            '.role-switch-text'
                        );

                    const dot =
                        switchButton.querySelector(
                            '.role-switch-dot'
                        );


                    if (
                        !circle ||
                        !text ||
                        !dot
                    ) {
                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Loading
                    |--------------------------------------------------------------------------
                    */

                    switchButton.dataset.loading = 'true';

                    switchButton.disabled = true;

                    switchButton.style.opacity = '0.7';


                    try {

                        const response =
                            await fetch(url, {

                                method: 'PATCH',

                                headers: {

                                    'Content-Type':
                                        'application/json',

                                    'Accept':
                                        'application/json',

                                    'X-CSRF-TOKEN':
                                        document
                                            .querySelector(
                                                'meta[name="csrf-token"]'
                                            )
                                            ?.getAttribute('content'),

                                    'X-Requested-With':
                                        'XMLHttpRequest',

                                },

                                body: JSON.stringify({
                                    role: newRole
                                }),

                            });


                        const result =
                            await response.json();


                        /*
                        |--------------------------------------------------------------------------
                        | Request gagal
                        |--------------------------------------------------------------------------
                        */

                        if (!response.ok || !result.success) {

                            throw new Error(
                                result.message ||
                                'Role pengguna gagal diperbarui.'
                            );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Update tampilan berdasarkan response server
                        |--------------------------------------------------------------------------
                        */

                        const updatedRole =
                            result.data.role;


                        switchButton.dataset.role =
                            updatedRole;


                        switchButton.setAttribute(
                            'aria-label',
                            `Ubah role ${updatedRole}`
                        );


                        if (updatedRole === 'admin') {

                            /*
                            | ADMIN
                            */

                            switchButton.style.background =
                                '#eaf1ff';

                            switchButton.style.color =
                                '#3478f6';


                            circle.style.transform =
                                'translateX(74px)';


                            dot.style.background =
                                '#3478f6';


                            text.textContent =
                                'Admin';


                            text.style.left =
                                '12px';

                            text.style.right =
                                'auto';

                            text.style.color =
                                '#3478f6';


                        } else {

                            /*
                            | USER
                            */

                            switchButton.style.background =
                                '#edf0f5';

                            switchButton.style.color =
                                '#667080';


                            circle.style.transform =
                                'translateX(0)';


                            dot.style.background =
                                '#adb5bd';


                            text.textContent =
                                'User';


                            text.style.left =
                                'auto';

                            text.style.right =
                                '12px';

                            text.style.color =
                                '#667080';

                        }

                    } catch (error) {

                        console.error(
                            'Gagal mengubah role:',
                            error
                        );


                        /*
                        |--------------------------------------------------------------------------
                        | Tidak mengubah tampilan jika server gagal
                        |--------------------------------------------------------------------------
                        */

                        alert(
                            error.message ||
                            'Role pengguna gagal diperbarui.'
                        );

                    } finally {

                        switchButton.dataset.loading =
                            'false';

                        switchButton.disabled =
                            false;

                        switchButton.style.opacity =
                            '1';

                    }

                }
            );

        });

    });

</script>
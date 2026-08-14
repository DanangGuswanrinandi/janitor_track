{{-- =========================================================
     BULK DELETE
========================================================== --}}

<div
    class="d-flex align-items-center justify-content-end mt-3"
>

    <button
        type="button"
        id="{{ $buttonId }}"
        class="btn fw-semibold d-inline-flex align-items-center gap-2 admin-table-delete-selected"
        data-bs-toggle="modal"
        data-bs-target="#{{ $modalId }}"
        disabled
        style="
            min-height: 40px;
            padding: 8px 14px;
            border: 1px solid #f1d9dc;
            border-radius: 9px;
            background: #ffffff;
            color: #dc3545;
            font-size: 13px;
            opacity: 0.55;
            cursor: not-allowed;
        "
    >

        <i class="bi bi-trash"></i>

        <span>
            {{ $label ?? 'Hapus Pilihan' }}
        </span>

    </button>

</div>
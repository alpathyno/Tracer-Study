@extends('layouts.app')

@section('title', 'Kelola Admin')
@section('page-title', 'Kelola Admin')

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Page Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="page-header-title">Kelola Admin</h1>
        <p class="page-header-sub">Tambah, edit, dan hapus akun administrator</p>
    </div>
    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Admin
    </a>
</div>

{{-- Filter --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.admins.index') }}">
            <div class="filter-bar">
                <div class="filter-search-wrap">
                    <i class="bi bi-search filter-search-icon"></i>
                    <input
                        type="text"
                        name="search"
                        class="form-control filter-search-input"
                        placeholder="Cari nama atau email admin..."
                        value="{{ $search }}"
                    >
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    @if($search)
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-outline">
                            <i class="bi bi-x-lg"></i> Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Admin</th>
                        <th>Email</th>
                        <th>Bergabung</th>
                        <th>Status</th>
                        <th style="text-align:center; width:120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                        <tr>
                            {{-- Admin --}}
                            <td>
                                <div class="table-user">
                                    <div class="table-avatar" style="background:linear-gradient(135deg,var(--primary-light),var(--primary));">
                                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                                    </div>
                                    <div class="table-user-info">
                                        <div class="table-user-name">
                                            {{ $admin->name }}
                                            @if($admin->id === Auth::id())
                                                <span class="self-badge">Anda</span>
                                            @endif
                                        </div>
                                        <div class="table-user-email">Administrator</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="text-muted" style="font-size:13.5px;">
                                {{ $admin->email }}
                            </td>

                            {{-- Bergabung --}}
                            <td class="text-muted" style="font-size:12.5px;">
                                {{ $admin->created_at->format('d M Y') }}
                            </td>

                            {{-- Status --}}
                            <td>
                                <span class="badge badge-working">Aktif</span>
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="table-actions">
                                    @if($admin->id !== Auth::id())
                                        <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                           class="btn-action btn-action-edit"
                                           title="Edit Admin">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.admins.destroy', $admin->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirmDelete(this, '{{ $admin->name }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn-action btn-action-delete"
                                                    title="Hapus Admin">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted" style="font-size:12px;">—</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-state-icon-wrap">
                                        <i class="bi bi-person-gear"></i>
                                    </div>
                                    <p class="empty-state-title">Tidak ada admin ditemukan</p>
                                    <p class="empty-state-desc">
                                        @if($search)
                                            Coba ubah kata kunci pencarian.
                                        @else
                                            Belum ada admin lain yang terdaftar.
                                        @endif
                                    </p>
                                    @if($search)
                                        <a href="{{ route('admin.admins.index') }}" class="btn btn-outline mt-2">
                                            <i class="bi bi-x-circle"></i> Reset Filter
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($admins->hasPages())
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Menampilkan <strong>{{ $admins->firstItem() }}–{{ $admins->lastItem() }}</strong>
                    dari <strong>{{ $admins->total() }}</strong> admin
                </div>
                <div class="pagination-links">
                    {{ $admins->withQueryString()->links() }}
                </div>
            </div>
        @else
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Total <strong>{{ $admins->count() }}</strong> admin
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal-overlay" id="deleteModal">
    <div class="confirm-modal">
        <div class="confirm-modal-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h3 class="confirm-modal-title">Hapus Admin?</h3>
        <p class="confirm-modal-desc">
            Kamu akan menghapus akun admin <strong id="deleteTargetName"></strong>.
            Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="confirm-modal-actions">
            <button class="btn btn-outline" onclick="closeDeleteModal()">Batal</button>
            <button class="btn btn-danger-soft" onclick="submitDeleteForm()">
                <i class="bi bi-trash3"></i> Ya, Hapus
            </button>
        </div>
    </div>
</div>

<style>
.page-header-title {
    font-size: 22px; font-weight: 800;
    color: var(--gray-900); margin: 0 0 2px;
    letter-spacing: -0.02em;
}
.page-header-sub {
    font-size: 13.5px; color: var(--gray-400);
    margin: 0; font-weight: 500;
}

/* Filter */
.filter-bar { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.filter-search-wrap { position: relative; display: flex; align-items: center; flex: 1; }
.filter-search-icon { position: absolute; left: 11px; color: var(--gray-400); font-size: 14px; pointer-events: none; z-index: 1; }
.filter-search-input { padding-left: 34px; height: 38px; font-size: 13.5px; }
.filter-actions { display: flex; gap: 8px; }

/* Table */
.table-user { display: flex; align-items: center; gap: 11px; }
.table-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800; color: white; flex-shrink: 0;
}
.table-user-info { min-width: 0; }
.table-user-name {
    font-size: 13.5px; font-weight: 700;
    color: var(--gray-800); display: flex; align-items: center; gap: 6px;
}
.table-user-email { font-size: 11.5px; color: var(--gray-400); font-weight: 500; }

.self-badge {
    font-size: 10px; font-weight: 700;
    background: var(--primary-glow); color: var(--primary);
    border: 1px solid rgba(30,58,95,0.15);
    padding: 2px 7px; border-radius: 999px;
    letter-spacing: 0.04em;
}

/* Actions */
.table-actions { display: flex; align-items: center; justify-content: center; gap: 6px; }
.btn-action {
    width: 32px; height: 32px; border-radius: var(--radius-sm);
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 14px; border: none; cursor: pointer;
    transition: var(--transition); text-decoration: none;
}
.btn-action-edit  { background: var(--warning-bg); color: var(--warning); }
.btn-action-edit:hover  { background: #FEF3C7; transform: translateY(-1px); }
.btn-action-delete { background: var(--danger-bg); color: var(--danger); }
.btn-action-delete:hover { background: #FEE2E2; transform: translateY(-1px); }

/* Pagination */
.pagination-wrap {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 20px; border-top: 1px solid var(--gray-100);
    flex-wrap: wrap; gap: 12px;
}
.pagination-info { font-size: 13px; color: var(--gray-400); font-weight: 500; }
.pagination-info strong { color: var(--gray-700); font-weight: 700; }
.pagination-links .pagination { margin: 0; gap: 4px; }

/* Empty State */
.empty-state { text-align: center; padding: 56px 20px; }
.empty-state-icon-wrap {
    width: 64px; height: 64px; background: var(--gray-100);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px; font-size: 28px; color: var(--gray-300);
}
.empty-state-title { font-size: 15px; font-weight: 700; color: var(--gray-600); margin: 0 0 6px; }
.empty-state-desc  { font-size: 13.5px; color: var(--gray-400); margin: 0; }

/* Delete Modal */
.modal-overlay {
    position: fixed; inset: 0;
    background: rgba(15,23,42,0.5); backdrop-filter: blur(4px);
    z-index: 9999; display: none; align-items: center; justify-content: center; padding: 20px;
}
.modal-overlay.show { display: flex; }
.confirm-modal {
    background: var(--surface); border-radius: var(--radius-xl);
    padding: 32px; max-width: 380px; width: 100%;
    text-align: center; box-shadow: var(--shadow-lg);
    animation: modalIn 0.2s cubic-bezier(0.34,1.56,0.64,1);
}
@keyframes modalIn { from { transform: scale(0.9); opacity:0; } to { transform:scale(1); opacity:1; } }
.confirm-modal-icon {
    width: 56px; height: 56px; background: var(--danger-bg); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px; font-size: 24px; color: var(--danger);
}
.confirm-modal-title { font-size: 18px; font-weight: 800; color: var(--gray-900); margin: 0 0 8px; }
.confirm-modal-desc  { font-size: 13.5px; color: var(--gray-500); line-height: 1.6; margin: 0 0 24px; }
.confirm-modal-actions { display: flex; gap: 10px; justify-content: center; }
</style>

@push('scripts')
<script>
let pendingDeleteForm = null;

function confirmDelete(form, name) {
    pendingDeleteForm = form;
    document.getElementById('deleteTargetName').textContent = name;
    document.getElementById('deleteModal').classList.add('show');
    return false;
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
    pendingDeleteForm = null;
}

function submitDeleteForm() {
    if (pendingDeleteForm) pendingDeleteForm.submit();
}

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDeleteModal();
});
</script>
@endpush

@endsection
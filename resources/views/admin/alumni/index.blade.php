@extends('layouts.app')

@section('title', 'Kelola Alumni')
@section('page-title', 'Kelola Alumni')

@section('content')

{{-- ===== FLASH MESSAGES ===== --}}
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

{{-- ===== PAGE HEADER ===== --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="page-header-title">Data Alumni</h1>
        <p class="page-header-sub">Kelola dan pantau seluruh data alumni terdaftar</p>
    </div>
    <div class="alumni-total-badge">
        <i class="bi bi-people-fill"></i>
        <span>{{ $alumni->total() }} Alumni</span>
    </div>
</div>

{{-- ===== FILTER BAR ===== --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.alumni.index') }}">
            <div class="filter-bar">

                {{-- Search --}}
                <div class="filter-search-wrap">
                    <i class="bi bi-search filter-search-icon"></i>
                    <input
                        type="text"
                        name="search"
                        class="form-control filter-search-input"
                        placeholder="Cari nama, email, NISN..."
                        value="{{ request('search') }}"
                    >
                </div>

                {{-- Major --}}
                <div class="filter-select-wrap">
                    <i class="bi bi-journal-bookmark filter-select-icon"></i>
                    <select name="major" class="form-select filter-select">
                        <option value="">Semua Jurusan</option>
                        @foreach($majors as $m)
                            <option value="{{ $m }}" {{ request('major') == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Year --}}
                <div class="filter-select-wrap">
                    <i class="bi bi-calendar3 filter-select-icon"></i>
                    <select name="year" class="form-select filter-select">
                        <option value="">Semua Tahun</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Actions --}}
                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    @if(request('search') || request('major') || request('year'))
                        <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline">
                            <i class="bi bi-x-lg"></i> Reset
                        </a>
                    @endif
                </div>

            </div>

            {{-- Active Filters --}}
            @if(request('search') || request('major') || request('year'))
                <div class="active-filters mt-3">
                    <span class="active-filters-label">Filter aktif:</span>
                    @if(request('search'))
                        <span class="filter-chip">
                            <i class="bi bi-search"></i> "{{ request('search') }}"
                        </span>
                    @endif
                    @if(request('major'))
                        <span class="filter-chip">
                            <i class="bi bi-journal-bookmark"></i> {{ request('major') }}
                        </span>
                    @endif
                    @if(request('year'))
                        <span class="filter-chip">
                            <i class="bi bi-calendar3"></i> {{ request('year') }}
                        </span>
                    @endif
                </div>
            @endif
        </form>
    </div>
</div>

{{-- ===== TABLE ===== --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="width: 280px;">Alumni</th>
                        <th>Jurusan</th>
                        <th>Tahun Lulus</th>
                        <th>NISN</th>
                        <th>Status Tracer</th>
                        <th style="width: 100px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alumni as $user)
                        <tr>
                            {{-- Alumni --}}
                            <td>
                                <div class="table-user">
                                    <div class="table-avatar" style="background: {{ '#' . substr(md5($user->name), 0, 6) }}20; color: #{{ substr(md5($user->name), 0, 6) }};">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="table-user-info">
                                        <div class="table-user-name">{{ $user->name }}</div>
                                        <div class="table-user-email">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Jurusan --}}
                            <td>
                                @if($user->alumniProfile?->major)
                                    <span class="major-badge">{{ $user->alumniProfile->major }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            {{-- Tahun Lulus --}}
                            <td>
                                <span class="year-text">{{ $user->alumniProfile?->graduation_year ?? '—' }}</span>
                            </td>

                            {{-- NISN --}}
                            <td>
                                <span class="nisn-text">{{ $user->nisn ?? '—' }}</span>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($user->tracerStudy)
                                    @php
                                        $statusMap = [
                                            'working'      => ['label' => 'Bekerja',       'class' => 'badge-working'],
                                            'studying'     => ['label' => 'Studi Lanjut',  'class' => 'badge-studying'],
                                            'entrepreneur' => ['label' => 'Wirausaha',     'class' => 'badge-entrepreneur'],
                                            'unemployed'   => ['label' => 'Belum Bekerja', 'class' => 'badge-unemployed'],
                                        ];
                                        $s = $statusMap[$user->tracerStudy->status] ?? ['label' => ucfirst($user->tracerStudy->status), 'class' => 'badge-empty'];
                                    @endphp
                                    <span class="badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                                @else
                                    <span class="badge badge-empty">
                                        <i class="bi bi-hourglass"></i> Belum Isi
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.alumni.show', $user->id) }}"
                                       class="btn-action btn-action-view"
                                       title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.alumni.destroy', $user->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirmDelete(this, '{{ $user->name }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn-action btn-action-delete"
                                                title="Hapus Alumni">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-state-icon-wrap">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <p class="empty-state-title">Tidak ada data alumni</p>
                                    <p class="empty-state-desc">
                                        @if(request('search') || request('major') || request('year'))
                                            Coba ubah atau reset filter pencarian.
                                        @else
                                            Belum ada alumni yang terdaftar.
                                        @endif
                                    </p>
                                    @if(request('search') || request('major') || request('year'))
                                        <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline mt-2">
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

        {{-- ===== PAGINATION ===== --}}
        @if($alumni->hasPages())
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Menampilkan
                    <strong>{{ $alumni->firstItem() }}–{{ $alumni->lastItem() }}</strong>
                    dari <strong>{{ $alumni->total() }}</strong> alumni
                </div>
                <div class="pagination-links">
                    {{ $alumni->withQueryString()->links() }}
                </div>
            </div>
        @else
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Menampilkan <strong>{{ $alumni->count() }}</strong> alumni
                </div>
            </div>
        @endif

    </div>
</div>

{{-- ===== DELETE CONFIRM MODAL ===== --}}
<div class="modal-overlay" id="deleteModal">
    <div class="confirm-modal">
        <div class="confirm-modal-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h3 class="confirm-modal-title">Hapus Alumni?</h3>
        <p class="confirm-modal-desc">
            Kamu akan menghapus data alumni <strong id="deleteTargetName"></strong>.
            Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="confirm-modal-actions">
            <button class="btn btn-outline" onclick="closeDeleteModal()">Batal</button>
            <button class="btn btn-danger-soft" id="deleteConfirmBtn" onclick="submitDeleteForm()">
                <i class="bi bi-trash3"></i> Ya, Hapus
            </button>
        </div>
    </div>
</div>

<style>
/* ===== PAGE HEADER ===== */
.page-header-title {
    font-size: 22px;
    font-weight: 800;
    color: var(--gray-900);
    margin: 0 0 2px;
    letter-spacing: -0.02em;
}

.page-header-sub {
    font-size: 13.5px;
    color: var(--gray-400);
    margin: 0;
    font-weight: 500;
}

.alumni-total-badge {
    display: flex;
    align-items: center;
    gap: 7px;
    background: var(--primary-glow);
    border: 1.5px solid rgba(30,58,95,0.12);
    border-radius: 999px;
    padding: 8px 16px;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--primary);
}

/* ===== FILTER BAR ===== */
.filter-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-search-wrap,
.filter-select-wrap {
    position: relative;
    display: flex;
    align-items: center;
}

.filter-search-icon,
.filter-select-icon {
    position: absolute;
    left: 11px;
    color: var(--gray-400);
    font-size: 14px;
    pointer-events: none;
    z-index: 1;
}

.filter-search-input {
    padding-left: 34px;
    min-width: 240px;
    height: 38px;
    font-size: 13.5px;
}

.filter-select {
    padding-left: 32px;
    height: 38px;
    font-size: 13.5px;
    min-width: 150px;
    cursor: pointer;
}

.filter-actions {
    display: flex;
    gap: 8px;
    margin-left: auto;
}

/* Active Filters */
.active-filters {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    padding-top: 10px;
    border-top: 1px solid var(--gray-100);
}

.active-filters-label {
    font-size: 11.5px;
    font-weight: 700;
    color: var(--gray-400);
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.filter-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    background: var(--primary-glow);
    border: 1px solid rgba(30,58,95,0.12);
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
}

/* ===== TABLE CELLS ===== */
.table-user {
    display: flex;
    align-items: center;
    gap: 11px;
}

.table-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 800;
    flex-shrink: 0;
    border: 2px solid rgba(0,0,0,0.04);
}

.table-user-info { min-width: 0; }

.table-user-name {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--gray-800);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.table-user-email {
    font-size: 11.5px;
    color: var(--gray-400);
    font-weight: 500;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.major-badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    background: var(--gray-100);
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    color: var(--gray-600);
    letter-spacing: 0.03em;
}

.year-text {
    font-family: 'DM Mono', monospace;
    font-size: 13px;
    font-weight: 500;
    color: var(--gray-700);
}

.nisn-text {
    font-family: 'DM Mono', monospace;
    font-size: 12.5px;
    color: var(--gray-500);
}

/* ===== ACTION BUTTONS ===== */
.table-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.btn-action {
    width: 32px;
    height: 32px;
    border-radius: var(--radius-sm);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
}

.btn-action-view {
    background: var(--info-bg);
    color: var(--info);
}

.btn-action-view:hover {
    background: #DBEAFE;
    color: var(--info);
    transform: translateY(-1px);
}

.btn-action-delete {
    background: var(--danger-bg);
    color: var(--danger);
}

.btn-action-delete:hover {
    background: #FEE2E2;
    color: var(--danger);
    transform: translateY(-1px);
}

/* ===== PAGINATION ===== */
.pagination-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-top: 1px solid var(--gray-100);
    flex-wrap: wrap;
    gap: 12px;
}

.pagination-info {
    font-size: 13px;
    color: var(--gray-400);
    font-weight: 500;
}

.pagination-info strong {
    color: var(--gray-700);
    font-weight: 700;
}

.pagination-links .pagination {
    margin: 0;
    gap: 4px;
}

/* ===== EMPTY STATE ===== */
.empty-state {
    text-align: center;
    padding: 56px 20px;
}

.empty-state-icon-wrap {
    width: 64px;
    height: 64px;
    background: var(--gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    font-size: 28px;
    color: var(--gray-300);
}

.empty-state-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--gray-600);
    margin: 0 0 6px;
}

.empty-state-desc {
    font-size: 13.5px;
    color: var(--gray-400);
    margin: 0;
}

/* ===== DELETE MODAL ===== */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal-overlay.show {
    display: flex;
}

.confirm-modal {
    background: var(--surface);
    border-radius: var(--radius-xl);
    padding: 32px;
    max-width: 380px;
    width: 100%;
    text-align: center;
    box-shadow: var(--shadow-lg);
    animation: modalIn 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes modalIn {
    from { transform: scale(0.9); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}

.confirm-modal-icon {
    width: 56px;
    height: 56px;
    background: var(--danger-bg);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    font-size: 24px;
    color: var(--danger);
}

.confirm-modal-title {
    font-size: 18px;
    font-weight: 800;
    color: var(--gray-900);
    margin: 0 0 8px;
}

.confirm-modal-desc {
    font-size: 13.5px;
    color: var(--gray-500);
    line-height: 1.6;
    margin: 0 0 24px;
}

.confirm-modal-actions {
    display: flex;
    gap: 10px;
    justify-content: center;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .filter-bar { flex-direction: column; align-items: stretch; }
    .filter-search-input { min-width: unset; width: 100%; }
    .filter-select { min-width: unset; width: 100%; }
    .filter-actions { margin-left: 0; }
    .pagination-wrap { justify-content: center; flex-direction: column; text-align: center; }
}
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
    if (pendingDeleteForm) {
        pendingDeleteForm.submit();
    }
}

// Close on overlay click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

// Close on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDeleteModal();
});
</script>
@endpush

@endsection
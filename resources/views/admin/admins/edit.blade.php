@extends('layouts.app')

@section('title', 'Edit Admin')
@section('page-title', 'Edit Admin')

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.admins.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h1 class="page-header-title">Edit Administrator</h1>
        <p class="page-header-sub">Perbarui data akun admin — {{ $admin->name }}</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <div class="section-header mb-0">
                    <div class="section-header-icon"><i class="bi bi-person-gear"></i></div>
                    <h5>Data Administrator</h5>
                </div>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.admins.update', $admin->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="form-group mb-4">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text" name="name"
                                class="form-control input-with-icon @error('name') is-invalid @enderror"
                                value="{{ old('name', $admin->name) }}"
                                placeholder="Nama lengkap admin"
                                required>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group mb-4">
                        <label class="form-label">Alamat Email</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" name="email"
                                class="form-control input-with-icon @error('email') is-invalid @enderror"
                                value="{{ old('email', $admin->email) }}"
                                placeholder="email@contoh.com"
                                required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="divider"></div>

                    {{-- Password baru (opsional) --}}
                    <div class="optional-section mb-2">
                        <div class="optional-section-label">
                            <i class="bi bi-shield-lock"></i>
                            Ganti Password
                            <span class="optional-tag">Opsional</span>
                        </div>
                        <p class="optional-section-desc">Kosongkan jika tidak ingin mengubah password.</p>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Password Baru</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="password" id="password"
                                class="form-control input-with-icon input-with-icon-right @error('password') is-invalid @enderror"
                                placeholder="Kosongkan jika tidak diubah">
                            <button type="button" class="input-toggle-pass" onclick="togglePass('password')">
                                <i class="bi bi-eye" id="password-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control input-with-icon input-with-icon-right"
                                placeholder="Ulangi password baru">
                            <button type="button" class="input-toggle-pass" onclick="togglePass('password_confirmation')">
                                <i class="bi bi-eye" id="password_confirmation-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-outline">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Info card --}}
        <div class="card mt-3">
            <div class="card-body">
                <div class="admin-meta">
                    <div class="admin-meta-item">
                        <span class="admin-meta-label"><i class="bi bi-calendar3"></i> Bergabung</span>
                        <span class="admin-meta-value">{{ $admin->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="admin-meta-item">
                        <span class="admin-meta-label"><i class="bi bi-clock-history"></i> Update Terakhir</span>
                        <span class="admin-meta-value">{{ $admin->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="admin-meta-item">
                        <span class="admin-meta-label"><i class="bi bi-shield"></i> Role</span>
                        <span class="admin-meta-value">Administrator</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.page-header-title { font-size: 22px; font-weight: 800; color: var(--gray-900); margin: 0 0 2px; letter-spacing: -0.02em; }
.page-header-sub   { font-size: 13.5px; color: var(--gray-400); margin: 0; font-weight: 500; }

.btn-back {
    width: 36px; height: 36px; border-radius: var(--radius-md);
    background: var(--surface); border: 1.5px solid var(--gray-200);
    display: flex; align-items: center; justify-content: center;
    color: var(--gray-600); text-decoration: none; font-size: 15px;
    transition: var(--transition); flex-shrink: 0;
}
.btn-back:hover { background: var(--gray-50); color: var(--gray-800); border-color: var(--gray-300); }

.input-icon-wrap { position: relative; }
.input-icon {
    position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
    color: var(--gray-400); font-size: 15px; pointer-events: none; z-index: 1;
}
.input-with-icon       { padding-left: 38px; }
.input-with-icon-right { padding-right: 40px; }

.input-toggle-pass {
    position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
    background: none; border: none; color: var(--gray-400);
    cursor: pointer; padding: 4px; font-size: 15px;
    display: flex; align-items: center; transition: color 0.2s;
}
.input-toggle-pass:hover { color: var(--gray-600); }

/* Optional section */
.optional-section { margin-bottom: 16px; }
.optional-section-label {
    display: flex; align-items: center; gap: 7px;
    font-size: 13px; font-weight: 700; color: var(--gray-700);
    margin-bottom: 4px;
}
.optional-tag {
    font-size: 10px; font-weight: 700; letter-spacing: 0.06em;
    background: var(--gray-100); color: var(--gray-400);
    padding: 2px 8px; border-radius: 999px; text-transform: uppercase;
}
.optional-section-desc { font-size: 12.5px; color: var(--gray-400); margin: 0; }

/* Admin meta */
.admin-meta { display: flex; flex-direction: column; gap: 10px; }
.admin-meta-item { display: flex; justify-content: space-between; align-items: center; font-size: 13px; }
.admin-meta-label { display: flex; align-items: center; gap: 6px; color: var(--gray-400); font-weight: 600; }
.admin-meta-value { color: var(--gray-700); font-weight: 600; }
</style>

@push('scripts')
<script>
function togglePass(id) {
    const input = document.getElementById(id);
    const icon  = document.getElementById(id + '-eye');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
@endpush

@endsection
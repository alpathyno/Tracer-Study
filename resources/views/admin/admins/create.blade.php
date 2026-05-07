@extends('layouts.app')

@section('title', 'Tambah Admin')
@section('page-title', 'Tambah Admin')

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.admins.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h1 class="page-header-title">Tambah Admin Baru</h1>
        <p class="page-header-sub">Buat akun administrator baru</p>
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

                <form method="POST" action="{{ route('admin.admins.store') }}">
                    @csrf

                    {{-- Nama --}}
                    <div class="form-group mb-4">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text" name="name"
                                class="form-control input-with-icon @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
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
                                value="{{ old('email') }}"
                                placeholder="email@contoh.com"
                                required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="divider"></div>

                    {{-- Password --}}
                    <div class="form-group mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="password" id="password"
                                class="form-control input-with-icon input-with-icon-right @error('password') is-invalid @enderror"
                                placeholder="Minimal 8 karakter"
                                required>
                            <button type="button" class="input-toggle-pass" onclick="togglePass('password')">
                                <i class="bi bi-eye" id="password-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="form-group mb-5">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control input-with-icon input-with-icon-right"
                                placeholder="Ulangi password"
                                required>
                            <button type="button" class="input-toggle-pass" onclick="togglePass('password_confirmation')">
                                <i class="bi bi-eye" id="password_confirmation-eye"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Info box --}}
                    <div class="info-box mb-5">
                        <i class="bi bi-shield-check info-box-icon"></i>
                        <div class="info-box-text">
                            Akun ini akan memiliki akses penuh sebagai <strong>Administrator</strong>.
                            Pastikan hanya memberikan akses kepada orang yang dipercaya.
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Admin
                        </button>
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-outline">
                            Batal
                        </a>
                    </div>
                </form>
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

/* Input with icon */
.input-icon-wrap { position: relative; }
.input-icon {
    position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
    color: var(--gray-400); font-size: 15px; pointer-events: none; z-index: 1;
}
.input-with-icon      { padding-left: 38px; }
.input-with-icon-right { padding-right: 40px; }

.input-toggle-pass {
    position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
    background: none; border: none; color: var(--gray-400);
    cursor: pointer; padding: 4px; font-size: 15px;
    display: flex; align-items: center; transition: color 0.2s;
}
.input-toggle-pass:hover { color: var(--gray-600); }

/* Info box */
.info-box {
    display: flex; align-items: flex-start; gap: 10px;
    background: var(--info-bg); border: 1px solid rgba(3,105,161,0.15);
    border-radius: var(--radius-md); padding: 12px 16px;
}
.info-box-icon { color: var(--info); font-size: 16px; flex-shrink: 0; margin-top: 1px; }
.info-box-text { font-size: 13px; color: var(--info); line-height: 1.6; }
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
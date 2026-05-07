@extends('layouts.app')

@section('title', 'Profil Alumni')

@section('content')
<h4 class="mb-4">Edit Profil</h4>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('alumni.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    <small class="text-muted">Email tidak dapat diubah.</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="graduation_year" class="form-label">Tahun Lulus</label>
                    <input type="number" class="form-control @error('graduation_year') is-invalid @enderror"
                           id="graduation_year" name="graduation_year"
                           value="{{ old('graduation_year', $profile->graduation_year) }}"
                           min="2000" max="{{ date('Y') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="major" class="form-label">Jurusan</label>
                    <select class="form-select @error('major') is-invalid @enderror"
                            id="major" name="major" required>
                        <option value="">Pilih Jurusan</option>
                        <option value="TKJ" {{ old('major', $profile->major) == 'TKJ' ? 'selected' : '' }}>TKJ (Teknik Komputer dan Jaringan)</option>
                        <option value="RPL" {{ old('major', $profile->major) == 'RPL' ? 'selected' : '' }}>RPL (Rekayasa Perangkat Lunak)</option>
                        <option value="TBSM" {{ old('major', $profile->major) == 'TBSM' ? 'selected' : '' }}>TBSM (Teknik Bisnis Sepeda Motor)</option>
                        <option value="TO" {{ old('major', $profile->major) == 'TO' ? 'selected' : '' }}>TO (Teknik Ototronik)</option>
                        <option value="TKI" {{ old('major', $profile->major) == 'TKI' ? 'selected' : '' }}>TKI (Teknik Kimia Industri)</option>
                        <option value="TAV" {{ old('major', $profile->major) == 'TAV' ? 'selected' : '' }}>TAV (Teknik Audio Video)</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">No. Telepon</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                       id="phone" name="phone" value="{{ old('phone', $profile->phone) }}" required>
            </div>

            <div class="mb-4">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control @error('address') is-invalid @enderror"
                          id="address" name="address" rows="3" required>{{ old('address', $profile->address) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('alumni.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
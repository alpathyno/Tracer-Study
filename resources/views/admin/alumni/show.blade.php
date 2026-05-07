@extends('layouts.app')

@section('title', 'Detail Alumni')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Detail Alumni</h4>
    <div>
        <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-person me-2"></i>Data Pribadi</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>{{ $alumni->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{ $alumni->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>NISN</strong></td>
                        <td>{{ $alumni->nisn ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Terdaftar</strong></td>
                        <td>{{ $alumni->created_at->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-mortarboard me-2"></i>Data Alumni</h5>
            </div>
            <div class="card-body">
                @if($alumni->alumniProfile)
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Tahun Lulus</strong></td>
                            <td>{{ $alumni->alumniProfile->graduation_year }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jurusan</strong></td>
                            <td>{{ $alumni->alumniProfile->major }}</td>
                        </tr>
                        <tr>
                            <td><strong>No. Telepon</strong></td>
                            <td>{{ $alumni->alumniProfile->phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>{{ $alumni->alumniProfile->address }}</td>
                        </tr>
                    </table>
                @else
                    <p class="text-muted">Data alumni profil tidak tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-clipboard-data me-2"></i>Tracer Study</h5>
    </div>
    <div class="card-body">
        @if($alumni->tracerStudy)
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>
                                <span class="badge bg-{{ $alumni->tracerStudy->status == 'working' ? 'success' : ($alumni->tracerStudy->status == 'studying' ? 'info' : ($alumni->tracerStudy->status == 'entrepreneur' ? 'warning' : 'danger')) }}">
                                    {{ ucfirst($alumni->tracerStudy->status) }}
                                </span>
                            </td>
                        </tr>
                        @if($alumni->tracerStudy->status == 'working')
                            <tr>
                                <td><strong>Perusahaan</strong></td>
                                <td>{{ $alumni->tracerStudy->company_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Posisi</strong></td>
                                <td>{{ $alumni->tracerStudy->job_position }}</td>
                            </tr>
                            <tr>
                                <td><strong>Gaji</strong></td>
                                <td>Rp {{ number_format($alumni->tracerStudy->salary, 0, ',', '.') }}</td>
                            </tr>
                        @endif
                        @if($alumni->tracerStudy->status == 'studying')
                            <tr>
                                <td><strong>Universitas</strong></td>
                                <td>{{ $alumni->tracerStudy->university_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jurusan</strong></td>
                                <td>{{ $alumni->tracerStudy->study_major }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenjang</strong></td>
                                <td>{{ $alumni->tracerStudy->level }}</td>
                            </tr>
                        @endif
                        @if($alumni->tracerStudy->status == 'entrepreneur')
                            <tr>
                                <td><strong>Nama Bisnis</strong></td>
                                <td>{{ $alumni->tracerStudy->company_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Bidang</strong></td>
                                <td>{{ $alumni->tracerStudy->job_position }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Waktu Tunggu</strong></td>
                            <td>{{ $alumni->tracerStudy->waiting_time }} bulan</td>
                        </tr>
                        <tr>
                            <td><strong>Relevansi</strong></td>
                            <td>{{ $alumni->tracerStudy->job_relevance }}/5</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Submit</strong></td>
                            <td>{{ $alumni->tracerStudy->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @if($alumni->tracerStudy->feedback)
                <div class="mt-3">
                    <h6>Feedback/Saran:</h6>
                    <p class="bg-light p-3 rounded">{{ $alumni->tracerStudy->feedback }}</p>
                </div>
            @endif
        @else
            <p class="text-muted">Alumni belum mengisi tracer study.</p>
        @endif
    </div>
</div>
@endsection
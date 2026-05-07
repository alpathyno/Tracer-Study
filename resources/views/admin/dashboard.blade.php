@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- ===== FLASH MESSAGES ===== --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ===== WELCOME BANNER ===== --}}
<div class="welcome-banner mb-4">
    <div class="welcome-banner-content">
        <div class="welcome-text">
            <p class="welcome-greeting">Selamat datang kembali</p>
            <h2 class="welcome-name">{{ Auth::user()->name }}</h2>
            <p class="welcome-sub">Berikut ringkasan data alumni terkini.</p>
        </div>
        <div class="welcome-date">
            <i class="bi bi-calendar3"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>
    <div class="welcome-banner-deco"></div>
</div>

{{-- ===== STAT CARDS ===== --}}
<div class="stats-grid mb-4">

    <div class="stat-card stat-card-primary">
        <div class="stat-card-ghost-icon"><i class="bi bi-people"></i></div>
        <div class="stat-label">Total Alumni</div>
        <div class="stat-value">{{ $totalAlumni }}</div>
        <div class="stat-sub">Alumni terdaftar</div>
    </div>

    <div class="stat-card stat-card-success">
        <div class="stat-card-ghost-icon"><i class="bi bi-briefcase"></i></div>
        <div class="stat-label">Bekerja</div>
        <div class="stat-value">{{ $working }}</div>
        <div class="stat-sub" style="color: var(--success);">
            @if($totalAlumni > 0)
                {{ number_format(($working / $totalAlumni) * 100, 1) }}% dari total
            @else
                0% dari total
            @endif
        </div>
    </div>

    <div class="stat-card stat-card-info">
        <div class="stat-card-ghost-icon"><i class="bi bi-book"></i></div>
        <div class="stat-label">Melanjutkan Studi</div>
        <div class="stat-value">{{ $studying }}</div>
        <div class="stat-sub" style="color: var(--info);">
            @if($totalAlumni > 0)
                {{ number_format(($studying / $totalAlumni) * 100, 1) }}% dari total
            @else
                0% dari total
            @endif
        </div>
    </div>

    <div class="stat-card stat-card-warning">
        <div class="stat-card-ghost-icon"><i class="bi bi-clock"></i></div>
        <div class="stat-label">Rata-rata Tunggu</div>
        <div class="stat-value">{{ number_format($avgWaitingTime, 1) }}<span class="stat-value-unit">bln</span></div>
        <div class="stat-sub" style="color: var(--warning);">Waktu tunggu kerja</div>
    </div>

</div>

{{-- ===== ROW: STATUS OVERVIEW + QUICK ACCESS ===== --}}
<div class="row g-4 mb-4">

    {{-- Status Overview --}}
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="section-header mb-0" style="margin-bottom:0!important;">
                    <div class="section-header-icon"><i class="bi bi-pie-chart"></i></div>
                    <h5>Distribusi Status Alumni</h5>
                </div>
                <a href="{{ route('admin.analytics') }}" class="btn btn-sm btn-outline">
                    Lihat Analytics <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="status-overview-grid">

                    <div class="status-overview-item">
                        <div class="status-icon-wrap" style="background:#EDFAF4;">
                            <i class="bi bi-briefcase-fill" style="color:var(--success);"></i>
                        </div>
                        <div class="status-overview-info">
                            <div class="status-overview-num">{{ $working }}</div>
                            <div class="status-overview-label">Bekerja</div>
                        </div>
                        <div class="status-overview-bar-wrap">
                            <div class="status-overview-bar" style="
                                background: var(--success);
                                width: {{ $totalAlumni > 0 ? ($working / $totalAlumni) * 100 : 0 }}%;
                            "></div>
                        </div>
                        <div class="status-overview-pct">
                            {{ $totalAlumni > 0 ? number_format(($working / $totalAlumni) * 100, 0) : 0 }}%
                        </div>
                    </div>

                    <div class="status-overview-item">
                        <div class="status-icon-wrap" style="background:var(--info-bg);">
                            <i class="bi bi-book-fill" style="color:var(--info);"></i>
                        </div>
                        <div class="status-overview-info">
                            <div class="status-overview-num">{{ $studying }}</div>
                            <div class="status-overview-label">Studi Lanjut</div>
                        </div>
                        <div class="status-overview-bar-wrap">
                            <div class="status-overview-bar" style="
                                background: var(--info);
                                width: {{ $totalAlumni > 0 ? ($studying / $totalAlumni) * 100 : 0 }}%;
                            "></div>
                        </div>
                        <div class="status-overview-pct">
                            {{ $totalAlumni > 0 ? number_format(($studying / $totalAlumni) * 100, 0) : 0 }}%
                        </div>
                    </div>

                    <div class="status-overview-item">
                        <div class="status-icon-wrap" style="background:var(--warning-bg);">
                            <i class="bi bi-shop" style="color:var(--warning);"></i>
                        </div>
                        <div class="status-overview-info">
                            <div class="status-overview-num">{{ $entrepreneur }}</div>
                            <div class="status-overview-label">Wirausaha</div>
                        </div>
                        <div class="status-overview-bar-wrap">
                            <div class="status-overview-bar" style="
                                background: var(--warning);
                                width: {{ $totalAlumni > 0 ? ($entrepreneur / $totalAlumni) * 100 : 0 }}%;
                            "></div>
                        </div>
                        <div class="status-overview-pct">
                            {{ $totalAlumni > 0 ? number_format(($entrepreneur / $totalAlumni) * 100, 0) : 0 }}%
                        </div>
                    </div>

                    <div class="status-overview-item">
                        <div class="status-icon-wrap" style="background:var(--danger-bg);">
                            <i class="bi bi-search" style="color:var(--danger);"></i>
                        </div>
                        <div class="status-overview-info">
                            <div class="status-overview-num">{{ $unemployed }}</div>
                            <div class="status-overview-label">Belum Bekerja</div>
                        </div>
                        <div class="status-overview-bar-wrap">
                            <div class="status-overview-bar" style="
                                background: var(--danger);
                                width: {{ $totalAlumni > 0 ? ($unemployed / $totalAlumni) * 100 : 0 }}%;
                            "></div>
                        </div>
                        <div class="status-overview-pct">
                            {{ $totalAlumni > 0 ? number_format(($unemployed / $totalAlumni) * 100, 0) : 0 }}%
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Quick Access --}}
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <div class="section-header mb-0">
                    <div class="section-header-icon"><i class="bi bi-lightning"></i></div>
                    <h5>Akses Cepat</h5>
                </div>
            </div>
            <div class="card-body d-flex flex-column gap-3">
                <a href="{{ route('admin.alumni.index') }}" class="quick-link-card">
                    <div class="quick-link-icon" style="background:#EFF6FF; color:var(--primary);">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="quick-link-info">
                        <div class="quick-link-title">Kelola Alumni</div>
                        <div class="quick-link-desc">Lihat & cari data alumni</div>
                    </div>
                    <i class="bi bi-chevron-right quick-link-arrow"></i>
                </a>

                <a href="{{ route('admin.analytics') }}" class="quick-link-card">
                    <div class="quick-link-icon" style="background:#EDFAF4; color:var(--success);">
                        <i class="bi bi-bar-chart-line-fill"></i>
                    </div>
                    <div class="quick-link-info">
                        <div class="quick-link-title">Analytics</div>
                        <div class="quick-link-desc">Statistik & visualisasi data</div>
                    </div>
                    <i class="bi bi-chevron-right quick-link-arrow"></i>
                </a>

                {{-- Ringkasan angka --}}
                <div class="summary-box mt-auto">
                    <div class="summary-box-row">
                        <span class="summary-box-label">Total Wirausaha</span>
                        <span class="summary-box-val">{{ $entrepreneur }}</span>
                    </div>
                    <div class="summary-box-row">
                        <span class="summary-box-label">Belum Bekerja</span>
                        <span class="summary-box-val">{{ $unemployed }}</span>
                    </div>
                    <div class="summary-box-row">
                        <span class="summary-box-label">Response Rate</span>
                        <span class="summary-box-val" style="color:var(--success);">
                            @php
                                $totalTracer = $working + $studying + $entrepreneur + $unemployed;
                            @endphp
                            {{ $totalAlumni > 0 ? number_format(($totalTracer / $totalAlumni) * 100, 1) : 0 }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===== RECENT TRACER TABLE ===== --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="section-header mb-0">
            <div class="section-header-icon"><i class="bi bi-clock-history"></i></div>
            <h5>Tracer Study Terbaru</h5>
        </div>
        <a href="{{ route('admin.alumni.index') }}" class="btn btn-sm btn-outline">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Alumni</th>
                        <th>Status</th>
                        <th>Perusahaan / Universitas</th>
                        <th>Tanggal Submit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTracers as $trace)
                        <tr>
                            <td>
                                <div class="table-user">
                                    <div class="table-avatar">
                                        {{ strtoupper(substr($trace->user->name, 0, 1)) }}
                                    </div>
                                    <span class="table-user-name">{{ $trace->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    $statusMap = [
                                        'working'      => ['label' => 'Bekerja',       'class' => 'badge-working'],
                                        'studying'     => ['label' => 'Studi Lanjut',  'class' => 'badge-studying'],
                                        'entrepreneur' => ['label' => 'Wirausaha',     'class' => 'badge-entrepreneur'],
                                        'unemployed'   => ['label' => 'Belum Bekerja', 'class' => 'badge-unemployed'],
                                    ];
                                    $s = $statusMap[$trace->status] ?? ['label' => ucfirst($trace->status), 'class' => 'badge-empty'];
                                @endphp
                                <span class="badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                            </td>
                            <td class="text-muted">
                                {{ $trace->company_name ?? $trace->university_name ?? '—' }}
                            </td>
                            <td class="text-muted" style="font-size:12.5px;">
                                {{ $trace->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.alumni.show', $trace->user->id) }}"
                                   class="btn btn-sm btn-outline" title="Lihat detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox empty-state-icon"></i>
                                    <p class="empty-state-text">Belum ada data tracer study.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
/* ===== WELCOME BANNER ===== */
.welcome-banner {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    border-radius: var(--radius-xl);
    padding: 24px 28px;
    position: relative;
    overflow: hidden;
}

.welcome-banner-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    position: relative;
    z-index: 1;
}

.welcome-greeting {
    font-size: 13px;
    color: rgba(255,255,255,0.65);
    margin: 0 0 4px;
    font-weight: 500;
}

.welcome-name {
    font-size: 22px;
    font-weight: 800;
    color: #FFFFFF;
    margin: 0 0 4px;
    letter-spacing: -0.02em;
}

.welcome-sub {
    font-size: 13px;
    color: rgba(255,255,255,0.55);
    margin: 0;
}

.welcome-date {
    display: flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 999px;
    padding: 7px 14px;
    font-size: 12.5px;
    font-weight: 600;
    color: rgba(255,255,255,0.85);
    white-space: nowrap;
}

.welcome-banner-deco {
    position: absolute;
    right: -40px; top: -40px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    pointer-events: none;
}

.welcome-banner-deco::after {
    content: '';
    position: absolute;
    inset: 30px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
}

/* ===== STATS GRID ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

.stat-value-unit {
    font-size: 16px;
    font-weight: 600;
    margin-left: 3px;
    opacity: 0.75;
}

/* ===== STATUS OVERVIEW ===== */
.status-overview-grid {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.status-overview-item {
    display: grid;
    grid-template-columns: 36px 120px 1fr 40px;
    align-items: center;
    gap: 12px;
}

.status-icon-wrap {
    width: 36px; height: 36px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.status-overview-info { min-width: 0; }

.status-overview-num {
    font-size: 18px;
    font-weight: 800;
    color: var(--gray-800);
    line-height: 1;
    letter-spacing: -0.02em;
}

.status-overview-label {
    font-size: 11.5px;
    color: var(--gray-400);
    font-weight: 600;
    margin-top: 2px;
}

.status-overview-bar-wrap {
    height: 6px;
    background: var(--gray-100);
    border-radius: 999px;
    overflow: hidden;
}

.status-overview-bar {
    height: 100%;
    border-radius: 999px;
    transition: width 0.8s cubic-bezier(0.4,0,0.2,1);
    min-width: 4px;
}

.status-overview-pct {
    font-size: 12px;
    font-weight: 700;
    color: var(--gray-500);
    text-align: right;
}

/* ===== QUICK LINKS ===== */
.quick-link-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px;
    background: var(--gray-50);
    border: 1.5px solid var(--gray-100);
    border-radius: var(--radius-md);
    text-decoration: none;
    transition: var(--transition);
}

.quick-link-card:hover {
    border-color: var(--gray-200);
    background: var(--surface);
    box-shadow: var(--shadow-sm);
    transform: translateX(2px);
}

.quick-link-icon {
    width: 40px; height: 40px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.quick-link-info { flex: 1; min-width: 0; }

.quick-link-title {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--gray-800);
}

.quick-link-desc {
    font-size: 11.5px;
    color: var(--gray-400);
    margin-top: 1px;
}

.quick-link-arrow {
    color: var(--gray-300);
    font-size: 13px;
    transition: var(--transition);
}

.quick-link-card:hover .quick-link-arrow { color: var(--gray-500); }

/* ===== SUMMARY BOX ===== */
.summary-box {
    background: var(--gray-50);
    border: 1px solid var(--gray-100);
    border-radius: var(--radius-md);
    padding: 14px;
}

.summary-box-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 6px 0;
    border-bottom: 1px solid var(--gray-100);
    font-size: 13px;
}

.summary-box-row:last-child { border-bottom: none; }

.summary-box-label { color: var(--gray-500); font-weight: 500; }
.summary-box-val   { font-weight: 700; color: var(--gray-800); }

/* ===== TABLE USER ===== */
.table-user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.table-avatar {
    width: 30px; height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-light), var(--primary));
    color: white;
    font-size: 11px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.table-user-name {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--gray-800);
}

/* ===== EMPTY STATE ===== */
.empty-state {
    text-align: center;
    padding: 40px 20px;
}

.empty-state-icon {
    font-size: 40px;
    color: var(--gray-200);
    display: block;
    margin-bottom: 10px;
}

.empty-state-text {
    font-size: 14px;
    color: var(--gray-400);
    margin: 0;
    font-weight: 500;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .status-overview-item { grid-template-columns: 36px 100px 1fr 36px; }
}

@media (max-width: 640px) {
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .welcome-banner-content { flex-direction: column; align-items: flex-start; gap: 14px; }
    .status-overview-item { grid-template-columns: 36px 1fr 40px; }
    .status-overview-info { display: none; }
}
</style>
@endsection
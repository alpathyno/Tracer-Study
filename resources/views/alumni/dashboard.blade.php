@extends('layouts.app')

@section('title', 'Dashboard Alumni')
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

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ===== WELCOME BANNER ===== --}}
<div class="welcome-banner mb-4">
    <div class="welcome-banner-content">
        <div class="welcome-avatar">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="welcome-text">
            <p class="welcome-greeting">Selamat datang kembali</p>
            <h2 class="welcome-name">{{ $user->name }}</h2>
            <p class="welcome-meta">
                <span class="welcome-meta-chip">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    {{ $user->alumniProfile->major ?? 'Jurusan belum diisi' }}
                </span>
                <span class="welcome-meta-chip">
                    <i class="bi bi-calendar3"></i>
                    Lulus {{ $user->alumniProfile->graduation_year ?? '—' }}
                </span>
                @if($user->nisn)
                <span class="welcome-meta-chip">
                    <i class="bi bi-hash"></i>
                    {{ $user->nisn }}
                </span>
                @endif
            </p>
        </div>
    </div>
    <div class="welcome-banner-deco"></div>
    <div class="welcome-banner-deco-2"></div>
</div>

{{-- ===== STAT CARDS ===== --}}
<div class="alumni-stats-grid mb-4">

    {{-- Status Tracer --}}
    <div class="astat-card {{ $tracer ? 'astat-'.($tracer->status) : 'astat-empty' }}">
        <div class="astat-icon-wrap">
            @if(!$tracer)
                <i class="bi bi-clipboard-x"></i>
            @elseif($tracer->status == 'working')
                <i class="bi bi-briefcase-fill"></i>
            @elseif($tracer->status == 'studying')
                <i class="bi bi-book-fill"></i>
            @elseif($tracer->status == 'entrepreneur')
                <i class="bi bi-shop"></i>
            @else
                <i class="bi bi-search"></i>
            @endif
        </div>
        <div class="astat-body">
            <div class="astat-label">Status Saat Ini</div>
            <div class="astat-value">{{ $tracer?->status_label ?? 'Belum Diisi' }}</div>
            <div class="astat-sub">Tracer Study</div>
        </div>
    </div>

    {{-- Relevansi --}}
    <div class="astat-card astat-info">
        <div class="astat-icon-wrap">
            <i class="bi bi-star-fill"></i>
        </div>
        <div class="astat-body">
            <div class="astat-label">Relevansi Kerja</div>
            <div class="astat-value">
                @if($tracer?->job_relevance)
                    {{ $tracer->job_relevance }}<span class="astat-unit">/5</span>
                @else
                    —
                @endif
            </div>
            <div class="astat-sub">Skor relevansi pekerjaan</div>
        </div>
    </div>

    {{-- Waktu Tunggu --}}
    <div class="astat-card astat-warning">
        <div class="astat-icon-wrap">
            <i class="bi bi-clock-fill"></i>
        </div>
        <div class="astat-body">
            <div class="astat-label">Waktu Tunggu</div>
            <div class="astat-value">
                @if($tracer?->waiting_time !== null)
                    {{ $tracer->waiting_time }}<span class="astat-unit">bln</span>
                @else
                    —
                @endif
            </div>
            <div class="astat-sub">Sejak lulus hingga kerja</div>
        </div>
    </div>

</div>

{{-- ===== ROW: PROFIL + TRACER ===== --}}
<div class="row g-4">

    {{-- ===== PROFIL SAYA ===== --}}
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="section-header mb-0">
                    <div class="section-header-icon"><i class="bi bi-person"></i></div>
                    <h5>Profil Saya</h5>
                </div>
                <a href="{{ route('alumni.profile') }}" class="btn btn-sm btn-outline">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
            <div class="card-body">
                @if($user->alumniProfile)
                    <div class="profile-avatar-row">
                        <div class="profile-avatar-lg">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="profile-name">{{ $user->name }}</div>
                            <div class="profile-role">Alumni · {{ $user->alumniProfile->major }}</div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="info-list">
                        <div class="info-row">
                            <div class="info-row-label">
                                <i class="bi bi-envelope"></i> Email
                            </div>
                            <div class="info-row-value">{{ $user->email }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-label">
                                <i class="bi bi-telephone"></i> Telepon
                            </div>
                            <div class="info-row-value">{{ $user->alumniProfile->phone }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-label">
                                <i class="bi bi-geo-alt"></i> Alamat
                            </div>
                            <div class="info-row-value">{{ $user->alumniProfile->address }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-label">
                                <i class="bi bi-mortarboard"></i> Jurusan
                            </div>
                            <div class="info-row-value">{{ $user->alumniProfile->major }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-label">
                                <i class="bi bi-calendar3"></i> Tahun Lulus
                            </div>
                            <div class="info-row-value">{{ $user->alumniProfile->graduation_year }}</div>
                        </div>
                    </div>
                @else
                    <div class="empty-profile">
                        <div class="empty-profile-icon">
                            <i class="bi bi-person-x"></i>
                        </div>
                        <p class="empty-profile-title">Profil belum lengkap</p>
                        <p class="empty-profile-desc">Lengkapi profil agar data kamu tercatat dengan baik.</p>
                        <a href="{{ route('alumni.profile') }}" class="btn btn-primary mt-2">
                            <i class="bi bi-pencil"></i> Lengkapi Profil
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ===== TRACER STUDY ===== --}}
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="section-header mb-0">
                    <div class="section-header-icon"><i class="bi bi-clipboard-data"></i></div>
                    <h5>Tracer Study</h5>
                </div>
                @if($tracer)
                    <a href="{{ route('tracer.edit') }}" class="btn btn-sm btn-outline">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                @endif
            </div>
            <div class="card-body">
                @if($tracer)
                    {{-- Status badge besar --}}
                    @php
                        $statusConfig = [
                            'working'      => ['label'=>'Bekerja',       'class'=>'badge-working',      'icon'=>'bi-briefcase-fill',  'color'=>'var(--success)', 'bg'=>'var(--success-bg)'],
                            'studying'     => ['label'=>'Studi Lanjut',  'class'=>'badge-studying',     'icon'=>'bi-book-fill',       'color'=>'var(--info)',    'bg'=>'var(--info-bg)'],
                            'entrepreneur' => ['label'=>'Wirausaha',     'class'=>'badge-entrepreneur', 'icon'=>'bi-shop',            'color'=>'var(--warning)', 'bg'=>'var(--warning-bg)'],
                            'unemployed'   => ['label'=>'Belum Bekerja', 'class'=>'badge-unemployed',   'icon'=>'bi-search',          'color'=>'var(--danger)',  'bg'=>'var(--danger-bg)'],
                        ];
                        $sc = $statusConfig[$tracer->status] ?? $statusConfig['unemployed'];
                    @endphp

                    <div class="tracer-status-banner" style="background:{{ $sc['bg'] }}; border-color: {{ $sc['color'] }}20;">
                        <div class="tracer-status-icon" style="background:{{ $sc['color'] }}15; color:{{ $sc['color'] }};">
                            <i class="bi {{ $sc['icon'] }}"></i>
                        </div>
                        <div>
                            <div class="tracer-status-label">Status Kamu Saat Ini</div>
                            <div class="tracer-status-value" style="color:{{ $sc['color'] }};">{{ $sc['label'] }}</div>
                        </div>
                        <span class="badge {{ $sc['class'] }} ms-auto">Aktif</span>
                    </div>

                    {{-- Detail berdasarkan status --}}
                    <div class="info-list mt-3">
                        @if($tracer->status == 'working')
                            <div class="info-row">
                                <div class="info-row-label"><i class="bi bi-building"></i> Perusahaan</div>
                                <div class="info-row-value fw-semibold">{{ $tracer->company_name }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-row-label"><i class="bi bi-person-badge"></i> Posisi</div>
                                <div class="info-row-value">{{ $tracer->job_position }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-row-label"><i class="bi bi-cash-coin"></i> Gaji</div>
                                <div class="info-row-value fw-semibold" style="color:var(--success);">
                                    Rp {{ number_format($tracer->salary, 0, ',', '.') }}
                                </div>
                            </div>
                        @endif

                        @if($tracer->status == 'studying')
                            <div class="info-row">
                                <div class="info-row-label"><i class="bi bi-bank"></i> Universitas</div>
                                <div class="info-row-value fw-semibold">{{ $tracer->university_name }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-row-label"><i class="bi bi-journal-bookmark"></i> Jurusan</div>
                                <div class="info-row-value">{{ $tracer->study_major }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-row-label"><i class="bi bi-layers"></i> Jenjang</div>
                                <div class="info-row-value">{{ $tracer->level }}</div>
                            </div>
                        @endif

                        @if($tracer->status == 'entrepreneur')
                            <div class="info-row">
                                <div class="info-row-label"><i class="bi bi-shop"></i> Nama Usaha</div>
                                <div class="info-row-value fw-semibold">{{ $tracer->company_name }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-row-label"><i class="bi bi-tag"></i> Bidang</div>
                                <div class="info-row-value">{{ $tracer->job_position }}</div>
                            </div>
                        @endif

                        <div class="info-row">
                            <div class="info-row-label"><i class="bi bi-hourglass-split"></i> Waktu Tunggu</div>
                            <div class="info-row-value">{{ $tracer->waiting_time }} bulan</div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-label"><i class="bi bi-star"></i> Relevansi</div>
                            <div class="info-row-value">
                                <div class="star-row">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $tracer->job_relevance ? 'bi-star-fill' : 'bi-star' }}"
                                           style="color: {{ $i <= $tracer->job_relevance ? '#F59E0B' : 'var(--gray-200)' }}; font-size:13px;"></i>
                                    @endfor
                                    <span class="ms-1" style="font-size:12px; color:var(--gray-500); font-weight:600;">{{ $tracer->job_relevance }}/5</span>
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-label"><i class="bi bi-calendar-check"></i> Diisi pada</div>
                            <div class="info-row-value" style="color:var(--gray-400); font-size:12.5px;">
                                {{ $tracer->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    @if($tracer->feedback)
                        <div class="feedback-box mt-3">
                            <div class="feedback-box-label">
                                <i class="bi bi-chat-quote"></i> Feedback untuk Sekolah
                            </div>
                            <p class="feedback-box-text">{{ $tracer->feedback }}</p>
                        </div>
                    @endif

                @else
                    {{-- Belum isi tracer --}}
                    <div class="tracer-empty">
                        <div class="tracer-empty-icon">
                            <i class="bi bi-clipboard-x"></i>
                        </div>
                        <p class="tracer-empty-title">Belum mengisi Tracer Study</p>
                        <p class="tracer-empty-desc">
                            Ceritakan perjalananmu setelah lulus. Data kamu sangat membantu pengembangan sekolah.
                        </p>
                        <a href="{{ route('tracer.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Isi Tracer Study Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<style>
/* ===== WELCOME BANNER ===== */
.welcome-banner {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    border-radius: var(--radius-xl);
    padding: 28px 32px;
    position: relative;
    overflow: hidden;
}

.welcome-banner-content {
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative;
    z-index: 2;
}

.welcome-avatar {
    width: 60px; height: 60px;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    border: 2px solid rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 800;
    color: white;
    flex-shrink: 0;
}

.welcome-greeting {
    font-size: 13px;
    color: rgba(255,255,255,0.6);
    margin: 0 0 3px;
    font-weight: 500;
}

.welcome-name {
    font-size: 22px;
    font-weight: 800;
    color: white;
    margin: 0 0 10px;
    letter-spacing: -0.02em;
}

.welcome-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    margin: 0;
}

.welcome-meta-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    color: rgba(255,255,255,0.85);
}

.welcome-banner-deco {
    position: absolute;
    right: -50px; top: -50px;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    pointer-events: none;
}

.welcome-banner-deco-2 {
    position: absolute;
    right: 60px; bottom: -70px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: rgba(200,169,110,0.08);
    border: 1px solid rgba(200,169,110,0.1);
    pointer-events: none;
}

/* ===== ALUMNI STAT CARDS ===== */
.alumni-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

.astat-card {
    background: white;
    border: 1.5px solid var(--gray-100);
    border-radius: var(--radius-lg);
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.astat-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.astat-icon-wrap {
    width: 48px; height: 48px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}

/* Status variants */
.astat-working .astat-icon-wrap    { background: var(--success-bg); color: var(--success); }
.astat-studying .astat-icon-wrap   { background: var(--info-bg);    color: var(--info); }
.astat-entrepreneur .astat-icon-wrap{ background: var(--warning-bg); color: var(--warning); }
.astat-unemployed .astat-icon-wrap { background: var(--danger-bg);  color: var(--danger); }
.astat-empty .astat-icon-wrap      { background: var(--gray-100);   color: var(--gray-400); }
.astat-info .astat-icon-wrap       { background: var(--warning-bg); color: #F59E0B; }
.astat-warning .astat-icon-wrap    { background: var(--info-bg);    color: var(--info); }

.astat-body { flex: 1; min-width: 0; }

.astat-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--gray-400);
    margin-bottom: 4px;
}

.astat-value {
    font-size: 24px;
    font-weight: 800;
    color: var(--gray-900);
    letter-spacing: -0.03em;
    line-height: 1.1;
}

.astat-unit {
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-400);
    margin-left: 2px;
}

.astat-sub {
    font-size: 12px;
    color: var(--gray-400);
    font-weight: 500;
    margin-top: 3px;
}

/* ===== PROFILE CARD ===== */
.profile-avatar-row {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 16px;
}

.profile-avatar-lg {
    width: 52px; height: 52px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-light), var(--primary));
    color: white;
    font-size: 20px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.profile-name {
    font-size: 15px;
    font-weight: 800;
    color: var(--gray-900);
    letter-spacing: -0.01em;
}

.profile-role {
    font-size: 12.5px;
    color: var(--gray-400);
    font-weight: 500;
    margin-top: 2px;
}

.info-list { display: flex; flex-direction: column; }

.info-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--gray-100);
    font-size: 13.5px;
}

.info-row:last-child { border-bottom: none; }

.info-row-label {
    display: flex;
    align-items: center;
    gap: 6px;
    min-width: 130px;
    flex-shrink: 0;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--gray-400);
}

.info-row-label i { font-size: 13px; }

.info-row-value {
    color: var(--gray-700);
    font-weight: 500;
    flex: 1;
    word-break: break-word;
}

/* ===== EMPTY PROFILE ===== */
.empty-profile {
    text-align: center;
    padding: 32px 20px;
}

.empty-profile-icon {
    width: 56px; height: 56px;
    background: var(--gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    font-size: 24px;
    color: var(--gray-300);
}

.empty-profile-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--gray-600);
    margin: 0 0 6px;
}

.empty-profile-desc {
    font-size: 13px;
    color: var(--gray-400);
    margin: 0;
    line-height: 1.6;
}

/* ===== TRACER STUDY CARD ===== */
.tracer-status-banner {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px;
    border-radius: var(--radius-md);
    border: 1.5px solid;
}

.tracer-status-icon {
    width: 44px; height: 44px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.tracer-status-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--gray-400);
    margin-bottom: 2px;
}

.tracer-status-value {
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -0.02em;
}

/* Star row */
.star-row {
    display: flex;
    align-items: center;
    gap: 2px;
}

/* Feedback box */
.feedback-box {
    background: var(--gray-50);
    border: 1px solid var(--gray-100);
    border-left: 3px solid var(--accent);
    border-radius: var(--radius-md);
    padding: 14px 16px;
}

.feedback-box-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--gray-400);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.feedback-box-text {
    font-size: 13.5px;
    color: var(--gray-600);
    line-height: 1.65;
    margin: 0;
    font-style: italic;
}

/* ===== TRACER EMPTY STATE ===== */
.tracer-empty {
    text-align: center;
    padding: 40px 20px;
}

.tracer-empty-icon {
    width: 64px; height: 64px;
    background: var(--gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    font-size: 28px;
    color: var(--gray-300);
}

.tracer-empty-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--gray-700);
    margin: 0 0 8px;
}

.tracer-empty-desc {
    font-size: 13.5px;
    color: var(--gray-400);
    line-height: 1.6;
    margin: 0;
    max-width: 320px;
    margin: 0 auto;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .alumni-stats-grid { grid-template-columns: 1fr; }
    .welcome-banner-content { flex-direction: column; align-items: flex-start; gap: 14px; }
    .info-row-label { min-width: 110px; }
}
</style>

@endsection
@extends('layouts.app')

@section('title', 'Analytics — Tracer Study')
@section('page-title', 'Analytics')

@section('content')

{{-- ===== STAT CARDS ===== --}}
<div class="stats-grid mb-4">

    <div class="stat-card stat-card-primary">
        <div class="stat-card-ghost-icon"><i class="bi bi-people"></i></div>
        <div class="stat-label">Total Alumni</div>
        <div class="stat-value">{{ $totalAlumni }}</div>
        <div class="stat-sub">Alumni terdaftar</div>
    </div>

    <div class="stat-card stat-card-info">
        <div class="stat-card-ghost-icon"><i class="bi bi-clipboard-check"></i></div>
        <div class="stat-label">Total Responden</div>
        <div class="stat-value">{{ $totalTracer }}</div>
        <div class="stat-sub" style="color:var(--info);">
            {{ $totalAlumni > 0 ? number_format(($totalTracer / $totalAlumni) * 100, 1) : 0 }}% response rate
        </div>
    </div>

    <div class="stat-card stat-card-success">
        <div class="stat-card-ghost-icon"><i class="bi bi-cash-coin"></i></div>
        <div class="stat-label">Rata-rata Gaji</div>
        <div class="stat-value">{{ $avgSalary > 0 ? 'Rp ' . number_format($avgSalary / 1000000, 1) . 'jt' : '—' }}</div>
        <div class="stat-sub" style="color:var(--success);">Per bulan</div>
    </div>

    <div class="stat-card stat-card-warning">
        <div class="stat-card-ghost-icon"><i class="bi bi-star"></i></div>
        <div class="stat-label">Skor Relevansi</div>
        <div class="stat-value">{{ number_format($avgRelevance, 1) }}<span class="stat-value-unit">/5</span></div>
        <div class="stat-sub" style="color:var(--warning);">Rata-rata skor</div>
    </div>

</div>

{{-- ===== ROW: CHARTS ===== --}}
<div class="row g-4 mb-4">

    {{-- Pie Chart: Status --}}
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <div class="section-header mb-0">
                    <div class="section-header-icon"><i class="bi bi-pie-chart"></i></div>
                    <h5>Distribusi Status Alumni</h5>
                </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div class="chart-wrap">
                    <canvas id="statusChart"></canvas>
                </div>
                {{-- Legend --}}
                <div class="chart-legend mt-3">
                    @php
                        $legendColors = ['#0F7B55','#0369A1','#B45309','#B91C1C'];
                    @endphp
                    @foreach($statusLabels as $i => $label)
                        <div class="chart-legend-item">
                            <span class="chart-legend-dot" style="background:{{ $legendColors[$i] ?? '#94A3B8' }};"></span>
                            <span class="chart-legend-label">{{ $label }}</span>
                            <span class="chart-legend-val">{{ $statusCounts[$i] ?? 0 }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Bar Chart: Jurusan --}}
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header">
                <div class="section-header mb-0">
                    <div class="section-header-icon"><i class="bi bi-bar-chart"></i></div>
                    <h5>Alumni per Jurusan</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-wrap-bar">
                    <canvas id="majorChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===== ROW: SUMMARY STATS ===== --}}
<div class="card">
    <div class="card-header">
        <div class="section-header mb-0">
            <div class="section-header-icon"><i class="bi bi-graph-up-arrow"></i></div>
            <h5>Ringkasan Statistik</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="summary-stats-grid">

            <div class="summary-stat-card">
                <div class="summary-stat-icon" style="background:#EFF6FF; color:var(--primary);">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="summary-stat-body">
                    <div class="summary-stat-label">Rata-rata Waktu Tunggu</div>
                    <div class="summary-stat-value">{{ number_format($avgWaiting, 1) }} <span>bulan</span></div>
                    <div class="summary-stat-desc">Sejak lulus hingga mendapat pekerjaan</div>
                </div>
                <div class="summary-stat-visual">
                    <div class="summary-ring" style="--pct: {{ min($avgWaiting / 12 * 100, 100) }}; --color: var(--primary);">
                        <svg viewBox="0 0 36 36">
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#E2E8F0" stroke-width="2.5"/>
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="var(--primary)" stroke-width="2.5"
                                stroke-dasharray="{{ min($avgWaiting / 12 * 100, 100) }} 100"
                                stroke-dashoffset="25" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="summary-stat-card">
                <div class="summary-stat-icon" style="background:#EDFAF4; color:var(--success);">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div class="summary-stat-body">
                    <div class="summary-stat-label">Rata-rata Gaji</div>
                    <div class="summary-stat-value">Rp <span>{{ number_format($avgSalary, 0, ',', '.') }}</span></div>
                    <div class="summary-stat-desc">Gaji alumni yang bekerja per bulan</div>
                </div>
                <div class="summary-stat-visual">
                    <div class="summary-ring" style="--color: var(--success);">
                        <svg viewBox="0 0 36 36">
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#E2E8F0" stroke-width="2.5"/>
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="var(--success)" stroke-width="2.5"
                                stroke-dasharray="75 100"
                                stroke-dashoffset="25" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="summary-stat-card">
                <div class="summary-stat-icon" style="background:#FFFBEB; color:var(--warning);">
                    <i class="bi bi-star-half"></i>
                </div>
                <div class="summary-stat-body">
                    <div class="summary-stat-label">Rata-rata Relevansi</div>
                    <div class="summary-stat-value">{{ number_format($avgRelevance, 1) }} <span>/ 5</span></div>
                    <div class="summary-stat-desc">Relevansi pekerjaan dengan bidang studi</div>
                </div>
                <div class="summary-stat-visual">
                    {{-- Star rating visual --}}
                    <div class="star-rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($avgRelevance))
                                <i class="bi bi-star-fill" style="color:#F59E0B;"></i>
                            @elseif($i - 0.5 <= $avgRelevance)
                                <i class="bi bi-star-half" style="color:#F59E0B;"></i>
                            @else
                                <i class="bi bi-star" style="color:#E2E8F0;"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* ===== STATS GRID ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

.stat-value-unit {
    font-size: 16px;
    font-weight: 600;
    margin-left: 2px;
    opacity: 0.7;
}

/* ===== CHART ===== */
.chart-wrap {
    width: 100%;
    max-width: 240px;
    margin: 0 auto;
}

.chart-wrap-bar {
    width: 100%;
    height: 240px;
    position: relative;
}

/* Legend */
.chart-legend {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 0 8px;
}

.chart-legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12.5px;
}

.chart-legend-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.chart-legend-label {
    flex: 1;
    color: var(--gray-600);
    font-weight: 500;
}

.chart-legend-val {
    font-weight: 700;
    color: var(--gray-800);
    font-size: 13px;
}

/* ===== SUMMARY STATS GRID ===== */
.summary-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.summary-stat-card {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 18px;
    background: var(--gray-50);
    border: 1.5px solid var(--gray-100);
    border-radius: var(--radius-lg);
    transition: var(--transition);
}

.summary-stat-card:hover {
    border-color: var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.summary-stat-icon {
    width: 44px;
    height: 44px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.summary-stat-body { flex: 1; min-width: 0; }

.summary-stat-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--gray-400);
    margin-bottom: 6px;
}

.summary-stat-value {
    font-size: 22px;
    font-weight: 800;
    color: var(--gray-900);
    letter-spacing: -0.03em;
    line-height: 1.1;
    margin-bottom: 6px;
}

.summary-stat-value span {
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-500);
    letter-spacing: 0;
}

.summary-stat-desc {
    font-size: 12px;
    color: var(--gray-400);
    font-weight: 500;
    line-height: 1.4;
}

/* Ring chart */
.summary-stat-visual { flex-shrink: 0; }

.summary-ring {
    width: 48px;
    height: 48px;
}

.summary-ring svg {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
}

/* Star rating */
.star-rating {
    display: flex;
    gap: 3px;
    font-size: 18px;
    margin-top: 4px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .summary-stats-grid { grid-template-columns: 1fr; }
}

@media (max-width: 640px) {
    .stats-grid { grid-template-columns: 1fr 1fr; }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const statusColors = ['#0F7B55', '#0369A1', '#B45309', '#B91C1C'];

    // ===== PIE CHART: Status =====
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: @json($statusLabels),
            datasets: [{
                data: @json($statusCounts),
                backgroundColor: statusColors,
                borderColor: '#FFFFFF',
                borderWidth: 3,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E293B',
                    titleColor: '#F1F5F9',
                    bodyColor: '#94A3B8',
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(ctx) {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const pct = total > 0 ? ((ctx.parsed / total) * 100).toFixed(1) : 0;
                            return ` ${ctx.parsed} alumni (${pct}%)`;
                        }
                    }
                }
            }
        }
    });

    // ===== BAR CHART: Jurusan =====
    const majorCtx = document.getElementById('majorChart').getContext('2d');
    new Chart(majorCtx, {
        type: 'bar',
        data: {
            labels: @json($majorLabels),
            datasets: [{
                label: 'Jumlah Alumni',
                data: @json($majorCounts),
                backgroundColor: 'rgba(30, 58, 95, 0.85)',
                borderRadius: 6,
                borderSkipped: false,
                hoverBackgroundColor: '#2A5298',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E293B',
                    titleColor: '#F1F5F9',
                    bodyColor: '#94A3B8',
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(ctx) {
                            return ` ${ctx.parsed.y} alumni`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: {
                        font: { family: 'Plus Jakarta Sans', size: 12, weight: '600' },
                        color: '#94A3B8',
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#F1F5F9',
                        drawBorder: false,
                    },
                    border: { display: false, dash: [4, 4] },
                    ticks: {
                        font: { family: 'Plus Jakarta Sans', size: 11 },
                        color: '#CBD5E1',
                        precision: 0,
                    }
                }
            }
        }
    });
});
</script>
@endpush

@endsection
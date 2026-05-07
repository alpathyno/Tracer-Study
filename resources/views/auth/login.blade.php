<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Tracer Study</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="margin:0; padding:0; font-family:'Plus Jakarta Sans',sans-serif; background:#F8FAFC;">

<div class="auth-container">

    {{-- ===== LEFT PANEL (Branding) ===== --}}
    <div class="auth-left">
        <div class="auth-left-inner">

            <div class="auth-brand">
                <div class="auth-brand-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <div>
                    <div class="auth-brand-name">Tracer Study</div>
                    <div class="auth-brand-sub">SMK Gadjah Mada</div>
                </div>
            </div>

            <div class="auth-hero">
                <h1 class="auth-hero-title">
                    Lacak Perjalanan<br>
                    <span class="auth-hero-highlight">Alumni Kami</span>
                </h1>
                <p class="auth-hero-desc">
                    Platform resmi untuk memantau perkembangan karir dan pendidikan alumni. Data yang akurat untuk masa depan yang lebih baik.
                </p>
            </div>

            <div class="auth-stats">
                <div class="auth-stat-item">
                    <div class="auth-stat-value">500+</div>
                    <div class="auth-stat-label">Alumni Terdaftar</div>
                </div>
                <div class="auth-stat-divider"></div>
                <div class="auth-stat-item">
                    <div class="auth-stat-value">6</div>
                    <div class="auth-stat-label">Program Keahlian</div>
                </div>
                <div class="auth-stat-divider"></div>
                <div class="auth-stat-item">
                    <div class="auth-stat-value">85%</div>
                    <div class="auth-stat-label">Terserap Kerja</div>
                </div>
            </div>

            {{-- Decorative elements --}}
            <div class="auth-deco-circle auth-deco-1"></div>
            <div class="auth-deco-circle auth-deco-2"></div>
            <div class="auth-deco-dots"></div>
        </div>
    </div>

    {{-- ===== RIGHT PANEL (Form) ===== --}}
    <div class="auth-right">
        <div class="auth-form-wrap">

            <div class="auth-form-header">
                <h2 class="auth-form-title">Selamat Datang</h2>
                <p class="auth-form-subtitle">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            @if ($errors->any())
                <div class="auth-alert auth-alert-danger">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="auth-alert auth-alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="auth-field">
                    <label for="email" class="auth-label">Alamat Email</label>
                    <div class="auth-input-wrap">
                        <span class="auth-input-icon"><i class="bi bi-envelope"></i></span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="auth-input @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="auth-field">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="password" class="auth-label">Password</label>
                    </div>
                    <div class="auth-input-wrap">
                        <span class="auth-input-icon"><i class="bi bi-lock"></i></span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="auth-input @error('password') is-invalid @enderror"
                            placeholder="Masukkan password"
                            required
                        >
                        <button type="button" class="auth-toggle-pass" onclick="togglePassword('password')">
                            <i class="bi bi-eye" id="password-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="auth-btn-submit">
                    <span>Masuk</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <div class="auth-footer">
                <p>Belum punya akun?
                    <a href="{{ route('register') }}" class="auth-link">Daftar sebagai alumni</a>
                </p>
            </div>

        </div>
    </div>

</div>

<style>
/* ============================================================
   AUTH LAYOUT
============================================================ */
.auth-container {
    display: flex;
    min-height: 100vh;
}

/* ===== LEFT PANEL ===== */
.auth-left {
    width: 45%;
    background: linear-gradient(145deg, #0F172A 0%, #1E3A5F 60%, #2A5298 100%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.auth-left-inner {
    position: relative;
    z-index: 2;
    padding: 48px;
    width: 100%;
    max-width: 460px;
}

/* Brand */
.auth-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 56px;
}

.auth-brand-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #C8A96E, #E8C98A);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #0F172A;
    box-shadow: 0 4px 16px rgba(200,169,110,0.3);
}

.auth-brand-name {
    font-size: 16px;
    font-weight: 800;
    color: #F1F5F9;
    letter-spacing: -0.01em;
}

.auth-brand-sub {
    font-size: 10.5px;
    font-weight: 500;
    color: rgba(148,163,184,0.8);
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

/* Hero */
.auth-hero { margin-bottom: 48px; }

.auth-hero-title {
    font-size: 38px;
    font-weight: 800;
    color: #F1F5F9;
    line-height: 1.15;
    letter-spacing: -0.03em;
    margin-bottom: 16px;
}

.auth-hero-highlight {
    color: #C8A96E;
    position: relative;
    display: inline-block;
}

.auth-hero-highlight::after {
    content: '';
    position: absolute;
    bottom: 2px;
    left: 0;
    right: 0;
    height: 2px;
    background: #C8A96E;
    opacity: 0.4;
    border-radius: 2px;
}

.auth-hero-desc {
    font-size: 14.5px;
    color: rgba(148,163,184,0.9);
    line-height: 1.7;
    margin: 0;
    max-width: 320px;
}

/* Stats */
.auth-stats {
    display: flex;
    align-items: center;
    gap: 24px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 20px 24px;
    backdrop-filter: blur(10px);
}

.auth-stat-item { text-align: center; }

.auth-stat-value {
    font-size: 24px;
    font-weight: 800;
    color: #C8A96E;
    letter-spacing: -0.03em;
    line-height: 1;
}

.auth-stat-label {
    font-size: 10.5px;
    font-weight: 600;
    color: rgba(148,163,184,0.7);
    letter-spacing: 0.04em;
    margin-top: 4px;
    text-transform: uppercase;
}

.auth-stat-divider {
    width: 1px;
    height: 36px;
    background: rgba(255,255,255,0.1);
    flex-shrink: 0;
}

/* Decorative */
.auth-deco-circle {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(200,169,110,0.1);
    pointer-events: none;
}

.auth-deco-1 {
    width: 400px;
    height: 400px;
    top: -100px;
    right: -100px;
    background: radial-gradient(ellipse, rgba(200,169,110,0.06) 0%, transparent 70%);
}

.auth-deco-2 {
    width: 250px;
    height: 250px;
    bottom: -60px;
    left: -60px;
    background: radial-gradient(ellipse, rgba(42,82,152,0.15) 0%, transparent 70%);
    border-color: rgba(42,82,152,0.15);
}

.auth-deco-dots {
    position: absolute;
    bottom: 48px;
    right: 48px;
    width: 80px;
    height: 80px;
    background-image: radial-gradient(rgba(200,169,110,0.2) 1px, transparent 1px);
    background-size: 12px 12px;
    pointer-events: none;
}

/* ===== RIGHT PANEL ===== */
.auth-right {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #F8FAFC;
    padding: 40px 24px;
}

.auth-form-wrap {
    width: 100%;
    max-width: 400px;
}

.auth-form-header { margin-bottom: 32px; }

.auth-form-title {
    font-size: 26px;
    font-weight: 800;
    color: #0F172A;
    letter-spacing: -0.03em;
    margin: 0 0 6px;
}

.auth-form-subtitle {
    font-size: 14px;
    color: #64748B;
    margin: 0;
    font-weight: 500;
}

/* Alert */
.auth-alert {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 20px;
}

.auth-alert i { font-size: 16px; flex-shrink: 0; margin-top: 1px; }

.auth-alert-danger {
    background: #FEF2F2;
    border: 1px solid rgba(185,28,28,0.2);
    color: #B91C1C;
}

.auth-alert-success {
    background: #EDFAF4;
    border: 1px solid rgba(15,123,85,0.2);
    color: #0F7B55;
}

/* Form */
.auth-form { display: flex; flex-direction: column; gap: 20px; margin-bottom: 24px; }

.auth-field { display: flex; flex-direction: column; gap: 6px; }

.auth-label {
    font-size: 12.5px;
    font-weight: 700;
    color: #334155;
    letter-spacing: 0.01em;
}

.auth-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
}

.auth-input-icon {
    position: absolute;
    left: 13px;
    color: #94A3B8;
    font-size: 15px;
    pointer-events: none;
    z-index: 1;
}

.auth-input {
    width: 100%;
    padding: 11px 42px 11px 40px;
    background: #FFFFFF;
    border: 1.5px solid #E2E8F0;
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    color: #1E293B;
    transition: all 0.2s ease;
    outline: none;
}

.auth-input:focus {
    border-color: #2A5298;
    box-shadow: 0 0 0 3px rgba(42,82,152,0.1);
    background: #FFFFFF;
}

.auth-input::placeholder { color: #CBD5E1; }
.auth-input.is-invalid { border-color: #B91C1C; }

.auth-toggle-pass {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    color: #94A3B8;
    cursor: pointer;
    padding: 4px;
    font-size: 15px;
    transition: color 0.2s;
    display: flex;
    align-items: center;
}

.auth-toggle-pass:hover { color: #475569; }

/* Submit Button */
.auth-btn-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 13px 20px;
    background: linear-gradient(135deg, #2A5298, #1E3A5F);
    color: white;
    border: none;
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    letter-spacing: 0.01em;
    box-shadow: 0 4px 16px rgba(30,58,95,0.3);
    margin-top: 4px;
}

.auth-btn-submit:hover {
    background: linear-gradient(135deg, #1E3A5F, #152a47);
    box-shadow: 0 6px 20px rgba(30,58,95,0.4);
    transform: translateY(-1px);
}

.auth-btn-submit:active { transform: translateY(0); }

.auth-btn-submit i { font-size: 16px; transition: transform 0.2s; }
.auth-btn-submit:hover i { transform: translateX(3px); }

/* Footer */
.auth-footer {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #E2E8F0;
}

.auth-footer p {
    font-size: 13.5px;
    color: #64748B;
    margin: 0;
    font-weight: 500;
}

.auth-link {
    color: #2A5298;
    font-weight: 700;
    text-decoration: none;
    transition: color 0.2s;
}

.auth-link:hover {
    color: #1E3A5F;
    text-decoration: underline;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .auth-container { flex-direction: column; }
    .auth-left {
        width: 100%;
        min-height: 220px;
        padding: 32px 24px;
    }
    .auth-left-inner { padding: 0; }
    .auth-brand { margin-bottom: 24px; }
    .auth-hero { margin-bottom: 24px; }
    .auth-hero-title { font-size: 26px; }
    .auth-stats { padding: 14px 16px; gap: 16px; }
    .auth-deco-1, .auth-deco-2, .auth-deco-dots { display: none; }
    .auth-right { padding: 32px 20px; }
}
</style>

<script>
// Prevent forward button ke dashboard setelah logout
history.pushState(null, null, location.href);
window.addEventListener('popstate', function () {
    history.pushState(null, null, location.href);
});

function togglePassword(id) {
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
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Alumni — Tracer Study</title>
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
                    Bergabung &<br>
                    <span class="auth-hero-highlight">Bagikan Perjalananmu</span>
                </h1>
                <p class="auth-hero-desc">
                    Daftarkan dirimu sebagai alumni dan bantu sekolah memahami perjalanan karir lulusannya.
                </p>
            </div>

            {{-- Steps --}}
            <div class="auth-steps">
                <div class="auth-step">
                    <div class="auth-step-num">1</div>
                    <div class="auth-step-info">
                        <div class="auth-step-title">Buat Akun</div>
                        <div class="auth-step-desc">Isi data diri dan akun</div>
                    </div>
                </div>
                <div class="auth-step-connector"></div>
                <div class="auth-step">
                    <div class="auth-step-num">2</div>
                    <div class="auth-step-info">
                        <div class="auth-step-title">Lengkapi Profil</div>
                        <div class="auth-step-desc">Data alumni & jurusan</div>
                    </div>
                </div>
                <div class="auth-step-connector"></div>
                <div class="auth-step">
                    <div class="auth-step-num">3</div>
                    <div class="auth-step-info">
                        <div class="auth-step-title">Isi Tracer Study</div>
                        <div class="auth-step-desc">Ceritakan perjalananmu</div>
                    </div>
                </div>
            </div>

            {{-- Decorative --}}
            <div class="auth-deco-circle auth-deco-1"></div>
            <div class="auth-deco-circle auth-deco-2"></div>
            <div class="auth-deco-dots"></div>
        </div>
    </div>

    {{-- ===== RIGHT PANEL (Form) ===== --}}
    <div class="auth-right">
        <div class="auth-form-wrap">

            <div class="auth-form-header">
                <h2 class="auth-form-title">Buat Akun Baru</h2>
                <p class="auth-form-subtitle">Isi data di bawah ini untuk mendaftar</p>
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

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                {{-- Section: Akun --}}
                <div class="form-section">
                    <div class="form-section-label">
                        <i class="bi bi-person-badge"></i> Data Akun
                    </div>

                    <div class="form-row-2">
                        <div class="auth-field">
                            <label class="auth-label">Nama Lengkap</label>
                            <div class="auth-input-wrap">
                                <span class="auth-input-icon"><i class="bi bi-person"></i></span>
                                <input type="text" name="name"
                                    class="auth-input @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Nama lengkap"
                                    required>
                            </div>
                        </div>

                        <div class="auth-field">
                            <label class="auth-label">NIM</label>
                            <div class="auth-input-wrap">
                                <span class="auth-input-icon"><i class="bi bi-hash"></i></span>
                                <input type="text" name="nisn"
                                    class="auth-input @error('nisn') is-invalid @enderror"
                                    value="{{ old('nisn') }}"
                                    placeholder="Nomor Induk Siswa"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="auth-field">
                        <label class="auth-label">Alamat Email</label>
                        <div class="auth-input-wrap">
                            <span class="auth-input-icon"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email"
                                class="auth-input @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                required>
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div class="auth-field">
                            <label class="auth-label">Password</label>
                            <div class="auth-input-wrap">
                                <span class="auth-input-icon"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" id="password"
                                    class="auth-input @error('password') is-invalid @enderror"
                                    placeholder="Min. 8 karakter"
                                    required>
                                <button type="button" class="auth-toggle-pass" onclick="togglePassword('password')">
                                    <i class="bi bi-eye" id="password-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="auth-field">
                            <label class="auth-label">Konfirmasi Password</label>
                            <div class="auth-input-wrap">
                                <span class="auth-input-icon"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="auth-input"
                                    placeholder="Ulangi password"
                                    required>
                                <button type="button" class="auth-toggle-pass" onclick="togglePassword('password_confirmation')">
                                    <i class="bi bi-eye" id="password_confirmation-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section: Data Alumni --}}
                <div class="form-section">
                    <div class="form-section-label">
                        <i class="bi bi-mortarboard"></i> Data Alumni
                    </div>

                    <div class="form-row-2">
                        <div class="auth-field">
                            <label class="auth-label">Tahun Lulus</label>
                            <div class="auth-input-wrap">
                                <span class="auth-input-icon"><i class="bi bi-calendar3"></i></span>
                                <input type="number" name="graduation_year"
                                    class="auth-input @error('graduation_year') is-invalid @enderror"
                                    value="{{ old('graduation_year') }}"
                                    placeholder="{{ date('Y') }}"
                                    min="2000" max="{{ date('Y') }}"
                                    required>
                            </div>
                        </div>

                        <div class="auth-field">
                            <label class="auth-label">Jurusan</label>
                            <div class="auth-input-wrap">
                                <span class="auth-input-icon"><i class="bi bi-journal-bookmark"></i></span>
                                <select name="major"
                                    class="auth-input auth-select @error('major') is-invalid @enderror"
                                    required>
                                    <option value="">Pilih Jurusan</option>
                                    <option value="TKJ"  {{ old('major') == 'TKJ'  ? 'selected' : '' }}>TKJ — Teknik Komputer & Jaringan</option>
                                    <option value="RPL"  {{ old('major') == 'RPL'  ? 'selected' : '' }}>RPL — Rekayasa Perangkat Lunak</option>
                                    <option value="TBSM" {{ old('major') == 'TBSM' ? 'selected' : '' }}>TBSM — Teknik Bisnis Sepeda Motor</option>
                                    <option value="TO"   {{ old('major') == 'TO'   ? 'selected' : '' }}>TO — Teknik Ototronik</option>
                                    <option value="TKI"  {{ old('major') == 'TKI'  ? 'selected' : '' }}>TKI — Teknik Kimia Industri</option>
                                    <option value="TAV"  {{ old('major') == 'TAV'  ? 'selected' : '' }}>TAV — Teknik Audio Video</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="auth-field">
                        <label class="auth-label">No. Telepon</label>
                        <div class="auth-input-wrap">
                            <span class="auth-input-icon"><i class="bi bi-telephone"></i></span>
                            <input type="text" name="phone"
                                class="auth-input @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}"
                                placeholder="08xxxxxxxxxx"
                                required>
                        </div>
                    </div>

                    <div class="auth-field">
                        <label class="auth-label">Alamat</label>
                        <textarea name="address"
                            class="auth-input auth-textarea @error('address') is-invalid @enderror"
                            placeholder="Alamat lengkap..."
                            rows="2"
                            required>{{ old('address') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="auth-btn-submit">
                    <i class="bi bi-person-plus"></i>
                    <span>Daftar Sekarang</span>
                    <i class="bi bi-arrow-right ms-auto"></i>
                </button>
            </form>

            <div class="auth-footer">
                <p>Sudah punya akun?
                    <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
                </p>
            </div>

        </div>
    </div>
</div>

<style>
/* ============================================================
   AUTH LAYOUT (shared with login)
============================================================ */
.auth-container {
    display: flex;
    min-height: 100vh;
}

/* ===== LEFT PANEL ===== */
.auth-left {
    width: 38%;
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
}

.auth-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 48px;
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
}

.auth-brand-sub {
    font-size: 10.5px;
    font-weight: 500;
    color: rgba(148,163,184,0.8);
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.auth-hero { margin-bottom: 40px; }

.auth-hero-title {
    font-size: 32px;
    font-weight: 800;
    color: #F1F5F9;
    line-height: 1.2;
    letter-spacing: -0.03em;
    margin-bottom: 14px;
}

.auth-hero-highlight {
    color: #C8A96E;
    position: relative;
    display: inline-block;
}

.auth-hero-highlight::after {
    content: '';
    position: absolute;
    bottom: 2px; left: 0; right: 0;
    height: 2px;
    background: #C8A96E;
    opacity: 0.4;
    border-radius: 2px;
}

.auth-hero-desc {
    font-size: 13.5px;
    color: rgba(148,163,184,0.9);
    line-height: 1.7;
    margin: 0;
}

/* Steps */
.auth-steps {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.auth-step {
    display: flex;
    align-items: center;
    gap: 14px;
}

.auth-step-num {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: rgba(200,169,110,0.15);
    border: 1.5px solid rgba(200,169,110,0.4);
    color: #C8A96E;
    font-size: 12px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.auth-step-title {
    font-size: 13px;
    font-weight: 700;
    color: #E2E8F0;
}

.auth-step-desc {
    font-size: 11.5px;
    color: rgba(148,163,184,0.7);
}

.auth-step-connector {
    width: 1.5px;
    height: 20px;
    background: rgba(200,169,110,0.2);
    margin-left: 14px;
}

/* Decorative */
.auth-deco-circle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}

.auth-deco-1 {
    width: 380px; height: 380px;
    top: -100px; right: -120px;
    background: radial-gradient(ellipse, rgba(200,169,110,0.06) 0%, transparent 70%);
    border: 1px solid rgba(200,169,110,0.08);
}

.auth-deco-2 {
    width: 220px; height: 220px;
    bottom: -50px; left: -50px;
    background: radial-gradient(ellipse, rgba(42,82,152,0.12) 0%, transparent 70%);
    border: 1px solid rgba(42,82,152,0.12);
}

.auth-deco-dots {
    position: absolute;
    bottom: 48px; right: 48px;
    width: 70px; height: 70px;
    background-image: radial-gradient(rgba(200,169,110,0.2) 1px, transparent 1px);
    background-size: 12px 12px;
    pointer-events: none;
}

/* ===== RIGHT PANEL ===== */
.auth-right {
    flex: 1;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    background: #F8FAFC;
    padding: 40px 32px;
    overflow-y: auto;
}

.auth-form-wrap {
    width: 100%;
    max-width: 520px;
    padding: 8px 0;
}

.auth-form-header { margin-bottom: 28px; }

.auth-form-title {
    font-size: 24px;
    font-weight: 800;
    color: #0F172A;
    letter-spacing: -0.03em;
    margin: 0 0 6px;
}

.auth-form-subtitle {
    font-size: 13.5px;
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
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 20px;
}

.auth-alert i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }
.auth-alert-danger  { background: #FEF2F2; border: 1px solid rgba(185,28,28,0.2); color: #B91C1C; }
.auth-alert-success { background: #EDFAF4; border: 1px solid rgba(15,123,85,0.2); color: #0F7B55; }

/* Form */
.auth-form { display: flex; flex-direction: column; gap: 0; margin-bottom: 20px; }

/* Form Section */
.form-section {
    background: #FFFFFF;
    border: 1.5px solid #E2E8F0;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin-bottom: 14px;
}

.form-section-label {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #64748B;
    display: flex;
    align-items: center;
    gap: 6px;
    padding-bottom: 12px;
    border-bottom: 1px solid #F1F5F9;
}

.form-row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

/* Fields */
.auth-field { display: flex; flex-direction: column; gap: 5px; }

.auth-label {
    font-size: 12px;
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
    left: 11px;
    color: #94A3B8;
    font-size: 14px;
    pointer-events: none;
    z-index: 1;
}

.auth-input {
    width: 100%;
    padding: 9px 36px 9px 36px;
    background: #F8FAFC;
    border: 1.5px solid #E2E8F0;
    border-radius: 8px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    color: #1E293B;
    transition: all 0.2s ease;
    outline: none;
    appearance: none;
}

.auth-input:focus {
    border-color: #2A5298;
    box-shadow: 0 0 0 3px rgba(42,82,152,0.1);
    background: #FFFFFF;
}

.auth-input::placeholder { color: #CBD5E1; }
.auth-input.is-invalid { border-color: #B91C1C; }

.auth-select { padding-left: 36px; cursor: pointer; }

.auth-textarea {
    padding: 9px 13px;
    resize: none;
    min-height: 64px;
}

.auth-toggle-pass {
    position: absolute;
    right: 10px;
    background: none;
    border: none;
    color: #94A3B8;
    cursor: pointer;
    padding: 4px;
    font-size: 14px;
    display: flex;
    align-items: center;
    transition: color 0.2s;
}

.auth-toggle-pass:hover { color: #475569; }

/* Submit */
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
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 16px rgba(30,58,95,0.3);
    margin-top: 4px;
}

.auth-btn-submit:hover {
    background: linear-gradient(135deg, #1E3A5F, #152a47);
    box-shadow: 0 6px 20px rgba(30,58,95,0.4);
    transform: translateY(-1px);
}

/* Footer */
.auth-footer {
    text-align: center;
    padding-top: 16px;
    border-top: 1px solid #E2E8F0;
}

.auth-footer p {
    font-size: 13px;
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

.auth-link:hover { color: #1E3A5F; text-decoration: underline; }

/* Responsive */
@media (max-width: 900px) {
    .auth-left { width: 42%; }
    .auth-hero-title { font-size: 26px; }
}

@media (max-width: 768px) {
    .auth-container { flex-direction: column; }
    .auth-left { width: 100%; padding: 28px 24px; }
    .auth-left-inner { padding: 0; }
    .auth-brand { margin-bottom: 20px; }
    .auth-hero { margin-bottom: 20px; }
    .auth-hero-title { font-size: 24px; }
    .auth-deco-1, .auth-deco-2, .auth-deco-dots { display: none; }
    .auth-right { padding: 28px 20px; align-items: flex-start; }
    .form-row-2 { grid-template-columns: 1fr; }
}
</style>

@push('scripts')
<script>
// Prevent back/forward navigation
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
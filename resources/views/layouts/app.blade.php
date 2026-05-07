<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tracer Study System')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* ============================================================
           CSS VARIABLES & BASE
        ============================================================ */
        :root {
            --sidebar-width: 260px;

            /* Brand Colors */
            --primary:        #1E3A5F;
            --primary-light:  #2A5298;
            --primary-glow:   rgba(30, 58, 95, 0.12);
            --accent:         #C8A96E;
            --accent-light:   #E8C98A;
            --accent-glow:    rgba(200, 169, 110, 0.2);

            /* Status Colors */
            --success:        #0F7B55;
            --success-bg:     #EDFAF4;
            --info:           #0369A1;
            --info-bg:        #EFF6FF;
            --warning:        #B45309;
            --warning-bg:     #FFFBEB;
            --danger:         #B91C1C;
            --danger-bg:      #FEF2F2;

            /* Neutrals */
            --gray-50:        #F8FAFC;
            --gray-100:       #F1F5F9;
            --gray-200:       #E2E8F0;
            --gray-300:       #CBD5E1;
            --gray-400:       #94A3B8;
            --gray-500:       #64748B;
            --gray-600:       #475569;
            --gray-700:       #334155;
            --gray-800:       #1E293B;
            --gray-900:       #0F172A;

            /* Sidebar */
            --sidebar-bg:         #0F172A;
            --sidebar-border:     rgba(255,255,255,0.06);
            --sidebar-text:       #94A3B8;
            --sidebar-text-hover: #F1F5F9;
            --sidebar-active-bg:  rgba(200, 169, 110, 0.12);
            --sidebar-active-text:#C8A96E;

            /* Surfaces */
            --surface:        #FFFFFF;
            --surface-hover:  #F8FAFC;
            --bg-main:        #F1F5F9;

            /* Shadows */
            --shadow-xs:  0 1px 2px rgba(15,23,42,0.04);
            --shadow-sm:  0 2px 8px rgba(15,23,42,0.06), 0 1px 2px rgba(15,23,42,0.04);
            --shadow-md:  0 4px 16px rgba(15,23,42,0.08), 0 2px 4px rgba(15,23,42,0.04);
            --shadow-lg:  0 8px 32px rgba(15,23,42,0.10), 0 4px 8px rgba(15,23,42,0.06);

            /* Radius */
            --radius-sm:  6px;
            --radius-md:  10px;
            --radius-lg:  16px;
            --radius-xl:  20px;

            /* Transitions */
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: var(--gray-800);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ============================================================
           SIDEBAR
        ============================================================ */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Decorative top accent line */
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), var(--primary-light), transparent);
        }

        /* Subtle background texture */
        .sidebar::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(ellipse at 80% 0%, rgba(200,169,110,0.06) 0%, transparent 60%),
                radial-gradient(ellipse at 20% 100%, rgba(42,82,152,0.08) 0%, transparent 60%);
            pointer-events: none;
        }

        .sidebar-inner {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 0;
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--sidebar-border);
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--primary);
            flex-shrink: 0;
            box-shadow: 0 2px 8px var(--accent-glow);
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .sidebar-brand-title {
            font-size: 14px;
            font-weight: 700;
            color: #F1F5F9;
            letter-spacing: 0.01em;
        }

        .sidebar-brand-subtitle {
            font-size: 10px;
            font-weight: 500;
            color: var(--sidebar-text);
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        /* Nav Section */
        .sidebar-section {
            padding: 20px 12px 8px;
            flex: 1;
        }

        .sidebar-section-label {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(148,163,184,0.5);
            padding: 0 8px;
            margin-bottom: 6px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0 0 8px;
        }

        .sidebar-nav li { margin-bottom: 2px; }

        .sidebar-nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--sidebar-text);
            font-size: 13.5px;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .sidebar-nav-link:hover {
            color: var(--sidebar-text-hover);
            background-color: rgba(255,255,255,0.05);
        }

        .sidebar-nav-link.active {
            color: var(--sidebar-active-text);
            background-color: var(--sidebar-active-bg);
            font-weight: 600;
        }

        .sidebar-nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 2.5px;
            background: var(--accent);
            border-radius: 0 2px 2px 0;
        }

        .sidebar-nav-icon {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
            font-size: 15px;
            flex-shrink: 0;
            transition: var(--transition);
            background-color: rgba(255,255,255,0.04);
        }

        .sidebar-nav-link.active .sidebar-nav-icon {
            background-color: rgba(200,169,110,0.15);
        }

        /* User Profile Footer */
        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid var(--sidebar-border);
            position: relative;
            z-index: 1;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 10px 8px;
            border-radius: var(--radius-md);
            margin-bottom: 8px;
        }

        .sidebar-avatar {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .sidebar-user-info { flex: 1; min-width: 0; }

        .sidebar-user-name {
            font-size: 12.5px;
            font-weight: 600;
            color: #E2E8F0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3;
        }

        .sidebar-user-role {
            font-size: 10px;
            color: var(--sidebar-text);
            font-weight: 500;
            letter-spacing: 0.04em;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 8px 12px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: var(--radius-md);
            color: var(--sidebar-text);
            font-size: 12.5px;
            font-weight: 500;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-logout:hover {
            background: rgba(185, 28, 28, 0.15);
            border-color: rgba(185,28,28,0.3);
            color: #FCA5A5;
        }

        /* ============================================================
           MAIN CONTENT
        ============================================================ */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .top-navbar {
            background: var(--surface);
            border-bottom: 1px solid var(--gray-200);
            padding: 0 28px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-xs);
        }

        .top-navbar-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--gray-800);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .top-navbar-title .breadcrumb-sep {
            color: var(--gray-300);
            font-weight: 400;
        }

        .top-navbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-avatar-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px 5px 5px;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: 999px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            color: var(--gray-700);
        }

        .navbar-avatar-btn:hover {
            background: var(--gray-100);
            color: var(--gray-800);
        }

        .navbar-avatar {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 11px;
            font-weight: 700;
        }

        .navbar-user-name {
            font-size: 13px;
            font-weight: 600;
        }

        /* Page Content */
        .page-content {
            padding: 28px;
            flex: 1;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1, .page-header h4 {
            font-size: 22px;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .page-header p {
            color: var(--gray-500);
            margin: 4px 0 0;
            font-size: 14px;
        }

        /* ============================================================
           CARDS
        ============================================================ */
        .card {
            background: var(--surface);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .card:hover { box-shadow: var(--shadow-md); }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--gray-100);
            padding: 16px 20px;
        }

        .card-header h5 {
            font-size: 14px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            letter-spacing: -0.01em;
        }

        .card-body { padding: 20px; }

        /* Stat Cards */
        .stat-card {
            border-radius: var(--radius-lg);
            padding: 20px;
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
            transition: var(--transition);
        }

        .stat-card:hover { transform: translateY(-2px); }

        .stat-card-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-color: var(--primary);
        }

        .stat-card-success {
            background: var(--success-bg);
            border-color: rgba(15,123,85,0.15);
        }

        .stat-card-info {
            background: var(--info-bg);
            border-color: rgba(3,105,161,0.15);
        }

        .stat-card-warning {
            background: var(--warning-bg);
            border-color: rgba(180,83,9,0.15);
        }

        .stat-card-ghost-icon {
            position: absolute;
            right: -10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 72px;
            opacity: 0.08;
            line-height: 1;
        }

        .stat-card-primary .stat-card-ghost-icon { color: white; opacity: 0.15; }

        .stat-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .stat-card-primary .stat-label { color: rgba(255,255,255,0.7); }
        .stat-card-success .stat-label  { color: var(--success); }
        .stat-card-info .stat-label     { color: var(--info); }
        .stat-card-warning .stat-label  { color: var(--warning); }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.03em;
        }

        .stat-card-primary .stat-value  { color: white; }
        .stat-card-success .stat-value  { color: var(--success); }
        .stat-card-info .stat-value     { color: var(--info); }
        .stat-card-warning .stat-value  { color: var(--warning); }

        .stat-sub {
            font-size: 12px;
            margin-top: 4px;
        }

        .stat-card-primary .stat-sub { color: rgba(255,255,255,0.6); }

        /* ============================================================
           TABLE
        ============================================================ */
        .table {
            font-size: 13.5px;
            color: var(--gray-700);
            margin: 0;
        }

        .table thead th {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--gray-400);
            border-bottom: 1px solid var(--gray-100);
            padding: 10px 16px;
            background: var(--gray-50);
        }

        .table thead th:first-child { border-radius: var(--radius-sm) 0 0 0; }
        .table thead th:last-child  { border-radius: 0 var(--radius-sm) 0 0; }

        .table tbody td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }

        .table tbody tr:last-child td { border-bottom: none; }

        .table tbody tr:hover td { background-color: var(--gray-50); }

        /* ============================================================
           BADGES
        ============================================================ */
        .badge {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.04em;
            padding: 4px 10px;
            border-radius: 999px;
        }

        .badge-working    { background: var(--success-bg);  color: var(--success); }
        .badge-studying   { background: var(--info-bg);     color: var(--info); }
        .badge-entrepreneur{ background: var(--warning-bg); color: var(--warning); }
        .badge-unemployed { background: var(--danger-bg);   color: var(--danger); }
        .badge-empty      { background: var(--gray-100);    color: var(--gray-500); }

        /* ============================================================
           BUTTONS
        ============================================================ */
        .btn {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 13px;
            border-radius: var(--radius-md);
            padding: 8px 16px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
            line-height: 1.4;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
            box-shadow: 0 2px 8px rgba(30,58,95,0.25);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary), #152a47);
            color: white;
            box-shadow: 0 4px 12px rgba(30,58,95,0.35);
            transform: translateY(-1px);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: var(--primary);
            box-shadow: 0 2px 8px var(--accent-glow);
        }

        .btn-accent:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px var(--accent-glow);
            color: var(--primary);
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--gray-200);
            color: var(--gray-600);
        }

        .btn-outline:hover {
            background: var(--gray-50);
            border-color: var(--gray-300);
            color: var(--gray-800);
        }

        .btn-outline-primary {
            background: transparent;
            border: 1.5px solid var(--primary-light);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background: var(--primary-glow);
            color: var(--primary);
        }

        .btn-danger-soft {
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid rgba(185,28,28,0.15);
        }

        .btn-danger-soft:hover {
            background: #FEE2E2;
            color: var(--danger);
        }

        .btn-sm {
            font-size: 12px;
            padding: 5px 10px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
        }

        /* ============================================================
           FORMS
        ============================================================ */
        .form-label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
            letter-spacing: 0.01em;
        }

        .form-control, .form-select {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13.5px;
            color: var(--gray-800);
            background: var(--surface);
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-md);
            padding: 9px 13px;
            transition: var(--transition);
            box-shadow: none;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px var(--primary-glow);
            outline: none;
            background: var(--surface);
            color: var(--gray-800);
        }

        .form-control::placeholder { color: var(--gray-300); }

        .form-control:disabled, .form-control[readonly] {
            background: var(--gray-50);
            color: var(--gray-400);
            cursor: not-allowed;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--danger);
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(185,28,28,0.1);
        }

        .invalid-feedback {
            font-size: 12px;
            color: var(--danger);
            margin-top: 4px;
        }

        .form-text {
            font-size: 11.5px;
            color: var(--gray-400);
            margin-top: 4px;
        }

        /* ============================================================
           ALERTS
        ============================================================ */
        .alert {
            border-radius: var(--radius-md);
            padding: 12px 16px;
            font-size: 13.5px;
            font-weight: 500;
            border: 1px solid transparent;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-success {
            background: var(--success-bg);
            border-color: rgba(15,123,85,0.2);
            color: var(--success);
        }

        .alert-danger {
            background: var(--danger-bg);
            border-color: rgba(185,28,28,0.2);
            color: var(--danger);
        }

        .alert-warning {
            background: var(--warning-bg);
            border-color: rgba(180,83,9,0.2);
            color: var(--warning);
        }

        .btn-close { opacity: 0.5; }
        .btn-close:hover { opacity: 1; }

        /* ============================================================
           DIVIDER
        ============================================================ */
        .divider {
            height: 1px;
            background: var(--gray-100);
            margin: 20px 0;
        }

        /* ============================================================
           SECTION HEADER (for detail pages)
        ============================================================ */
        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .section-header-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            background: var(--primary-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 15px;
        }

        .section-header h5, .section-header h6 {
            font-size: 14px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
        }

        /* ============================================================
           PAGINATION
        ============================================================ */
        .pagination {
            gap: 4px;
        }

        .page-link {
            border-radius: var(--radius-sm) !important;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-600);
            border: 1.5px solid var(--gray-200);
            padding: 6px 12px;
            transition: var(--transition);
        }

        .page-link:hover {
            background: var(--gray-50);
            border-color: var(--gray-300);
            color: var(--gray-800);
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* ============================================================
           SCROLLBAR
        ============================================================ */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb {
            background: var(--gray-200);
            border-radius: 999px;
        }
        ::-webkit-scrollbar-thumb:hover { background: var(--gray-300); }

        /* ============================================================
           UTILITY CLASSES
        ============================================================ */
        .text-muted    { color: var(--gray-400) !important; }
        .text-primary  { color: var(--primary) !important; }
        .text-accent   { color: var(--accent) !important; }
        .text-success  { color: var(--success) !important; }
        .text-warning  { color: var(--warning) !important; }
        .text-danger   { color: var(--danger) !important; }
        .text-info     { color: var(--info) !important; }

        .bg-surface { background: var(--surface) !important; }
        .bg-main    { background: var(--bg-main) !important; }

        .fw-semibold { font-weight: 600; }
        .fw-bold     { font-weight: 700; }
        .fw-extrabold{ font-weight: 800; }

        /* Info Row (for detail pages) */
        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid var(--gray-100);
            font-size: 13.5px;
        }

        .info-row:last-child { border-bottom: none; }

        .info-row-label {
            width: 140px;
            flex-shrink: 0;
            font-weight: 600;
            color: var(--gray-500);
            font-size: 12.5px;
        }

        .info-row-value {
            color: var(--gray-800);
            font-weight: 500;
            flex: 1;
        }

        /* ============================================================
           AUTH PAGES (no sidebar)
        ============================================================ */
        .auth-wrapper {
            min-height: 100vh;
            background: var(--gray-50);
        }
    </style>
    @stack('styles')
</head>
<body>

@auth
    {{-- ======================= SIDEBAR ======================= --}}
    <aside class="sidebar">
        <div class="sidebar-inner">

            {{-- Brand --}}
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('alumni.dashboard') }}" class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <div class="sidebar-brand-text">
                    <span class="sidebar-brand-title">Tracer Study</span>
                    <span class="sidebar-brand-subtitle">SMK Management</span>
                </div>
            </a>

            {{-- Navigation --}}
            <div class="sidebar-section">
                @if(Auth::user()->role === 'admin')
                    <p class="sidebar-section-label">Admin Panel</p>
                    <ul class="sidebar-nav">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <span class="sidebar-nav-icon"><i class="bi bi-speedometer2"></i></span>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.alumni.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.alumni.*') ? 'active' : '' }}">
                                <span class="sidebar-nav-icon"><i class="bi bi-people"></i></span>
                                Kelola Alumni
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.analytics') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                                <span class="sidebar-nav-icon"><i class="bi bi-bar-chart-line"></i></span>
                                Analytics
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.admins.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                                <span class="sidebar-nav-icon"><i class="bi bi-person-gear"></i></span>
                                Kelola Admin
                            </a>
                        </li>
                    </ul>
                @else
                    <p class="sidebar-section-label">Menu Alumni</p>
                    <ul class="sidebar-nav">
                        <li>
                            <a href="{{ route('alumni.dashboard') }}"
                               class="sidebar-nav-link {{ request()->routeIs('alumni.dashboard') ? 'active' : '' }}">
                                <span class="sidebar-nav-icon"><i class="bi bi-house"></i></span>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('alumni.profile') }}"
                               class="sidebar-nav-link {{ request()->routeIs('alumni.profile') ? 'active' : '' }}">
                                <span class="sidebar-nav-icon"><i class="bi bi-person"></i></span>
                                Profil Saya
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tracer.create') }}"
                               class="sidebar-nav-link {{ request()->routeIs('tracer.*') ? 'active' : '' }}">
                                <span class="sidebar-nav-icon"><i class="bi bi-clipboard-data"></i></span>
                                Tracer Study
                            </a>
                        </li>
                    </ul>
                @endif
            </div>

            {{-- Footer User --}}
            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="sidebar-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                        <div class="sidebar-user-role">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Alumni' }}</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        Keluar
                    </button>
                </form>
            </div>

        </div>
    </aside>

    {{-- ======================= MAIN CONTENT ======================= --}}
    <div class="main-content">

        {{-- Top Navbar --}}
        <header class="top-navbar">
            <div class="top-navbar-title">
                @yield('page-title', 'Dashboard')
            </div>
            <div class="top-navbar-actions">
                <div class="navbar-avatar-btn">
                    <div class="navbar-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="navbar-user-name">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        {{-- Page Body --}}
        <main class="page-content">
            @yield('content')
        </main>

    </div>

@else
    {{-- ======================= GUEST / AUTH PAGES ======================= --}}
    <div class="auth-wrapper">
        @yield('content')
    </div>
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Auto-dismiss alerts after 4 seconds
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
            setTimeout(function () {
                let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                if (bsAlert) bsAlert.close();
            }, 4000);
        });

        // Set active nav link based on current URL (fallback)
        document.querySelectorAll('.sidebar-nav-link').forEach(function (link) {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });
    });
</script>

@stack('scripts')

@auth
<script>
    // Prevent back button ke halaman login setelah sudah login
    history.pushState(null, null, location.href);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, location.href);
    });
</script>
@endauth
</body>
</html>
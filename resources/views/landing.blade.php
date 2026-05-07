<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Study — SMK</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:       #1E3A5F;
            --primary-light: #2A5298;
            --accent:        #C8A96E;
            --accent-light:  #E8C98A;
            --success:       #0F7B55;
            --gray-50:       #F8FAFC;
            --gray-100:      #F1F5F9;
            --gray-200:      #E2E8F0;
            --gray-400:      #94A3B8;
            --gray-500:      #64748B;
            --gray-600:      #475569;
            --gray-700:      #334155;
            --gray-800:      #1E293B;
            --gray-900:      #0F172A;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--gray-800);
            background: #fff;
            -webkit-font-smoothing: antialiased;
        }

        /* ============================================================
           NAVBAR
        ============================================================ */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 9999;
            padding: 0 5%;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .navbar * { pointer-events: auto; }

        .navbar.scrolled {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--gray-200);
            box-shadow: 0 2px 16px rgba(15,23,42,0.06);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            color: var(--primary);
        }

        .nav-brand-name {
            font-size: 15px;
            font-weight: 800;
            color: rgba(139, 130, 28, 0.95);
            letter-spacing: -0.01em;
        }

        .nav-brand-sub {
            font-size: 10px;
            color: var(--gray-400);
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--gray-600);
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: var(--primary); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-nav-login {
            padding: 8px 18px;
            border: 1.5px solid rgba(255,255,255,0.35);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-nav-login:hover {
            border-color: rgba(255,255,255,0.7);
            color: #ffffff;
            background: rgba(255,255,255,0.08);
        }

        /* Setelah scroll — navbar jadi putih, warna tombol gelap */
        .navbar.scrolled .btn-nav-login {
            border-color: var(--gray-200);
            color: var(--gray-700);
        }

        .navbar.scrolled .btn-nav-login:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: transparent;
        }

        .btn-nav-register {
            padding: 8px 18px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(30,58,95,0.25);
        }

        .btn-nav-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(30,58,95,0.35);
            color: white;
        }

        /* ============================================================
           HERO SECTION
        ============================================================ */
        .hero {
            min-height: 100vh;
            background: linear-gradient(160deg, #0F172A 0%, #1E3A5F 50%, #2A5298 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 120px 5% 80px;
        }

        /* Background decorations — semua non-interactive */
        .hero-bg-circle,
        .hero-grid,
        .hero-bg-dots,
        .hero-bg-dots-2 {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .hero-grid { border-radius: 0; }

        .hero-bg-c1 {
            width: 600px; height: 600px;
            top: -150px; right: -100px;
            background: radial-gradient(ellipse, rgba(200,169,110,0.08) 0%, transparent 70%);
            border: 1px solid rgba(200,169,110,0.07);
            z-index: 0;
        }

        .hero-bg-c2 {
            width: 400px; height: 400px;
            bottom: -100px; left: -80px;
            background: radial-gradient(ellipse, rgba(42,82,152,0.2) 0%, transparent 70%);
            z-index: 0;
        }

        .hero-bg-c3 {
            width: 200px; height: 200px;
            top: 30%; right: 20%;
            background: radial-gradient(ellipse, rgba(200,169,110,0.06) 0%, transparent 70%);
            border: 1px solid rgba(200,169,110,0.06);
            z-index: 0;
        }

        .hero-bg-dots {
            position: absolute;
            top: 80px; right: 5%;
            width: 120px; height: 120px;
            background-image: radial-gradient(rgba(200,169,110,0.15) 1.5px, transparent 1.5px);
            background-size: 14px 14px;
            pointer-events: none;
            z-index: 0;
        }

        .hero-bg-dots-2 {
            position: absolute;
            bottom: 60px; left: 5%;
            width: 80px; height: 80px;
            background-image: radial-gradient(rgba(255,255,255,0.07) 1.5px, transparent 1.5px);
            background-size: 12px 12px;
            pointer-events: none;
            z-index: 0;
        }

        /* Grid line decoration */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 10;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 60px;
        }

        /* Left: text */
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 13px;
            background: rgba(200,169,110,0.12);
            border: 1px solid rgba(200,169,110,0.25);
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--accent);
            letter-spacing: 0.07em;
            text-transform: uppercase;
            margin-bottom: 22px;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 800;
            color: #F1F5F9;
            line-height: 1.1;
            letter-spacing: -0.04em;
            margin-bottom: 20px;
        }

        .hero-title-accent {
            color: var(--accent);
            position: relative;
        }

        .hero-title-accent::after {
            content: '';
            position: absolute;
            bottom: 4px; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), transparent);
            border-radius: 2px;
            opacity: 0.5;
        }

        .hero-desc {
            font-size: 16px;
            color: rgba(148,163,184,0.9);
            line-height: 1.75;
            margin-bottom: 36px;
            max-width: 460px;
            font-weight: 400;
        }

        .hero-cta {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: var(--primary);
            border: none;
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14.5px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 20px rgba(200,169,110,0.35);
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(200,169,110,0.45);
            color: var(--primary);
        }

        .btn-hero-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 24px;
            background: rgba(255,255,255,0.07);
            color: rgba(241,245,249,0.9);
            border: 1.5px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-hero-secondary:hover {
            background: rgba(255,255,255,0.12);
            border-color: rgba(255,255,255,0.25);
            color: white;
        }

        /* Right: stats card */
        .hero-card-wrap {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .hero-stat-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            padding: 20px 24px;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s;
        }

        .hero-stat-card:hover {
            background: rgba(255,255,255,0.09);
            border-color: rgba(200,169,110,0.2);
            transform: translateX(4px);
        }

        .hero-stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .hero-stat-body { flex: 1; }

        .hero-stat-num {
            font-size: 26px;
            font-weight: 800;
            color: #F1F5F9;
            letter-spacing: -0.03em;
            line-height: 1;
        }

        .hero-stat-label {
            font-size: 12.5px;
            color: rgba(148,163,184,0.8);
            font-weight: 500;
            margin-top: 3px;
        }

        .hero-stat-badge {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        /* ============================================================
           STATS BAR
        ============================================================ */
        .stats-bar {
            background: var(--primary);
            padding: 28px 5%;
        }

        .stats-bar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stats-bar-item {
            text-align: center;
            padding: 12px;
            border-right: 1px solid rgba(255,255,255,0.1);
        }

        .stats-bar-item:last-child { border-right: none; }

        .stats-bar-num {
            font-size: 32px;
            font-weight: 800;
            color: var(--accent);
            letter-spacing: -0.04em;
            line-height: 1;
        }

        .stats-bar-label {
            font-size: 12.5px;
            color: rgba(148,163,184,0.8);
            font-weight: 600;
            margin-top: 5px;
            letter-spacing: 0.02em;
        }

        /* ============================================================
           ABOUT SECTION
        ============================================================ */
        .section {
            padding: 90px 5%;
        }

        .section-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 13px;
            background: rgba(30,58,95,0.07);
            border: 1px solid rgba(30,58,95,0.12);
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 800;
            color: var(--gray-900);
            letter-spacing: -0.03em;
            line-height: 1.2;
            margin-bottom: 14px;
        }

        .section-title span { color: var(--primary-light); }

        .section-desc {
            font-size: 15.5px;
            color: var(--gray-500);
            line-height: 1.75;
            max-width: 560px;
            font-weight: 400;
        }

        /* About grid */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-feature-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-top: 36px;
        }

        .about-feature {
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }

        .about-feature-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            background: rgba(30,58,95,0.07);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--primary);
            flex-shrink: 0;
        }

        .about-feature-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 3px;
        }

        .about-feature-desc {
            font-size: 13.5px;
            color: var(--gray-500);
            line-height: 1.6;
        }

        /* Right visual */
        .about-visual {
            position: relative;
        }

        .about-card-main {
            background: white;
            border: 1.5px solid var(--gray-200);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 8px 40px rgba(15,23,42,0.08);
        }

        .about-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .about-card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--gray-800);
        }

        .about-card-badge {
            font-size: 11px;
            font-weight: 700;
            color: var(--success);
            background: #EDFAF4;
            padding: 3px 10px;
            border-radius: 999px;
        }

        .about-progress-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .about-progress-item {}

        .about-progress-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .about-progress-label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--gray-700);
        }

        .about-progress-pct {
            font-size: 12px;
            font-weight: 700;
            color: var(--gray-500);
        }

        .about-progress-bar {
            height: 7px;
            background: var(--gray-100);
            border-radius: 999px;
            overflow: hidden;
        }

        .about-progress-fill {
            height: 100%;
            border-radius: 999px;
            transition: width 1s ease;
        }

        .about-float-card {
            position: absolute;
            background: white;
            border: 1.5px solid var(--gray-200);
            border-radius: 14px;
            padding: 14px 18px;
            box-shadow: 0 8px 32px rgba(15,23,42,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .about-float-card-1 {
            bottom: -20px;
            left: -24px;
        }

        .about-float-card-2 {
            top: -20px;
            right: -24px;
        }

        .float-icon {
            width: 36px; height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .float-val {
            font-size: 16px;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1;
        }

        .float-label {
            font-size: 11px;
            color: var(--gray-400);
            font-weight: 500;
        }

        /* ============================================================
           HOW IT WORKS
        ============================================================ */
        .how-section {
            background: var(--gray-50);
            padding: 90px 5%;
        }

        .how-header {
            text-align: center;
            margin-bottom: 56px;
        }

        .how-header .section-desc {
            margin: 0 auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        /* Connector line between steps */
        .steps-grid::before {
            content: '';
            position: absolute;
            top: 36px;
            left: calc(16.66% + 20px);
            right: calc(16.66% + 20px);
            height: 2px;
            background: linear-gradient(90deg, var(--gray-200), var(--accent), var(--gray-200));
            z-index: 0;
        }

        .step-card {
            background: white;
            border: 1.5px solid var(--gray-200);
            border-radius: 18px;
            padding: 28px 24px;
            text-align: center;
            position: relative;
            z-index: 1;
            transition: all 0.3s;
        }

        .step-card:hover {
            border-color: rgba(30,58,95,0.2);
            box-shadow: 0 8px 32px rgba(15,23,42,0.07);
            transform: translateY(-4px);
        }

        .step-num-wrap {
            width: 52px; height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
            font-size: 20px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 4px 16px rgba(30,58,95,0.3);
        }

        .step-icon {
            font-size: 32px;
            margin-bottom: 14px;
            display: block;
        }

        .step-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 10px;
            letter-spacing: -0.02em;
        }

        .step-desc {
            font-size: 13.5px;
            color: var(--gray-500);
            line-height: 1.7;
        }

        /* ============================================================
           CTA SECTION
        ============================================================ */
        .cta-section {
            padding: 90px 5%;
            background: white;
        }

        .cta-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .cta-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 60%, #3B6CC7 100%);
            border-radius: 24px;
            padding: 56px 64px;
            position: relative;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 40px;
        }

        .cta-card::before {
            content: '';
            position: absolute;
            right: -60px; top: -60px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
        }

        .cta-card::after {
            content: '';
            position: absolute;
            left: -40px; bottom: -40px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(200,169,110,0.08);
        }

        .cta-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 13px;
            background: rgba(200,169,110,0.15);
            border: 1px solid rgba(200,169,110,0.25);
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            color: var(--accent);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .cta-title {
            font-size: 34px;
            font-weight: 800;
            color: white;
            letter-spacing: -0.03em;
            line-height: 1.2;
            margin-bottom: 12px;
        }

        .cta-desc {
            font-size: 15px;
            color: rgba(148,163,184,0.9);
            line-height: 1.6;
        }

        .cta-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
            position: relative;
            z-index: 1;
            flex-shrink: 0;
        }

        .btn-cta-primary {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 15px 32px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: var(--primary);
            border: none;
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14.5px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 20px rgba(200,169,110,0.4);
            white-space: nowrap;
        }

        .btn-cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(200,169,110,0.5);
            color: var(--primary);
        }

        .btn-cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: rgba(255,255,255,0.08);
            color: rgba(241,245,249,0.9);
            border: 1.5px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-cta-secondary:hover {
            background: rgba(255,255,255,0.12);
            color: white;
        }

        /* ============================================================
           FOOTER
        ============================================================ */
        .footer {
            background: var(--gray-900);
            padding: 48px 5% 28px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 32px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            margin-bottom: 24px;
            gap: 40px;
            flex-wrap: wrap;
        }

        .footer-brand { max-width: 280px; }

        .footer-brand-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .footer-brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            color: var(--primary);
        }

        .footer-brand-name {
            font-size: 15px;
            font-weight: 800;
            color: #F1F5F9;
        }

        .footer-brand-desc {
            font-size: 13px;
            color: rgba(148,163,184,0.7);
            line-height: 1.6;
        }

        .footer-links-title {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(148,163,184,0.5);
            margin-bottom: 14px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
            list-style: none;
        }

        .footer-links a {
            font-size: 13.5px;
            color: rgba(148,163,184,0.75);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .footer-links a:hover { color: #F1F5F9; }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-copy {
            font-size: 12.5px;
            color: rgba(148,163,184,0.5);
        }

        .footer-copy span { color: var(--accent); }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 1024px) {
            .hero-title { font-size: 42px; }
            .cta-card { padding: 40px 40px; }
            .cta-title { font-size: 28px; }
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 20px; }
            .nav-links { display: none; }

            .hero { padding: 100px 20px 60px; }
            .hero-inner { grid-template-columns: 1fr; gap: 40px; }
            .hero-title { font-size: 34px; }
            .hero-card-wrap { display: grid; grid-template-columns: 1fr 1fr; }

            .stats-bar-inner { grid-template-columns: repeat(2, 1fr); }
            .stats-bar-item { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
            .stats-bar-item:nth-child(2n) { border-bottom: 1px solid rgba(255,255,255,0.08); }

            .section { padding: 60px 20px; }
            .about-grid { grid-template-columns: 1fr; gap: 40px; }
            .about-float-card-1, .about-float-card-2 { display: none; }

            .how-section { padding: 60px 20px; }
            .steps-grid { grid-template-columns: 1fr; }
            .steps-grid::before { display: none; }

            .cta-section { padding: 60px 20px; }
            .cta-card {
                grid-template-columns: 1fr;
                padding: 36px 28px;
                text-align: center;
            }
            .cta-actions { flex-direction: row; flex-wrap: wrap; justify-content: center; }
            .cta-title { font-size: 24px; }

            .footer-top { flex-direction: column; }
        }

        /* ============================================================
           ANIMATIONS
        ============================================================ */
        .fade-up {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-up-delay-1 { transition-delay: 0.1s; }
        .fade-up-delay-2 { transition-delay: 0.2s; }
        .fade-up-delay-3 { transition-delay: 0.3s; }
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar" id="mainNav">
        <a href="{{ route('landing') }}" class="nav-brand">
            <div class="nav-brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div>
                <div class="nav-brand-name">Tracer Study</div>
                <div class="nav-brand-sub">SMK Gadjah Mada</div>
            </div>
        </a>

        <ul class="nav-links">
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#cara-kerja">Cara Kerja</a></li>
            <li><a href="#statistik">Statistik</a></li>
        </ul>

        <div class="nav-actions">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('alumni.dashboard') }}" class="btn-nav-login">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-nav-register" style="border:none; cursor:pointer;">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-nav-login">Masuk</a>
                <a href="{{ route('register') }}" class="btn-nav-register">Daftar Alumni</a>
            @endauth
        </div>
    </nav>

    {{-- ===== HERO ===== --}}
    <section class="hero">
        <div class="hero-grid"></div>
        <div class="hero-bg-circle hero-bg-c1"></div>
        <div class="hero-bg-circle hero-bg-c2"></div>
        <div class="hero-bg-circle hero-bg-c3"></div>
        <div class="hero-bg-dots"></div>
        <div class="hero-bg-dots-2"></div>

        <div class="hero-inner">
            {{-- Left --}}
            <div class="hero-left">
                <div class="hero-eyebrow">
                    <i class="bi bi-patch-check-fill"></i>
                    Platform Resmi Tracer Study SMK Gadjah Mada
                </div>
                <h1 class="hero-title">
                    Lacak Perjalanan<br>
                    Alumni <span class="hero-title-accent">Terbaik</span><br>
                    Kami
                </h1>
                <p class="hero-desc">
                    Sistem tracer study digital yang menghubungkan alumni dengan institusi. Pantau perkembangan karir, pendidikan, dan kontribusi nyata lulusan SMK kami.
                </p>
                <div class="hero-cta">
                    @auth
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('alumni.dashboard') }}" class="btn-hero-primary">
                            <i class="bi bi-speedometer2"></i>
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-hero-primary">
                            <i class="bi bi-person-plus-fill"></i>
                            Daftar Sekarang
                        </a>
                        <a href="#cara-kerja" class="btn-hero-secondary">
                            <i class="bi bi-play-circle"></i>
                            Cara Kerja
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Right: stat cards --}}
            <div class="hero-right">
                <div class="hero-card-wrap">

                    <div class="hero-stat-card">
                        <div class="hero-stat-icon" style="background:rgba(15,123,85,0.15);">
                            <i class="bi bi-briefcase-fill" style="color:#4ADE80;"></i>
                        </div>
                        <div class="hero-stat-body">
                            <div class="hero-stat-num">{{ $workingPct }}%</div>
                            <div class="hero-stat-label">Alumni terserap dunia kerja</div>
                        </div>
                        <span class="hero-stat-badge" style="background:rgba(15,123,85,0.15); color:#4ADE80;">↑ Tinggi</span>
                    </div>

                    <div class="hero-stat-card">
                        <div class="hero-stat-icon" style="background:rgba(200,169,110,0.15);">
                            <i class="bi bi-people-fill" style="color:var(--accent-light);"></i>
                        </div>
                        <div class="hero-stat-body">
                            <div class="hero-stat-num">{{ $totalAlumni }}</div>
                            <div class="hero-stat-label">Alumni terdaftar aktif</div>
                        </div>
                        <span class="hero-stat-badge" style="background:rgba(200,169,110,0.15); color:var(--accent-light);">Aktif</span>
                    </div>

                    <div class="hero-stat-card">
                        <div class="hero-stat-icon" style="background:rgba(42,82,152,0.2);">
                            <i class="bi bi-journal-bookmark-fill" style="color:#93C5FD;"></i>
                        </div>
                        <div class="hero-stat-body">
                            <div class="hero-stat-num">6</div>
                            <div class="hero-stat-label">Program keahlian tersedia</div>
                        </div>
                        <span class="hero-stat-badge" style="background:rgba(42,82,152,0.2); color:#93C5FD;">Jurusan</span>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ===== STATS BAR ===== --}}
    <div class="stats-bar" id="statistik">
        <div class="stats-bar-inner">
            <div class="stats-bar-item">
                <div class="stats-bar-num">{{ $totalAlumni }}</div>
                <div class="stats-bar-label">Alumni Terdaftar</div>
            </div>
            <div class="stats-bar-item">
                <div class="stats-bar-num">{{ $workingPct }}%</div>
                <div class="stats-bar-label">Terserap Kerja</div>
            </div>
            <div class="stats-bar-item">
                <div class="stats-bar-num">6</div>
                <div class="stats-bar-label">Program Keahlian</div>
            </div>
            <div class="stats-bar-item">
                <div class="stats-bar-num">{{ number_format($avgRelevance, 1) }}</div>
                <div class="stats-bar-label">Skor Relevansi Rata-rata</div>
            </div>
        </div>
    </div>

    {{-- ===== ABOUT SECTION ===== --}}
    <section class="section" id="tentang">
        <div class="section-inner">
            <div class="about-grid">
                {{-- Left --}}
                <div>
                    <div class="section-eyebrow fade-up">
                        <i class="bi bi-info-circle-fill"></i> Tentang Program
                    </div>
                    <h2 class="section-title fade-up fade-up-delay-1">
                        Apa itu <span>Tracer Study</span>?
                    </h2>
                    <p class="section-desc fade-up fade-up-delay-2">
                        Tracer Study adalah program pemantauan alumni yang bertujuan untuk mengetahui perkembangan karir dan kehidupan lulusan setelah meninggalkan bangku sekolah.
                    </p>

                    <div class="about-feature-list">
                        <div class="about-feature fade-up fade-up-delay-1">
                            <div class="about-feature-icon">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <div>
                                <div class="about-feature-title">Data Akurat & Real-time</div>
                                <div class="about-feature-desc">Informasi perkembangan alumni selalu diperbarui secara langsung oleh alumni bersangkutan.</div>
                            </div>
                        </div>

                        <div class="about-feature fade-up fade-up-delay-2">
                            <div class="about-feature-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <div class="about-feature-title">Data Aman & Terpercaya</div>
                                <div class="about-feature-desc">Privasi alumni terjaga dengan sistem keamanan berlapis dan akses yang terotorisasi.</div>
                            </div>
                        </div>

                        <div class="about-feature fade-up fade-up-delay-3">
                            <div class="about-feature-icon">
                                <i class="bi bi-bar-chart-line"></i>
                            </div>
                            <div>
                                <div class="about-feature-title">Analitik Mendalam</div>
                                <div class="about-feature-desc">Dashboard admin dengan visualisasi data untuk pengambilan keputusan strategis sekolah.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: visual card --}}
                <div class="about-visual fade-up fade-up-delay-2">
                    <div class="about-card-main">
                        <div class="about-card-header">
                            <div class="about-card-title">Status Alumni 2024</div>
                            <span class="about-card-badge">● Live</span>
                        </div>
                        <div class="about-progress-list">
                            <div class="about-progress-item">
                                <div class="about-progress-meta">
                                    <span class="about-progress-label">Bekerja</span>
                                    <span class="about-progress-pct">{{ $workingPct }}%</span>
                                </div>
                                <div class="about-progress-bar">
                                    <div class="about-progress-fill" style="width:{{ $workingPct }}%; background: #0F7B55;"></div>
                                </div>
                            </div>
                            <div class="about-progress-item">
                                <div class="about-progress-meta">
                                    <span class="about-progress-label">Studi Lanjut</span>
                                    <span class="about-progress-pct">{{ $studyingPct }}%</span>
                                </div>
                                <div class="about-progress-bar">
                                    <div class="about-progress-fill" style="width:{{ $studyingPct }}%; background: #0369A1;"></div>
                                </div>
                            </div>
                            <div class="about-progress-item">
                                <div class="about-progress-meta">
                                    <span class="about-progress-label">Wirausaha</span>
                                    <span class="about-progress-pct">{{ $entrepreneurPct }}%</span>
                                </div>
                                <div class="about-progress-bar">
                                    <div class="about-progress-fill" style="width:{{ $entrepreneurPct }}%; background: #B45309;"></div>
                                </div>
                            </div>
                            <div class="about-progress-item">
                                <div class="about-progress-meta">
                                    <span class="about-progress-label">Belum Bekerja</span>
                                    <span class="about-progress-pct">{{ $unemployedPct }}%</span>
                                </div>
                                <div class="about-progress-bar">
                                    <div class="about-progress-fill" style="width:{{ $unemployedPct }}%; background: #B91C1C;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-float-card about-float-card-1">
                        <div class="float-icon" style="background:#EDFAF4; color:#0F7B55; font-size:18px;">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <div>
                            <div class="float-val">{{ number_format($avgRelevance, 1) }}/5</div>
                            <div class="float-label">Skor Relevansi</div>
                        </div>
                    </div>

                    <div class="about-float-card about-float-card-2">
                        <div class="float-icon" style="background:#EFF6FF; color:#0369A1; font-size:18px;">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div>
                            <div class="float-val">{{ number_format($avgWaiting, 1) }} bln</div>
                            <div class="float-label">Rata-rata tunggu</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== HOW IT WORKS ===== --}}
    <section class="how-section" id="cara-kerja">
        <div class="how-header section-inner">
            <div class="section-eyebrow fade-up" style="margin: 0 auto 16px;">
                <i class="bi bi-list-check"></i> Cara Kerja
            </div>
            <h2 class="section-title fade-up fade-up-delay-1" style="text-align:center;">
                Mulai dalam <span>3 Langkah</span> Mudah
            </h2>
            <p class="section-desc fade-up fade-up-delay-2" style="text-align:center; margin: 0 auto;">
                Proses pendaftaran dan pengisian tracer study dirancang semudah mungkin agar semua alumni bisa berpartisipasi.
            </p>
        </div>

        <div class="steps-grid">
            <div class="step-card fade-up fade-up-delay-1">
                <div class="step-num-wrap">1</div>
                <span class="step-icon">📝</span>
                <div class="step-title">Daftar Akun</div>
                <p class="step-desc">Buat akun alumni dengan mengisi nama, NISN, email, dan data kelulusan kamu. Proses cepat, hanya butuh beberapa menit.</p>
            </div>

            <div class="step-card fade-up fade-up-delay-2">
                <div class="step-num-wrap">2</div>
                <span class="step-icon">👤</span>
                <div class="step-title">Lengkapi Profil</div>
                <p class="step-desc">Isi informasi profil alumni seperti jurusan, tahun lulus, nomor telepon, dan alamat agar datamu lengkap dan valid.</p>
            </div>

            <div class="step-card fade-up fade-up-delay-3">
                <div class="step-num-wrap">3</div>
                <span class="step-icon">🎯</span>
                <div class="step-title">Isi Tracer Study</div>
                <p class="step-desc">Ceritakan perjalananmu setelah lulus — bekerja, kuliah, atau berwirausaha. Data kamu membantu sekolah berkembang lebih baik.</p>
            </div>
        </div>
    </section>

    {{-- ===== CTA SECTION ===== --}}
    <section class="cta-section">
        <div class="cta-inner">
            <div class="cta-card">
                <div style="position:relative; z-index:1;">
                    <div class="cta-eyebrow">
                        <i class="bi bi-rocket-takeoff-fill"></i> Bergabung Sekarang
                    </div>
                    <h2 class="cta-title">Siap Berbagi<br>Perjalananmu?</h2>
                    <p class="cta-desc">
                        Bantu sekolah memahami kebutuhan industri dan dunia nyata. Partisipasi kamu sangat berarti untuk generasi alumni berikutnya.
                    </p>
                </div>
                <div class="cta-actions">
                    @auth
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('alumni.dashboard') }}" class="btn-cta-primary">
                            <i class="bi bi-speedometer2"></i>
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-cta-primary">
                            <i class="bi bi-person-plus-fill"></i>
                            Daftar Alumni
                        </a>
                        <a href="{{ route('login') }}" class="btn-cta-secondary">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Sudah punya akun
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand">
                    <div class="footer-brand-row">
                        <div class="footer-brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="footer-brand-name">Tracer Study SMK</div>
                    </div>
                    <p class="footer-brand-desc">
                        Platform resmi pemantauan alumni SMK. Membangun data yang akurat untuk masa depan pendidikan yang lebih baik.
                    </p>
                </div>

                <div>
                    <div class="footer-links-title">Navigasi</div>
                    <ul class="footer-links">
                        <li><a href="#tentang">Tentang Program</a></li>
                        <li><a href="#cara-kerja">Cara Kerja</a></li>
                        <li><a href="#statistik">Statistik</a></li>
                    </ul>
                </div>

                <div>
                    <div class="footer-links-title">Akun</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('login') }}">Login Alumni</a></li>
                        <li><a href="{{ route('register') }}">Daftar Alumni</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-copy">© {{ date('Y') }} Tracer Study SMK. Dibuat dengan <span>♥</span> untuk alumni.</p>
                <p class="footer-copy">Sistem Informasi Tracer Study</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 40);
        });

        // Fade-up on scroll (Intersection Observer)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    </script>
</body>
</html>
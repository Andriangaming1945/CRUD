@php
    $namaUser = auth()->user()->name ?? 'Administrator';
    $inisialUser = mb_strtoupper(mb_substr($namaUser, 0, 1));

    $stats = $stats ?? [
        'total' => 128,
        'aktif' => 112,
        'nonaktif' => 16,
        'login_hari_ini' => 34,
    ];

    $pertumbuhan = $pertumbuhan ?? [
        'labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        'data' => [96, 101, 104, 109, 115, 121, 128],
    ];

    $tipeAkun = $tipeAkun ?? [
        ['nama' => 'Admin', 'jumlah' => 6],
        ['nama' => 'Operator', 'jumlah' => 24],
        ['nama' => 'Pengguna', 'jumlah' => 98],
    ];

    $akunTerbaru = $akunTerbaru ?? [
        ['nama' => 'Rizky Pratama', 'email' => 'rizky.pratama@mail.com', 'tipe' => 'Operator', 'status' => 'aktif', 'dibuat' => '04 Okt 2026'],
        ['nama' => 'Salsabila Nur', 'email' => 'salsabila.nur@mail.com', 'tipe' => 'Pengguna', 'status' => 'aktif', 'dibuat' => '03 Okt 2026'],
        ['nama' => 'Dimas Aryo', 'email' => 'dimas.aryo@mail.com', 'tipe' => 'Pengguna', 'status' => 'nonaktif', 'dibuat' => '02 Okt 2026'],
        ['nama' => 'Fitri Handayani', 'email' => 'fitri.h@mail.com', 'tipe' => 'Admin', 'status' => 'aktif', 'dibuat' => '30 Sep 2026'],
        ['nama' => 'Bagas Wicaksono', 'email' => 'bagas.w@mail.com', 'tipe' => 'Pengguna', 'status' => 'aktif', 'dibuat' => '29 Sep 2026'],
        ['nama' => 'Ayu Lestari', 'email' => 'ayu.lestari@mail.com', 'tipe' => 'Operator', 'status' => 'nonaktif', 'dibuat' => '27 Sep 2026'],
    ];

    $aktivitas = $aktivitas ?? [
        ['teks' => 'Akun Rizky Pratama dibuat', 'waktu' => '10 menit lalu', 'warna' => 'blue'],
        ['teks' => 'Tipe akun Dimas Aryo diubah', 'waktu' => '1 jam lalu', 'warna' => 'violet'],
        ['teks' => 'Akun Ayu Lestari dinonaktifkan', 'waktu' => '3 jam lalu', 'warna' => 'amber'],
        ['teks' => 'Password Salsabila Nur direset', 'waktu' => 'Kemarin', 'warna' => 'blue'],
        ['teks' => 'Akun Bagas Wicaksono diaktifkan', 'waktu' => 'Kemarin', 'warna' => 'green'],
    ];

    $palet = ['#3D5AFE', '#6C4DFF', '#FFB547', '#22B07D'];
    $totalTipe = max(array_sum(array_column($tipeAkun, 'jumlah')), 1);
    $kum = 0;
    $total = max($stats['total'], 1);
    $persenAktif = round($stats['aktif'] / $total * 100);
    $persenNonaktif = round($stats['nonaktif'] / $total * 100);
    $persenLogin = round($stats['login_hari_ini'] / max($stats['aktif'], 1) * 100);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Manajemen Akun</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --ink: #12183F;
            --ink-2: #1C2457;
            --bg: #F1F2FA;
            --blue: #3D5AFE;
            --blue-dark: #2A41D1;
            --violet: #6C4DFF;
            --amber: #FFB547;
            --green: #22B07D;
            --text: #161A3F;
            --muted: #737797;
            --line: #E3E5F2;
            --danger: #D8344C;
            --side: 16rem;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--side);
            z-index: 1040;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
            background: var(--ink);
            color: #fff;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .sidebar.open {
            transform: none;
        }

        .scrim {
            position: fixed;
            inset: 0;
            z-index: 1030;
            background: rgba(10, 14, 50, 0.5);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .scrim.open {
            opacity: 1;
            pointer-events: auto;
        }

        .side-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0 0.6rem;
            margin-bottom: 2rem;
            font-weight: 800;
            font-size: 1.05rem;
            letter-spacing: -0.01em;
        }

        .side-logo {
            width: 2.4rem;
            height: 2.4rem;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--blue), var(--violet));
        }

        .side-logo svg {
            width: 1.2rem;
            height: 1.2rem;
        }

        .nav-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .nav-link-x {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.72rem 0.9rem;
            border-radius: 12px;
            color: rgba(214, 220, 255, 0.72);
            font-size: 0.92rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .nav-link-x svg {
            width: 1.2rem;
            height: 1.2rem;
            flex-shrink: 0;
        }

        .nav-link-x:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #fff;
        }

        .nav-link-x.active {
            background: linear-gradient(90deg, rgba(61, 90, 254, 0.95), rgba(108, 77, 255, 0.85));
            color: #fff;
            box-shadow: 0 10px 22px rgba(61, 90, 254, 0.35);
        }

        .side-foot {
            margin-top: auto;
            padding: 0.9rem;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.06);
            font-size: 0.82rem;
            color: rgba(214, 220, 255, 0.72);
            line-height: 1.5;
        }

        .side-foot b {
            display: block;
            color: #fff;
            font-size: 0.88rem;
            margin-bottom: 0.15rem;
        }

        .side-logout-form {
            margin-top: 0.75rem;
        }

        .side-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.75rem 0.9rem;
            border: 1.5px solid rgba(255, 120, 140, 0.35);
            border-radius: 12px;
            background: rgba(216, 52, 76, 0.12);
            color: #FF8FA0;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 700;
            transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        }

        .side-logout svg {
            width: 1.1rem;
            height: 1.1rem;
            transition: transform 0.3s ease;
        }

        .side-logout:hover {
            background: var(--danger);
            border-color: var(--danger);
            color: #fff;
        }

        .side-logout:hover svg {
            transform: translateX(3px);
        }

        .side-logout:active {
            transform: scale(0.98);
        }

        .side-logout:focus-visible {
            outline: 3px solid rgba(255, 143, 160, 0.6);
            outline-offset: 2px;
        }

        .main {
            min-height: 100vh;
            padding: 1.25rem 1.25rem 2.5rem;
        }

        @media (min-width: 992px) {
            .sidebar {
                transform: none;
            }

            .scrim {
                display: none;
            }

            .main {
                margin-left: var(--side);
                padding: 1.75rem 2.25rem 3rem;
            }

            .menu-btn {
                display: none !important;
            }
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            min-width: 0;
        }

        .menu-btn {
            width: 2.6rem;
            height: 2.6rem;
            display: grid;
            place-items: center;
            border: 1.5px solid var(--line);
            border-radius: 12px;
            background: #fff;
            color: var(--text);
        }

        .menu-btn svg {
            width: 1.2rem;
            height: 1.2rem;
        }

        .page-title {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.15;
        }

        .page-sub {
            margin: 0.2rem 0 0;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.35rem 0.8rem 0.35rem 0.4rem;
            border: 1.5px solid var(--line);
            border-radius: 999px;
            background: #fff;
            color: var(--text);
            font-weight: 600;
            font-size: 0.88rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .user-btn:hover,
        .user-btn.show {
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(61, 90, 254, 0.1);
        }

        .avatar {
            width: 2.1rem;
            height: 2.1rem;
            border-radius: 50%;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            font-weight: 700;
            font-size: 0.85rem;
            color: #fff;
            background: linear-gradient(135deg, var(--blue), var(--violet));
        }

        .dropdown-menu {
            border: 1.5px solid var(--line);
            border-radius: 14px;
            padding: 0.4rem;
            min-width: 11rem;
            box-shadow: 0 20px 40px rgba(30, 38, 120, 0.14);
            font-size: 0.9rem;
        }

        .dropdown-item {
            border-radius: 9px;
            padding: 0.55rem 0.8rem;
            font-weight: 500;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            width: 100%;
            border: 0;
            background: transparent;
            color: var(--danger);
            font-weight: 600;
        }

        .logout-btn:hover {
            background: rgba(216, 52, 76, 0.08);
            color: var(--danger);
        }

        .logout-btn svg {
            width: 1.05rem;
            height: 1.05rem;
        }

        .panel {
            height: 100%;
            padding: 1.4rem;
            border: 1.5px solid var(--line);
            border-radius: 20px;
            background: #fff;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.1rem;
        }

        .panel-title {
            margin: 0;
            font-size: 1.02rem;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .panel-note {
            margin: 0.15rem 0 0;
            font-size: 0.82rem;
            color: var(--muted);
        }

        .btn-main {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.62rem 1.05rem;
            border: 0;
            border-radius: 12px;
            color: #fff;
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            background-image: linear-gradient(90deg, var(--blue-dark) 50%, var(--blue) 50%);
            background-size: 200% 100%;
            background-position: right center;
            box-shadow: 0 10px 20px rgba(61, 90, 254, 0.28);
            transition: background-position 0.45s cubic-bezier(0.2, 0.7, 0.2, 1), transform 0.2s ease;
        }

        .btn-main:hover {
            color: #fff;
            background-position: left center;
            transform: translateY(-2px);
        }

        .btn-main svg {
            width: 1rem;
            height: 1rem;
        }

        .stat {
            position: relative;
            height: 100%;
            padding: 1.25rem 1.3rem;
            border: 1.5px solid var(--line);
            border-radius: 20px;
            background: #fff;
            overflow: hidden;
        }

        .stat.hero {
            border: 0;
            color: #fff;
            background: linear-gradient(140deg, var(--blue) 0%, var(--violet) 100%);
            box-shadow: 0 18px 36px rgba(61, 90, 254, 0.32);
        }

        .stat.hero::after {
            content: '';
            position: absolute;
            right: -2.5rem;
            top: -2.5rem;
            width: 9rem;
            height: 9rem;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.86rem;
            font-weight: 600;
            color: var(--muted);
        }

        .stat.hero .stat-top {
            color: rgba(236, 239, 255, 0.85);
        }

        .stat-ico {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 11px;
            display: grid;
            place-items: center;
            background: rgba(61, 90, 254, 0.1);
            color: var(--blue);
        }

        .stat-ico.green {
            background: rgba(34, 176, 125, 0.12);
            color: var(--green);
        }

        .stat-ico.red {
            background: rgba(216, 52, 76, 0.1);
            color: var(--danger);
        }

        .stat-ico.amber {
            background: rgba(255, 181, 71, 0.2);
            color: #B97800;
        }

        .stat.hero .stat-ico {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .stat-ico svg {
            width: 1.1rem;
            height: 1.1rem;
        }

        .stat-num {
            font-size: 2.1rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1;
        }

        .stat-foot {
            margin-top: 0.9rem;
            font-size: 0.8rem;
            color: var(--muted);
        }

        .stat.hero .stat-foot {
            color: rgba(236, 239, 255, 0.85);
        }

        .meter {
            height: 0.4rem;
            margin-top: 0.9rem;
            border-radius: 999px;
            background: #ECEEF9;
            overflow: hidden;
        }

        .meter i {
            display: block;
            height: 100%;
            width: var(--w);
            border-radius: inherit;
            background: var(--c, var(--blue));
            transform-origin: left;
            animation: fill 1s 0.35s cubic-bezier(0.2, 0.8, 0.2, 1) both;
        }

        @keyframes fill {
            from { transform: scaleX(0); }
            to { transform: scaleX(1); }
        }

        .chart-wrap {
            position: relative;
        }

        #growth {
            display: block;
            width: 100%;
            height: 230px;
            overflow: visible;
        }

        .tip {
            position: absolute;
            top: 0;
            transform: translate(-50%, -110%);
            padding: 0.4rem 0.7rem;
            border-radius: 10px;
            background: var(--ink);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 600;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.15s ease;
        }

        .tip small {
            display: block;
            font-weight: 500;
            color: rgba(214, 220, 255, 0.75);
        }

        .tip.on {
            opacity: 1;
        }

        .donut-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.3rem;
        }

        .donut-ring {
            position: relative;
            width: 11rem;
            height: 11rem;
        }

        .donut-ring svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
            overflow: visible;
        }

        .donut-ring circle {
            fill: none;
            stroke-width: 4;
            transition: opacity 0.2s ease, stroke-width 0.2s ease;
        }

        .donut-ring.dim circle {
            opacity: 0.25;
        }

        .donut-ring.dim circle.on {
            opacity: 1;
            stroke-width: 5.2;
        }

        .donut-center {
            position: absolute;
            inset: 0;
            display: grid;
            place-content: center;
            text-align: center;
        }

        .donut-center b {
            font-size: 1.9rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1;
        }

        .donut-center span {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .legend {
            list-style: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .legend li {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.5rem 0.6rem;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: default;
            transition: background 0.2s ease;
        }

        .legend li:hover {
            background: #F4F5FC;
        }

        .legend i {
            width: 0.65rem;
            height: 0.65rem;
            border-radius: 50%;
            background: var(--c);
        }

        .legend span {
            margin-left: auto;
            font-weight: 700;
        }

        .legend em {
            font-style: normal;
            color: var(--muted);
            font-weight: 500;
            font-size: 0.8rem;
            min-width: 2.4rem;
            text-align: right;
        }

        .tools {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.6rem;
        }

        .search {
            position: relative;
        }

        .search svg {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            width: 1rem;
            height: 1rem;
            transform: translateY(-50%);
            color: #9A9EBB;
            pointer-events: none;
        }

        .search input {
            width: 12.5rem;
            height: 2.5rem;
            padding: 0 0.9rem 0 2.4rem;
            border: 1.5px solid var(--line);
            border-radius: 11px;
            background: #F5F6FC;
            font-family: inherit;
            font-size: 0.86rem;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .search input:focus {
            background: #fff;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(61, 90, 254, 0.12);
        }

        .chips {
            display: flex;
            gap: 0.3rem;
            padding: 0.25rem;
            border-radius: 11px;
            background: #F1F2FA;
        }

        .chip-btn {
            border: 0;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            background: transparent;
            color: var(--muted);
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            transition: background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        }

        .chip-btn.on {
            background: #fff;
            color: var(--blue);
            box-shadow: 0 2px 8px rgba(30, 38, 120, 0.1);
        }

        .tbl {
            width: 100%;
            border-collapse: collapse;
        }

        .tbl th {
            padding: 0.6rem 0.8rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--muted);
            text-align: left;
            border-bottom: 1.5px solid var(--line);
            white-space: nowrap;
        }

        .tbl td {
            padding: 0.8rem;
            font-size: 0.88rem;
            border-bottom: 1px solid #EEF0F8;
            vertical-align: middle;
            white-space: nowrap;
        }

        .tbl tbody tr {
            transition: background 0.15s ease;
        }

        .tbl tbody tr:hover {
            background: #F7F8FD;
        }

        .tbl tbody tr:last-child td {
            border-bottom: 0;
        }

        .who {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .who .avatar {
            width: 2.2rem;
            height: 2.2rem;
        }

        .who b {
            display: block;
            font-weight: 600;
        }

        .who small {
            color: var(--muted);
            font-size: 0.78rem;
        }

        .av-0 { background: linear-gradient(135deg, #3D5AFE, #6C4DFF); }
        .av-1 { background: linear-gradient(135deg, #22B07D, #11896A); }
        .av-2 { background: linear-gradient(135deg, #FFB547, #F0832F); }
        .av-3 { background: linear-gradient(135deg, #E0508E, #B83280); }

        .tag {
            display: inline-block;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 600;
            background: rgba(61, 90, 254, 0.09);
            color: var(--blue-dark);
        }

        .state {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .state::before {
            content: '';
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background: currentColor;
        }

        .state.aktif {
            color: #178A61;
        }

        .state.nonaktif {
            color: #98708A;
        }

        .empty-row td {
            text-align: center;
            color: var(--muted);
            padding: 2rem 0.8rem;
        }

        .table-scroll {
            overflow-x: auto;
            margin: 0 -0.4rem;
            padding: 0 0.4rem;
        }

        .feed {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .feed li {
            position: relative;
            display: flex;
            gap: 0.85rem;
            padding-bottom: 1.15rem;
        }

        .feed li:last-child {
            padding-bottom: 0;
        }

        .feed li::before {
            content: '';
            position: absolute;
            left: 0.4rem;
            top: 1.1rem;
            bottom: -0.1rem;
            width: 1.5px;
            background: var(--line);
        }

        .feed li:last-child::before {
            display: none;
        }

        .feed .dot {
            width: 0.85rem;
            height: 0.85rem;
            margin-top: 0.2rem;
            border-radius: 50%;
            flex-shrink: 0;
            border: 3px solid #fff;
            box-shadow: 0 0 0 1.5px var(--c);
            background: var(--c);
        }

        .feed .dot.blue { --c: var(--blue); }
        .feed .dot.violet { --c: var(--violet); }
        .feed .dot.amber { --c: var(--amber); }
        .feed .dot.green { --c: var(--green); }

        .feed p {
            margin: 0;
            font-size: 0.88rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .feed small {
            color: var(--muted);
            font-size: 0.78rem;
        }

        .btn-main:focus-visible,
        .menu-btn:focus-visible,
        .user-btn:focus-visible,
        .chip-btn:focus-visible,
        .nav-link-x:focus-visible {
            outline: 3px solid rgba(61, 90, 254, 0.45);
            outline-offset: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            .meter i, .sidebar, .scrim {
                animation: none;
                transition: none;
            }
        }
    </style>
</head>
<body>
    <div class="scrim" id="scrim"></div>

    <aside class="sidebar" id="sidebar">
        <div class="side-brand">
            <span class="side-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7.5 2.6v5.6c0 4.7-3.1 8.3-7.5 9.8-4.4-1.5-7.5-5.1-7.5-9.8V5.6L12 3z"/><path d="M9 12l2.2 2.2L15.2 10"/></svg>
            </span>
            Manajemen Akun
        </div>

        <ul class="nav-list">
            <li>
                <a href="/dashboard" class="nav-link-x active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7.5" height="9" rx="2"/><rect x="13.5" y="3" width="7.5" height="5.5" rx="2"/><rect x="13.5" y="11.5" width="7.5" height="9.5" rx="2"/><rect x="3" y="15" width="7.5" height="6" rx="2"/></svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="nav-link-x">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.6-3.6 3.2-5.5 6.5-5.5s5.9 1.9 6.5 5.5"/><path d="M16 4.7a3.5 3.5 0 0 1 0 6.6"/><path d="M18 14.8c2 .6 3.2 2.3 3.5 5.2"/></svg>
                    Data Akun
                </a>
            </li>
            <li>
                <a href="#" class="nav-link-x">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7.5 2.6v5.6c0 4.7-3.1 8.3-7.5 9.8-4.4-1.5-7.5-5.1-7.5-9.8V5.6L12 3z"/></svg>
                    Tipe Akun
                </a>
            </li>
            <li>
                <a href="#" class="nav-link-x">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                    Log Aktivitas
                </a>
            </li>
            <li>
                <a href="#" class="nav-link-x">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>
                    Pengaturan
                </a>
            </li>
        </ul>

        <div class="side-foot">
            <b>{{ $namaUser }}</b>
            Sedang masuk sebagai pengelola sistem.
        </div>

        <form action="/logout" method="POST" class="side-logout-form">
            @csrf
            <button type="submit" class="side-logout">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h4"/><path d="M15 8l4 4-4 4"/><path d="M19 12H9"/></svg>
                Keluar
            </button>
        </form>
    </aside>

    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button type="button" class="menu-btn" id="menuBtn" aria-label="Buka menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h10"/></svg>
                </button>
                <div>
                    <h1 class="page-title">Selamat datang, {{ $namaUser }}</h1>
                    <p class="page-sub">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>

            <div class="dropdown">
                <button type="button" class="user-btn" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="avatar">{{ $inisialUser }}</span>
                    <span class="d-none d-sm-inline">{{ $namaUser }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h4"/><path d="M15 8l4 4-4 4"/><path d="M19 12H9"/></svg>
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <section class="row g-3 mb-3">
            <div class="col-6 col-xl-3">
                <div class="stat hero">
                    <div class="stat-top">
                        Total akun
                        <span class="stat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.6-3.6 3.2-5.5 6.5-5.5s5.9 1.9 6.5 5.5"/><path d="M16 4.7a3.5 3.5 0 0 1 0 6.6"/><path d="M18 14.8c2 .6 3.2 2.3 3.5 5.2"/></svg></span>
                    </div>
                    <div class="stat-num" data-count="{{ $stats['total'] }}">0</div>
                    <div class="stat-foot">Semua akun terdaftar</div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat">
                    <div class="stat-top">
                        Akun aktif
                        <span class="stat-ico green"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span>
                    </div>
                    <div class="stat-num" data-count="{{ $stats['aktif'] }}">0</div>
                    <div class="meter"><i style="--w: {{ $persenAktif }}%; --c: var(--green)"></i></div>
                    <div class="stat-foot">{{ $persenAktif }}% dari total akun</div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat">
                    <div class="stat-top">
                        Akun nonaktif
                        <span class="stat-ico red"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M5.6 5.6l12.8 12.8"/></svg></span>
                    </div>
                    <div class="stat-num" data-count="{{ $stats['nonaktif'] }}">0</div>
                    <div class="meter"><i style="--w: {{ $persenNonaktif }}%; --c: var(--danger)"></i></div>
                    <div class="stat-foot">{{ $persenNonaktif }}% dari total akun</div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat">
                    <div class="stat-top">
                        Login hari ini
                        <span class="stat-ico amber"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4"/><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/></svg></span>
                    </div>
                    <div class="stat-num" data-count="{{ $stats['login_hari_ini'] }}">0</div>
                    <div class="meter"><i style="--w: {{ $persenLogin }}%; --c: var(--amber)"></i></div>
                    <div class="stat-foot">{{ $persenLogin }}% dari akun aktif</div>
                </div>
            </div>
        </section>

        <section class="row g-3 mb-3">
            <div class="col-lg-8">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2 class="panel-title">Pertumbuhan akun</h2>
                            <p class="panel-note">Jumlah akun terdaftar dalam 7 hari terakhir</p>
                        </div>
                        <a href="#" class="btn-main">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                            Tambah akun
                        </a>
                    </div>
                    <div class="chart-wrap" id="chartWrap">
                        <svg id="growth" viewBox="0 0 640 230" role="img" aria-label="Grafik pertumbuhan akun"></svg>
                        <div class="tip" id="tip"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2 class="panel-title">Tipe akun</h2>
                            <p class="panel-note">Sebaran berdasarkan peran</p>
                        </div>
                    </div>
                    <div class="donut-box">
                        <div class="donut-ring" id="donut">
                            <svg viewBox="0 0 36 36">
                                <circle cx="18" cy="18" r="15.9155" stroke="#EEF0F8"/>
                                @foreach ($tipeAkun as $i => $t)
                                    @php $pct = $t['jumlah'] / $totalTipe * 100; @endphp
                                    <circle data-i="{{ $i }}" cx="18" cy="18" r="15.9155" stroke="{{ $palet[$i % count($palet)] }}" stroke-dasharray="{{ round(max($pct - 1.2, 0), 2) }} {{ round(100 - max($pct - 1.2, 0), 2) }}" stroke-dashoffset="{{ round(-$kum, 2) }}" stroke-linecap="round"/>
                                    @php $kum += $pct; @endphp
                                @endforeach
                            </svg>
                            <div class="donut-center">
                                <b>{{ $totalTipe }}</b>
                                <span>akun</span>
                            </div>
                        </div>
                        <ul class="legend" id="legend">
                            @foreach ($tipeAkun as $i => $t)
                                <li data-i="{{ $i }}" style="--c: {{ $palet[$i % count($palet)] }}">
                                    <i></i>{{ $t['nama'] }}
                                    <span>{{ $t['jumlah'] }}</span>
                                    <em>{{ round($t['jumlah'] / $totalTipe * 100) }}%</em>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="row g-3">
            <div class="col-xl-8">
                <div class="panel">
                    <div class="panel-head flex-wrap">
                        <div>
                            <h2 class="panel-title">Akun terbaru</h2>
                            <p class="panel-note">Akun yang baru ditambahkan ke sistem</p>
                        </div>
                        <div class="tools">
                            <div class="search">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
                                <input type="text" id="q" placeholder="Cari nama atau email" autocomplete="off">
                            </div>
                            <div class="chips" id="chips">
                                <button type="button" class="chip-btn on" data-f="semua">Semua</button>
                                <button type="button" class="chip-btn" data-f="aktif">Aktif</button>
                                <button type="button" class="chip-btn" data-f="nonaktif">Nonaktif</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-scroll">
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>Akun</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                </tr>
                            </thead>
                            <tbody id="rows">
                                @foreach ($akunTerbaru as $i => $a)
                                    <tr data-status="{{ $a['status'] }}" data-text="{{ strtolower($a['nama'] . ' ' . $a['email']) }}">
                                        <td>
                                            <div class="who">
                                                <span class="avatar av-{{ $i % 4 }}">{{ mb_strtoupper(mb_substr($a['nama'], 0, 1)) }}</span>
                                                <span>
                                                    <b>{{ $a['nama'] }}</b>
                                                    <small>{{ $a['email'] }}</small>
                                                </span>
                                            </div>
                                        </td>
                                        <td><span class="tag">{{ $a['tipe'] }}</span></td>
                                        <td><span class="state {{ $a['status'] }}">{{ ucfirst($a['status']) }}</span></td>
                                        <td>{{ $a['dibuat'] }}</td>
                                    </tr>
                                @endforeach
                                <tr class="empty-row" id="emptyRow" hidden>
                                    <td colspan="4">Tidak ada akun yang cocok.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2 class="panel-title">Aktivitas terakhir</h2>
                            <p class="panel-note">Perubahan data akun</p>
                        </div>
                    </div>
                    <ul class="feed">
                        @foreach ($aktivitas as $log)
                            <li>
                                <span class="dot {{ $log['warna'] }}"></span>
                                <div>
                                    <p>{{ $log['teks'] }}</p>
                                    <small>{{ $log['waktu'] }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            var sidebar = document.getElementById('sidebar');
            var scrim = document.getElementById('scrim');

            function setMenu(open) {
                sidebar.classList.toggle('open', open);
                scrim.classList.toggle('open', open);
            }

            document.getElementById('menuBtn').addEventListener('click', function () {
                setMenu(!sidebar.classList.contains('open'));
            });

            scrim.addEventListener('click', function () {
                setMenu(false);
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') setMenu(false);
            });

            var counters = document.querySelectorAll('[data-count]');
            counters.forEach(function (el) {
                var end = parseInt(el.getAttribute('data-count'), 10) || 0;
                if (reduce) {
                    el.textContent = end.toLocaleString('id-ID');
                    return;
                }
                var start = null;
                function tick(ts) {
                    if (start === null) start = ts;
                    var p = Math.min((ts - start) / 1000, 1);
                    var eased = 1 - Math.pow(1 - p, 3);
                    el.textContent = Math.round(end * eased).toLocaleString('id-ID');
                    if (p < 1) requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            });

            var series = @json($pertumbuhan);
            var svg = document.getElementById('growth');
            var wrap = document.getElementById('chartWrap');
            var tip = document.getElementById('tip');
            var NS = 'http://www.w3.org/2000/svg';
            var W = 640;
            var H = 230;
            var pl = 10;
            var pr = 10;
            var pt = 24;
            var pb = 30;
            var vals = series.data;
            var n = vals.length;
            var lo0 = Math.min.apply(null, vals);
            var hi0 = Math.max.apply(null, vals);
            var span = (hi0 - lo0) || 1;
            var lo = lo0 - span * 0.25;
            var hi = hi0 + span * 0.15;
            var guide = null;
            var dot = null;
            var first = true;

            function px(i) {
                return n === 1 ? W / 2 : pl + i * (W - pl - pr) / (n - 1);
            }

            function py(v) {
                return pt + (1 - (v - lo) / (hi - lo)) * (H - pt - pb);
            }

            function mk(name, attrs) {
                var node = document.createElementNS(NS, name);
                for (var k in attrs) node.setAttribute(k, attrs[k]);
                return node;
            }

            function build() {
                W = wrap.clientWidth || 640;
                svg.setAttribute('viewBox', '0 0 ' + W + ' ' + H);
                while (svg.firstChild) svg.removeChild(svg.firstChild);

                var defs = mk('defs', {});
                var grad = mk('linearGradient', { id: 'areaFill', x1: '0', y1: '0', x2: '0', y2: '1' });
                grad.appendChild(mk('stop', { offset: '0%', 'stop-color': '#3D5AFE', 'stop-opacity': '0.28' }));
                grad.appendChild(mk('stop', { offset: '100%', 'stop-color': '#3D5AFE', 'stop-opacity': '0' }));
                defs.appendChild(grad);
                svg.appendChild(defs);

                for (var g = 0; g < 4; g++) {
                    var gy = pt + g * (H - pt - pb) / 3;
                    svg.appendChild(mk('line', { x1: pl, x2: W - pr, y1: gy, y2: gy, stroke: '#EEF0F8', 'stroke-width': 1 }));
                }

                var d = 'M' + px(0) + ' ' + py(vals[0]);
                for (var i = 1; i < n; i++) {
                    var cx = (px(i - 1) + px(i)) / 2;
                    d += ' C' + cx + ' ' + py(vals[i - 1]) + ' ' + cx + ' ' + py(vals[i]) + ' ' + px(i) + ' ' + py(vals[i]);
                }

                var area = mk('path', { d: d + ' L' + px(n - 1) + ' ' + (H - pb) + ' L' + px(0) + ' ' + (H - pb) + ' Z', fill: 'url(#areaFill)' });
                var line = mk('path', { d: d, fill: 'none', stroke: '#3D5AFE', 'stroke-width': 3, 'stroke-linecap': 'round' });
                svg.appendChild(area);
                svg.appendChild(line);

                series.labels.forEach(function (lb, i) {
                    var t = mk('text', { x: px(i), y: H - 8, 'text-anchor': i === 0 ? 'start' : (i === n - 1 ? 'end' : 'middle'), fill: '#737797', 'font-size': 12, 'font-family': 'Plus Jakarta Sans, sans-serif' });
                    t.textContent = lb;
                    svg.appendChild(t);
                });

                guide = mk('line', { y1: pt - 6, y2: H - pb, stroke: '#3D5AFE', 'stroke-width': 1, 'stroke-dasharray': '4 4', opacity: 0 });
                dot = mk('circle', { r: 5.5, fill: '#fff', stroke: '#3D5AFE', 'stroke-width': 3, opacity: 0 });
                svg.appendChild(guide);
                svg.appendChild(dot);

                if (!reduce && first) {
                    var len = line.getTotalLength();
                    line.style.strokeDasharray = len;
                    line.style.strokeDashoffset = len;
                    area.style.opacity = 0;
                    requestAnimationFrame(function () {
                        line.style.transition = 'stroke-dashoffset 1.3s cubic-bezier(0.2, 0.7, 0.2, 1) 0.2s';
                        area.style.transition = 'opacity 0.8s ease 1s';
                        line.style.strokeDashoffset = 0;
                        area.style.opacity = 1;
                    });
                }

                first = false;
            }

            build();

            var resizeTimer;
            window.addEventListener('resize', function () {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(build, 120);
            });

            svg.addEventListener('mousemove', function (e) {
                var r = svg.getBoundingClientRect();
                var x = (e.clientX - r.left) / r.width * W;
                var idx = Math.round((x - pl) / ((W - pl - pr) / Math.max(n - 1, 1)));
                idx = Math.max(0, Math.min(n - 1, idx));
                var cxp = px(idx);
                var cyp = py(vals[idx]);
                guide.setAttribute('x1', cxp);
                guide.setAttribute('x2', cxp);
                guide.setAttribute('opacity', 1);
                dot.setAttribute('cx', cxp);
                dot.setAttribute('cy', cyp);
                dot.setAttribute('opacity', 1);
                tip.innerHTML = vals[idx] + ' akun<small>' + series.labels[idx] + '</small>';
                tip.style.left = cxp + 'px';
                tip.style.top = cyp + 'px';
                tip.classList.add('on');
            });

            svg.addEventListener('mouseleave', function () {
                guide.setAttribute('opacity', 0);
                dot.setAttribute('opacity', 0);
                tip.classList.remove('on');
            });

            var donut = document.getElementById('donut');
            var segs = donut.querySelectorAll('circle[data-i]');
            document.querySelectorAll('#legend li').forEach(function (li) {
                li.addEventListener('mouseenter', function () {
                    donut.classList.add('dim');
                    segs.forEach(function (s) {
                        s.classList.toggle('on', s.getAttribute('data-i') === li.getAttribute('data-i'));
                    });
                });
                li.addEventListener('mouseleave', function () {
                    donut.classList.remove('dim');
                    segs.forEach(function (s) {
                        s.classList.remove('on');
                    });
                });
            });

            var rows = document.querySelectorAll('#rows tr[data-status]');
            var emptyRow = document.getElementById('emptyRow');
            var q = document.getElementById('q');
            var chips = document.querySelectorAll('#chips .chip-btn');
            var filter = 'semua';

            function apply() {
                var term = q.value.trim().toLowerCase();
                var shown = 0;
                rows.forEach(function (tr) {
                    var okStatus = filter === 'semua' || tr.getAttribute('data-status') === filter;
                    var okText = tr.getAttribute('data-text').indexOf(term) !== -1;
                    var ok = okStatus && okText;
                    tr.hidden = !ok;
                    if (ok) shown++;
                });
                emptyRow.hidden = shown !== 0;
            }

            q.addEventListener('input', apply);

            chips.forEach(function (c) {
                c.addEventListener('click', function () {
                    filter = c.getAttribute('data-f');
                    chips.forEach(function (x) {
                        x.classList.toggle('on', x === c);
                    });
                    apply();
                });
            });
        })();
    </script>
</body>
</html>
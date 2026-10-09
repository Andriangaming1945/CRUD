<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Manajemen Akun')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --sb-width: 250px;
            --sb-bg: #141629;
            --sb-active: #5b5bd6;
            --sb-text: #aeb3c7;
            --page-bg: #f4f5fa;
        }
        body {
            background: var(--page-bg);
            font-size: 0.9rem;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sb-width);
            background: var(--sb-bg);
            z-index: 1040;
            transition: transform 0.25s ease;
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.25rem 1.25rem 1rem;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
        }
        .sidebar-brand .brand-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--sb-active);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }
        .sidebar-nav {
            list-style: none;
            margin: 0;
            padding: 0.5rem 0.75rem;
        }
        .sidebar-nav li + li {
            margin-top: 0.25rem;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 0.85rem;
            border-radius: 6px;
            color: var(--sb-text);
            text-decoration: none;
            font-size: 0.85rem;
            transition: background 0.15s, color 0.15s;
        }
        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
        }
        .sidebar-nav a.active {
            background: var(--sb-active);
            color: #fff;
        }
        .main-wrap {
            margin-left: var(--sb-width);
            min-height: 100vh;
        }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
        }
        .topbar .user-info {
            text-align: right;
            line-height: 1.2;
        }
        .topbar .user-info strong {
            display: block;
            font-size: 0.75rem;
        }
        .topbar .user-info span {
            font-size: 0.75rem;
            color: #444;
        }
        .content {
            padding: 0 1.5rem 2rem;
        }
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-wrap {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <a href="{{ url('/dashboard') }}" class="sidebar-brand">
            <span class="brand-icon"><i class="bi bi-shield-check"></i></span>
            Manajemen Akun
        </a>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('/tipe-akun') }}" class="{{ request()->is('tipe-akun*') ? 'active' : '' }}">
                    <i class="bi bi-person-vcard"></i> Tipe Akun
                </a>
            </li>
            <li>
                <a href="{{ url('/jenis-aksi') }}" class="{{ request()->is('jenis-aksi*') ? 'active' : '' }}">
                    <i class="bi bi-lightning-charge"></i> Jenis Aksi
                </a>
            </li>
            
        </ul>
        <div class="topbar" style="margin-top: 400px; padding: 1rem;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger" style="width: 200px">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </form>
        </div>
       
    </aside>
  

        <main class="content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
</body>
</html>
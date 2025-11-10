<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @stack('styles')
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-bg: #ffffff;
            --sidebar-collapsed-width: 88px;
            --main-content-bg: #f4f7f6;
        }

        body {
            overflow-x: hidden;
            background-color: var(--main-content-bg);
        }

        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            transition: transform 0.3s ease-in-out;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050; /* Higher z-index */
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transform: translateX(0);
        }

        #sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: #555;
            text-decoration: none;
            border-bottom: 1px solid #f0f0f0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 500;
        }

        #sidebar .nav-link i {
            margin-right: 20px;
            font-size: 1.3rem;
            width: 25px;
            text-align: center;
            color: #888;
            transition: color 0.2s;
        }

        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            background-color: #f0f5ff;
            color: #0d6efd;
            border-left: 4px solid #0d6efd;
        }
        
        #sidebar .nav-link:hover i, #sidebar .nav-link.active i {
            color: #0d6efd;
        }

        #main-content {
            transition: margin-left 0.3s ease-in-out, filter 0.3s ease-in-out;
            margin-left: var(--sidebar-width);
            padding: 20px;
            width: calc(100% - var(--sidebar-width));
        }
        
        #sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040; /* Below sidebar, above content */
        }

        /* Collapsed state for desktop */
        body.sidebar-collapsed #sidebar {
            transform: translateX(calc(-1 * var(--sidebar-width) + var(--sidebar-collapsed-width)));
        }
        body.sidebar-collapsed #main-content {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }
        body.sidebar-collapsed #sidebar .nav-link span {
            opacity: 0;
            visibility: hidden;
        }
        body.sidebar-collapsed #sidebar .nav-link {
            justify-content: center;
        }
        body.sidebar-collapsed #sidebar .nav-link i {
            margin-right: 0;
        }

        #sidebar-toggler {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1051; /* Above sidebar */
            background: #fff;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: left 0.3s ease-in-out;
        }
        
        body.sidebar-collapsed #sidebar-toggler {
            left: 15px;
        }

        /* Mobile view */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #main-content {
                margin-left: 0;
                width: 100%;
                filter: blur(0); /* No blur by default */
            }
            body.sidebar-active-mobile #sidebar {
                transform: translateX(0);
            }
            body.sidebar-active-mobile #main-content {
                filter: blur(4px);
                pointer-events: none; /* Disable interaction with content */
            }
            body.sidebar-active-mobile #sidebar-overlay {
                display: block;
            }
            
            /* Hide collapsed styles on mobile */
            body.sidebar-collapsed #sidebar {
                transform: translateX(-100%);
            }
            body.sidebar-collapsed #main-content {
                margin-left: 0;
                width: 100%;
            }
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 50px; /* Adjust for fixed toggler */
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div id="sidebar-overlay"></div>
    <button id="sidebar-toggler" class="btn" type="button">
        <i class="bi bi-list fs-5"></i>
    </button>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="position-sticky pt-5">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}" title="Dashboard">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('pakai-stock.form') ? 'active' : '' }}" href="{{ route('pakai-stock.form') }}" title="Pakai Stock">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>Pakai Stock</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('tambah-stock.form') ? 'active' : '' }}" href="{{ route('tambah-stock.form') }}" title="Tambah Stock">
                        <i class="bi bi-plus-square-fill"></i>
                        <span>Tambah Stock</span>
                    </a>
                </li>
                @can('manage-stock')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('kelola-stock.index') ? 'active' : '' }}" href="{{ route('kelola-stock.index') }}" title="Kelola Stock">
                            <i class="bi bi-box-seam-fill"></i>
                            <span>Kelola Stock</span>
                        </a>
                    </li>
                @endcan
                @can('manage-users')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('kelola-user.index') ? 'active' : '' }}" href="{{ route('kelola-user.index') }}" title="Kelola User">
                            <i class="bi bi-people-fill"></i>
                            <span>Kelola User</span>
                        </a>
                    </li>
                @endcan
                @can('manage-users')
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('log-aktivitas.index') ? 'active' : '' }}" href="{{ route('log-aktivitas.index') }}" title="Log Aktivitas">
                        <i class="bi bi-clock-history"></i>
                        <span>Log Aktivitas</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <div class="content-header">
            <h1 class="h2">@yield('page_title', 'Dashboard')</h1>
            <div class="btn-toolbar">
                @if (Auth::check())
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                @endif
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggler = document.getElementById('sidebar-toggler');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const body = document.body;
            const isMobile = () => window.innerWidth <= 768;

            const toggleSidebar = () => {
                if (isMobile()) {
                    body.classList.toggle('sidebar-active-mobile');
                } else {
                    body.classList.toggle('sidebar-collapsed');
                }
            };

            sidebarToggler.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);

            // Initial state setup
            if (!isMobile()) {
                body.classList.add('sidebar-collapsed');
            }
        });
    </script>
</body>
</html>
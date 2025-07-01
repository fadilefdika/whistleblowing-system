<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>

    {{-- Bootstrap CSS (via CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS (via CDN, versi sesuai CSS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')
</head>
<body class="admin-layout">
    <div class="layout-wrapper">
        <!-- Mobile Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <h1 class="brand-title">Admin Panel</h1>
                <button class="sidebar-close-btn" id="sidebarCloseBtn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <nav class="sidebar-nav">
                <h6 class="nav-section-title">NAVIGATION</h6>
                <ul class="nav-links">
                    <li>
                        <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt"></i>
                            <span class="link-text">Reports</span>
                        </a>
                    </li>
                    <!-- Tambahkan menu lainnya di sini -->
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <form method="POST" action="{{route('admin.logout') }}">
                    @csrf
                    <button class="logout-btn" type="submit">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="content-wrapper">
            <!-- Navbar -->
            <nav class="admin-navbar">
                <div class="navbar-content">
                    <div class="navbar-left">
                        <button class="sidebar-toggle-btn" id="sidebarToggleBtn">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="page-title">
                            <h2>@yield('title', 'Dashboard')</h2>
                        </div>
                    </div>
                    <div class="user-menu">
                        <!-- User dropdown atau elemen lainnya -->
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')

    <style>
        /* ✅ Reset Universal untuk Menghindari Overflow */
        *, *::before, *::after {
            box-sizing: border-box;
            max-width: 100%;
        }
    
        html, body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }
    
        :root {
            --sidebar-width: 220px;
            --sidebar-bg: #1e293b;
            --sidebar-text: #e2e8f0;
            --sidebar-active: #3b82f6;
            --navbar-height: 60px;
            --navbar-bg: #ffffff;
            --content-bg: #f8fafc;
            --transition-speed: 0.3s;
        }
    
        body.admin-layout {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--content-bg);
            color: #334155;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }
    
        .layout-wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
            width: 100%;
        }
    
        /* Mobile Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-speed) ease;
        }
    
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
            display: block !important;
        }
    
        .sidebar-overlay:not(.active) {
            display: none !important;
        }
    
        /* Sidebar Styles */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: transform var(--transition-speed) ease;
            overflow-y: auto;
        }
    
        .sidebar-header {
            padding: 1.5rem 1rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    
        .brand-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            color: white;
        }
    
        .sidebar-close-btn {
            background: transparent;
            border: none;
            color: var(--sidebar-text);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: background 0.2s ease;
            display: none;
        }
    
        .sidebar-close-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    
        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
            overflow-y: auto;
        }
    
        .nav-section-title {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 1rem 0.5rem;
            margin: 0;
            color: #94a3b8;
            font-weight: 600;
        }
    
        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
    
        .nav-links a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
    
        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.05);
        }
    
        .nav-links a.active {
            background: rgba(59, 130, 246, 0.1);
            border-left-color: var(--sidebar-active);
            color: white;
        }
    
        .nav-links i {
            width: 24px;
            text-align: center;
            margin-right: 12px;
            font-size: 0.9rem;
        }
    
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    
        .logout-btn {
            background: transparent;
            border: none;
            color: var(--sidebar-text);
            display: flex;
            align-items: center;
            width: 100%;
            padding: 0.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background 0.2s ease;
        }
    
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    
        .logout-btn i {
            margin-right: 10px;
        }
    
        /* Content Wrapper */
        .content-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            transition: margin-left var(--transition-speed) ease;
            width: 100%;
        }
    
        /* Navbar Styles */
        .admin-navbar {
            height: var(--navbar-height);
            background: var(--navbar-bg);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
    
        .navbar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 1.5rem;
        }
    
        .navbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
    
        .sidebar-toggle-btn {
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: all 0.2s ease;
            display: none;
        }
    
        .sidebar-toggle-btn:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #334155;
        }
    
        .page-title h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: #1e293b;
        }
    
        /* Main Content Styles */
        .main-content {
            flex: 1;
            background-color: var(--content-bg);
            width: 100%;
        }
    
        /* Responsive Design */
        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
    
            .admin-sidebar.active {
                transform: translateX(0);
            }
    
            .content-wrapper {
                margin-left: 0;
            }
    
            .sidebar-toggle-btn {
                display: block;
            }
    
            .sidebar-close-btn {
                display: block;
            }
    
            .navbar-content {
                padding: 0 1rem;
            }
    
            .main-content {
                padding: 1rem;
            }
        }
    
        @media (max-width: 768px) {
            :root {
                --navbar-height: 56px;
            }
    
            .sidebar-header {
                padding: 1rem 1rem 0.75rem;
            }
    
            .brand-title {
                font-size: 1rem;
            }
    
            .nav-links a {
                padding: 0.875rem 1rem;
                font-size: 0.95rem;
            }
    
            .nav-links i {
                width: 20px;
                margin-right: 10px;
                font-size: 0.85rem;
            }
    
            .navbar-content {
                padding: 0 0.75rem;
            }
    
            .page-title h2 {
                font-size: 1.1rem;
            }
    
            .main-content {
                padding: 0.75rem;
            }
        }
    
        @media (max-width: 480px) {
            :root {
                --navbar-height: 52px;
            }

            .layout-wrapper {
                padding-bottom: 80px;
            }
    
            .sidebar-header {
                padding: 0.75rem 0.75rem 0.5rem;
            }
    
            .brand-title {
                font-size: 0.95rem;
            }
    
            .nav-section-title {
                padding: 0 0.75rem 0.375rem;
                font-size: 0.6rem;
            }
    
            .nav-links a {
                padding: 0.75rem 0.75rem;
                font-size: 0.9rem;
            }
    
            .nav-links i {
                width: 18px;
                margin-right: 8px;
                font-size: 0.8rem;
            }
    
            .sidebar-footer {
                padding: 0.75rem;
            }
    
            .logout-btn {
                padding: 0.375rem;
                font-size: 0.85rem;
            }
    
            .navbar-content {
                padding: 0 0.5rem;
            }
    
            .navbar-left {
                gap: 0.75rem;
            }
    
            .sidebar-toggle-btn {
                font-size: 1.1rem;
                padding: 0.375rem;
            }
    
            .page-title h2 {
                font-size: 1rem;
            }
    
            .main-content {
                padding: 0.5rem;
            }

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none !important;
                text-align: left;
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
            }

            .dataTables_wrapper .dataTables_length select {
                width: auto;
                display: inline-block;
            }
        }
    
        /* Animation for smooth transitions */
        .admin-sidebar,
        .content-wrapper,
        .sidebar-overlay {
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('adminSidebar');
            const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
            const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            // Toggle sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            }
            
            // Close sidebar
            function closeSidebar() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
            
            // Event listeners
            sidebarToggleBtn.addEventListener('click', toggleSidebar);
            sidebarCloseBtn.addEventListener('click', closeSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);
            
            // Close sidebar on window resize if screen becomes larger
            window.addEventListener('resize', function() {
                if (window.innerWidth > 1024) {
                    closeSidebar();
                }
            });
            
            // Close sidebar when clicking on nav links (mobile)
            const navLinks = document.querySelectorAll('.nav-links a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 1024) {
                        closeSidebar();
                    }
                });
            });
        });
    </script>
</body>
</html> 
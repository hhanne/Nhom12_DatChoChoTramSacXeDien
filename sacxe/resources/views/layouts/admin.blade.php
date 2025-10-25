<?php
// File: resources/views/layouts/admin.blade.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Quản lý Sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #4087b6ff 100%);
            --sidebar-bg: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
            --accent-color: #667eea;
            --hover-color: rgba(255, 255, 255, 0.1);
            --navbar-height: 70px;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow-x: hidden;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }

        /* Navbar với hiệu ứng glassmorphism - CỐ ĐỊNH */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-height);
            z-index: 1030;
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .search-input {
            max-width: 350px;
            border-radius: 25px;
            border: 2px solid transparent;
            background: rgba(102, 126, 234, 0.1);
            padding: 0.6rem 1.2rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--accent-color);
            background: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
            outline: none;
        }

        .btn-search {
            border-radius: 25px;
            background: var(--primary-gradient);
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        /* Icon navbar với animation */
        .nav-icon {
            font-size: 1.3rem;
            color: #667eea;
            position: relative;
            transition: all 0.3s ease;
            margin: 0 0.8rem;
        }

        .nav-icon:hover {
            transform: scale(1.2);
            color: #4874a6ff;
        }

        .nav-icon.bell::after {
            content: '3';
            position: absolute;
            top: -5px;
            right: -8px;
            background: #ff4757;
            color: white;
            font-size: 0.65rem;
            padding: 2px 5px;
            border-radius: 10px;
            font-weight: bold;
        }

        /* Sidebar hiện đại - CỐ ĐỊNH HOÀN TOÀN */
        .sidebar {
            position: fixed;
            top: var(--navbar-height);
            bottom: 0;
            left: 0;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            padding: 1.5rem 0;
            z-index: 1020;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: calc(100vh - var(--navbar-height));
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0.3rem 0;
        }

        .sidebar-menu a {
            color: rgba(255, 255, 255, 0.9);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: var(--hover-color);
            transition: width 0.3s ease;
            z-index: -1;
        }

        .sidebar-menu a:hover::before {
            width: 100%;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left-color: #fff;
            padding-left: 2rem;
            color: white;
        }

        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.2);
            border-left-color: #fff;
            color: white;
        }

        .sidebar-menu a i {
            margin-right: 0.8rem;
            font-size: 1.1rem;
            width: 25px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-menu a span {
            white-space: nowrap;
        }

        /* Content area */
        .content {
            margin-left: var(--sidebar-width);
            margin-top: var(--navbar-height);
            padding: 2rem;
            min-height: calc(100vh - var(--navbar-height));
            animation: fadeIn 0.5s ease;
            position: relative;
            z-index: 1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Dropdown cải tiến */
        .user-dropdown {
            position: relative;
        }

        .user-dropdown .dropdown-toggle {
            background: var(--primary-gradient);
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .user-dropdown .dropdown-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
            margin-top: 0.5rem;
            overflow: hidden;
            animation: slideDown 0.3s ease;
            z-index: 1031;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: var(--primary-gradient);
            color: white;
            padding-left: 2rem;
        }

        .btn-logout {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
            border: none;
            border-radius: 15px;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            width: 100%;
            text-align: left;
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, #ff8e53 0%, #ff6b6b 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
            color: white;
        }

        /* Card styles cho content */
        .content-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 80px;
            }

            .sidebar {
                width: var(--sidebar-width);
            }

            .sidebar-menu a span {
                display: none;
            }

            .sidebar-menu a {
                justify-content: center;
                padding: 1rem 0.5rem;
            }

            .sidebar-menu a:hover {
                padding-left: 0.5rem;
            }

            .sidebar-menu a i {
                margin-right: 0;
            }

            .content {
                margin-left: var(--sidebar-width);
            }

            .search-input {
                max-width: 150px;
            }

            .navbar-brand {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            :root {
                --sidebar-width: 0;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .navbar {
                padding: 0.5rem 1rem;
            }
        }

        /* Toggle button cho mobile */
        .sidebar-toggle {
            display: none;
            background: var(--primary-gradient);
            border: none;
            color: white;
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            transform: scale(1.1);
        }

        @media (max-width: 576px) {
            .sidebar-toggle {
                display: inline-block;
            }
        }

        /* Overlay cho mobile khi sidebar mở */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1019;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="sidebar-toggle me-3" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            
            <a class="navbar-brand" href="{{ route('admin.products.index') }}">
                <i class="bi bi-lightning-charge-fill"></i> Quản trị hệ thống
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->hoten }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person me-2"></i> Hồ sơ
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear me-2"></i> Cài đặt
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item btn-logout">
                                    <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar Overlay cho mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar - CỐ ĐỊNH -->
    <div class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.products.index') }}" class="{{ Route::is('admin.products.index') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.congsac.index') }}" class="{{ Route::is('admin.congsac.index') ? 'active' : '' }}">
                    <i class="bi bi-ev-station-fill"></i>
                    <span>Quản lý cổng sạc</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.tramsac.index') }}" class="{{ Route::is('admin.tramsac.index') ? 'active' : '' }}">
                    <i class="bi bi-building"></i>
                    <span>Quản lý trạm sạc</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.khachhang.index') }}" class="{{ Route::is('admin.khachhang.index') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Quản lý khách hàng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.datcho.index') }}" class="{{ Route::is('admin.products.datcho.index') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span>Quản lý đặt chỗ</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar trên mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                });

                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }

            // Tự động active menu item dựa trên URL
            const currentPath = window.location.pathname;
            const menuLinks = document.querySelectorAll('.sidebar-menu a');
            
            menuLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    menuLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                }
            });
        });

        // Prevent form submission on search (optional)
        document.querySelector('.navbar form').addEventListener('submit', function(e) {
            e.preventDefault();
            const searchValue = this.querySelector('.search-input').value;
            console.log('Searching for:', searchValue);
            // Implement your search functionality here
        });
    </script>
</body>
</html>
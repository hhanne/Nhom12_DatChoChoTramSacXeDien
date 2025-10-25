<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đặt chỗ của tôi - Trạm Sạc EV</title>
    
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- Base & Font Styles --- */
        body {
            background-color: #f4f5f7;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px 0;
        }

        /* --- Header (Top Bar) Styles --- */
        .top-bar {
            background-color: #fff;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .top-bar-left h2 { font-size: 1.25rem; font-weight: 600; color: #00c4a7; margin: 0; }
        .top-bar-left p { font-size: 0.875rem; color: #6c757d; margin: 0; }
        .top-bar-right { display: flex; align-items: center; gap: 1.5rem; }
        .notification-icon { position: relative; font-size: 1.5rem; color: #6c757d; cursor: pointer; }
        .notification-badge { position: absolute; top: -5px; right: -8px; background-color: #ff4d4f; color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 12px; display: flex; justify-content: center; align-items: center; font-weight: bold; }
        .user-profile { display: flex; align-items: center; gap: 0.75rem; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background-color: #00c4a7; color: white; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 1.2rem; text-transform: uppercase; }
        .user-info .user-name { font-weight: 600; font-size: 0.9rem; margin: 0; }
        .user-info .user-email { font-size: 0.8rem; color: #6c757d; margin: 0; }
        .logout-link { text-decoration: none; color: #ff4d4f; font-weight: 500; display: flex; align-items: center; gap: 0.4rem; cursor: pointer; }
        .logout-link:hover { color: #cc0000; }
        .nav-link-custom { text-decoration: none; color: #00bfa6; font-weight: 600; display: flex; align-items: center; gap: 0.4rem; }
        .nav-link-custom:hover { color: #00897b; }

        /* --- Footer Styles --- */
        footer {
            background-color: #00c4a7;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        /* --- Booking List Page Styles --- */
        .content-card {
            max-width: 1100px; /* Wider for table */
            margin: 40px auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            overflow: hidden; /* Hide overflowing table corners */
        }
        .card-header-custom {
            background-color: #00bfa6; /* Theme color */
            color: white;
            text-align: center;
            padding: 1.25rem 1rem;
        }
         .card-header-custom h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.6rem;
         }
        
        .table {
             margin-bottom: 0; /* Remove default margin */
        }
        .table thead th {
             background-color: #f8f9fa; /* Light grey header */
             border-bottom-width: 1px;
             font-weight: 600;
             color: #333;
             font-size: 0.9rem;
             text-transform: uppercase;
             letter-spacing: 0.5px;
        }
        .table tbody tr:hover {
            background-color: #f0fdfa; /* Light green hover */
        }
        .table td {
            vertical-align: middle;
            font-size: 0.95rem;
            color: #555;
        }
        
        /* Status Badges */
        .badge {
            padding: 0.4em 0.8em;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 20px;
        }
        .bg-warning { background-color: #fff3cd !important; color: #664d03 !important; }
        .bg-info { background-color: #cff4fc !important; color: #055160 !important; }
        .bg-success { background-color: #d1e7dd !important; color: #0f5132 !important; }
        .bg-danger { background-color: #f8d7da !important; color: #842029 !important; }
        .bg-secondary { background-color: #e2e3e5 !important; color: #41464b !important; }

        /* Action Buttons */
        .btn-cancel {
            background-color: #ffc107; /* Bootstrap warning */
            color: #333;
            border: none;
            font-weight: 500;
            padding: 5px 10px;
            font-size: 0.85rem;
            border-radius: 6px;
        }
        .btn-cancel:hover { background-color: #e0a800; }
        
        .btn-delete {
            background-color: transparent;
            color: #dc3545; /* Bootstrap danger */
            border: 1px solid #f5c2c7;
            font-weight: 500;
            padding: 5px 10px;
            font-size: 0.85rem;
            border-radius: 6px;
        }
        .btn-delete:hover { background-color: #f8d7da; color: #842029; }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state h5 { font-weight: 600; color: #555; }
        .empty-state p { color: #777; margin-bottom: 20px; }
        .btn-book-now {
             background-color: #00bfa6;
             border: none;
             color: white;
             font-weight: 600;
             padding: 10px 25px;
             border-radius: 8px;
             transition: background-color 0.3s ease;
             text-decoration: none;
        }
         .btn-book-now:hover {
             background-color: #009e8c;
         }

         /* Alert styling */
         .alert {
            margin: 20px; /* Add margin around alerts */
            border-radius: 8px; /* Consistent radius */
         }

    </style>
</head>
<body>

    <!-- Hidden Logout Form -->
    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
        @csrf
    </form>
    
    <!-- Synced Header -->
    <div class="top-bar">
        <div class="top-bar-left">
            <h2>Xin chào, {{ Auth::user()->hoten ?? Auth::user()->name }}!</h2>
            <p>Trạm Sạc EV</p>
        </div>
        <div class="top-bar-right">
            <a href="{{ route('dashboard') }}" class="nav-link-custom">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <div class="notification-icon">
                <i class="fa-solid fa-bell"></i>
                <span class="notification-badge">3</span> <!-- Example badge -->
            </div>
            <div class="user-profile">
                <div class="user-avatar">
                    {{ substr(Auth::user()->hoten ?? Auth::user()->name, 0, 1) }}
                </div>
                <div class="user-info">
                    <p class="user-name">{{ Auth::user()->hoten ?? Auth::user()->name }}</p>
                    <p class="user-email">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <a href="#" onclick="confirmLogout(event)" class="logout-link">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>
    
    <!-- Main Content Area -->
    <div class="main-content">
        <div class="container"> <!-- Removed py-5, added container -->

            <!-- Session Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>🎉 Thành công!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>⚠️ Lỗi!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="content-card"> <!-- Use content-card for styling -->
                <div class="card-header-custom">
                    <h3 class="mb-0">🚗 Danh sách đặt chỗ của tôi</h3>
                </div>

                <div class="card-body p-0"> <!-- Remove padding to allow table to fill -->
                    @if ($datChos->isEmpty())
                        <div class="empty-state">
                            <h5>Bạn chưa có đặt chỗ nào.</h5>
                            <p>Hãy bắt đầu tìm kiếm và đặt chỗ trạm sạc ngay hôm nay!</p>
                            <!-- Updated route name if necessary -->
                            <a href="{{ route('tramsac.index') }}" class="btn btn-book-now">
                                <i class="fas fa-charging-station me-2"></i> Tìm trạm sạc
                            </a> 
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0"> <!-- Removed mb-0 -->
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Trạm sạc</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Thời gian kết thúc</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datChos as $index => $datCho)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                            <td>{{ $datCho->tram->ten_tram ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($datCho->timebatdau)->format('H:i d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($datCho->timeketthuc)->format('H:i d/m/Y') }}</td>
                                            <td class="text-center">
                                                {{-- Updated badge classes --}}
                                                @switch($datCho->trangthai)
                                                    @case('dangcho')
                                                        <span class="badge bg-warning">Đang chờ</span>
                                                        @break
                                                    @case('danghoatdong')
                                                        <span class="badge bg-info">Đang hoạt động</span>
                                                        @break
                                                    @case('hoanthanh')
                                                        <span class="badge bg-success">Hoàn thành</span>
                                                        @break
                                                    @case('huy')
                                                        <span class="badge bg-danger">Đã hủy</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">Không xác định</span>
                                                @endswitch
                                            </td>
                                            <td class="text-center">
                                                {{-- Cancel Button (only when waiting & not started) --}}
                                                @if($datCho->trangthai === 'dangcho' && \Carbon\Carbon::now()->lt($datCho->timebatdau))
                                                    <a href="{{ route('datcho.cancel', $datCho->id) }}"
                                                       class="btn btn-cancel btn-sm"
                                                       onclick="return confirm('Bạn có chắc chắn muốn hủy đặt chỗ này không?')">
                                                        <i class="fas fa-times me-1"></i> Hủy
                                                    </a>
                                                @endif

                                                {{-- Delete Button (only if cancelled) --}}
                                                @if($datCho->trangthai === 'huy')
                                                    <form action="{{ route('datcho.destroy', $datCho->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-delete btn-sm"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa đặt chỗ này vĩnh viễn không?')">
                                                            <i class="fas fa-trash-alt me-1"></i> Xóa
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div> <!-- End card-body -->
            </div> <!-- End content-card -->
        </div> <!-- End container -->
    </div> <!-- End main-content -->

    <!-- Synced Footer -->
    <footer>
        &copy; {{ date('Y') }} Trạm Sạc Điện. Bản quyền thuộc về hệ thống quản lý EV.
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Logout Confirmation Script -->
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm('Bạn có chắc chắn muốn đăng xuất không?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh sách Trạm Sạc - Trạm Sạc EV</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      background-color: #f4f5f7; /* Màu nền xám nhạt giống e-commerce */
      font-family: 'Poppins', sans-serif;
    }

    /* --- BỐ CỤC CHÍNH 2 CỘT --- */
    .sidebar {
        background-color: #ffffff;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        height: fit-content; /* Chiều cao tự động theo nội dung */
    }
    
    .sidebar-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
    }
    .sidebar-title .fa-filter {
        margin-right: 10px;
        color: #00bfa6;
    }

    /* --- THẺ TRẠM SẠC (CARD) --- */
    .station-card {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .station-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    
    .card-img-container {
        position: relative;
        height: 180px;
    }
    .card-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .status-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #fff;
    }
    .status-active { background-color: #28a745; }
    .status-inactive { background-color: #6c757d; }
    
    .card-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.1rem;
        color: #1c1c1c;
        margin-bottom: 8px;
    }

    .card-text {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
    }
    .card-text .fa-map-marker-alt {
        margin-right: 8px;
        margin-top: 3px;
        color: #00bfa6;
    }

    .station-meta {
        margin-top: auto; /* Đẩy xuống dưới cùng */
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #f0f0f0;
        padding-top: 15px;
    }
    
    .meta-item {
        font-size: 0.9rem;
        color: #333;
    }
    .meta-item .fas {
        margin-right: 5px;
        color: #00bfa6;
    }

    .btn-detail {
        background-color: #00bfa6;
        border: none;
        color: white;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
        font-size: 0.9rem;
    }
    .btn-detail:hover {
        background-color: #009e8c;
    }

    /* Sắp xếp & Phân trang */
    .sort-bar {
        background-color: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        margin-bottom: 24px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .pagination .page-item.active .page-link {
        background-color: #00bfa6;
        border-color: #00bfa6;
    }
    .pagination .page-link {
        color: #00bfa6;
    }

    /* Back link */
    .back-link {
        color: #00bfa6;
        text-decoration: none;
        font-weight: 600;
    }
    .back-link:hover { text-decoration: underline; }


            /* ----- START: CSS CHO THANH HEADER MỚI ----- */
        .top-bar {
            background-color: #fff;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .top-bar-left h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #00c4a7;
            margin: 0;
        }
        .top-bar-left p {
            font-size: 0.875rem;
            color: #6c757d;
            margin: 0;
        }
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem; /* Khoảng cách giữa các mục */
        }
        .notification-icon {
            position: relative;
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background-color: #ff4d4f;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #00c4a7;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .user-info .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0;
        }
        .user-info .user-email {
            font-size: 0.8rem;
            color: #6c757d;
            margin: 0;
        }
        .logout-link {
            text-decoration: none;
            color: #ff4d4f;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .logout-link:hover {
            color: #cc0000;
        }
        /* Footer */
        footer {
            background-color: #00c4a7;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }

  </style>
</head>

<body>
    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
        @csrf
    </form>

    <div class="top-bar">
        <div class="top-bar-left">
            <h2>Xin chào, {{ Auth::user()->hoten ?? Auth::user()->name }}!</h2>
            <p>Trạm Sạc EV</p>
        </div>
        <div class="top-bar-right">
            <a href="{{ route('dashboard') }}" class="logout-link" style="color:#00bfa6; font-weight: 600;">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
            <div class="notification-icon">
                <i class="fa-solid fa-bell"></i>
                <span class="notification-badge">3</span>
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
                <i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Đăng xuất</span>
            </a>
        </div>
    </div>

    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm('Bạn có chắc chắn muốn đăng xuất không?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-3">
                <aside class="sidebar">
                    <h5 class="sidebar-title"><i class="fas fa-filter"></i> Bộ lọc tìm kiếm</h5>
                    <form method="GET" action="{{ route('tramsac.index') }}" id="filter-form">
                        <div class="mb-3">
                            <label for="search" class="form-label fw-bold">Tên hoặc địa chỉ</label>
                            <input type="text" id="search" name="search" class="form-control" placeholder="Nhập từ khóa..." value="{{ request('search') }}">
                        </div>
                        <div class="mb-3">
                            <label for="loaitram" class="form-label fw-bold">Loại trạm</label>
                            <select name="loaitram" id="loaitram" class="form-select">
                                <option value="">Tất cả</option>
                                <option value="Nhanh" {{ request('loaitram') == 'Nhanh' ? 'selected' : '' }}>Sạc nhanh</option>
                                <option value="Chậm" {{ request('loaitram') == 'Chậm' ? 'selected' : '' }}>Sạc thường</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="min_congsuat" class="form-label fw-bold">Công suất tối thiểu</label>
                            <input type="number" step="0.1" id="min_congsuat" name="min_congsuat" class="form-control" placeholder="kW" value="{{ request('min_congsuat') }}">
                        </div>
                        <div class="mb-3">
                            <label for="sort" class="form-label fw-bold">Sắp xếp theo tên</label>
                            <select name="sort" id="sort" class="form-select" onchange="document.getElementById('filter-form').submit();">
                                <option value="">Mặc định</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Tên Z-A</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-detail">Áp dụng</button>
                        </div>
                    </form>
                </aside>
            </div>

            <div class="col-lg-9">
                <main class="main-content">
                    <div class="row">
                        @forelse($tramsacs as $tram)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="station-card">
                                    <div class="card-img-container">
                                        @if($tram->hinhanh_url)
                                            <img src="{{ $tram->hinhanh_url }}" alt="Ảnh trạm sạc" class="img-fluid">
                                        @else
                                            <img src="https://via.placeholder.com/400x250.png/00bfa6/FFFFFF?text=EV+Station" alt="Ảnh mặc định" class="img-fluid">
                                        @endif

                                        @if($tram->trangthai == 'hoatdong')
                                            <span class="status-badge status-active">Hoạt động</span>
                                        @else
                                            <span class="status-badge status-inactive">Bảo trì</span>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $tram->tentram }}</h5>
                                        <p class="card-text">
                                            <i class="fas fa-map-marker-alt"></i> {{ $tram->diachi }}
                                        </p>
                                        <div class="station-meta">
                                            <span class="meta-item"><i class="fas fa-charging-station"></i> {{ $tram->loaitram }}</span>
                                            <span class="meta-item"><i class="fas fa-plug"></i> {{ $tram->soluong_congsac }} cổng</span>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white border-0 pb-3">
                                        <a href="{{ route('tramsac.show', $tram->tramsac_id) }}" class="btn btn-detail w-100">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">Không tìm thấy trạm sạc nào phù hợp.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $tramsacs->appends(request()->query())->links() }}
                    </div>
                </main>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Trạm Sạc Điện. Bản quyền thuộc về hệ thống quản lý EV.
    </footer>
</body>

</html>
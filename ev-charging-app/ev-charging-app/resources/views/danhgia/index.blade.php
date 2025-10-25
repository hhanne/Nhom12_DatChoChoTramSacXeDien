<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh giá trạm - {{ $tram->tentram }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- CSS NỀN & FONT --- */
        body {
            background-color: #f4f5f7;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex-grow: 1;
        }

        /* --- CSS HEADER (TOP-BAR) --- */
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
            gap: 1.5rem;
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
            text-transform: uppercase;
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
            cursor: pointer;
        }
        .logout-link:hover {
            color: #cc0000;
        }

        /* --- CSS FOOTER --- */
        footer {
            background-color: #00c4a7;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }

        /* --- CSS MỚI CHO TRANG ĐÁNH GIÁ --- */
        .review-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            padding: 30px;
            height: 100%;
        }
        .review-card h2 {
            color: #00bfa6;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
        }
        
        /* Form và Nút */
        .form-control, .form-select {
            border-radius: 8px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #00bfa6;
            box-shadow: 0 0 0 0.2rem rgba(0, 191, 166, 0.25);
        }
        
        .btn-submit-review {
            background-color: #00bfa6;
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-submit-review:hover {
            background-color: #009e8c;
        }
        
        /* Danh sách đánh giá */
        .review-list h4 {
            font-weight: 600;
            color: #1c1c1c;
            margin-bottom: 20px;
        }
        .review-item {
            display: flex;
            gap: 15px;
            border-bottom: 1px solid #eee;
            padding: 20px 0;
        }
        .review-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .review-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #e0f7f3;
            color: #00897b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
            text-transform: uppercase;
            flex-shrink: 0;
        }
        .review-body .review-user {
            font-weight: 600;
            margin-bottom: 0;
        }
        .review-body .review-stars {
            color: #fadb14; /* Màu vàng sao */
        }
        .review-body .review-content {
            margin: 8px 0;
            color: #555;
        }
        .review-body .review-date {
            font-size: 0.85rem;
            color: #999;
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
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
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
            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>
    
    <div class="main-content">
        <div class="container my-5">
            <div class="row g-4">

                <div class="col-lg-5">
                    <div class="review-card">
                        <h2>Viết đánh giá</h2>
                        <h4 class="text-center h5 mb-4" style="color: #00897b;">{{ $tram->tentram }}</h4>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('danhgia.store', $tram->tramsac_id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="sao" class="form-label fw-bold">Xếp hạng của bạn:</label>
                                <select name="sao" id="sao" class="form-select" required>
                                    <option value="">-- Chọn số sao --</option>
                                    <option value="5">★★★★★ (Tuyệt vời)</option>
                                    <option value="4">★★★★☆ (Tốt)</option>
                                    <option value="3">★★★☆☆ (Ổn)</option>
                                    <option value="2">★★☆☆☆ (Tệ)</option>
                                    <option value="1">★☆☆☆☆ (Rất tệ)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="noidung" class="form-label fw-bold">Nội dung đánh giá:</label>
                                <textarea name="noidung" id="noidung" rows="4" class="form-control" placeholder="Chia sẻ trải nghiệm của bạn về trạm sạc này..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-submit-review w-100">
                                <i class="fas fa-paper-plane me-2"></i> Gửi đánh giá
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="review-card review-list">
                        <h4>Tất cả đánh giá ({{ $danhgias->count() }})</h4>

                        @forelse($danhgias as $dg)
                            <div class="review-item">
                                <div class="review-avatar">
                                    {{ substr($dg->user->hoten ?? 'U', 0, 1) }}
                                </div>
                                <div class="review-body">
                                    <p class="review-user">{{ $dg->user->hoten }}</p>
                                    <div class="review-stars">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $dg->sao) ★ @else ☆ @endif
                                        @endfor
                                    </div>
                                    <p class="review-content">{{ $dg->noidung }}</p>
                                    <small class="review-date">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($dg->ngaydanhgia)->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center mt-3">Chưa có đánh giá nào cho trạm này. Hãy là người đầu tiên!</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Trạm Sạc Điện. Bản quyền thuộc về hệ thống quản lý EV.
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh giá của tôi - Trạm Sạc EV</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content { flex-grow: 1; }

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

        footer { background-color: #00c4a7; color: white; text-align: center; padding: 20px; margin-top: 50px; }

        .content-card {
            max-width: 900px; margin: 40px auto; background: white;
            border-radius: 16px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        .content-card h2 { text-align: center; color: #00bfa5; margin-bottom: 25px; font-weight: 700; }

        .review-item {
            display: flex; gap: 15px; border-bottom: 1px solid #eee;
            padding: 20px 0; justify-content: space-between; align-items: flex-start;
        }
        .review-avatar {
            width: 45px; height: 45px; border-radius: 50%; background-color: #e0f7f3;
            color: #00897b; display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; flex-shrink: 0;
        }
        .review-body { flex: 1; }
        .review-station { font-weight: 600; font-size: 1.1rem; color: #00796b; margin-bottom: 4px; }
        .review-stars { color: #fadb14; }
        .review-content { margin: 8px 0; color: #555; }
        .review-date { font-size: 0.85rem; color: #999; }
        .review-actions { display: flex; gap: 8px; }

        .btn-edit {
            background-color: #00bfa6;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
        }
        .btn-edit:hover { background-color: #009c87; }

        .btn-delete {
            background-color: #ff4d4f;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
        }
        .btn-delete:hover { background-color: #d9363e; }

        .no-data { text-align: center; color: #777; margin-top: 20px; padding: 20px; }
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
        <a href="#" onclick="confirmLogout(event)" class="logout-link">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Đăng xuất</span>
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

<div class="main-content">
    <div class="content-card">
        <h2>⭐ Đánh giá của tôi</h2>

        @if($danhgias->isEmpty())
            <p class="no-data">Bạn chưa viết đánh giá nào.</p>
        @else
            @foreach($danhgias as $dg)
                <div class="review-item">
                    <div class="review-avatar">
                        <i class="fas fa-charging-station"></i>
                    </div>
                    <div class="review-body">
                        <p class="review-station">{{ $dg->tramsac->tentram ?? 'Trạm không xác định' }}</p>
                        <div class="review-stars">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= $dg->sao ? '★' : '☆' }}
                            @endfor
                        </div>
                        <p class="review-content">{{ $dg->noidung }}</p>
                        <small class="review-date">
                            <i class="fas fa-clock me-1"></i>
                            {{ \Carbon\Carbon::parse($dg->ngaydanhgia)->format('d/m/Y H:i') }}
                        </small>
                    </div>
                    <div class="review-actions">
                        <a href="{{ route('danhgia.edit', $dg->danhgia_id) }}" class="btn-edit">
                            <i class="fa-solid fa-pen-to-square"></i> Sửa
                        </a>
                        <form action="{{ route('danhgia.destroy', $dg->danhgia_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xoá đánh giá này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                <i class="fa-solid fa-trash"></i> Xoá
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<footer>
    &copy; 2025 Trạm Sạc Điện. Bản quyền thuộc về hệ thống quản lý EV.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

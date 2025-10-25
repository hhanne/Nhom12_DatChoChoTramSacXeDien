<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa đánh giá - Trạm Sạc EV</title>
    
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

        /* --- Footer Styles --- */
        footer {
            background-color: #00c4a7;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        /* --- Edit Review Page Styles --- */
        .edit-review-card {
            max-width: 700px; /* Consistent width */
            margin: 40px auto;
            background: white;
            border-radius: 16px; /* Consistent radius */
            padding: 40px; /* Consistent padding */
            box-shadow: 0 5px 20px rgba(0,0,0,0.08); /* Consistent shadow */
        }
        .edit-review-card h2 {
            text-align: center;
            color: #00bfa5; /* Synced color */
            margin-bottom: 25px;
            font-weight: 700; /* Synced font weight */
        }
        
        /* Form Styles */
        .form-label {
            font-weight: 600; /* Synced font weight */
            color: #333; /* Synced color */
        }
        .form-control, .form-select {
            border-radius: 8px; /* Synced radius */
            padding: 10px 12px; /* Synced padding */
            border: 1px solid #ced4da; /* Slightly improved border */
        }
        .form-control:focus, .form-select:focus {
            border-color: #00bfa6; /* Synced focus color */
            box-shadow: 0 0 0 0.2rem rgba(0, 191, 166, 0.25); /* Synced focus shadow */
        }
        
        /* Button Styles */
        .btn-update {
            background-color: #00bfa6; /* Synced button color */
            border: none;
            color: white;
            font-weight: 600; /* Synced font weight */
            padding: 10px 20px; /* Synced padding */
            border-radius: 8px; /* Synced radius */
            transition: background-color 0.3s ease; /* Synced transition */
        }
        .btn-update:hover {
            background-color: #009e8c; /* Synced hover color */
        }
        .btn-back {
             background-color: #6c757d; /* Synced secondary button color */
             border: none;
             color: white;
             font-weight: 500;
             padding: 10px 18px; /* Synced padding */
             border-radius: 8px; /* Synced radius */
             text-decoration: none;
             transition: background-color 0.3s ease;
        }
         .btn-back:hover {
             background-color: #5a6268; /* Synced hover color */
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
            <a href="{{ route('danhgia.my') }}" class="logout-link" style="color:#00bfa6; font-weight: 600;">
                <i class="fas fa-star"></i>
                <span>Đánh giá của tôi</span>
            </a>
            <div class="notification-icon">
                <i class="fa-solid fa-bell"></i>
                <span class="notification-badge">3</span> </div>
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
        <div class="edit-review-card">
            <h2>✏️ Chỉnh sửa đánh giá</h2>
            <p class="text-center text-muted mb-4">
                Trạm: <strong>{{ $danhgia->tramsac->tentram ?? 'Không rõ trạm' }}</strong>
            </p>

            <form method="POST" action="{{ route('danhgia.update', $danhgia->danhgia_id) }}"> @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="sao" class="form-label">Số sao:</label>
                    <select name="sao" id="sao" class="form-select" required>
                        <option value="5" {{ $danhgia->sao == 5 ? 'selected' : '' }}>★★★★★ (Tuyệt vời)</option>
                        <option value="4" {{ $danhgia->sao == 4 ? 'selected' : '' }}>★★★★☆ (Tốt)</option>
                        <option value="3" {{ $danhgia->sao == 3 ? 'selected' : '' }}>★★★☆☆ (Ổn)</option>
                        <option value="2" {{ $danhgia->sao == 2 ? 'selected' : '' }}>★★☆☆☆ (Tệ)</option>
                        <option value="1" {{ $danhgia->sao == 1 ? 'selected' : '' }}>★☆☆☆☆ (Rất tệ)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="noidung" class="form-label">Nội dung:</label>
                    <textarea name="noidung" id="noidung" rows="4" class="form-control" required>{{ $danhgia->noidung }}</textarea>
                </div>

                <div class="d-flex gap-2 mt-4"> <button type="submit" class="btn btn-update">
                        <i class="fas fa-save me-2"></i> Cập nhật
                    </button>
                    <a href="{{ route('danhgia.my') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left me-2"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Trạm Sạc Điện. Bản quyền thuộc về hệ thống quản lý EV.
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
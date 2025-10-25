<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Trạm Sạc Điện</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f8fafc;
        }

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
            text-transform: uppercase; /* Hiển thị chữ cái đầu */
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
            cursor: pointer; /* Đổi thành con trỏ */
        }
        .logout-link:hover {
            color: #cc0000;
        }
        /* ----- END: CSS CHO THANH HEADER MỚI ----- */

        /* Hero Banner */
        .hero-banner {
            position: relative;
            background: url('https://comlink.cdn.vccloud.vn/wp-content/uploads/2025/08/Kho-khan-ket-noi-va-tich-hop-tram-sac-xe-dien-1024x538.webp') no-repeat center center/cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .hero-banner h2 {
            font-size: 36px;
            font-weight: 700;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.4);
        }
        .hero-banner p {
            font-size: 18px;
            margin-top: 15px;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.4);
        }
        /* Feature Cards */
        .container-cards {
            max-width: 1200px;
            margin: 40px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 0 15px;
        }
        .card-feature {
            flex: 1 1 250px;
            max-width: 280px; /* Giới hạn độ rộng card */
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .card-feature:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .card-feature h3 {
            color: #00c4a7;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        .card-feature p {
            font-size: 14px;
            margin-bottom: 15px;
        }
        .card-feature a {
            display: inline-block;
            text-decoration: none;
            color: white;
            background-color: #00c4a7;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.2s;
        }
        .card-feature a:hover {
            background-color: #00a38a;
        }

        /* Statistics */
        .stats {
            background: white;
            max-width: 1200px;
            margin: 40px auto;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            padding: 30px 20px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .stat-item {
            flex: 1 1 200px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .stat-item:hover {
            transform: scale(1.05);
        }
        .stat-item h2 {
            color: #00c4a7;
            font-size: 32px;
            margin-bottom: 5px;
        }
        .stat-item p {
            font-size: 14px;
            color: #555;
        }
        /* Slider Section */
        .slider-section {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }
        .slick-slide {
            outline: none;
            padding: 0 10px; /* Thêm khoảng cách giữa các slide */
        }
        .slider-section img {
            border-radius: 16px;
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        /* Testimonials */
        .testimonials {
            max-width: 1000px;
            margin: 60px auto;
            text-align: center;
            padding: 0 15px;
        }
        .testimonials h3 {
            font-size: 28px;
            font-weight: 700;
            color: #00897b;
            margin-bottom: 30px;
        }
        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin: 10px;
        }
        .testimonial-card p {
            font-style: italic;
            color: #555;
        }
        .testimonial-card h5 {
            margin-top: 15px;
            color: #00c4a7;
        }
        /* Footer */
        footer {
            background-color: #00c4a7;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
        @media (max-width: 768px) {
            .hero-banner {
                height: 300px;
            }
            .stats {
                flex-direction: column;
            }
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
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

    
    <div class="hero-banner">
        <div>
            <h2>Trạm Sạc EV đồng hành cùng bạn</h2>
            <p>Tìm trạm, đặt chỗ và theo dõi hoạt động mọi lúc, mọi nơi.</p>
        </div>
    </div>

    <div class="container-cards">
        <div class="card-feature">
            <h3>🔍 Tìm trạm sạc</h3>
            <p>Xem danh sách các trạm sạc gần bạn.</p>
            <a href="{{ route('tramsac.index') }}">Xem trạm</a>
        </div>
        <div class="card-feature">
            <h3>⚡ Lịch sử đặt chỗ</h3>
            <p>Xem danh sách cổng sạc, trạm sạc mà bạn đã đặt.</p>
            <a href="{{ route('profile.history') }}">Xem lịch sử</a>
        </div>
        <div class="card-feature">
            <h3>⭐ Đánh giá</h3>
            <p>Viết và gửi đánh giá về trải nghiệm của bạn.</p>
            <a href="{{ route('danhgia.my') }}">Xem đánh giá</a>
        </div>
        <div class="card-feature">
            <h3>👤 Hồ sơ</h3>
            <p>Chỉnh sửa thông tin cá nhân, mật khẩu và cài đặt tài khoản.</p>
            <a href="{{ route('profile.show') }}">Quản lý hồ sơ</a>
        </div>
    </div>

    <div class="stats">
        <div class="stat-item">
            <h2>120</h2>
            <p>Trạm sạc</p>
        </div>
        <div class="stat-item">
            <h2>450</h2>
            <p>Lượt sạc hôm nay</p>
        </div>
        <div class="stat-item">
            <h2>3000</h2>
            <p>Tổng lượt sạc</p>
        </div>
        <div class="stat-item">
            <h2>50</h2>
            <p>Trạm đang hoạt động</p>
        </div>
    </div>

    <div class="slider-section">
        <div class="slider">
            <div><img src="https://greenfuture.tech/_next/image?url=https%3A%2F%2Fupload-static.fgf.vn%2Fcms%2Ftram-sac-xe-dien-VinFast-2.jpg&w=3840&q=100" alt="Trạm 1"></div>
            <div><img src="https://cms-i.autodaily.vn/du-lieu/2021/02/03/dsc-3396-copy.jpg" alt="Trạm 2"></div>
            <div><img src="https://congnghiepmoitruong.vn/stores/news_dataimages/nguyenquang/062023/01/16/76677e605ffca1d012e6536cedbf8bf0.jpg?rt=20230601163515" alt="Trạm 3"></div>
        </div>
    </div>

    <div class="testimonials">
        <h3>Khách hàng nói về chúng tôi</h3>
        <div class="slider-testimonial">
            <div class="testimonial-card">
                <p>"Hệ thống đặt chỗ trạm sạc quá tiện lợi, tiết kiệm thời gian."</p>
                <h5>Nguyễn Văn A</h5>
            </div>
            <div class="testimonial-card">
                <p>"Dễ dàng quản lý và theo dõi lượt sạc, giao diện rất thân thiện."</p>
                <h5>Trần Thị B</h5>
            </div>
            <div class="testimonial-card">
                <p>"Rất hài lòng với dịch vụ, đội ngũ hỗ trợ nhanh chóng và chuyên nghiệp."</p>
                <h5>Lê Văn C</h5>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Trạm Sạc Điện. Bản quyền thuộc về hệ thống quản lý EV.
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 3000,
                centerMode: true,
                variableWidth: true
            });
            $('.slider-testimonial').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 4000
            });
        });
    </script>
</body>
</html>
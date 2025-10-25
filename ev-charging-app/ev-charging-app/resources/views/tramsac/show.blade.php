<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết trạm sạc - {{ $tram->tentram }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obZ3Dpkdk=" crossorigin=""/>

    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- TOP BAR --- */
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

        /* --- STATION DETAIL --- */
        .station-detail-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            padding: 30px;
            margin-bottom: 20px;
        }
        .station-info h1 {
            font-weight: 700;
            font-size: 2rem;
            color: #1c1c1c;
            margin-bottom: 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 15px;
        }
        .status-active { background-color: #28a745; }
        .status-inactive { background-color: #6c757d; }
        .info-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }
        .info-list li {
            font-size: 1rem;
            color: #555;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }
        .info-list .fas {
            color: #00c4a7;
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }
        .station-image-wrapper {
            border-radius: 12px;
            overflow: hidden;
        }
        .station-image-wrapper img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        /* --- MAP --- */
        .map-container {
            height: 300px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
        }
        .map-link {
            display: inline-block;
            color: #00c4a7;
            text-decoration: none;
            font-weight: 600;
            margin-top: 10px;
        }
        .map-link:hover {
            text-decoration: underline;
        }
        .leaflet-popup-content {
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .leaflet-popup-content h6 {
            color: #00c4a7;
            margin: 0 0 5px 0;
        }
        .leaflet-popup-content p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* --- PORTS LIST --- */
        .ports-list-container {
            margin-top: 40px;
        }
        .ports-list-container h3 {
            font-weight: 600;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .port-grid-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 15px;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        .port-card {
            display: flex;
            flex-direction: column;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 4px solid rgba(0,0,0,0.2);
            min-height: 110px;
            word-wrap: break-word;
        }
        .port-card strong {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: #424242;
        }
        .port-card .port-detail {
            font-size: 0.85rem;
            font-weight: 500;
            opacity: 0.9;
            line-height: 1.4;
            color: #424242;
        }
        .port-card .port-detail .fas {
            margin-right: 5px;
        }
        .port-card.available.type-fast {
            background-color: #E57373;
            border-bottom-color: #F48FB1;
            cursor: pointer;
        }
        .port-card.available.type-fast:hover {
            background-color: #F48FB1;
            transform: translateY(-2px);
        }
        .port-card.available.type-slow {
            background-color: #60C4B0;
            border-bottom-color: #7986CB;
            cursor: pointer;
        }
        .port-card.available.type-slow:hover {
            background-color: #7986CB;
            transform: translateY(-2px);
        }
        .port-card.busy {
            background-color: #B0BEC5;
            color: #616161;
            border-bottom-color: #90A4AE;
            cursor: not-allowed;
        }
        .port-card.busy strong,
        .port-card.busy .port-detail {
            color: #616161;
        }
        .port-legend {
            margin-top: 25px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #eee;
        }
        .legend-item {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }
        .legend-box {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        /* --- FOOTER --- */
        footer {
            background-color: #00c4a7;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 1200px) {
            .port-grid-container {
                grid-template-columns: repeat(5, 1fr);
            }
        }
        @media (max-width: 992px) {
            .port-grid-container {
                grid-template-columns: repeat(4, 1fr);
            }
            .map-container {
                height: 250px;
            }
        }
        @media (max-width: 768px) {
            .station-detail-card {
                padding: 20px;
            }
            .port-grid-container {
                grid-template-columns: repeat(3, 1fr);
            }
            .map-container {
                height: 200px;
            }
        }
        @media (max-width: 576px) {
            .port-grid-container {
                grid-template-columns: repeat(2, 1fr);
            }
            .station-info h1 {
                font-size: 1.5rem;
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
            <a href="{{ route('dashboard') }}" class="logout-link" style="color:#00c4a7; font-weight: 600;">
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

    <div class="container my-5">
        <div class="station-detail-card">
            <div class="row">
                <div class="col-md-6">
                    <div class="station-image-wrapper">
                        @if($tram->hinhanh_url)
                            <img src="{{ $tram->hinhanh_url }}" alt="Ảnh trạm sạc {{ $tram->tentram }}" class="img-fluid">
                        @else
                            <img src="https://via.placeholder.com/600x400.png/00bfa6/FFFFFF?text=EV+Station" alt="Ảnh mặc định" class="img-fluid">
                        @endif
                    </div>
                    <!-- <div class="map-container" id="map"></div> -->
                    <a href="https://www.openstreetmap.org/?mlat={{ $tram->toado_lat }}&mlon={{ $tram->toado_lng }}#map=15/{{ $tram->toado_lat }}/{{ $tram->toado_lng }}" target="_blank" class="map-link">
                        <i class="fas fa-map-marked-alt"></i> Xem trên OpenStreetMap
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="station-info">
                        @if($tram->trangthai == 'hoatdong')
                            <span class="status-badge status-active">Đang hoạt động</span>
                        @else
                            <span class="status-badge status-inactive">Đang bảo trì</span>
                        @endif
                        <h1>{{ $tram->tentram }}</h1>
                        <ul class="info-list">
                            <li><i class="fas fa-map-marker-alt"></i> <strong>Địa chỉ:</strong> {{ $tram->diachi }}</li>
                            <li><i class="fas fa-charging-station"></i> <strong>Loại trạm:</strong> {{ $tram->loaitram }}</li>
                            <li><i class="fas fa-plug"></i> <strong>Tổng số cổng:</strong> {{ $tram->soluong_congsac }}</li>
                            <li><i class="fas fa-star"></i> <strong>Đánh giá:</strong> ⭐ {{ $tram->trung_binh_sao ?? 'Chưa có đánh giá' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="ports-list-container">
                        <h3><i class="fas fa-th"></i> Sơ đồ cổng sạc</h3>
                        <div class="port-grid-container">
                            @forelse($tram->congsacs as $cong)
                                @php
                                    $isBusy = $cong->trangthai !== 'trong';
                                    $isFast = $cong->congsuat >= 50;
                                    $cardClasses = 'port-card ';
                                    if ($isBusy) {
                                        $cardClasses .= 'busy';
                                    } else {
                                        $cardClasses .= 'available ';
                                        $cardClasses .= $isFast ? 'type-fast' : 'type-slow';
                                    }
                                    $href = $isBusy ? '#' : route('datcho.create', ['tram_id' => $tram->tramsac_id, 'cong_id' => $cong->congsac_id]);
                                    $tag = $isBusy ? 'span' : 'a';
                                @endphp
                                <{{ $tag }} href="{{ $href }}" class="{{ $cardClasses }}" @if($isBusy) disabled @endif>
                                    <strong>{{ $cong->tencong }}</strong>
                                    <div class="port-detail">
                                        <div><i class="fas fa-bolt"></i> {{ $cong->loaicong }}</div>
                                        <div><i class="fas fa-tachometer-alt"></i> {{ $cong->congsuat }} kW</div>
                                    </div>
                                </{{ $tag }}>
                            @empty
                                <p style="grid-column: 1 / -1; text-align: center;">Trạm này hiện chưa có thông tin cổng sạc.</p>
                            @endforelse
                        </div>
                        <div class="port-legend mt-4">
                            <div class="legend-item">
                                <span class="legend-box" style="background-color: #E57373;"></span> Sạc nhanh (Trống)
                            </div>
                            <div class="legend-item">
                                <span class="legend-box" style="background-color: #60C4B0;"></span> Sạc thường (Trống)
                            </div>
                            <div class="legend-item">
                                <span class="legend-box" style="background-color: #B0BEC5;"></span> Đang bận / Đã đặt
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('tramsac.index') }}" class="back-link"><i class="fas fa-arrow-left"></i> Quay lại danh sách trạm</a>
    </div>

    <footer>
        &copy; 2025 Trạm Sạc Điện. Bản quyền thuộc về hệ thống quản lý EV.
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCt0YxImZJDEc4gXz2U0K0nF3r0U0K0nF3r0U0K0=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([{{ $tram->toado_lat }}, {{ $tram->toado_lng }}], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 18
            }).addTo(map);

            const markerIcon = L.divIcon({
                className: 'custom-icon',
                html: '<i class="fas fa-charging-station" style="color: #00c4a7; font-size: 24px;"></i>',
                iconSize: [30, 30],
                iconAnchor: [15, 30],
                popupAnchor: [0, -30]
            });

            const marker = L.marker([{{ $tram->toado_lat }}, {{ $tram->toado_lng }}], { icon: markerIcon }).addTo(map);
            
            marker.bindPopup(`
                <div>
                    <h6>${"{{ $tram->tentram }}"}</h6>
                    <p>${"{{ $tram->diachi }}"}</p>
                    <p style="color: ${"{{ $tram->trangthai == 'hoatdong' ? '#28a745' : '#6c757d' }}"}">
                        ${"{{ $tram->trangthai == 'hoatdong' ? 'Đang hoạt động' : 'Đang bảo trì' }}"}
                    </p>
                </div>
            `).openPopup();
        });

        function confirmLogout(event) {
            event.preventDefault();
            if (confirm('Bạn có chắc chắn muốn đăng xuất không?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>
</html>
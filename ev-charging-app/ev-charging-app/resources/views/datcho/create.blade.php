<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt chỗ sạc - Trạm Sạc EV</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- Base Styles --- */
        html, body {
            height: 100%; /* Needed for flex column layout */
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            color: #333;
            display: flex; /* Make body a flex container */
            flex-direction: column; /* Stack header, content, footer vertically */
            margin: 0; /* Remove default body margin */
        }
        .main-content {
             flex-grow: 1; /* Allow content to take available space */
             padding-bottom: 50px; /* Add some space above footer */
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
            flex-shrink: 0; /* Prevent header from shrinking */
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
        .nav-link-custom { /* Style for Dashboard/My Reviews links */
             text-decoration: none;
             color: #00bfa6;
             font-weight: 600;
             display: flex;
             align-items: center;
             gap: 0.4rem;
        }
         .nav-link-custom:hover {
             color: #00897b;
         }

        /* --- Footer Styles --- */
        footer {
            background-color: #00c4a7;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto; /* Push footer to bottom */
            flex-shrink: 0; /* Prevent footer from shrinking */
        }


        /* --- Main Booking Card --- */
        .booking-card {
            max-width: 750px;
            margin: 40px auto 0 auto; /* Add top margin */
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }

        /* --- Station Info Block --- */
        .station-info-block {
            background-color: #f0fdfa;
            border-left: 5px solid #00bfa6;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            position: relative;
        }
        .station-info-block h5 { font-weight: 600; margin-bottom: 15px; color: #1a1a1a; }
        .station-info-block p { margin-bottom: 5px; color: #555; font-size: 0.95rem; }
        .station-info-block strong { color: #00897b; display: inline-block; width: 80px; }
        .btn-change-station { position: absolute; top: 20px; right: 20px; background-color: #e0f7f3; color: #00897b; border: 1px solid #b2dfdb; border-radius: 6px; padding: 5px 12px; font-size: 0.85rem; font-weight: 500; text-decoration: none; transition: all 0.3s ease; }
        .btn-change-station:hover { background-color: #b2dfdb; color: #004d40; }

        /* --- Section Titles --- */
        .section-title { font-weight: 600; color: #1a1a1a; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid #eee; font-size: 1.1rem; }
        
        /* --- Form Elements --- */
        .form-label { font-weight: 500; color: #555; margin-bottom: 6px; font-size: 0.9rem; }
        .form-control, .form-select { border-radius: 6px; border: 1px solid #ced4da; padding: 10px 12px; font-size: 0.95rem; }
        .form-control:focus, .form-select:focus { border-color: #00bfa6; box-shadow: 0 0 0 0.2rem rgba(0, 191, 166, 0.25); }
        input[type="datetime-local"] { position: relative; }

        /* --- Info Bar --- */
        .info-bar { background-color: #e6f7ff; border: 1px solid #91d5ff; color: #1890ff; padding: 10px 15px; border-radius: 6px; margin-top: 5px; font-size: 0.9rem; display: flex; align-items: center; }
        .info-bar .fa-info-circle { margin-right: 10px; font-size: 1.1rem; }
        .info-bar span { margin-right: 15px; }

        /* --- Buttons --- */
        .action-buttons { display: flex; gap: 15px; margin-top: 30px; }
        .btn-back { background-color: #f0f0f0; color: #555; border: 1px solid #ccc; font-weight: 500; padding: 10px 20px; border-radius: 6px; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; }
        .btn-back:hover { background-color: #e0e0e0; border-color: #bbb; color: #333; }
        .btn-confirm { background-color: #00bfa6; color: white; border: none; font-weight: 600; padding: 10px 20px; border-radius: 6px; transition: background-color 0.3s ease; flex-grow: 1; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-confirm:hover { background-color: #009e8c; }
        .btn-confirm:disabled { background-color: #adb5bd; cursor: not-allowed; }

        /* --- Alert Messages --- */
        .alert { padding: 12px 15px; border-radius: 6px; margin-top: 20px; text-align: center; font-weight: 500; border: 1px solid transparent; }
        .alert-success { background: #d1e7dd; color: #0f5132; border-color: #badbcc; }
        .alert-danger { background: #f8d7da; color: #842029; border-color: #f5c2c7; }

        /* === MỚI: CSS CHO CHỌN PHƯƠNG THỨC THANH TOÁN === */
        .payment-method-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 10px;
        }
        .payment-option input[type="radio"] {
            display: none; /* Ẩn radio button gốc */
        }
        .payment-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            height: 100%;
            text-align: center;
        }
        .payment-option label i {
            font-size: 2rem;
            color: #00bfa6;
            margin-bottom: 10px;
        }
        .payment-option label span {
            font-weight: 600;
            font-size: 0.95rem;
            color: #333;
        }
        /* Style khi được chọn */
        .payment-option input[type="radio"]:checked + label {
            border-color: #00bfa6;
            background-color: #f0fdfa;
            box-shadow: 0 0 10px rgba(0, 191, 166, 0.1);
        }
        .payment-option input[type="radio"]:checked + label span {
            color: #007a6e;
        }


        /* === MỚI: CSS CHO KHỐI MÃ QR === */
        .payment-qr-container {
            display: none; /* Ẩn mặc định */
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        .payment-qr-container.show {
            display: flex; /* Hiển thị khi được chọn */
        }
        .qr-code-image {
            max-width: 100%;
            width: 250px; /* Kích thước cố định cho QR */
            height: auto;
            border-radius: 8px;
            background-color: #eee; /* Nền placeholder */
            margin-bottom: 15px;
            border: 1px solid #ccc;
            aspect-ratio: 1 / 1; /* Giữ tỷ lệ vuông */
        }
        .qr-instructions {
            font-weight: 500;
            color: #333;
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 15px;
        }
        .qr-app-logos {
            display: flex;
            gap: 10px;
            filter: grayscale(80%);
            opacity: 0.8;
        }
         .qr-app-logos img {
            height: 20px;
         }
        
        .qr-amount {
            font-size: 1.1rem;
            font-weight: 600;
            color: #d9534f; /* Màu đỏ cho số tiền */
            margin-top: 15px;
        }
        /* === KẾT THÚC CSS MỚI === */

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
            <a href="{{ route('dashboard') }}" class="nav-link-custom">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
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
            <a href="#" onclick="confirmLogout(event)" class="logout-link">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>
    
    <div class="main-content">
        <div class="booking-card">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form id="datchoForm" method="POST" action="{{ route('datcho.store') }}">
                @csrf
                <input type="hidden" name="tram_id" value="{{ $tram->tramsac_id }}">
                <input type="hidden" name="cong_id" value="{{ $cong->congsac_id }}">

                <div class="station-info-block">
                    <h5>{{ $tram->tentram }}</h5>
                    <p><strong>Địa chỉ:</strong> {{ $tram->diachi }}</p>
                    <p><strong>Cổng sạc:</strong> {{ $cong->tencong }} ({{ $cong->loaicong }})</p>
                    <p><strong>Công suất:</strong> {{ $cong->congsuat }} kW</p>
                    <a href="{{ route('tramsac.index') }}" class="btn-change-station">Chọn trạm khác</a>
                </div>

                <div class="mb-4">
                    <h6 class="section-title">Thời gian đặt chỗ</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="timebatdau" class="form-label">Thời gian bắt đầu</label>
                            <input type="datetime-local" class="form-control" id="timebatdau" name="timebatdau" required>
                        </div>
                        <div class="col-md-6">
                            <label for="timeketthuc" class="form-label">Thời gian kết thúc</label>
                            <input type="datetime-local" class="form-control" id="timeketthuc" name="timeketthuc" required>
                        </div>
                    </div>
                    <div class="info-bar mt-2" id="infoBar">
                        <i class="fas fa-info-circle"></i>
                        <span id="duration_preview">Thời lượng: 0 giờ</span>
                        <span id="sotien_preview_text">Số tiền dự kiến: 0 VND</span>
                    </div>
                </div>

                <!-- === MỚI: KHỐI CHỌN THANH TOÁN BẰNG RADIO === -->
                <div class="mb-4">
                     <h6 class="section-title">Phương thức thanh toán</h6>
                     <div class="payment-method-options">
                        <!-- Option 1: Tiền mặt -->
                        <div class="payment-option">
                            <input type="radio" id="pay-tienmat" name="phuongthuc_thanhtoan" value="tienmat" checked>
                            <label for="pay-tienmat">
                                <i class="fas fa-money-bill-wave"></i>
                                <span>Tiền mặt</span>
                            </label>
                        </div>
                        <!-- Option 2: Bank QR -->
                        <div class="payment-option">
                            <input type="radio" id="pay-bankqr" name="phuongthuc_thanhtoan" value="bank_qr">
                            <label for="pay-bankqr">
                                <i class="fas fa-qrcode"></i>
                                <span>Chuyển khoản / Quét QR</span>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- === KẾT THÚC KHỐI RADIO === -->

                
                <!-- === MỚI: KHỐI QR NGÂN HÀNG (VIETQR) === -->
                <div id="bank-qr-container" class="payment-qr-container">
                    <p class="qr-instructions">
                        Sử dụng App Ngân hàng hoặc Ví điện tử (Momo, ZaloPay...) để quét mã VietQR
                    </p>
                    <!-- 
                      Sử dụng link Google Drive của bạn. 
                      Thêm onerror để phòng trường hợp link lỗi hoặc cần quyền truy cập.
                    -->
                    <img src="https://api.vietqr.io/image/970422-090xxxxxxx-RFqYQWJ.png?accountName=USER%20NAME&amount=10000" 
                         alt="VietQR Code" 
                         class="qr-code-image"
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/250x250.png?text=Lỗi+tải+ảnh+QR'; this.style.border='2px dashed red';">
                    
                    <div class="qr-app-logos">
                        <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-MoMo-Square.png" alt="Momo">
                        <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-ZaloPay-Square-1024x1024.png" alt="ZaloPay">
                        <img src="https://vinadesign.vn/uploads/images/2023/05/vnpay-logo-vinadesign-25-12-57-55.jpg" alt="VNPay">
                        <img src="https://miro.medium.com/max/1200/0*KzqxLvnc2k4tWGj0.jpg" alt="Vietcombank">
                    </div>

                    <div class="qr-amount">
                        Số tiền: <span id="bank-qr-amount">0 VND</span>
                    </div>
                </div>
                <!-- === KẾT THÚC KHỐI QR === -->
                 
                 <input type="hidden" id="sotien_hidden" name="sotien_dukien" value="0">
                 
                 <div id="availabilityMessage" class="alert" style="display:none; margin-top: 0; margin-bottom: 20px;"></div>

                <div class="action-buttons">
                     <!-- <a href="{{ route('tramsac.show', $tram->tramsac_id) }}" class="btn btn-back">
                          <i class="fas fa-arrow-left"></i> Quay lại
                     </a> -->
                     <button type="submit" class="btn btn-confirm" disabled>
                          <i class="fas fa-check"></i> Xác nhận đặt chỗ
                     </button>
                </div>
            </form>

        </div> </div> <footer>
        &copy; {{ date('Y') }} Trạm Sạc Điện. Bản quyền thuộc về hệ thống quản lý EV.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm('Bạn có chắc chắn muốn đăng xuất không?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Constants and Elements ---
        const congSuat = {{ $cong->congsuat }};
        const giaDien = 5000; 

        const timeStartInput = document.getElementById('timebatdau');
        const timeEndInput = document.getElementById('timeketthuc');
        const durationPreview = document.getElementById('duration_preview');
        const sotienPreviewText = document.getElementById('sotien_preview_text');
        const sotienHiddenInput = document.getElementById('sotien_hidden');
        const availabilityMessage = document.getElementById('availabilityMessage');
        const form = document.getElementById('datchoForm');
        const submitButton = form.querySelector('button[type="submit"]');

        // === MỚI: LẤY CÁC ELEMENT CỦA QR CODE ===
        const paymentMethodRadios = document.querySelectorAll('input[name="phuongthuc_thanhtoan"]');
        const bankQRContainer = document.getElementById('bank-qr-container');
        const bankQRAmount = document.getElementById('bank-qr-amount');
        
        // --- Functions ---
        function tinhTienVaThoiLuong() {
            const start = new Date(timeStartInput.value);
            const end = new Date(timeEndInput.value);
            
            // Lấy giá trị từ radio button đang được chọn
            const selectedMethod = document.querySelector('input[name="phuongthuc_thanhtoan"]:checked').value;

            let durationText = "Thời lượng: 0 giờ";
            let costText = "Số tiền dự kiến: 0 VND";
            let calculatedCost = 0;
            let diffHours = 0;

            if (!isNaN(start) && !isNaN(end) && end > start) {
                const diffMillis = end - start;
                diffHours = diffMillis / (1000 * 60 * 60);
                durationText = `Thời lượng: ${diffHours.toFixed(1).replace('.', ',')} giờ`;
                calculatedCost = congSuat * diffHours * giaDien;
                
                // Cập nhật logic giảm giá dựa trên radio button
                if (selectedMethod !== 'tienmat') { 
                    calculatedCost *= 0.98; // Giảm 2% cho thanh toán online/QR
                }
                calculatedCost = Math.round(calculatedCost);
                costText = `Số tiền dự kiến: ${new Intl.NumberFormat('vi-VN').format(calculatedCost)} VND`;
            } 
            
            const formattedCost = new Intl.NumberFormat('vi-VN').format(calculatedCost) + ' VND';
            
            // Cập nhật thông tin chung
            durationPreview.textContent = durationText;
            sotienPreviewText.textContent = costText;
            sotienHiddenInput.value = calculatedCost;
            
            // Cập nhật số tiền trong khối QR
            bankQRAmount.textContent = formattedCost;
        }
        
        // === MỚI: HÀM HIỂN THỊ/ẨN MÃ QR ===
        function updatePaymentDisplay() {
            const selectedMethod = document.querySelector('input[name="phuongthuc_thanhtoan"]:checked').value;
            
            if (selectedMethod === 'bank_qr') {
                bankQRContainer.classList.add('show');
            } else {
                bankQRContainer.classList.remove('show');
            }
        }
        // === KẾT THÚC HÀM MỚI ===

        function checkAvailability() {
            const startValue = timeStartInput.value;
            const endValue = timeEndInput.value;
            const cong_id = {{ $cong->congsac_id }};

            if (!startValue || !endValue || new Date(endValue) <= new Date(startValue)) {
                availabilityMessage.style.display = 'none'; 
                submitButton.disabled = true; 
                return;
            }
            
            fetch("{{ route('datcho.checkAvailability') }}", {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    congsac_id: cong_id, 
                    start: startValue, 
                    end: endValue 
                })
            })
            .then(response => {
                if (!response.ok) { throw new Error('Network response error'); }
                return response.json();
             })
            .then(res => {
                availabilityMessage.style.display = 'block';
                if (res.available) {
                    availabilityMessage.className = 'alert alert-success';
                    availabilityMessage.innerHTML = '<i class="fas fa-check-circle me-2"></i>Cổng sạc sẵn sàng cho khung giờ này.';
                    submitButton.disabled = false;
                } else {
                    availabilityMessage.className = 'alert alert-danger';
                    availabilityMessage.innerHTML = '<i class="fas fa-times-circle me-2"></i>Cổng sạc đã có người đặt. Vui lòng chọn thời gian khác.';
                    submitButton.disabled = true;
                }
            })
            .catch(error => {
                console.error('Availability check error:', error);
                availabilityMessage.className = 'alert alert-danger';
                availabilityMessage.textContent = 'Lỗi khi kiểm tra tình trạng cổng sạc. Vui lòng thử lại.';
                availabilityMessage.style.display = 'block';
                submitButton.disabled = true;
            });
        }

        // --- Event Listeners ---
        timeStartInput.addEventListener('change', () => {
            tinhTienVaThoiLuong(); 
            checkAvailability();
        });
        timeEndInput.addEventListener('change', () => {
            tinhTienVaThoiLuong(); 
            checkAvailability();
        });
        
        // === MỚI: Thêm listener cho TẤT CẢ radio button ===
        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                tinhTienVaThoiLuong(); // Tính lại tiền (vì có thể có chiết khấu)
                updatePaymentDisplay(); // Hiển thị/ẩn mã QR
            });
        });
        
        // === MỚI: Chạy hàm một lần khi tải trang để đảm bảo trạng thái đúng ===
        tinhTienVaThoiLuong();
        updatePaymentDisplay();
    });
    </script>

</body>
</html>

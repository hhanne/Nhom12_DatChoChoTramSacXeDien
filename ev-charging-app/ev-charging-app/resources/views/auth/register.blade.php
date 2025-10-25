<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Trạm Sạc EV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0fcf9, #f0fdfa);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0; /* Thêm padding trên/dưới cho form dài */
        }

        .register-wrapper {
            display: flex;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 950px; /* Tăng độ rộng để chứa form 2 cột */
            width: 100%;
            margin: 20px;
        }

        .register-left, .register-right {
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-left {
            background: #f0fdfa;
            text-align: center;
            align-items: center;
            flex-basis: 40%; /* Cột trái chiếm 40% */
        }

        .register-left img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        .register-left h2 {
            font-size: 24px;
            font-weight: 700;
            color: #00897b;
            margin-bottom: 8px;
        }

        .register-left p {
            color: #555;
            font-size: 14px;
        }
        
        .register-left .dots {
            margin-top: 20px;
        }
        .register-left .dots span {
            width:10px;height:10px;background:#00bfa6;border-radius:50%;display:inline-block;margin:0 4px;
        }

        .register-right {
            flex-basis: 60%; /* Cột form chiếm 60% */
        }

        .register-right h3 {
            font-weight: 700;
            color: #1c1c1c;
            margin-bottom: 20px;
            text-align: left;
        }

        /* Dùng label thay vì placeholder cho form nhiều trường */
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-size: 14px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #00bfa6;
            padding: 10px 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        /* Căn chỉnh cho input date */
        .form-control[type="date"] {
            color: #555;
        }

        .form-control:focus, .form-select:focus {
            border-color: #00d4b4;
            box-shadow: 0 0 0 0.2rem rgba(0, 191, 166, 0.25);
            outline: none;
        }
        
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;
        }

        .btn-register {
            width: 100%;
            background: linear-gradient(to right, #00bfa6, #00d4b4);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: linear-gradient(to right, #00a08b, #00c1a1);
        }

        .login-text {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .login-text a {
            color: #00bfa6;
            text-decoration: none;
            font-weight: 600;
        }
        .login-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .register-wrapper {
                flex-direction: column;
            }
            .register-left, .register-right {
                flex-basis: auto;
            }
        }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-left">
            <img src="https://cdn-icons-png.flaticon.com/512/9448/9448853.png" alt="Logo">
            <h2>Chào mừng bạn!</h2>
            <p>Tạo tài khoản để bắt đầu đặt chỗ sạc.</p>
            <div class="dots">
                <span></span><span></span><span></span>
            </div>
        </div>
        
        <div class="register-right">
            <h3>Tạo tài khoản</h3>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hoten">{{ __('Họ tên') }}</label>
                            <input id="hoten" type="text" class="form-control @error('hoten') is-invalid @enderror" name="hoten" value="{{ old('hoten') }}" required autofocus>
                            @error('hoten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sdt">{{ __('Số điện thoại') }}</label>
                            <input id="sdt" type="text" class="form-control @error('sdt') is-invalid @enderror" name="sdt" value="{{ old('sdt') }}">
                            @error('sdt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gioitinh">{{ __('Giới tính') }}</label>
                            <select id="gioitinh" name="gioitinh" class="form-select @error('gioitinh') is-invalid @enderror">
                                <option value="Nam" {{ old('gioitinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ old('gioitinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            </select>
                            @error('gioitinh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ngaysinh">{{ __('Ngày sinh') }}</label>
                            <input id="ngaysinh" type="date" class="form-control @error('ngaysinh') is-invalid @enderror" name="ngaysinh" value="{{ old('ngaysinh') }}">
                            @error('ngaysinh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="diachi">{{ __('Địa chỉ') }}</label>
                    <input id="diachi" type="text" class="form-control @error('diachi') is-invalid @enderror" name="diachi" value="{{ old('diachi') }}">
                    @error('diachi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">{{ __('Mật khẩu') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Xác nhận mật khẩu') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    {{ __('Đăng ký') }}
                </button>
                
                <p class="login-text">
                    {{ __('Đã có tài khoản?') }}
                    <a href="{{ route('login') }}">
                        {{ __('Đăng nhập ngay') }}
                    </a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
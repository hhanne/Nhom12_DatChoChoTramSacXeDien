<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập - Trạm Sạc EV</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Thêm Google Font Poppins (từ mẫu) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0fcf9, #f0fdfa);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .login-wrapper {
      display: flex;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      overflow: hidden;
      max-width: 900px;
      width: 100%;
    }

    .login-left, .login-right {
      padding: 40px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-left {
      background: #f0fdfa;
      text-align: center;
      align-items: center;
    }

    .login-left img {
      width: 80px;
      height: 80px;
      margin-bottom: 20px;
    }

    .login-left h2 {
      font-size: 24px;
      font-weight: 700;
      color: #00897b;
      margin-bottom: 8px;
    }

    .login-left p {
      color: #555;
      font-size: 14px;
    }
    
    .login-left .dots {
        margin-top: 20px;
    }
    .login-left .dots span {
        width:10px;height:10px;background:#00bfa6;border-radius:50%;display:inline-block;margin:0 4px;
    }

    .login-right {
      max-width: 450px; /* Tăng nhẹ độ rộng để vừa các thông báo lỗi */
    }

    .login-right h3 {
      font-weight: 700;
      color: #1c1c1c;
      margin-bottom: 10px;
      text-align: left;
    }

    .login-right p.subtitle {
      color: #555;
      font-size: 14px;
      margin-bottom: 25px;
      text-align: left;
    }

    .form-control {
      border-radius: 10px;
      border: 1.5px solid #00bfa6;
      padding: 10px 12px;
      font-size: 15px;
      /* Bỏ margin-bottom mặc định để kiểm soát bằng div bọc ngoài */
    }

    .form-control:focus {
      border-color: #00d4b4;
      box-shadow: 0 0 0 0.2rem rgba(0, 191, 166, 0.25);
    }
    
    /* CSS cho thông báo lỗi validation của Laravel */
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    .invalid-feedback {
        display: block; /* Luôn hiển thị nếu có */
        width: 100%;
        margin-top: .25rem;
        font-size: .875em;
        color: #dc3545;
    }
    
    /* CSS cho thông báo session (ví dụ: đặt lại mật khẩu thành công) */
    .session-status {
        font-size: 14px;
        color: #0f5132;
        background-color: #d1e7dd;
        padding: 10px 15px;
        border: 1px solid #badbcc;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: left;
    }

    .btn-login {
      width: 100%;
      background: linear-gradient(to right, #00bfa6, #00d4b4);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
      margin-top: 10px; /* Thêm khoảng cách với mục bên trên */
    }

    .btn-login:hover {
      background: linear-gradient(to right, #00a08b, #00c1a1);
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      margin-bottom: 20px; /* Tăng khoảng cách */
    }
    
    .options label {
        font-weight: 500;
        color: #555;
    }

    .options a {
      color: #00bfa6;
      text-decoration: none;
    }

    .options a:hover {
      text-decoration: underline;
    }
    
    .register-text {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }

    @media (max-width: 768px) {
      .login-wrapper {
        flex-direction: column;
      }
      .login-left, .login-right {
        max-width: 100%;
        padding: 30px;
      }
    }
  </style>
</head>
<body>
  <div class="login-wrapper">
    <div class="login-left">
      <img src="https://cdn-icons-png.flaticon.com/512/9448/9448853.png" alt="Logo">
      <h2>Trạm Sạc EV</h2>
      <p>Hệ thống đặt chỗ cho trạm sạc</p>
      <div class="dots">
        <span></span><span></span><span></span>
      </div>
    </div>
    
    <div class="login-right">
      <h3>Xin chào</h3>
      <p class="subtitle">Đăng nhập để đặt chỗ nhé!</p>

      <!-- Tích hợp Session Status của Laravel -->
      <x-auth-session-status class="session-status" :status="session('status')" />

      <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <!-- Email Address -->
        <div class="mb-3">
          <input id="email" type="email" 
                 class="form-control @error('email') is-invalid @enderror" 
                 name="email" 
                 value="{{ old('email') }}" 
                 placeholder="Email" 
                 required autofocus autocomplete="username">
                 
          <!-- Tích hợp Input Error của Laravel -->
          @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
          <input id="password" type="password"
                 class="form-control @error('password') is-invalid @enderror"
                 name="password"
                 placeholder="Mật khẩu"
                 required autocomplete="current-password">
                 
          <!-- Tích hợp Input Error của Laravel -->
          @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="options">
          <div class="form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label" for="remember_me">{{ __('Ghi nhớ đăng nhập') }}</label>
          </div>
          
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
              {{ __('Quên mật khẩu?') }}
            </a>
          @endif
        </div>

        <!-- Nút Đăng nhập -->
        <button type="submit" class="btn-login">
            {{ __('Đăng nhập') }}
        </button>
        
        <!-- Link Đăng ký -->
        <p class="register-text">
          Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
@extends('layouts.xacthuc')

@section('title', 'Đăng nhập')

@section('content')
<style>
    /* Override và bổ sung style cho form đăng nhập */
    .logo-container {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .logo-img {
        max-width: 100px;
        height: auto;
        transition: transform 0.3s ease;
    }
    
    .logo-img:hover {
        transform: scale(1.05);
    }
    
    h2 {
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        font-size: 1.75rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }
    
    .form-label i {
        margin-right: 0.5rem;
        color: #667eea;
        font-size: 1.1rem;
    }
    
    .form-control {
        border: 2px solid #e8e8e8;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        font-size: 0.95rem;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.08);
        background: white;
        outline: none;
    }
    
    .form-control::placeholder {
        color: #aaa;
        font-size: 0.9rem;
    }
    
    .input-group {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        z-index: 10;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        padding: 0.25rem;
    }
    
    .password-toggle:hover {
        color: #667eea;
        transform: translateY(-50%) scale(1.15);
    }
    
    .password-field {
        padding-right: 3rem !important;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 0.85rem 1rem;
        font-weight: 600;
        font-size: 1rem;
        width: 100%;
        margin-top: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
    
    .btn-primary:active {
        transform: translateY(0);
    }
    
    .form-check {
        display: flex;
        align-items: center;
    }
    
    .form-check-input {
        cursor: pointer;
        width: 1.1rem;
        height: 1.1rem;
        margin-top: 0;
    }
    
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
    
    .form-check-label {
        color: #555;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        margin-left: 0.25rem;
    }
    
    .forgot-password-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .forgot-password-link:hover {
        color: #764ba2;
        text-decoration: underline;
    }
    
    .remember-forgot-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        gap: 1rem;
    }
    
    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 1.5rem;
        padding: 1rem 1.25rem;
        animation: slideDown 0.4s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .alert i {
        font-size: 1.2rem;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #fff5f5 0%, #ffe5e5 100%);
        color: #c53030;
        border-left: 4px solid #c34a4aff;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        color: #15803d;
        border-left: 4px solid #4ade80;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.35rem;
        color: #dc3545;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    
    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
    }
    
    /* Responsive */
    @media (max-width: 576px) {
        h2 {
            font-size: 1.5rem;
        }
        
        .logo-img {
            max-width: 80px;
        }
        
        .remember-forgot-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .forgot-password-link {
            align-self: flex-end;
        }
    }
    
    /* Smooth transitions for all interactive elements */
    * {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>

<div class="logo-container">
    <img src="https://png.pngtree.com/png-vector/20250122/ourmid/pngtree-ev-electric-vehicle-charge-charging-station-sign-vector-png-image_15303556.png" 
         alt="EV Charging Station Logo" 
         class="logo-img">
</div>

<h2>Đăng Nhập</h2>

{{-- Hiển thị thông báo lỗi nếu có --}}
@if(session('error'))
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle-fill"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<form action="{{ route('login') }}" method="POST" id="loginForm">
    @csrf
    
    <div class="mb-3">
        <label for="email" class="form-label">
            <i class="bi bi-envelope-fill"></i>
            Email
        </label>
        <input type="email" 
               class="form-control @error('email') is-invalid @enderror" 
               id="email" 
               name="email" 
               placeholder="example@email.com" 
               value="{{ old('email') }}"
               autocomplete="email"
               required>
        @error('email')
            <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle"></i>
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">
            <i class="bi bi-lock-fill"></i>
            Mật khẩu
        </label>
        <div class="input-group">
            <input type="password" 
                   class="form-control password-field @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   placeholder="Nhập mật khẩu của bạn"
                   autocomplete="current-password"
                   required>
            <span class="password-toggle" id="togglePassword">
                <i class="bi bi-eye"></i>
            </span>
        </div>
        @error('password')
            <div class="invalid-feedback d-block">
                <i class="bi bi-exclamation-circle"></i>
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="remember-forgot-container">
        <div class="form-check">
            <input type="checkbox" 
                   class="form-check-input" 
                   id="remember" 
                   name="remember">
            <label class="form-check-label" for="remember">
                Ghi nhớ đăng nhập
            </label>
        </div>
        <a href="{{ url('/forgot-password') }}" class="forgot-password-link">
            Quên mật khẩu?
        </a>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Đăng Nhập</span>
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const toggleIcon = togglePassword.querySelector('i');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            if (type === 'text') {
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });
        
        // Form validation feedback
        const form = document.getElementById('loginForm');
        form.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                
                if (!email) {
                    document.getElementById('email').classList.add('is-invalid');
                }
                if (!password) {
                    document.getElementById('password').classList.add('is-invalid');
                }
            }
        });
        
        // Remove invalid class on input
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
@endsection
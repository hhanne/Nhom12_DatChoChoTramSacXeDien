@extends('layouts.admin')

@section('title', 'Thêm Khách Hàng')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        border-radius: 20px;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0.5rem 0 0 0;
    }

    .breadcrumb-item {
        color: rgba(255, 255, 255, 0.8);
    }

    .breadcrumb-item.active {
        color: white;
        font-weight: 600;
    }

    .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: white;
    }

    .content-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        transition: all 0.3s ease;
        background: #f5f5f5;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
        background: white;
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-back {
        background: #f0f0f0;
        color: #666;
        padding: 0.8rem 2rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #e0e0e0;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .alert {
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-person-plus-fill"></i>
        Thêm Khách Hàng
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('chinhsua.khachhang.index') }}">Quản lý khách hàng</a></li>
            <li class="breadcrumb-item active">Thêm khách hàng</li>
        </ol>
    </nav>
</div>

<!-- Main Content Card -->
<div class="content-card">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('chinhsua.khachhang.index') }}" class="btn-back">
            <i class="bi bi-arrow-left-circle me-2"></i>Quay lại danh sách
        </a>
    </div>

    <form action="{{ route('chinhsua.khachhang.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="hoten">
                <i class="bi bi-person me-2"></i>Tên Khách Hàng
            </label>
            <input type="text" class="form-control" id="hoten" name="hoten" value="{{ old('hoten') }}" required>
            @error('hoten')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="sdt">
                <i class="bi bi-telephone me-2"></i>Số Điện Thoại
            </label>
            <input type="text" class="form-control" id="sdt" name="sdt" pattern="[0-9]{10,11}" value="{{ old('sdt') }}" required>
            @error('sdt')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">
                <i class="bi bi-envelope me-2"></i>Email
            </label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="diachi">
                <i class="bi bi-geo-alt me-2"></i>Địa Chỉ
            </label>
            <textarea class="form-control" id="diachi" name="diachi" rows="3" required>{{ old('diachi') }}</textarea>
            @error('diachi')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gioitinh">
                        <i class="bi bi-gender-ambiguous me-2"></i>Giới Tính
                    </label>
                    <select class="form-control" id="gioitinh" name="gioitinh" required>
                        <option value="" {{ old('gioitinh') == '' ? 'selected' : '' }}>-- Chọn giới tính --</option>
                        <option value="Nam" {{ old('gioitinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ old('gioitinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    </select>
                    @error('gioitinh')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="trangthai">
                        <i class="bi bi-info-circle me-2"></i>Trạng Thái
                    </label>
                    <select class="form-control" id="trangthai" name="trangthai" required>
                        <option value="hoatdong" {{ old('trangthai') == 'hoatdong' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="bikhoa" {{ old('trangthai') == 'bikhoa' ? 'selected' : '' }}>Ngưng hoạt động</option>
                    </select>
                    @error('trangthai')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="ngaysinh">
                <i class="bi bi-calendar-check me-2"></i>Ngày Sinh
            </label>
            <input type="date" class="form-control" id="ngaysinh" name="ngaysinh" value="{{ old('ngaysinh') }}" required>
            @error('ngaysinh')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phanquyen">
                <i class="bi bi-shield-lock me-2"></i>Phân Quyền
            </label>
            <select class="form-control" id="phanquyen" name="phanquyen" required>
                <option value="user" {{ old('phanquyen') == 'user' ? 'selected' : '' }}>Người dùng</option>
                <option value="admin" {{ old('phanquyen') == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
            </select>
            @error('phanquyen')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">
                <i class="bi bi-lock me-2"></i>Mật Khẩu
            </label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn-save">
                <i class="bi bi-check-circle me-2"></i>Thêm Mới
            </button>
        </div>
    </form>
</div>
@endsection
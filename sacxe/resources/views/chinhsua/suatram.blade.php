@extends('layouts.admin')

@section('title', 'Sửa Trạm Sạc')

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
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.6);
    }
    .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
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
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.8rem;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: border-color 0.3s ease;
    }
    .form-group input:focus,
    .form-group select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-pencil-square"></i>
        Sửa Trạm Sạc
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('chinhsua.tramsac.index') }}">Quản lý trạm sạc</a></li>
            <li class="breadcrumb-item active">Sửa trạm sạc</li>
        </ol>
    </nav>
</div>

<!-- Main Content Card -->
<div class="content-card">
    <form action="{{ route('chinhsua.tramsac.update', $tramsac->tramsac_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tentram">Tên Trạm</label>
            <input type="text" name="tentram" id="tentram" value="{{ old('tentram', $tramsac->tentram) }}" required>
        </div>
        <div class="form-group">
            <label for="diachi">Địa Chỉ</label>
            <input type="text" name="diachi" id="diachi" value="{{ old('diachi', $tramsac->diachi) }}" required>
        </div>
        <div class="form-group">
            <label for="loaitram">Loại Trạm</label>
            <select name="loaitram" id="loaitram" required>
                <option value="Nhanh" {{ old('loaitram', $tramsac->loaitram) == 'Nhanh' ? 'selected' : '' }}>Sạc Nhanh</option>
                <option value="Cham" {{ old('loaitram', $tramsac->loaitram) == 'Cham' ? 'selected' : '' }}>Sạc Chậm</option>
            </select>
        </div>
        <div class="form-group">
            <label for="trangthai">Trạng Thái</label>
            <select name="trangthai" id="trangthai" required>
                <option value="hoatdong" {{ old('trangthai', $tramsac->trangthai) == 'hoatdong' ? 'selected' : '' }}>Hoạt động</option>
                <option value="trong" {{ old('trangthai', $tramsac->trangthai) == 'trong' ? 'selected' : '' }}>Trống</option>
                <option value="baotri" {{ old('trangthai', $tramsac->trangthai) == 'baotri' ? 'selected' : '' }}>Bảo trì</option>
                <option value="offline" {{ old('trangthai', $tramsac->trangthai) == 'offline' ? 'selected' : '' }}>Ngưng hoạt động</option>
            </select>
        </div>
        <div class="form-group">
            <label for="soluong_congsac">Số Lượng Cổng Sạc</label>
            <input type="number" name="soluong_congsac" id="soluong_congsac" value="{{ old('soluong_congsac', $tramsac->soluong_congsac) }}" required>
        </div>
        <div class="form-group">
            <label for="toado_lat">Tọa Độ Lat</label>
            <input type="text" name="toado_lat" id="toado_lat" value="{{ old('toado_lat', $tramsac->toado_lat) }}" required>
        </div>
        <div class="form-group">
            <label for="toado_lng">Tọa Độ Lng</label>
            <input type="text" name="toado_lng" id="toado_lng" value="{{ old('toado_lng', $tramsac->toado_lng) }}" required>
        </div>
        <button type="submit" class="btn-submit">Cập Nhật Trạm Sạc</button>
    </form>
</div>
@endsection
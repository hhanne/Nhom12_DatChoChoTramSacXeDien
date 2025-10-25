@extends('layouts.admin')

@section('title', 'Sửa Cổng Sạc')

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

    .form-group input:disabled,
    .form-group input[readonly] {
        background: #e9ecef;
        cursor: not-allowed;
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
        <i class="bi bi-plug-fill"></i>
        Sửa Cổng Sạc
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('chinhsua.congsac.index') }}">Quản lý cổng sạc</a></li>
            <li class="breadcrumb-item active">Sửa cổng sạc</li>
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
        <a href="{{ route('chinhsua.congsac.index') }}" class="btn-back">
            <i class="bi bi-arrow-left-circle me-2"></i>Quay lại danh sách
        </a>
    </div>

    <form action="{{ route('chinhsua.congsac.update', $congsac->congsac_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="congsac_id">
                <i class="bi bi-upc-scan me-2"></i>Mã Cổng Sạc
            </label>
            <input type="text" class="form-control" id="congsac_id" value="{{ old('congsac_id', $congsac->congsac_id) }}" readonly>
            @error('congsac_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tencong">
                <i class="bi bi-plug-fill me-2"></i>Tên Cổng Sạc
            </label>
            <input type="text" class="form-control" id="tencong" name="tencong" value="{{ old('tencong', $congsac->tencong) }}" required>
            @error('tencong')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tentram">
                <i class="bi bi-ev-station-fill me-2"></i>Trạm Sạc
            </label>
            <input type="text" class="form-control" id="tentram" value="{{ old('tentram', $congsac->tramsac ? $congsac->tramsac->tentram : 'N/A') }}" readonly>
            <input type="hidden" name="tramsac_id" value="{{ old('tramsac_id', $congsac->tramsac_id) }}">
            @error('tramsac_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="loaicong">
                <i class="bi bi-lightning-charge-fill me-2"></i>Loại Cổng
            </label>
            <select class="form-control" id="loaicong" name="loaicong" required>
                <option value="nhanh" {{ old('loaicong', $congsac->loaicong) == 'nhanh' ? 'selected' : '' }}>Sạc nhanh</option>
                <option value="cham" {{ old('loaicong', $congsac->loaicong) == 'cham' ? 'selected' : '' }}>Sạc chậm</option>
            </select>
            @error('loaicong')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="congsuat">
                <i class="bi bi-lightning-fill me-2"></i>Công Suất (kW)
            </label>
            <input type="number" class="form-control" id="congsuat" name="congsuat" value="{{ old('congsuat', $congsac->congsuat) }}" required min="0" step="0.1">
            @error('congsuat')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="trangthai">
                <i class="bi bi-info-circle me-2"></i>Trạng Thái
            </label>
            <select class="form-control" id="trangthai" name="trangthai" required>
                <option value="hoatdong" {{ old('trangthai', $congsac->trangthai) == 'hoatdong' ? 'selected' : '' }}>Hoạt động</option>
                <option value="baotri" {{ old('trangthai', $congsac->trangthai) == 'baotri' ? 'selected' : '' }}>Bảo trì</option>
                <option value="trong" {{ old('trangthai', $congsac->trangthai) == 'trong' ? 'selected' : '' }}>Trống</option>
            </select>
            @error('trangthai')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn-save">
                <i class="bi bi-check-circle me-2"></i>Lưu Thay Đổi
            </button>
        </div>
    </form>
</div>
@endsection
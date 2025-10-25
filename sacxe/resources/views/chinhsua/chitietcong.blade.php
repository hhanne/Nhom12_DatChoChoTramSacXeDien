@extends('layouts.admin')

@section('title', 'Chi Tiết Cổng Sạc')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

    .detail-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .detail-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f0f0f0;
    }

    .detail-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-header h2 i {
        color: #667eea;
    }

    .detail-group {
        margin-bottom: 1.5rem;
    }

    .detail-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-group label i {
        color: #667eea;
        font-size: 1.1rem;
    }

    .detail-value {
        padding: 0.8rem 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 0.95rem;
        background-color: #f5f5f5;
        color: #333;
    }

    .btn-back {
        background: #f0f0f0;
        color: #666;
        padding: 0.8rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #e0e0e0;
        transform: translateY(-2px);
        color: #333;
    }

    .info-box {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-left: 4px solid #667eea;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
    }

    .info-box i {
        color: #667eea;
        margin-right: 0.5rem;
        font-size: 1.2rem;
    }

    .info-box p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }

    .port-id-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .detail-card {
            padding: 1.5rem;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-plug-fill"></i>
        Chi Tiết Cổng Sạc
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('chinhsua.congsac.index') }}">Quản lý cổng sạc</a></li>
            <li class="breadcrumb-item active">Chi tiết cổng sạc</li>
        </ol>
    </nav>
</div>

<!-- Info Box -->
<div class="info-box">
    <i class="bi bi-info-circle-fill"></i>
    <p>Thông tin chi tiết của cổng sạc. Nhấn <strong>Quay lại</strong> để trở về danh sách cổng sạc.</p>
</div>

<!-- Detail Card -->
<div class="detail-card">
    <div class="detail-header">
        <h2>
            <i class="bi bi-outlet"></i>
            Thông Tin Cổng Sạc
        </h2>
    </div>

    <!-- Port ID Badge -->
    <div class="port-id-badge">
        <i class="bi bi-hash"></i>
        Mã cổng sạc: {{ $congsac->congsac_id }}
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="detail-group">
                <label>
                    <i class="bi bi-upc-scan"></i>
                    Mã Cổng Sạc
                </label>
                <div class="detail-value">{{ $congsac->congsac_id }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-group">
                <label>
                    <i class="bi bi-plug-fill"></i>
                    Tên Cổng Sạc
                </label>
                <div class="detail-value">{{ $congsac->tencong }}</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="detail-group">
                <label>
                    <i class="bi bi-ev-station-fill"></i>
                    Trạm Sạc
                </label>
                <div class="detail-value">{{ $congsac->tramsac->tentram ?? 'Không có trạm sạc' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-group">
                <label>
                    <i class="bi bi-lightning-charge-fill"></i>
                    Loại Cổng
                </label>
                <div class="detail-value">{{ $congsac->loaicong == 'Sạc nhanh' ? '⚡ Sạc nhanh (DC Fast Charging)' : '🔋 Sạc chậm (AC Charging)' }}</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="detail-group">
                <label>
                    <i class="bi bi-lightning-fill"></i>
                    Công Suất (kW)
                </label>
                <div class="detail-value">{{ $congsac->congsuat }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-group">
                <label>
                    <i class="bi bi-info-circle-fill"></i>
                    Trạng Thái
                </label>
                <div class="detail-value">{{ $congsac->trangthai == 'active' ? '✅ Hoạt động' : '❌ Ngưng hoạt động' }}</div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('chinhsua.congsac.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            Quay lại
        </a>
    </div>
</div>
@endsection
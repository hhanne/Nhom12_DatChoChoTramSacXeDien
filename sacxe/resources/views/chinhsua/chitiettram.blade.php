@extends('layouts.admin')

@section('title', 'Chi Tiết Trạm Sạc')

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
    .detail-row {
        padding: 1rem;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: flex-start;
    }
    .detail-row:last-child {
        border-bottom: none;
    }
    .detail-label {
        font-weight: 600;
        color: #333;
        min-width: 150px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .detail-label i {
        color: #667eea;
    }
    .detail-value {
        flex: 1;
        color: #666;
    }
    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .type-badge.fast {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    .type-badge.slow {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .status-badge.hoatdong {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        color: white;
    }
    .status-badge.trong {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    .status-badge.baotri {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    .status-badge.offline {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: white;
    }
    .status-badge i {
        font-size: 0.7rem;
    }
    .btn-secondary {
        background: #f0f0f0;
        color: #666;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .btn-secondary:hover {
        background: #e0e0e0;
        transform: translateY(-2px);
    }
    @media (max-width: 768px) {
        .detail-row {
            flex-direction: column;
        }
        .detail-label {
            margin-bottom: 0.5rem;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-eye"></i>
        Chi Tiết Trạm Sạc
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('chinhsua.tramsac.index') }}">Quản lý trạm sạc</a></li>
            <li class="breadcrumb-item active">Chi tiết trạm sạc</li>
        </ol>
    </nav>
</div>

<!-- Detail Card -->
<div class="content-card">
    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-building"></i>
            Tên trạm:
        </div>
        <div class="detail-value">{{ $tramsac->tentram }}</div>
    </div>
    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-hash"></i>
            Mã trạm:
        </div>
        <div class="detail-value">{{ $tramsac->tramsac_id }}</div>
    </div>
    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-geo-alt"></i>
            Địa chỉ:
        </div>
        <div class="detail-value">{{ $tramsac->diachi }}</div>
    </div>
    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-lightning"></i>
            Loại trạm:
        </div>
        <div class="detail-value">
            <span class="type-badge {{ $tramsac->loaitram == 'Nhanh' ? 'fast' : 'slow' }}">
                <i class="bi bi-{{ $tramsac->loaitram == 'Nhanh' ? 'lightning-charge-fill' : 'hourglass-split' }}"></i>
                {{ $tramsac->loaitram == 'Nhanh' ? 'Sạc nhanh' : 'Sạc chậm' }}
            </span>
        </div>
    </div>
    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-info-circle"></i>
            Trạng thái:
        </div>
        <div class="detail-value">
            <span class="status-badge {{ $tramsac->trangthai }}">
                <i class="bi bi-circle-fill"></i>
                {{ ucfirst($tramsac->trangthai == 'hoatdong' ? 'Hoạt động' : ($tramsac->trangthai == 'trong' ? 'Trống' : ($tramsac->trangthai == 'baotri' ? 'Bảo trì' : 'Ngưng hoạt động'))) }}
            </span>
        </div>
    </div>
    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-ev-station"></i>
            Số cổng sạc:
        </div>
        <div class="detail-value">{{ $tramsac->soluong_congsac }} cổng</div>
    </div>
    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-crosshair"></i>
            Tọa độ Latitude:
        </div>
        <div class="detail-value">{{ $tramsac->toado_lat }}</div>
    </div>
    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-crosshair"></i>
            Tọa độ Longitude:
        </div>
        <div class="detail-value">{{ $tramsac->toado_lng }}</div>
    </div>
    <div class="mt-4">
        <a href="{{ route('chinhsua.tramsac.index') }}" class="btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Quay lại
        </a>
    </div>
</div>
@endsection
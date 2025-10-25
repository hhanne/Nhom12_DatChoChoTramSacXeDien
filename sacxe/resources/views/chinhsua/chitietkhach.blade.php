@extends('layouts.admin')

@section('title', 'Chi Tiết Khách Hàng')

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

    .gender-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.8rem;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .gender-badge.male {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .gender-badge.female {
        background: linear-gradient(135deg, #536ea9ff 0%, #3077beff 100%);
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

    .status-badge.bikhoa {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
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
    }

    .btn-back:hover {
        background: #e0e0e0;
    }

    .btn-edit {
        background: linear-gradient(135deg, #6174c1ff 0%, #4f83cdff 100%);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(146, 164, 210, 0.4);
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-eye"></i>
        Chi Tiết Khách Hàng
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('chinhsua.khachhang.index') }}">Quản lý khách hàng</a></li>
            <li class="breadcrumb-item active">Chi tiết khách hàng</li>
        </ol>
    </nav>
</div>

<!-- Main Content Card -->
<div class="content-card">
    <div class="mb-3">
        <a href="{{ route('chinhsua.khachhang.index') }}" class="btn-back">
            <i class="bi bi-arrow-left-circle me-2"></i>Quay lại danh sách
        </a>
        <a href="{{ route('chinhsua.khachhang.edit', $user->user_id) }}" class="btn-edit">
            <i class="bi bi-pencil-fill me-2"></i>Sửa
        </a>
    </div>
    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-person"></i> Họ và tên:</div>
        <div class="detail-value">{{ $user->hoten ?? 'Chưa cập nhật' }}</div>
    </div>
    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-hash"></i> Mã khách hàng:</div>
        <div class="detail-value">KH{{ str_pad($user->user_id, 3, '0', STR_PAD_LEFT) }}</div>
    </div>
    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-envelope"></i> Email:</div>
        <div class="detail-value">{{ $user->email ?? 'Chưa cập nhật' }}</div>
    </div>
    <!-- (Các phần còn lại giữ nguyên) -->
    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-gender-ambiguous"></i> Giới tính:</div>
        <div class="detail-value">
            <span class="gender-badge {{ $user->gioitinh == 'Nam' ? 'male' : 'female' }}">
                <i class="bi bi-gender-{{ $user->gioitinh == 'Nam' ? 'male' : 'female' }}"></i>
                {{ $user->gioitinh ?? 'Chưa cập nhật' }}
            </span>
        </div>
    </div>
    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-calendar-check"></i> Ngày đăng ký:</div>
        <div class="detail-value">{{ optional($user->ngaytaotk)->format('d/m/Y') ?? 'Chưa cập nhật' }}</div>
    </div>
    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-info-circle"></i> Trạng thái:</div>
        <div class="detail-value">
            <span class="status-badge {{ $user->trangthai }}">
                <i class="bi bi-circle-fill"></i>
                {{ $user->trangthai == 'hoatdong' ? 'Hoạt động' : 'Ngưng hoạt động' }}
            </span>
        </div>
    </div>
</div>
@endsection
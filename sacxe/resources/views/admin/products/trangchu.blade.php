@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #5774baff 100%);
        border-radius: 20px;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-header p {
        margin: 0;
        opacity: 0.9;
        font-size: 1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #667eea 0%, #577abaff 100%);
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .stat-card .icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .stat-card.customers .icon-wrapper {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        color: white;
    }

    .stat-card.stations .icon-wrapper {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        color: white;
    }

    .stat-card.ports .icon-wrapper {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .stat-card.bookings .icon-wrapper {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
        color: white;
    }

    .stat-card .stat-label {
        font-size: 0.9rem;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .stat-card .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .stat-card .stat-change {
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .stat-card .stat-change.positive {
        color: #00b09b;
    }

    .stat-card .stat-change.negative {
        color: #f5576c;
    }

    .chart-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .chart-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .chart-card h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #333;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chart-card h3 i {
        color: #667eea;
    }

    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        padding: 1rem;
        border-left: 3px solid #e0e0e0;
        margin-bottom: 1rem;
        position: relative;
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        background: rgba(102, 126, 234, 0.05);
        border-left-color: #667eea;
    }

    .activity-item::before {
        content: '';
        position: absolute;
        left: -7px;
        top: 1.2rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: white;
        border: 3px solid #667eea;
    }

    .activity-item .activity-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.3rem;
    }

    .activity-item .activity-time {
        font-size: 0.85rem;
        color: #999;
    }

    .quick-actions {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .quick-actions h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #333;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .quick-action-btn {
        padding: 1.5rem;
        border-radius: 15px;
        border: 2px solid #e0e0e0;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
        color: #333;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.8rem;
    }

    .quick-action-btn i {
        font-size: 2rem;
        color: #667eea;
    }

    .quick-action-btn:hover {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .quick-action-btn span {
        font-weight: 600;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .chart-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-speedometer2"></i>
        Quản lý trạm sạc xe điện
    </h1>
    <p>Chào mừng trở lại! Đây là tổng quan hệ thống quản lý trạm đặt xe điện.</p>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <a href="{{ route('chinhsua.khachhang.index') }}" class="stat-card customers">
        <div class="icon-wrapper">
            <i class="bi bi-people-fill"></i>
        </div>
        <div class="stat-label">Khách hàng</div>
        <div class="stat-value">{{ $totalUsers }}</div>
        <div class="stat-change positive">
        </div>
    </a>

    <a href="{{ route('chinhsua.tramsac.index') }}" class="stat-card stations">
        <div class="icon-wrapper">
            <i class="bi bi-building"></i>
        </div>
        <div class="stat-label">Trạm sạc</div>
        <div class="stat-value">{{ $totalStations }}</div>
        <div class="stat-change positive">
        </div>
    </a>

    <a href="{{ route('chinhsua.congsac.index') }}" class="stat-card ports">
        <div class="icon-wrapper">
            <i class="bi bi-ev-station-fill"></i>
        </div>
        <div class="stat-label">Cổng sạc</div>
        <div class="stat-value">{{ $totalActivePorts }}</div>
        <div class="stat-change positive">
        </div>
    </a>

   <a href="{{ route('admin.products.datcho.index') }}" class="stat-card bookings">
        <div class="icon-wrapper">
            <i class="bi bi-calendar-check-fill"></i>
        </div>
        <div class="stat-label">Đặt chỗ</div>
        <div class="stat-value">{{ $totalBookings }}</div>
        <div class="stat-change positive">
        </div>
    </a>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h3>
        <i class="bi bi-lightning-charge-fill"></i>
        Thao tác nhanh
    </h3>
    <div class="quick-actions-grid">
        <a href="{{ route('chinhsua.themkhach') }}" class="quick-action-btn">
            <i class="bi bi-person-plus-fill"></i>
            <span>Thêm khách hàng</span>
        </a>
        <a href="{{ route('chinhsua.tramsac.create') }}" class="quick-action-btn">
            <i class="bi bi-building-add"></i>
            <span>Thêm trạm sạc</span>
        </a>
        <a href="{{ route('chinhsua.congsac.create') }}" class="quick-action-btn">
            <i class="bi bi-ev-station"></i>
            <span>Thêm cổng sạc</span>
        </a>
    </div>
</div>
@endsection

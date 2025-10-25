<?php
// File: resources/views/admin/products/datcho.blade.php
?>
@extends('layouts.admin')

@section('title', 'Quản Lý Đặt Chỗ')

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
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #577abaff 100%);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }
    .stat-card .icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }
    .stat-card.total .icon {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        color: white;
    }
    .stat-card.choxacnhan .icon {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: white;
    }
    .stat-card.dadat .icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    .stat-card.dang_sac .icon {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        color: white;
    }
    .stat-card.hoanthanh .icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    .stat-card.huy .icon {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    .stat-card h3 {
        font-size: 0.9rem;
        color: #666;
        margin: 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-card .value {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin: 0.5rem 0 0 0;
    }
    .content-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .search-box {
        position: relative;
        flex: 1;
        max-width: 400px;
    }
    .search-box input {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 3rem;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    .search-box input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 1.1rem;
    }
    .filter-group {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
    }
    .filter-btn {
        padding: 0.8rem 1.5rem;
        border: 2px solid #e0e0e0;
        background: white;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .filter-btn:hover {
        border-color: #667eea;
        color: #667eea;
    }
    .filter-btn.active {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        color: white;
        border-color: transparent;
    }
    .table-wrapper {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
    }
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .modern-table thead {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
    }
    .modern-table thead th {
        padding: 1.2rem 1rem;
        text-align: left;
        font-weight: 600;
        color: white;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
    }
    .modern-table thead th:first-child {
        border-top-left-radius: 12px;
    }
    .modern-table thead th:last-child {
        border-top-right-radius: 12px;
    }
    .modern-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f0f0f0;
    }
    .modern-table tbody tr:hover {
        background: linear-gradient(90deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        transform: scale(1.01);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }
    .modern-table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        color: #333;
    }
    .station-name {
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .station-name i {
        color: #667eea;
        font-size: 1.2rem;
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
    .status-badge.choxacnhan {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: white;
    }
    .status-badge.dadat {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    .status-badge.dang_sac {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        color: white;
    }
    .status-badge.hoanthanh {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    .status-badge.huy {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    .status-badge i {
        font-size: 0.7rem;
    }
    @media (max-width: 768px) {
        .toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .search-box {
            max-width: 100%;
        }
        .filter-group {
            width: 100%;
        }
        .stats-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-calendar-check-fill"></i>
        Quản Lý Đặt Chỗ
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý đặt chỗ</li>
        </ol>
    </nav>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stat-card total">
        <div class="icon">
            <i class="bi bi-calendar-check-fill"></i>
        </div>
        <h3>Tổng đặt chỗ</h3>
        <p class="value">{{ $stats['total'] }}</p>
    </div>
    <div class="stat-card choxacnhan">
        <div class="icon">
            <i class="bi bi-hourglass-split"></i>
        </div>
        <h3>Chờ xác nhận</h3>
        <p class="value">{{ $stats['choxacnhan'] }}</p>
    </div>
    <div class="stat-card dadat">
        <div class="icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h3>Đã đặt</h3>
        <p class="value">{{ $stats['dadat'] }}</p>
    </div>
    <div class="stat-card dang_sac">
        <div class="icon">
            <i class="bi bi-lightning-charge-fill"></i>
        </div>
        <h3>Đang sạc</h3>
        <p class="value">{{ $stats['dang_sac'] }}</p>
    </div>
    <div class="stat-card hoanthanh">
        <div class="icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h3>Hoàn thành</h3>
        <p class="value">{{ $stats['hoanthanh'] }}</p>
    </div>
    <div class="stat-card huy">
        <div class="icon">
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <h3>Hủy</h3>
        <p class="value">{{ $stats['huy'] }}</p>
    </div>
</div>

<!-- Main Content Card -->
<div class="content-card">
    <!-- Toolbar -->
    <div class="toolbar">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Tìm kiếm đặt chỗ...">
        </div>
        
        <div class="filter-group">
            <button class="filter-btn active" data-filter="all">
                <i class="bi bi-grid-fill"></i> Tất cả
            </button>
            <button class="filter-btn" data-filter="choxacnhan">
                <i class="bi bi-hourglass-split"></i> Chờ xác nhận
            </button>
            <button class="filter-btn" data-filter="dadat">
                <i class="bi bi-check-circle-fill"></i> Đã đặt
            </button>
            <button class="filter-btn" data-filter="dang_sac">
                <i class="bi bi-lightning-charge-fill"></i> Đang sạc
            </button>
            <button class="filter-btn" data-filter="hoanthanh">
                <i class="bi bi-check-circle-fill"></i> Hoàn thành
            </button>
            <button class="filter-btn" data-filter="huy">
                <i class="bi bi-x-circle-fill"></i> Hủy
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Đặt Chỗ</th>
                    <th>Khách Hàng</th>
                    <th>Trạm Sạc</th>
                    <th>Cổng Sạc</th>
                    <th>Thanh Toán</th>
                    <th>Ngày Đặt</th>
                    <th>Thời Gian Bắt Đầu</th>
                    <th>Thời Gian Kết Thúc</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @if ($datchos->isEmpty())
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 2rem;">
                            Không có đặt chỗ nào được tìm thấy.
                        </td>
                    </tr>
                @else
                    @foreach ($datchos as $index => $datcho)
                        @if ($datcho->datcho_id)
                            <tr data-status="{{ $datcho->trangthai }}"
                                data-id="{{ $datcho->datcho_id }}"
                                data-user="{{ $datcho->user_name }}"
                                data-tram="{{ $datcho->tram_name }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="station-name">
                                        <i class="bi bi-hash"></i>
                                        <div>
                                            <div>{{ $datcho->datcho_id }}</div>
                                            <div style="font-size: 0.85rem; color: #999; font-weight: normal;">ID: {{ $datcho->datcho_id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="station-name">
                                        <i class="bi bi-person-fill"></i>
                                        {{ $datcho->user_name ?? 'N/A' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="station-name">
                                        <i class="bi bi-building-fill"></i>
                                        {{ $datcho->tram_name ?? 'N/A' }}
                                    </div>
                                </td>
                                <td>{{ $datcho->congsac_id ?? 'N/A' }}</td>
                                <td>{{ $datcho->thanhtoan_id ?? 'N/A' }}</td>
                                <td>{{ $datcho->ngaydat ? \Carbon\Carbon::parse($datcho->ngaydat)->format('d/m/Y') : 'N/A' }}</td>
                                <td>{{ $datcho->timebatdau ? \Carbon\Carbon::parse($datcho->timebatdau)->format('d/m/Y H:i') : 'N/A' }}</td>
                                <td>{{ $datcho->timeketthuc ? \Carbon\Carbon::parse($datcho->timeketthuc)->format('d/m/Y H:i') : 'N/A' }}</td>
                                <td>
                                    <span class="status-badge {{ $datcho->trangthai }}">
                                        <i class="bi bi-circle-fill"></i>
                                        {{ ucfirst($datcho->trangthai == 'choxacnhan' ? 'Chờ xác nhận' : ($datcho->trangthai == 'dadat' ? 'Đã đặt' : ($datcho->trangthai == 'dang_sac' ? 'Đang sạc' : ($datcho->trangthai == 'hoanthanh' ? 'Hoàn thành' : 'Hủy')))) }}
                                    </span>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="pagination" style="margin-top: 1.5rem; display: flex; justify-content: center;">
        {{ $datchos->links() }}
    </div>
</div>

<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Filter functionality
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            const rows = document.querySelectorAll('#tableBody tr');
            
            rows.forEach(row => {
                if (filter === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.dataset.status === filter ? '' : 'none';
                }
            });
        });
    });
</script>
@endsection
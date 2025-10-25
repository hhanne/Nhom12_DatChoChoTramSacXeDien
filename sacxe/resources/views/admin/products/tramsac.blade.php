@extends('layouts.admin')

@section('title', 'Quản Lý Trạm Sạc')

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
    .stat-card.charging .icon {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        color: white;
    }
    .stat-card.available .icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    .stat-card.maintenance .icon {
        background: linear-gradient(135deg, #b95865ff 0%, #f5576c 100%);
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
    .btn-add {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        text-decoration: none;
        cursor: pointer;
    }
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
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
    .station-address {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        color: #666;
        font-size: 0.9rem;
    }
    .station-address i {
        color: #667eea;
        margin-top: 0.2rem;
        flex-shrink: 0;
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
        background: linear-gradient(135deg, #d36c81ff 0%, #f5576c 100%);
        color: white;
    }
    .status-badge.offline {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: white;
    }
    .status-badge i {
        font-size: 0.7rem;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: nowrap;
        align-items: center;
    }
    .btn-action {
        padding: 0.5rem 0.8rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .btn-view {
        background: linear-gradient(135deg, #4facfe 0%, #4facfe 100%);
        color: white;
        text-decoration: none;
    }
    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
        color: white;
    }
    .btn-edit {
        background: linear-gradient(135deg, #5cb4caff 0%, #4facfe 100%);
        color: white;
        text-decoration: none;
    }
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(240, 147, 251, 0.4);
        color: white;
    }
    .btn-delete {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: white;
        text-decoration: none;
    }
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
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
        .action-buttons {
            justify-content: flex-start;
            flex-wrap: nowrap;
            overflow-x: auto;
        }
        .btn-action {
            padding: 0.5rem 0.7rem;
            font-size: 0.8rem;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-building"></i>
        Quản Lý Trạm Sạc
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý trạm sạc</li>
        </ol>
    </nav>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stat-card total">
        <div class="icon">
            <i class="bi bi-building"></i>
        </div>
        <h3>Tổng trạm sạc</h3>
        <p class="value">{{ $tramsacs->count() }}</p>
    </div>
    <div class="stat-card charging">
        <div class="icon">
            <i class="bi bi-lightning-charge-fill"></i>
        </div>
        <h3>Hoạt động</h3>
        <p class="value">{{ $tramsacs->where('trangthai', 'hoatdong')->count() }}</p>
    </div>
    <div class="stat-card available">
        <div class="icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h3>Trống</h3>
        <p class="value">{{ $tramsacs->where('trangthai', 'trong')->count() }}</p>
    </div>
    <div class="stat-card maintenance">
        <div class="icon">
            <i class="bi bi-tools"></i>
        </div>
        <h3>Bảo trì</h3>
        <p class="value">{{ $tramsacs->where('trangthai', 'baotri')->count() }}</p>
    </div>
</div>

<!-- Main Content Card -->
<div class="content-card">
    <!-- Toolbar -->
    <div class="toolbar">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Tìm kiếm trạm sạc...">
        </div>
        
        <div class="filter-group">
            <button class="filter-btn active" data-filter="all">
                <i class="bi bi-grid-fill"></i> Tất cả
            </button>
            <button class="filter-btn" data-filter="fast">
                <i class="bi bi-lightning-fill"></i> Sạc nhanh
            </button>
            <button class="filter-btn" data-filter="slow">
                <i class="bi bi-hourglass-split"></i> Sạc chậm
            </button>
        </div>

        <a href="{{ route('chinhsua.tramsac.create') }}" class="btn-add">
            <i class="bi bi-plus-circle-fill"></i>
            Thêm trạm sạc
        </a>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Trạm</th>
                    <th>Địa Chỉ</th>
                    <th>Loại Trạm</th>
                    <th>Trạng Thái</th>
                    <th>Tác Vụ</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @if ($tramsacs->isEmpty())
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem;">
                            Không có trạm sạc nào được tìm thấy.
                        </td>
                    </tr>
                @else
                    @foreach ($tramsacs as $index => $tramsac)
                        @if ($tramsac->tramsac_id)
                            <tr data-type="{{ $tramsac->loaitram == 'Nhanh' ? 'fast' : 'slow' }}"
                                data-id="{{ $tramsac->tramsac_id }}"
                                data-name="{{ $tramsac->tentram }}"
                                data-address="{{ $tramsac->diachi }}"
                                data-station-type="{{ $tramsac->loaitram }}"
                                data-status="{{ $tramsac->trangthai }}"
                                data-ports="{{ $tramsac->soluong_congsac }}"
                                data-lat="{{ $tramsac->toado_lat }}"
                                data-lng="{{ $tramsac->toado_lng }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="station-name">
                                        <i class="bi bi-building-fill"></i>
                                        <div>
                                            <div>{{ $tramsac->tentram ?? 'Chưa đặt tên' }}</div>
                                            <div style="font-size: 0.85rem; color: #999; font-weight: normal;">ID: {{ $tramsac->tramsac_id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="station-address">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ $tramsac->diachi }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="type-badge {{ $tramsac->loaitram == 'Nhanh' ? 'fast' : 'slow' }}">
                                        <i class="bi bi-{{ $tramsac->loaitram == 'Nhanh' ? 'lightning-charge-fill' : 'hourglass-split' }}"></i>
                                        {{ $tramsac->loaitram == 'Nhanh' ? 'Sạc nhanh' : 'Sạc chậm' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $tramsac->trangthai }}">
                                        <i class="bi bi-circle-fill"></i>
                                        {{ ucfirst($tramsac->trangthai == 'hoatdong' ? 'Hoạt động' : ($tramsac->trangthai == 'trong' ? 'Trống' : ($tramsac->trangthai == 'baotri' ? 'Bảo trì' : 'Ngưng hoạt động'))) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('chinhsua.tramsac.show', $tramsac->tramsac_id) }}" class="btn-action btn-view">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('chinhsua.tramsac.edit', $tramsac->tramsac_id) }}" class="btn-action btn-edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="{{ route('chinhsua.tramsac.delete', $tramsac->tramsac_id) }}" class="btn-action btn-delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
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
                    row.style.display = row.dataset.type === filter ? '' : 'none';
                }
            });
        });
    });
</script>
@endsection

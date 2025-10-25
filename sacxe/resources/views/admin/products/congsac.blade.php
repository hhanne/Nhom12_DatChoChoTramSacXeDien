@extends('layouts.admin')

@section('title', 'Quản Lý Cổng Sạc')

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

    .stat-card.active .icon {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        color: white;
    }

    .stat-card.inactive .icon {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .stat-card.fast .icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
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

    .port-name {
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .port-name i {
        color: #667eea;
        font-size: 1.1rem;
    }

    .station-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .station-info i {
        color: #999;
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

    .type-badge.nhanh {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .type-badge.cham {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    .power-info {
        font-weight: 600;
        color: #667eea;
        display: flex;
        align-items: center;
        gap: 0.3rem;
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

    .status-badge.baotri {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .status-badge.trong {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .status-badge i {
        font-size: 0.7rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(240, 147, 251, 0.4);
    }

    .btn-delete {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: white;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }

    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        color: white;
        border: none;
        padding: 1.5rem 2rem;
    }

    .modal-header h5 {
        font-weight: 700;
        margin: 0;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.8rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .modal-footer {
        border: none;
        padding: 1rem 2rem 2rem;
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-cancel {
        background: #f0f0f0;
        color: #666;
        padding: 0.8rem 2rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-cancel:hover {
        background: #e0e0e0;
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
        <i class="bi bi-ev-station-fill"></i>
        Quản Lý Cổng Sạc
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý cổng sạc</li>
        </ol>
    </nav>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stat-card total">
        <div class="icon">
            <i class="bi bi-ev-station"></i>
        </div>
        <h3>Tổng cổng sạc</h3>
        <p class="value">{{ $congsacs->count() }}</p>
    </div>
    <div class="stat-card active">
        <div class="icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h3>Đang hoạt động</h3>
        <p class="value">{{ $congsacs->where('trangthai', 'hoatdong')->count() }}</p>
    </div>
    <div class="stat-card inactive">
        <div class="icon">
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <h3>Bảo trì</h3>
        <p class="value">{{ $congsacs->where('trangthai', 'baotri')->count() }}</p>
    </div>
    <div class="stat-card fast">
        <div class="icon">
            <i class="bi bi-lightning-charge-fill"></i>
        </div>
        <h3>Cổng sạc nhanh</h3>
        <p class="value">{{ $congsacs->where('loaicong', 'nhanh')->count() }}</p>
    </div>
</div>

<!-- Main Content Card -->
<div class="content-card">
    <!-- Toolbar -->
    <div class="toolbar">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Tìm kiếm cổng sạc...">
        </div>
        
        <div class="filter-group">
            <button class="filter-btn active" data-filter="all">
                <i class="bi bi-grid-fill"></i> Tất cả
            </button>
            <button class="filter-btn" data-filter="nhanh">
                <i class="bi bi-lightning-fill"></i> Sạc nhanh
            </button>
            <button class="filter-btn" data-filter="cham">
                <i class="bi bi-hourglass-split"></i> Sạc chậm
            </button>
        </div>

        <a href="{{ route('chinhsua.congsac.create') }}" class="btn-add">
            <i class="bi bi-plus-circle-fill"></i>
            Thêm cổng sạc
        </a>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Cổng Sạc</th>
                    <th>Trạm Sạc</th>
                    <th>Loại Cổng</th>
                    <th>Công Suất</th>
                    <th>Trạng Thái</th>
                    <th>Tác Vụ</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($congsacs as $index => $congsac)
                    <tr data-type="{{ $congsac->loaicong }}"
                        data-id="{{ $congsac->congsac_id }}"
                        data-name="{{ $congsac->tencong }}"
                        data-station-id="{{ $congsac->tramsac_id }}"
                        data-station-name="{{ $congsac->tramsac ? $congsac->tramsac->tentram : 'Không xác định' }}"
                        data-type="{{ $congsac->loaicong }}"
                        data-power="{{ $congsac->congsuat }}"
                        data-status="{{ $congsac->trangthai }}">
                        <td>{{ $index + 1 + $congsacs->firstItem() }}</td>
                        <td>
                            <div class="port-name">
                                <i class="bi bi-plug-fill"></i>
                                {{ $congsac->tencong }}
                            </div>
                        </td>
                        <td>
                            <div class="station-info">
                                <i class="bi bi-geo-alt-fill"></i>
                                {{ $congsac->tramsac ? $congsac->tramsac->tentram : 'Không xác định' }}
                            </div>
                        </td>
                        <td>
                            <span class="type-badge {{ $congsac->loaicong }}">
                                <i class="bi bi-{{ $congsac->loaicong == 'nhanh' ? 'lightning-charge-fill' : 'hourglass-split' }}"></i>
                                {{ $congsac->loaicong == 'nhanh' ? 'Sạc nhanh' : 'Sạc chậm' }}
                            </span>
                        </td>
                        <td>
                            <div class="power-info">
                                <i class="bi bi-speedometer2"></i>
                                {{ $congsac->congsuat }} kW
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $congsac->trangthai }}">
                                <i class="bi bi-circle-fill"></i>
                                {{ $congsac->trangthai == 'hoatdong' ? 'Hoạt động' : ($congsac->trangthai == 'baotri' ? 'Bảo trì' : 'Trống') }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('chinhsua.congsac.show', $congsac->congsac_id) }}" class="btn-action btn-edit">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('chinhsua.congsac.edit', $congsac->congsac_id) }}" class="btn-action btn-edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="{{ route('chinhsua.congsac.delete', $congsac->congsac_id) }}" class="btn-action btn-delete">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item {{ $congsacs->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $congsacs->previousPageUrl() }}" tabindex="-1">
                    <i class="bi bi-chevron-left"></i> Trước
                </a>
            </li>
            @for ($i = 1; $i <= $congsacs->lastPage(); $i++)
                <li class="page-item {{ $congsacs->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $congsacs->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $congsacs->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $congsacs->nextPageUrl() }}">
                    Sau <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>
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
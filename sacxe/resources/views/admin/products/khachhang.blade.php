@extends('layouts.admin')

@section('title', 'Quản Lý Khách Hàng')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: #f5f7fa;
    }
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #577abaff 100%);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(76, 99, 210, 0.3);
    }
    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0.75rem 0 0 0;
    }
    .breadcrumb-item {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.9rem;
    }
    .breadcrumb-item.active {
        color: white;
        font-weight: 500;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.6);
        content: "/";
    }
    .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
    }
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }
    .stat-card .icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .stat-card.total .icon {
        background: linear-gradient(135deg, #4c63d2 0%, #4facfe 100%);
        color: white;
    }
    .stat-card.active .icon {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    .stat-card.inactive .icon {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    .stat-card.new .icon {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    .stat-card h3 {
        font-size: 0.8rem;
        color: #6b7280;
        margin: 0 0 0.5rem 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-card .value {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }
    .content-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }
    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .search-filter-group {
        display: flex;
        gap: 1rem;
        flex: 1;
        flex-wrap: wrap;
    }
    .search-box {
        position: relative;
        flex: 1;
        min-width: 250px;
        max-width: 400px;
    }
    .search-box input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        background: #f9fafb;
    }
    .search-box input:focus {
        border-color: #4facfe;
        box-shadow: 0 0 0 3px rgba(76, 99, 210, 0.1);
        outline: none;
        background: white;
    }
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1rem;
    }
    .filter-group {
        display: flex;
        gap: 0.75rem;
    }
    .filter-btn {
        padding: 0.75rem 1.5rem;
        border: 2px solid #e5e7eb;
        background: white;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 0.875rem;
        color: #6b7280;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .filter-btn:hover {
        border-color: #4facfe;
        color: #4facfe;
        background: #f0f3ff;
    }
    .filter-btn.active {
        background: #4c63d2;
        color: white;
        border-color: #4c63d2;
    }
    .btn-add {
        background: #4c63d2;
        color: white;
        padding: 0.75rem 1.75rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    .btn-add:hover {
        background: #4facfe;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(76, 99, 210, 0.3);
        color: white;
    }
    .table-responsive {
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    thead {
        background: #4c63d2;
    }
    thead th {
        padding: 1rem 1.25rem;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: white;
        border: none;
        text-align: left;
    }
    thead th:first-child {
        border-radius: 10px 0 0 0;
    }
    thead th:last-child {
        border-radius: 0 10px 0 0;
    }
    tbody tr {
        transition: all 0.2s ease;
        background: white;
    }
    tbody tr:hover {
        background: #f9fafb;
    }
    tbody td {
        padding: 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        color: #374151;
        font-size: 0.9rem;
    }
    tbody tr:last-child td {
        border-bottom: none;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .status-badge.hoatdong,
    .status-badge.active {
        background: #d1fae5;
        color: #065f46;
    }
    .status-badge.bikhoa {
        background: #fee2e2;
        color: #991b1b;
    }
    .status-badge i {
        font-size: 0.5rem;
    }
    .gender-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.875rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .gender-badge.male {
        background: #dbeafe;
        color: #4facfe;
    }
    .gender-badge.female {
        background: #fce7f3;
        color: #9f1239;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        text-decoration: none;
    }
    .btn-view {
        background: #06b6d4;
        color: white;
    }
    .btn-view:hover {
        background: #0891b2;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(6, 182, 212, 0.3);
        color: white;
    }
    .btn-edit {
        background: #4593baff;
        color: white;
    }
    .btn-edit:hover {
        background: #2a9bbdff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(236, 72, 153, 0.3);
        color: white;
    }
    .btn-delete {
        background: #ef4444;
        color: white;
    }
    .btn-delete:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
    }
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }
    .page-item .page-link {
        border: 1px solid #e5e7eb;
        color: #4c63d2;
        padding: 0.625rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .page-item.active .page-link {
        background: #4c63d2;
        border-color: #4c63d2;
        color: white;
    }
    .page-item .page-link:hover {
        background: #4c63d2;
        border-color: #4c63d2;
        color: white;
    }
    .page-item.disabled .page-link {
        background: #f3f4f6;
        border-color: #e5e7eb;
        color: #9ca3af;
    }
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
        }
        .page-header h1 {
            font-size: 1.5rem;
        }
        .toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .search-filter-group {
            flex-direction: column;
        }
        .search-box {
            max-width: 100%;
        }
        .filter-group {
            width: 100%;
            overflow-x: auto;
        }
        .stats-container {
            grid-template-columns: 1fr;
        }
        .action-buttons {
            justify-content: flex-start;
        }
        table {
            font-size: 0.85rem;
        }
        thead th,
        tbody td {
            padding: 0.875rem;
        }
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .stat-card,
    .content-card {
        animation: fadeInUp 0.5s ease-out;
    }
    .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stat-card:nth-child(2) { animation-delay: 0.1s; }
    .stat-card:nth-child(3) { animation-delay: 0.15s; }
    .stat-card:nth-child(4) { animation-delay: 0.2s; }
    .content-card { animation-delay: 0.25s; }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1><i class="bi bi-people"></i> Quản Lý Khách Hàng</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý khách hàng</li>
        </ol>
    </nav>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stat-card total">
        <div class="icon">
            <i class="bi bi-people"></i>
        </div>
        <h3>Tổng Khách Hàng</h3>
        <div class="value">{{ $users->total() }}</div>
    </div>
    <div class="stat-card active">
        <div class="icon">
            <i class="bi bi-lightning"></i>
        </div>
        <h3>Hoạt Động</h3>
        <div class="value">{{ $users->whereIn('trangthai', ['hoatdong', 'active'])->count() }}</div>
    </div>
    <div class="stat-card inactive">
        <div class="icon">
            <i class="bi bi-x-circle"></i>
        </div>
        <h3>Bị Khóa</h3>
        <div class="value">{{ $users->where('trangthai', 'bikhoa')->count() }}</div>
    </div>
    
</div>

<!-- Main Content Card -->
<div class="content-card">
    <!-- Toolbar -->
    <div class="toolbar">
        <div class="search-filter-group">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" placeholder="Tìm kiếm khách hàng..." onkeyup="searchCustomer()">
            </div>
            <div class="filter-group">
                <button class="filter-btn active" onclick="filterStatus('all')">
                    <i class="bi bi-grid"></i> Tất cả
                </button>
                <button class="filter-btn" onclick="filterStatus('hoatdong')">
                    <i class="bi bi-lightning"></i> Hoạt động
                </button>
                <button class="filter-btn" onclick="filterStatus('bikhoa')">
                    <i class="bi bi-pause-circle"></i> Bị khóa
                </button>
            </div>
        </div>
        <a href="{{ route('chinhsua.themkhach') }}" class="btn-add">
            <i class="bi bi-plus-circle"></i> Thêm khách hàng
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table id="customerTable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Trạng Thái</th>
                    <th>Tác Vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr class="customer-row" data-status="{{ $user->trangthai }}">
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td><strong>{{ $user->hoten ?? 'Chưa đặt tên' }}</strong></td>
                        <td>{{ $user->email ?? 'N/A' }}</td>
                        <td>{{ $user->sdt ?? 'N/A' }}</td>
                        <td>{{ $user->diachi ?? 'N/A' }}</td>
                        <td>
                            <span class="gender-badge {{ $user->gioitinh == 'Nam' ? 'male' : 'female' }}">
                                <i class="bi bi-gender-{{ $user->gioitinh == 'Nam' ? 'male' : 'female' }}"></i>
                                {{ $user->gioitinh ?? 'N/A' }}
                            </span>
                        </td>
                        <td>
                            <i class="bi bi-calendar-check" style="color: #4c63d2; margin-right: 0.25rem;"></i>
                            {{ $user->ngaysinh ? \Carbon\Carbon::parse($user->ngaysinh)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td>
                            <span class="status-badge {{ $user->trangthai }}">
                                <i class="bi bi-circle-fill"></i>
                                {{ $user->trangthai == 'bikhoa' ? 'Bị khóa' : 'Hoạt động' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('chinhsua.khachhang.show', $user->user_id) }}" class="btn-action btn-view" title="Xem chi tiết">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('chinhsua.khachhang.edit', $user->user_id) }}" class="btn-action btn-edit" title="Chỉnh sửa">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="{{ route('chinhsua.khachhang.delete', $user->user_id) }}" class="btn-action btn-delete" title="Xóa">
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
            <li class="page-item {{ $users->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1">
                    <i class="bi bi-chevron-left"></i> Trước
                </a>
            </li>
            @for ($i = 1; $i <= $users->lastPage(); $i++)
                <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $users->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $users->nextPageUrl() }}">
                    Sau <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>

<script>
    function searchCustomer() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('customerTable');
        const rows = table.getElementsByClassName('customer-row');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const textValue = cell.textContent || cell.innerText;
                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            rows[i].style.display = found ? '' : 'none';
        }
    }

    function filterStatus(status) {
        const rows = document.getElementsByClassName('customer-row');
        const filterButtons = document.querySelectorAll('.filter-btn');

        filterButtons.forEach(btn => btn.classList.remove('active'));
        event.target.closest('.filter-btn').classList.add('active');

        for (let i = 0; i < rows.length; i++) {
            const rowStatus = rows[i].getAttribute('data-status');
            if (status === 'all') {
                rows[i].style.display = '';
            } else if (status === 'hoatdong' && (rowStatus === 'hoatdong' || rowStatus === 'active')) {
                rows[i].style.display = '';
            } else if (status === 'bikhoa' && rowStatus === 'bikhoa') {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
</script>
@endsection
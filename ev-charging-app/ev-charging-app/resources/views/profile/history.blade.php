<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử đặt chỗ - Trạm Sạc EV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* --- CSS NỀN & FONT TỪ MẪU --- */
        body {
            background-color: #f4f5f7;
            font-family: 'Poppins', sans-serif;
        }

        /* --- CSS HEADER (TOP-BAR) TỪ MẪU --- */
        .top-bar {
            background-color: #fff;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .top-bar-left h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #00c4a7;
            margin: 0;
        }
        .top-bar-left p {
            font-size: 0.875rem;
            color: #6c757d;
            margin: 0;
        }
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .notification-icon {
            position: relative;
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background-color: #ff4d4f;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #00c4a7;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 1.2rem;
            text-transform: uppercase;
        }
        .user-info .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0;
        }
        .user-info .user-email {
            font-size: 0.8rem;
            color: #6c757d;
            margin: 0;
        }
        .logout-link {
            text-decoration: none;
            color: #ff4d4f;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
        }
        .logout-link:hover {
            color: #cc0000;
        }

        /* --- CSS FOOTER TỪ MẪU --- */
        footer {
            background-color: #00c4a7;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }

        /* --- CSS CHO TRANG PROFILE --- */
        
        /* Sidebar */
        .profile-sidebar {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            padding: 20px;
            height: fit-content;
        }
        .profile-user {
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .profile-user .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #00bfa6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .profile-user .name {
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
        }
        .profile-user .email {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }
        
        .profile-nav .nav-link {
            color: #333;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 8px;
        }
        .profile-nav .nav-link .fas {
            width: 25px;
            color: #00bfa6;
        }
        .profile-nav .nav-link:hover {
            background-color: #f0fdfa;
            color: #00897b;
        }
        .profile-nav .nav-link.active {
            background-color: #e0f7f3;
            color: #00897b;
            font-weight: 600;
        }
        
        /* Main Content Cards */
        .profile-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            padding: 30px;
            margin-bottom: 25px;
        }
        .profile-card h3 {
            font-weight: 600;
            font-size: 1.5rem;
            color: #1c1c1c;
            margin-bottom: 25px;
        }
        
        /* Form và Nút */
        .form-control, .form-select {
            border-radius: 8px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #00bfa6;
            box-shadow: 0 0 0 0.2rem rgba(0, 191, 166, 0.25);
        }
        .form-control[readonly] {
            background-color: #f4f5f7;
            cursor: not-allowed;
        }
        
        .btn-profile {
            background-color: #00bfa6;
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-profile:hover {
            background-color: #009e8c;
        }
        
        /* Bảng Lịch sử (Đây là CSS cho trạng thái đặt chỗ) */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .status-hoantat { background-color: #d1e7dd; color: #0f5132; }
        .status-dahuy { background-color: #f8d7da; color: #721c24; }
        .status-dangcho { background-color: #fff3cd; color: #664d03; }
        .status-dangsuly { background-color: #fff3cd; color: #664d03; } 
        .status-dat_thanh_cong { background-color: #d1e7dd; color: #0f5132; }

    </style>

</head>
<body>

@include('profile.includes.topbar')

<div class="container my-5">
    <div class="row">
        @include('profile.includes.sidebar')

        <main class="col-lg-9">
            <div class="profile-card">
                <h3 class="mb-4"><i class="fas fa-history me-2"></i>Lịch sử đặt chỗ</h3>

                @if ($datchos->isEmpty())
                    <p class="text-muted">Bạn chưa có lịch sử đặt chỗ nào.</p>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Trạm sạc</th>
                                    <th>Cổng sạc</th>
                                    <th>Ngày đặt</th>
                                    <th>Bắt đầu</th>
                                    <th>Kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datchos as $dat)
                                    @php
                                        // Sửa lỗi Carbon Parse
                                        $startTime = \Carbon\Carbon::parse($dat->timebatdau);
                                        
                                        // Chuẩn hóa trạng thái
                                        $statusKey = strtolower(str_replace(' ', '_', $dat->trangthai));
                                        
                                        // Map trạng thái với class CSS (ĐÃ THÊM 'choxacnhan')
                                        $statusMap = [
                                            'dat_thanh_cong' => 'status-dat_thanh_cong',
                                            'hoantat' => 'status-hoantat',
                                            'dahuy' => 'status-dahuy',
                                            'dangcho' => 'status-dangcho',
                                            'dangsuly' => 'status-dangsuly',
                                            'choxacnhan' => 'status-dangcho', // Thêm 'choxacnhan'
                                        ];
                                        $statusClass = $statusMap[$statusKey] ?? 'status-dangcho';
                                    @endphp
                                    <tr>
                                        <td>{{ $dat->tramSac->tentram ?? 'Không có dữ liệu' }}</td>
                                        <td>{{ $dat->congSac->tencong ?? 'Không có dữ liệu' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($dat->ngaydat)->format('d/m/Y') }}</td>
                                        
                                        <td>{{ \Carbon\Carbon::parse($dat->timebatdau)->format('d/m/Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($dat->timeketthuc)->format('d/m/Y H:i') }}</td>
                                        
                                        <td>
                                            <span class="status-badge {{ $statusClass }}">
                                                {{ ucfirst($dat->trangthai) }}
                                            </span>
                                        </td>

                                        <td class="text-nowrap">
                                            
                                            {{-- 1. Nút "Huỷ" (Sử dụng PUT) --}}
                                            @if(in_array($statusKey, ['dat_thanh_cong', 'dangcho', 'dangsuly', 'choxacnhan']) && $startTime->isFuture())
                                                
                                                <form action="{{ route('datcho.cancel', $dat->datcho_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn huỷ đặt chỗ này?');">
                                                    @csrf
                                                    @method('PUT') 
                                                    <button type="submit" class="btn btn-warning btn-sm" title="Huỷ đặt chỗ">
                                                        <i class="fas fa-times"></i> Huỷ
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- 2. Nút "Xoá" (Sử dụng DELETE) --}}
                                            @if(in_array($statusKey, ['hoantat', 'dahuy']))
                                                <form action="{{ route('datcho.destroy', $dat->datcho_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xoá vĩnh viễn lịch sử này?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Xoá lịch sử">
                                                        <i class="fas fa-trash"></i> Xoá
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Không có lịch sử đặt chỗ nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>

<footer>
    &copy; 2025 Trạm Sạc Điện. Bản quyền thuộc về hệ thống quản lý EV.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
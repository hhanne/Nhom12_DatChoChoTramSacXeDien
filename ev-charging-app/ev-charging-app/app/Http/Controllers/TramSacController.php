<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TramSac;
use App\Models\CongSac;

class TramSacController extends Controller
{
    // Áp dụng middleware 'auth' để chỉ người đăng nhập mới truy cập
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Hiển thị danh sách trạm sạc + tìm kiếm
    public function index(Request $request)
    {
        $query = TramSac::query();

        // Tìm kiếm theo tên hoặc địa chỉ
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('tentram', 'LIKE', "%{$search}%")
                  ->orWhere('diachi', 'LIKE', "%{$search}%");
            });
        }

        // Lọc theo loại trạm
        if ($request->filled('loaitram')) {
            $query->where('loaitram', $request->loaitram);
        }

        // Lọc theo công suất tối thiểu
        if ($request->filled('min_congsuat')) {
            $min = $request->min_congsuat;
            // Quan trọng: Phải đảm bảo 'congsacs' là tên relationship đúng trong Model TramSac
            $query->whereHas('congsacs', function($q) use ($min) {
                $q->where('congsuat', '>=', $min);
            });
        }

        // Chỉ hiển thị trạm hoạt động (Giữ nguyên nếu bạn muốn)
        // $query->where('trangthai', 'hoatdong'); // Tạm comment nếu muốn test với cả trạm bảo trì

        // ===== DI CHUYỂN KHỐI SẮP XẾP LÊN ĐÂY =====
        if ($request->filled('sort')) {
            if ($request->sort === 'name_asc') {
                $query->orderBy('tentram', 'asc'); // Sắp xếp A-Z
            } elseif ($request->sort === 'name_desc') {
                $query->orderBy('tentram', 'desc'); // Sắp xếp Z-A
            }
        } else {
             // Thêm sắp xếp mặc định nếu muốn (ví dụ: theo ID mới nhất)
             $query->orderBy('tramsac_id', 'desc'); 
        }
        // ===========================================

        // Gọi paginate() SAU KHI đã áp dụng filter và sort
        // Thêm appends() để giữ filter/sort khi chuyển trang
        $tramsacs = $query->paginate(9)->appends($request->query()); // Đổi thành 9 trạm/trang nếu muốn

        // Chỉ cần 1 lệnh return ở cuối
        return view('tramsac.index', compact('tramsacs'));
    }

    // Xem chi tiết trạm
    public function show($id)
    {
        $tram = TramSac::with('congsacs')->findOrFail($id);
        return view('tramsac.show', compact('tram'));
    }

    
}

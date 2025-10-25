<?php

namespace App\Http\Controllers;

use App\Models\Datcho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DatchoController extends Controller
{
    public function index()
    {
        try {
            $datchos = Datcho::select('datcho.*', 'users.hoten as user_name', 'tramsac.tentram as tram_name')
                ->leftJoin('users', 'datcho.user_id', '=', 'users.user_id')
                ->leftJoin('tramsac', 'datcho.tramsac_id', '=', 'tramsac.tramsac_id')
                ->leftJoin('congsac', 'datcho.congsac_id', '=', 'congsac.congsac_id')
                ->leftJoin('thanhtoan', 'datcho.thanhtoan_id', '=', 'thanhtoan.thanhtoan_id')
                ->paginate(10);

            // Thống kê cho Statistics Cards
            $stats = [
                'total' => Datcho::count(),
                'choxacnhan' => Datcho::where('trangthai', 'choxacnhan')->count(),
                'dadat' => Datcho::where('trangthai', 'dadat')->count(),
                'dang_sac' => Datcho::where('trangthai', 'dang_sac')->count(),
                'hoanthanh' => Datcho::where('trangthai', 'hoanthanh')->count(),
                'huy' => Datcho::where('trangthai', 'huy')->count(),
            ];

            return view('admin.products.datcho', compact('datchos', 'stats'));
        } catch (\Exception $e) {
            Log::error('Lỗi khi lấy danh sách đặt chỗ: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lấy danh sách đặt chỗ: ' . $e->getMessage());
        }
    }
}
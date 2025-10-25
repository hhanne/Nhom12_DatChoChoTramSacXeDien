<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tramsac;
use App\Models\Congsac;
use App\Models\Thanhtoan;
use App\Models\Datcho;
use App\Models\LichSuSuDung;
use Illuminate\Http\Request;

class TrangchuController extends Controller
{
    public function index()
    {
        // Tổng khách hàng
        $totalUsers = User::count();

        // Tổng trạm sạc
        $totalStations = Tramsac::count();

        // Tổng cổng sạc hoạt động
        $totalActivePorts = Congsac::where('trangthai', 'hoatdong')->count();

        // Tổng chỗ đặt
        $totalBookings = Datcho::count();

        // Doanh thu tháng hiện tại
        $currentMonth = now()->format('Y-m');
        $totalRevenue = Thanhtoan::where('trangthai', 'thanhcong')
            ->whereMonth('ngaythanhtoan', now()->month)
            ->whereYear('ngaythanhtoan', now()->year)
            ->sum('sotien');

        // Hoạt động gần đây
        $recentActivities = Datcho::with(['user', 'tramsac', 'congsac'])
            ->orderBy('timebatdau', 'desc')
            ->take(5)
            ->get();

        // Dữ liệu cho biểu đồ (số lượt sạc theo ngày trong tháng)
        $chargingData = LichSuSuDung::selectRaw('DATE(timebatdau) as date, COUNT(*) as count')
            ->whereMonth('timebatdau', now()->month)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $chargingData->pluck('date')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('d/m');
        })->toArray();

        $data = $chargingData->pluck('count')->toArray();

        return view('admin.products.trangchu', compact(
            'totalUsers',
            'totalStations',
            'totalActivePorts',
            'totalBookings',
            'totalRevenue',
            'recentActivities',
            'labels',
            'data'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\TramSac;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DanhGiaController extends Controller
{
    /**
     * Hiển thị danh sách đánh giá cho một trạm sạc
     */
    public function index($tramsac_id)
    {
        $tram = TramSac::findOrFail($tramsac_id);

        // Lấy danh sách đánh giá có kèm thông tin user
        $danhgias = DanhGia::where('tramsac_id', $tramsac_id)
            ->with('user')
            ->orderBy('ngaydanhgia', 'desc')
            ->get();

        return view('danhgia.index', compact('tram', 'danhgias'));
    }

    /**
     * Gửi đánh giá mới
     */
    public function store(Request $request, $tramsac_id)
    {
        $request->validate([
            'sao' => 'required|integer|min:1|max:5',
            'noidung' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'Bạn cần đăng nhập để gửi đánh giá.');
        }

        // Kiểm tra xem user đã từng đặt chỗ/sạc tại trạm này chưa
        $daTungSuDung = DB::table('datcho')
            ->where('user_id', Auth::id())
            ->where('tramsac_id', $tramsac_id)
            ->exists();

        if (!$daTungSuDung) {
            return back()->with('error', 'Bạn chỉ có thể đánh giá sau khi đã sử dụng trạm này.');
        }

        // Tạo đánh giá mới
        DanhGia::create([
            'user_id'     => Auth::id(),
            'tramsac_id'  => $tramsac_id,
            'sao'         => $request->sao,
            'noidung'     => $request->noidung,
            'ngaydanhgia' => now(),
        ]);

        return back()->with('success', 'Cảm ơn bạn đã gửi đánh giá!');
    }

    /**
     * Xem tất cả đánh giá đã viết của người dùng
     */
    public function myReviews()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem đánh giá của bạn.');
        }

        $danhgias = DanhGia::where('user_id', Auth::id())
            ->with('tramSac')
            ->orderBy('ngaydanhgia', 'desc')
            ->get();

        return view('danhgia.my', compact('danhgias'));
    }

    /**
     * Form chỉnh sửa đánh giá
     */
    public function edit($id)
    {
        $danhgia = DanhGia::where('danhgia_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('danhgia.edit', compact('danhgia'));
    }

    /**
     * Cập nhật đánh giá
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sao' => 'required|integer|min:1|max:5',
            'noidung' => 'required|string|max:255',
        ]);

        $danhgia = DanhGia::where('danhgia_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $danhgia->update([
            'sao' => $request->sao,
            'noidung' => $request->noidung,
            'ngaydanhgia' => now(),
        ]);

        return redirect()->route('danhgia.my')->with('success', 'Đánh giá đã được cập nhật.');
    }

    /**
     * Xoá đánh giá
     */
    public function destroy($id)
    {
        $danhgia = DanhGia::where('danhgia_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $danhgia->delete();

        return back()->with('success', 'Đánh giá đã được xoá.');
    }
}

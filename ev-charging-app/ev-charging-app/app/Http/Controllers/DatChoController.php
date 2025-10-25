<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDatChoRequest;
use App\Models\DatCho;
use App\Models\TramSac;
use App\Models\CongSac;
use App\Models\ThanhToan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DatChoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Hiển thị form đặt chỗ sạc
     */
    public function create(Request $request)
    {
        $tram = TramSac::findOrFail($request->tram_id);
        $cong = CongSac::findOrFail($request->cong_id);

        return view('datcho.create', compact('tram', 'cong'));
    }

    /**
     * Lưu thông tin đặt chỗ
     */
    public function store(StoreDatChoRequest $request)
    {
        $user = Auth::user();
        $cong = CongSac::findOrFail($request->cong_id);

        // Kiểm tra cổng sạc có bị trùng thời gian đặt không
        $isBusy = DatCho::where('congsac_id', $request->cong_id)
            ->where('trangthai', '!=', 'huy')
            ->where(function ($q) use ($request) {
                $q->whereBetween('timebatdau', [$request->timebatdau, $request->timeketthuc])
                  ->orWhereBetween('timeketthuc', [$request->timebatdau, $request->timeketthuc]);
            })
            ->exists();

        if ($isBusy) {
            return back()->with('error', '❌ Cổng sạc đã có người đặt trong thời gian này.');
        }

        // Tính số tiền
        $start = Carbon::parse($request->timebatdau);
        $end = Carbon::parse($request->timeketthuc);
        $hours = $end->diffInMinutes($start) / 60;
        $giaDien = 5000; // VND/kWh
        $sotien = $cong->congsuat * $hours * $giaDien;

        // Tạo thanh toán
        $thanhtoan = ThanhToan::create([
            'phuongthuc' => $request->phuongthuc_thanhtoan,
            'sotien' => $sotien,
            'trangthai' => 'choxuly',
            'magiaodich' => 'GD' . now()->timestamp
        ]);

        // Tạo bản ghi đặt chỗ
        $datCho = DatCho::create([
            'user_id' => Auth::id(),
            'tramsac_id' => $request->tram_id,
            'congsac_id' => $request->cong_id,
            'thanhtoan_id' => $thanhtoan->thanhtoan_id,
            'ngaydat' => now()->toDateString(),
            'timebatdau' => $request->timebatdau,
            'timeketthuc' => $request->timeketthuc,
            'trangthai' => 'choxacnhan',
        ]);

        // // Gửi email xác nhận (nếu có)
        // Mail::to($user->email)->send(new \App\Mail\DatChoSuccessMail($user, $datCho, $sotien));


        return redirect()
        ->route('danhgia.index', ['tramsac_id' => $request->tram_id])
        ->with('success', 'Đặt chỗ thành công! Hãy để lại đánh giá cho trạm sạc này.');
    }

    /**
     * API kiểm tra tính khả dụng của cổng sạc (AJAX)
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'congsac_id' => 'required|exists:congsac,congsac_id',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        $isBusy = DatCho::where('congsac_id', $request->congsac_id)
            ->where('trangthai', '!=', 'huy')
            ->where(function ($q) use ($request) {
                $q->whereBetween('timebatdau', [$request->start, $request->end])
                  ->orWhereBetween('timeketthuc', [$request->start, $request->end]);
            })
            ->exists();

        return response()->json(['available' => !$isBusy]);
    }

public function cancel($id)
{
    $datCho = DatCho::findOrFail($id);

    // Log debug để kiểm tra quyền và dữ liệu (tạm thời)
    Log::info('Attempting cancel', [
        'auth_id' => Auth::id(),
        'datCho_id' => $datCho->{$datCho->getKeyName()} ?? $id,
        'datCho_user_id' => $datCho->user_id ?? null,
        'datCho' => $datCho->toArray(),
    ]);

    // Kiểm tra quyền hủy
    $this->authorize('cancel', $datCho);

    // Kiểm tra thời gian bắt đầu
    if (now()->gte($datCho->timebatdau)) {
        return back()->with('error', '❌ Không thể hủy đặt chỗ đã bắt đầu.');
    }

    // Cập nhật trạng thái
    $datCho->update(['trangthai' => 'huy']);

    // // Gửi email xác nhận hủy
    // $user = Auth::user();
    // if ($user && $user->email) {
    //     try {
    //         Mail::send('emails.datcho_cancel', [
    //             'user' => $user,
    //             'datCho' => $datCho,
    //         ], function ($message) use ($user) {
    //             $message->to($user->email)
    //                     ->subject('⚠️ Xác nhận hủy đặt chỗ');
    //         });
    //     } catch (\Exception $e) {
    //         Log::error('Lỗi gửi mail hủy đặt chỗ: ' . $e->getMessage());
    //     }
    // }

    return back()->with('success', '✅ Đặt chỗ đã được hủy.');
}


public function destroy(DatCho $datCho)
{
    // Kiểm tra quyền
    $this->authorize('cancel', $datCho);

    // Chỉ xóa nếu đã hủy
    if ($datCho->trangthai !== 'huy') {
        return back()->with('error', '❌ Chỉ có thể xóa đặt chỗ đã bị hủy.');
    }

    try {
        $datCho->delete();
        return back()->with('success', '🗑️ Đặt chỗ đã được xóa.');
    } catch (\Exception $e) {
        Log::error('Lỗi xóa đặt chỗ: ' . $e->getMessage());
        return back()->with('error', '⚠️ Không thể xóa đặt chỗ.');
    }
}



    /**
     * Lịch sử đặt chỗ của người dùng
     */
    public function history()
    {
        $datchos = DatCho::where('user_id', Auth::id())
            ->with(['tramSac', 'congSac', 'thanhToan'])
            ->orderByDesc('ngaydat')
            ->get();

        return view('datcho.history', compact('datchos'));
    }
    
}

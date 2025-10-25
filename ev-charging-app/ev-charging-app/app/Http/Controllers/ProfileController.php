<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\DatCho; // Model đặt chỗ của bạn

class ProfileController extends Controller
{
    /**
     * ✅ Hiển thị trang hồ sơ cá nhân + lịch sử đặt chỗ
     */
    public function show()
    {
        $user = Auth::user();

        // Lấy lịch sử đặt chỗ của người dùng hiện tại
        $bookings = DatCho::with(['tramSac', 'congSac', 'thanhToan'])
            ->where('user_id', $user->user_id)
            ->orderByDesc('ngaydat')
            ->get();

        return view('profile.show', compact('user', 'bookings'));
    }

    /**
     * ✅ Cập nhật thông tin cá nhân
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Kiểm tra dữ liệu hợp lệ
        $validated = $request->validate([
            'hoten' => ['required', 'string', 'max:100'],
            'gioitinh' => ['required', 'in:Nam,Nữ'],
            'diachi' => ['nullable', 'string', 'max:255'],
            'ngaysinh' => ['nullable', 'date'],
            'sdt' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->user_id, 'user_id')],
            'matkhau' => ['nullable', 'confirmed', 'min:6'],
        ]);

        // Cập nhật thông tin
        $user->hoten = $validated['hoten'];
        $user->gioitinh = $validated['gioitinh'];
        $user->diachi = $validated['diachi'] ?? $user->diachi;
        $user->ngaysinh = $validated['ngaysinh'] ?? $user->ngaysinh;
        $user->sdt = $validated['sdt'] ?? $user->sdt;
        $user->email = $validated['email'];

        if (!empty($validated['matkhau'])) {
            $user->matkhau = Hash::make($validated['matkhau']);
        }

        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }


    // public function updatePassword(Request $request)
    // {
    //     $user = Auth::user();

    //     // Validate dữ liệu đầu vào
    //     $request->validate([
    //         'current_password' => ['required', 'string'],
    //         'password' => ['required', 'string', 'min:6', 'confirmed'],
    //     ]);

    //     // Kiểm tra mật khẩu hiện tại
    //     if (!Hash::check($request->current_password, $user->matkhau)) {
    //         return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.'])->withInput();
    //     }

    //     // Cập nhật mật khẩu mới
    //     $user->matkhau = Hash::make($request->password);
    //     $user->save();

    //     return back()->with('status', 'password-updated');
    // }
        public function history()
    {
        $datchos = DatCho::where('user_id', Auth::id())
            ->with(['tramSac', 'congSac', 'thanhToan'])
            ->orderByDesc('ngaydat')
            ->get();

        return view('profile.history', compact('datchos'));
    }

    // Hiển thị form đổi mật khẩu
    public function editPassword()
    {
        return view('profile.change-password'); // file Blade riêng
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validate dữ liệu đầu vào
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
       ]);

       // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.'])->withInput();
        }

        // Cập nhật mật khẩu mới (sử dụng bcrypt qua Hash::make)
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'password-updated');
    }


}

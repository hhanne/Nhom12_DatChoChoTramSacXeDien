<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class KhachhangController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.products.khachhang', compact('users'));
    }

    public function create()
    {
        return view('chinhsua.themkhach');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hoten' => 'required|string|max:100',
            'sdt' => 'required|string|regex:/^[0-9]{10,11}$/|unique:users,sdt',
            'email' => 'required|email|max:100|unique:users,email',
            'diachi' => 'required|string|max:255',
            'gioitinh' => 'required|in:Nam,Nữ',
            'ngaysinh' => 'required|date',
            'trangthai' => 'required|in:hoatdong,bikhoa,active',
            'phanquyen' => 'required|in:user,admin',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed in store: ' . json_encode($validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            User::create([
                'hoten' => $request->hoten,
                'sdt' => $request->sdt,
                'email' => $request->email,
                'diachi' => $request->diachi,
                'gioitinh' => $request->gioitinh,
                'ngaysinh' => $request->ngaysinh,
                'trangthai' => $request->trangthai,
                'phanquyen' => $request->phanquyen,
                'password' => Hash::make($request->password),
                'ngaytaotk' => now(),
            ]);

            return redirect()->route('chinhsua.khachhang.index')->with('success', 'Thêm khách hàng thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm khách hàng: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi thêm khách hàng: ' . $e->getMessage());
        }
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('chinhsua.chitietkhach', compact('user'));
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('chinhsua.suakhach', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
        Log::info('Update request for user_id: ' . $user_id . ', sdt: ' . $request->sdt);

        $validator = Validator::make($request->all(), [
            'hoten' => 'required|string|max:100',
            'sdt' => 'required|string|regex:/^[0-9]{10,11}$/|unique:users,sdt,' . $user_id . ',user_id',
            'email' => 'required|email|max:100|unique:users,email,' . $user_id . ',user_id',
            'diachi' => 'required|string|max:255',
            'gioitinh' => 'required|in:Nam,Nữ',
            'ngaysinh' => 'required|date',
            'trangthai' => 'required|in:hoatdong,bikhoa,active',
            'phanquyen' => 'required|in:user,admin',
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed in update: ' . json_encode($validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::findOrFail($user_id);
            $updateData = [
                'hoten' => $request->hoten,
                'sdt' => $request->sdt,
                'email' => $request->email,
                'diachi' => $request->diachi,
                'gioitinh' => $request->gioitinh,
                'ngaysinh' => $request->ngaysinh,
                'trangthai' => $request->trangthai,
                'phanquyen' => $request->phanquyen,
            ];

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            return redirect()->route('chinhsua.khachhang.index')->with('success', 'Cập nhật khách hàng thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật khách hàng: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật khách hàng: ' . $e->getMessage());
        }
    }

    public function delete($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('chinhsua.xoakhach', compact('user'));
    }

    public function destroy($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            Log::info('Attempting to delete khách hàng: ' . $user_id);

            // Kiểm tra dữ liệu liên quan
            $relatedData = [
                'datcho' => $user->datcho()->count(),
                'lichsusudungs' => $user->lichsusudungs()->count(),
                'danhgia' => $user->danhgia()->count(),
            ];
            Log::info('Related data count: ' . json_encode($relatedData));

            // Xóa dữ liệu liên quan
            if ($relatedData['datcho'] > 0) {
                $user->datcho()->delete();
                Log::info('Deleted ' . $relatedData['datcho'] . ' đặt chỗ for khách hàng: ' . $user_id);
            }
            if ($relatedData['lichsusudungs'] > 0) {
                $user->lichsusudungs()->delete();
                Log::info('Deleted ' . $relatedData['lichsusudungs'] . ' lịch sử sử dụng for khách hàng: ' . $user_id);
            }
            if ($relatedData['danhgia'] > 0) {
                $user->danhgia()->delete();
                Log::info('Deleted ' . $relatedData['danhgia'] . ' đánh giá for khách hàng: ' . $user_id);
            }

            // Xóa khách hàng
            $user->delete();
            Log::info('Khách hàng deleted successfully: ' . $user_id);
            return redirect()->route('chinhsua.khachhang.index')->with('success', 'Xóa khách hàng thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa khách hàng: ' . $e->getMessage());
            return redirect()->route('chinhsua.khachhang.index')->with('error', 'Đã xảy ra lỗi khi xóa khách hàng: ' . $e->getMessage());
        }
    }
}
<?php
// File: app/Http/Controllers/DangnhapController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DangnhapController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->phanquyen === 'admin') {
                return redirect()->route('admin.products.index');
            }
            // Đăng xuất người dùng không phải admin
            Auth::logout();
            return redirect('/dangnhap')->with('error', 'Chỉ quản trị viên được phép đăng nhập.');
        }
        return view('auth.dangnhap');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = \App\Models\User::where('email', $request->email)
            ->where('trangthai', 'hoatdong')
            ->first();

        if (!$user) {
            return back()->with('error', 'Tài khoản không tồn tại hoặc không hoạt động.');
        }

        if ($user->phanquyen !== 'admin') {
            return back()->with('error', 'Chỉ quản trị viên được phép đăng nhập.');
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/products')->with('success', 'Đăng nhập thành công!');
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/dangnhap')->with('success', 'Đăng xuất thành công!');
    }
}
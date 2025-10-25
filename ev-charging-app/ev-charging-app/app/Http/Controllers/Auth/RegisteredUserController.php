<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hoten' => ['required', 'string', 'max:100'],
            'gioitinh' => ['required', 'in:Nam,Nữ'],
            'ngaysinh' => ['nullable', 'date'],
            'diachi' => ['nullable', 'string', 'max:255'],
            'sdt' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'hoten' => $request->hoten,
            'gioitinh' => $request->gioitinh,
            'ngaysinh' => $request->ngaysinh,
            'diachi' => $request->diachi,
            'sdt' => $request->sdt,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
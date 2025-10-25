<?php

namespace App\Http\Controllers;

use App\Models\Tramsac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class TramsacController extends Controller
{
    // Hiển thị danh sách trạm sạc
    public function index()
    {
        $tramsacs = Tramsac::all();
        return view('admin.products.tramsac', compact('tramsacs'));
    }

    // Form thêm trạm sạc
    public function create()
    {
        return view('chinhsua.themtram');
    }

    // Xử lý lưu trạm sạc mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tentram' => 'required|string|max:100',
            'diachi' => 'required|string|max:255',
            'hinhanh_url' => 'nullable|url|max:255',
            'hinhanh_file' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'loaitram' => 'required|in:Nhanh,Chậm',
            'trangthai' => 'required|in:hoatdong,baotri,trong',
            'soluong_congsac' => 'required|integer|min:1',
            'toado_lat' => 'required|numeric',
            'toado_lng' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed in store: ' . json_encode($validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Xử lý upload ảnh nếu có
            $hinhanh_path = null;
            if ($request->hasFile('hinhanh_file')) {
                $file = $request->file('hinhanh_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/tramsac'), $fileName);
                $hinhanh_path = 'uploads/tramsac/' . $fileName;
            } elseif (!empty($request->hinhanh_url)) {
                $hinhanh_path = $request->hinhanh_url;
            }

            Tramsac::create([
                'tentram' => $request->tentram,
                'diachi' => $request->diachi,
                'hinhanh_url' => $hinhanh_path,
                'loaitram' => $request->loaitram,
                'trangthai' => $request->trangthai,
                'soluong_congsac' => $request->soluong_congsac,
                'toado_lat' => $request->toado_lat,
                'toado_lng' => $request->toado_lng,
            ]);

            return redirect()->route('chinhsua.tramsac.index')->with('success', 'Thêm trạm sạc thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm trạm sạc: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi thêm trạm sạc: ' . $e->getMessage());
        }
    }

    // Hiển thị chi tiết trạm sạc
    public function show($tramsac_id)
    {
        $tramsac = Tramsac::findOrFail($tramsac_id);
        return view('chinhsua.chitiettram', compact('tramsac'));
    }

    // Form sửa trạm sạc
    public function edit($tramsac_id)
    {
        $tramsac = Tramsac::findOrFail($tramsac_id);
        return view('chinhsua.suatram', compact('tramsac'));
    }

    // Xử lý cập nhật trạm sạc
    public function update(Request $request, $tramsac_id)
    {
        $validator = Validator::make($request->all(), [
            'tentram' => 'required|string|max:100',
            'diachi' => 'required|string|max:255',
            'hinhanh_url' => 'nullable|url|max:255',
            'hinhanh_file' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'loaitram' => 'required|in:Nhanh,Chậm',
            'trangthai' => 'required|in:hoatdong,baotri,trong',
            'soluong_congsac' => 'required|integer|min:1',
            'toado_lat' => 'required|numeric',
            'toado_lng' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed in update: ' . json_encode($validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $tramsac = Tramsac::findOrFail($tramsac_id);

            // Xử lý ảnh mới (nếu có)
            $hinhanh_path = $tramsac->hinhanh_url;
            if ($request->hasFile('hinhanh_file')) {
                $file = $request->file('hinhanh_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/tramsac'), $fileName);
                $hinhanh_path = 'uploads/tramsac/' . $fileName;
            } elseif (!empty($request->hinhanh_url)) {
                $hinhanh_path = $request->hinhanh_url;
            }

            $tramsac->update([
                'tentram' => $request->tentram,
                'diachi' => $request->diachi,
                'hinhanh_url' => $hinhanh_path,
                'loaitram' => $request->loaitram,
                'trangthai' => $request->trangthai,
                'soluong_congsac' => $request->soluong_congsac,
                'toado_lat' => $request->toado_lat,
                'toado_lng' => $request->toado_lng,
            ]);

            return redirect()->route('chinhsua.tramsac.index')->with('success', 'Cập nhật trạm sạc thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật trạm sạc: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật trạm sạc: ' . $e->getMessage());
        }
    }

    // Trang xác nhận xóa
    public function delete($tramsac_id)
    {
        $tramsac = Tramsac::findOrFail($tramsac_id);
        return view('chinhsua.xoatram', compact('tramsac'));
    }

    // Xử lý xóa trạm sạc
    public function destroy($tramsac_id)
    {
        try {
            $tramsac = Tramsac::findOrFail($tramsac_id);

            // Xóa dữ liệu liên quan
            $tramsac->congsacs()->delete();
            $tramsac->datcho()->delete();
            $tramsac->lichsusudungs()->delete();
            $tramsac->danhgia()->delete();

            // Xóa trạm sạc
            $tramsac->delete();

            return redirect()->route('chinhsua.tramsac.index')->with('success', 'Xóa trạm sạc thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa trạm sạc: ' . $e->getMessage());
            return redirect()->route('chinhsua.tramsac.index')->with('error', 'Đã xảy ra lỗi khi xóa trạm sạc: ' . $e->getMessage());
        }
    }
}

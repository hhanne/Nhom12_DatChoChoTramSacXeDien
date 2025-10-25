<?php

namespace App\Http\Controllers;

use App\Models\CongSac;
use App\Models\TramSac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CongSacController extends Controller
{
    public function index()
    {
        $congsacs = CongSac::with('tramsac')->paginate(10);
        $tramsacs = TramSac::all();
        return view('admin.products.congsac', compact('congsacs', 'tramsacs'));
    }

    public function show($congsac_id)
    {
        $congsac = CongSac::where('congsac_id', $congsac_id)->with('tramsac')->firstOrFail();
        return view('chinhsua.chitietcong', compact('congsac'));
    }

    public function create()
    {
        $tramsacs = TramSac::all();
        return view('chinhsua.themcong', compact('tramsacs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tencong' => 'required|string|max:50',
            'tramsac_id' => 'required|exists:tramsac,tramsac_id',
            'loaicong' => 'required|in:nhanh,cham',
            'congsuat' => 'required|numeric|min:0',
            'trangthai' => 'required|in:hoatdong,baotri,trong',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed in store: ' . json_encode($validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            CongSac::create([
                'tencong' => $request->tencong,
                'tramsac_id' => $request->tramsac_id,
                'loaicong' => $request->loaicong,
                'congsuat' => $request->congsuat,
                'trangthai' => $request->trangthai,
            ]);
            return redirect()->route('chinhsua.congsac.index')->with('success', 'Thêm cổng sạc thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm cổng sạc: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi thêm cổng sạc: ' . $e->getMessage());
        }
    }

    public function edit($congsac_id)
    {
        $congsac = CongSac::with('tramsac')->where('congsac_id', $congsac_id)->firstOrFail();
        $tramsacs = TramSac::all();
        return view('chinhsua.suacong', compact('congsac', 'tramsacs'));
    }

    public function update(Request $request, $congsac_id)
    {
        $validator = Validator::make($request->all(), [
            'tencong' => 'required|string|max:50',
            'tramsac_id' => 'required|exists:tramsac,tramsac_id',
            'loaicong' => 'required|in:nhanh,cham',
            'congsuat' => 'required|numeric|min:0',
            'trangthai' => 'required|in:hoatdong,baotri,trong',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed in update: ' . json_encode($validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $congsac = CongSac::where('congsac_id', $congsac_id)->firstOrFail();
            $congsac->update([
                'tencong' => $request->tencong,
                'tramsac_id' => $request->tramsac_id,
                'loaicong' => $request->loaicong,
                'congsuat' => $request->congsuat,
                'trangthai' => $request->trangthai,
            ]);
            return redirect()->route('chinhsua.congsac.index')->with('success', 'Cập nhật cổng sạc thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật cổng sạc: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật cổng sạc: ' . $e->getMessage());
        }
    }

    public function delete($congsac_id)
    {
        $congsac = CongSac::where('congsac_id', $congsac_id)->firstOrFail();
        return view('chinhsua.xoacong', compact('congsac'));
    }

    public function destroy($congsac_id)
    {
        try {
            $congsac = CongSac::where('congsac_id', $congsac_id)->firstOrFail();
            $congsac->delete();
            return redirect()->route('chinhsua.congsac.index')->with('success', 'Xóa cổng sạc thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa cổng sạc: ' . $e->getMessage());
            return redirect()->route('chinhsua.congsac.index')->with('error', 'Đã xảy ra lỗi khi xóa cổng sạc: ' . $e->getMessage());
        }
    }
}
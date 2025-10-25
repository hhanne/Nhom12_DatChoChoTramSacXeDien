<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDatChoRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Chỉ cho phép user đã đăng nhập gửi yêu cầu
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'tram_id' => 'required|exists:tramsac,tramsac_id',
            'cong_id' => 'required|exists:congsac,congsac_id',
            'timebatdau' => 'required|date',
            'timeketthuc' => 'required|date|after:timebatdau',
            'phuongthuc_thanhtoan' => 'required|in:tienmat,momo,zalopay,visa,vnpay',
        ];
    }

    public function messages(): array
    {
        return [
            'tram_id.required' => 'Vui lòng chọn trạm sạc.',
            'tram_id.exists' => 'Trạm sạc không tồn tại.',
            'cong_id.required' => 'Vui lòng chọn cổng sạc.',
            'cong_id.exists' => 'Cổng sạc không tồn tại.',
            'timebatdau.required' => 'Vui lòng chọn thời gian bắt đầu.',
            'timeketthuc.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu.',
            'phuongthuc_thanhtoan.in' => 'Phương thức thanh toán không hợp lệ.',
        ];
    }
}

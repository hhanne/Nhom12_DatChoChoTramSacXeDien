<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    use HasFactory;

    protected $table = 'thanhtoan';
    protected $primaryKey = 'thanhtoan_id';
    public $timestamps = false;

    protected $fillable = [
        'phuongthuc',   // tienmat, momo, zalopay, visa, vnpay
        'sotien',
        'trangthai',    // choxuly, thanhcong, thatbai
        'ngaythanhtoan',
        'magiaodich'
    ];

    // Quan hệ với DatCho
    public function datCho()
    {
        return $this->hasOne(DatCho::class, 'thanhtoan_id', 'thanhtoan_id');
    }
}

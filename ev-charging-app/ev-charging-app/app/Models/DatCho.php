<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatCho extends Model
{
    use HasFactory;

    protected $table = 'datcho';
    protected $primaryKey = 'datcho_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'tramsac_id', 'congsac_id',
        'thanhtoan_id', 'ngaydat', 'timebatdau', 'timeketthuc', 'trangthai'
    ];

    public function tramSac()
    {
        return $this->belongsTo(TramSac::class, 'tramsac_id');
    }

    public function congSac()
    {
        return $this->belongsTo(CongSac::class, 'congsac_id');
    }

    public function thanhToan() {
        return $this->belongsTo(ThanhToan::class, 'thanhtoan_id', 'thanhtoan_id');
    }

    public function user() {
        // Nếu bảng users dùng 'id' làm primary key, bỏ tham số thứ 3
        return $this->belongsTo(User::class, 'user_id');
    }
}

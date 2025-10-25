<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TramSac extends Model
{
    use HasFactory;

    protected $table = 'tramsac';
    protected $primaryKey = 'tramsac_id';
    public $timestamps = false;

    protected $fillable = [
        'tentram', 'diachi', 'loaitram', 'soluong_congsac',
        'toado_lat', 'toado_lng', 'trangthai', 'hinhanh_url'
    ];

    public function congsacs()
    {
        return $this->hasMany(CongSac::class, 'tramsac_id');
    }

    public function danhgias()
    {
        return $this->hasMany(DanhGia::class, 'tramsac_id');
    }

    public function getTrungBinhSaoAttribute()
    {
        return round($this->danhgias()->avg('sao'), 1);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;

    protected $table = 'danhgia';
    protected $primaryKey = 'danhgia_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tramsac_id',
        'sao',
        'noidung',
        'ngaydanhgia',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tramSac()
    {
        return $this->belongsTo(TramSac::class, 'tramsac_id');
    }
}

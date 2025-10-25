<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thanhtoan extends Model
{
    protected $table = 'thanhtoan';
    protected $primaryKey = 'thanhtoan_id';
    public $timestamps = false;

    protected $fillable = [
        'phuongthuc',
        'sotien',
        'ngaythanhtoan',
        'trangthai',
        'magiaodich',
    ];

    public function datcho()
    {
        return $this->hasMany(Datcho::class, 'thanhtoan_id', 'thanhtoan_id');
    }
}
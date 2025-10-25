<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tramsac extends Model
{
    protected $table = 'tramsac';
    protected $primaryKey = 'tramsac_id';
    public $timestamps = false;

    protected $fillable = [
        'tentram',
        'diachi',
        'loaitram',
        'soluong_congsac',
        'toado_lat',
        'toado_lng',
        'trangthai',
        'hinhanh_url',
    ];

    public function congsacs()
    {
        return $this->hasMany(Congsac::class, 'tramsac_id', 'tramsac_id');
    }

    public function datcho()
    {
        return $this->hasMany(Datcho::class, 'tramsac_id', 'tramsac_id');
    }

    public function lichsusudungs()
    {
        return $this->hasMany(Lichsusudung::class, 'tramsac_id', 'tramsac_id');
    }

    public function danhgia()
    {
        return $this->hasMany(Danhgia::class, 'tramsac_id', 'tramsac_id');
    }
}
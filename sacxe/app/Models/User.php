<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'hoten',
        'sdt',
        'email',
        'diachi',
        'gioitinh',
        'ngaysinh',
        'password',
        'trangthai',
        'ngaytaotk',
        'phanquyen',
    ];

    protected $hidden = [
        'password',
    ];

    public function datcho()
    {
        return $this->hasMany(Datcho::class, 'user_id', 'user_id');
    }

    public function danhgia()
    {
        return $this->hasMany(Danhgia::class, 'user_id', 'user_id');
    }

    public function lichsusudungs()
    {
        return $this->hasMany(Lichsusudung::class, 'user_id', 'user_id');
    }
}
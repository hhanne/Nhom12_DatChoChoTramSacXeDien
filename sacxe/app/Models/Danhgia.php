<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Danhgia extends Model
{
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
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function tramsac()
    {
        return $this->belongsTo(Tramsac::class, 'tramsac_id', 'tramsac_id');
    }
}
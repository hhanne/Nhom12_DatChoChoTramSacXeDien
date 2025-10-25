<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datcho extends Model
{
    protected $table = 'datcho';
    protected $primaryKey = 'datcho_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tramsac_id',
        'congsac_id',
        'thanhtoan_id',
        'ngaydat',
        'timebatdau',
        'timeketthuc',
        'trangthai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function tramsac()
    {
        return $this->belongsTo(Tramsac::class, 'tramsac_id', 'tramsac_id');
    }

    public function congsac()
    {
        return $this->belongsTo(Congsac::class, 'congsac_id', 'congsac_id');
    }

    public function thanhtoan()
    {
        return $this->belongsTo(Thanhtoan::class, 'thanhtoan_id', 'thanhtoan_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuSuDung extends Model
{
    protected $table = 'lichsusudung';
    protected $primaryKey = 'lichsu_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tramsac_id',
        'congsac_id',
        'timebatdau',
        'timeketthuc',
        'luong_dien',
        'tongtien',
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
}
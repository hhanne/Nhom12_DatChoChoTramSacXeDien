<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Congsac extends Model
{
    protected $table = 'congsac';
    protected $primaryKey = 'congsac_id';
    public $timestamps = false;

    protected $fillable = [
        'tencong',
        'tramsac_id',
        'loaicong',
        'congsuat',
        'trangthai',
    ];

    public function tramsac()
    {
        return $this->belongsTo(Tramsac::class, 'tramsac_id', 'tramsac_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongSac extends Model
{
    use HasFactory;

    protected $table = 'congsac';
    protected $primaryKey = 'congsac_id';
    public $timestamps = false;

    protected $fillable = [
        'tramsac_id', 'tencong', 'loaicong', 'congsuat', 'trangthai'
    ];

    public function tramsac()
    {
        return $this->belongsTo(TramSac::class, 'tramsac_id');
    }
}

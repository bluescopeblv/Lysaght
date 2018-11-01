<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefectList extends Model
{
    protected $table = "defectlist";

    public function loaikhiemkhuyet()
    {
    	return $this->belongsTo('App\LoaiKhiemKhuyet','id_loaikhiemkhuyet','id');
    }
}

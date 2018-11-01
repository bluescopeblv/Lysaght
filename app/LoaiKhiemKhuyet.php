<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiKhiemKhuyet extends Model
{
    protected $table = "loaikhiemkhuyet";

    public function defectlist()
    {
    	return $this->hasMany('App\Defectlist','id_loaikhiemkhuyet','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhanvien extends Model
{
    protected $table = "fs_nhanvien";

    public function nhanvien_group()
    {
    	return $this->belongsTo('App\NhanvienGroup','group_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhanvienGroup extends Model
{
    protected $table = "fs_nhanvien_group";

    public function nhanvien()
    {
    	return $this->hasMany('App\Nhanvien','group_id','id');
    }

    public function chamdiem()
    {
    	return $this->hasMany('App\Chamdiem','nhanvien_group_id','id');
    }

    public function fsgroup()
    {
    	return $this->belongsTo('App\FSGroup','fs_group_id','id');
    }
}

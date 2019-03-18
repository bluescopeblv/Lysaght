<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FSGroup extends Model
{
    protected $table = "fs_group";

    public function nhanviengroup()
    {
    	return $this->hasMany('App\NhanvienGroup','fs_group_id','id');
    }

}

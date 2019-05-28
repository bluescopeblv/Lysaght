<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutMaintType extends Model
{
    protected $table = "outs_maint_type";

    public function outs_maint_activity()
    {
    	return $this->hasMany('App\OutMaintActivity','outs_maint_type_id','id');
    }
}

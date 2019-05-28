<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutMaintMachine extends Model
{
    protected $table = "outs_maint_machine";

    public function outs_maint_activity()
    {
    	return $this->hasMany('App\OutMaintActivity','outs_maint_machine_id','id');
    }
}

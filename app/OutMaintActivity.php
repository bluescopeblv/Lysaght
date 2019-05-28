<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutMaintActivity extends Model
{
    protected $table = "outs_maint_activity";


    public function outs_maint_type()
    {
    	return $this->belongsTo('App\OutMaintType','outs_maint_type_id','id');
    }

    public function outs_maint_machine()
    {
    	return $this->belongsTo('App\OutMaintMachine','outs_maint_machine_id','id');
    }

    public function users()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
}

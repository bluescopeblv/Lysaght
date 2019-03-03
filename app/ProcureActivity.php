<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcureActivity extends Model
{
    protected $table = "procu_activity";


    public function proc_transportation_price()
    {
    	return $this->belongsTo('App\ProcureTransport','proc_transportation_price_id','id');
    }

    public function procu_production_norm()
    {
    	return $this->belongsTo('App\ProcureProduct','procu_production_norm_id','id');
    }

    public function procu_estimated_price()
    {
    	return $this->belongsTo('App\ProcureEstimated','procu_estimated_price_id','id');
    }

    public function users()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

}

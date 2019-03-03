<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcureEstimated extends Model
{
    protected $table = "procu_estimated_price";

    public function procu_activity()
    {
        return $this->hasMany('App\ProcureActivity','procu_estimated_price_id','id');
    }
}

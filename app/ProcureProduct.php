<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcureProduct extends Model
{
    protected $table = "procu_production_norm";

    public function procu_activity()
    {
        return $this->hasMany('App\ProcureActivity','procu_production_norm_id','id');
    }


    
}

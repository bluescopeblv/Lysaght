<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcureTransport extends Model
{
    protected $table = "proc_transportation_price";

    public function procu_activity()
    {
        return $this->hasMany('App\ProcureActivity','proc_transportation_price_id','id');
    }
}

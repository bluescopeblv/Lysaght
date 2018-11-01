<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "activity";

    public function activity_list()
    {
    	return $this->belongsTo('App\ActivityList','id_tenhoatdong','id');
    }
}

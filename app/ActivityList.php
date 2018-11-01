<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityList extends Model
{
    protected $table = "activity_list";

    public function activity()
    {
    	return $this->hasMany('App\Activity','id_tenhoatdong','id');
    }
}

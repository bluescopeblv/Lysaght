<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceChiPhiSparepart extends Model
{
    protected $table = "maint_chiphisparepart";

    public function users()
    {
    	return $this->belongsTo('App\User','id_user','id');
    }

}

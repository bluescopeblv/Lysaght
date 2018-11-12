<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitiet extends Model
{
    protected $table = "fs_chitiet";

    public function chamdiem()
    {
    	return $this->belongsTo('App\Chamdiem','chamdiem_id','id');
    }
}

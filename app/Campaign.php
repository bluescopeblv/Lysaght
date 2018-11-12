<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = "fs_campaign";

    public function chamdiem()
    {
    	return $this->hasMany('App\Chamdiem','campaign_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicActivity extends Model
{
    protected $table = "music_activity";

    public function music_info()
    {
        return $this->hasMany('App\MusicInfo','music_activity_id','id');
    }

    public function users()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
    
}

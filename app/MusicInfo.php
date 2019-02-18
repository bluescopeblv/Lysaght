<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicInfo extends Model
{
    protected $table = "music_info";

    public function music_activity()
    {
        return $this->belongsTo('App\MusicActivity','music_activity_id','id');
    }
}

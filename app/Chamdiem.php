<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chamdiem extends Model
{
    protected $table = "fs_chamdiem";

    public function chitiet()
    {
    	return $this->hasMany('App\Chitiet','chamdiem_id','id');
    }

    public function campaign()
    {
    	return $this->belongsTo('App\Campaign','campaign_id','id');
    }

    public function nhanvien_group()
    {
    	return $this->belongsTo('App\NhanvienGroup','nhanvien_group_id','id');
    }

    public function question_group()
    {
    	return $this->belongsTo('App\QuestionGroup','question_group_id','id');
    }
}

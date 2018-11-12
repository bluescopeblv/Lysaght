<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionGroup extends Model
{
    protected $table = "fs_question_group";

    public function question()
    {
    	return $this->hasMany('App\Question','group_id','id');
    }

    public function chamdiem()
    {
    	return $this->hasMany('App\Chamdiem','question_group_id','id');
    }
}

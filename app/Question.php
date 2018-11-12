<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "fs_question";

    public function question_group()
    {
    	return $this->belongsTo('App\QuestionGroup','group_id','id');
    }
}

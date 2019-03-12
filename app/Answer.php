<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answer';
    protected $fillable = ['answer_id','answer_nm','question_id','ans_correct','del_flag'];
    public $timestamps = false;
}

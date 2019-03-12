<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $fillable = ['question_id','question_nm','question_code','language_id','del_flag'];
    public $timestamps = false;
}

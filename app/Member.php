<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $fillable = ['username','password','email','birthday','address1','address2','gender','shool','education_year','interview_start','interview_end','experience_year','role','del_flag'];
    public $timestamps = false;
}

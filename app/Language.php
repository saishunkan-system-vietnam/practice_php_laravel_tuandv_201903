<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'language';
    protected $fillable = ['language_id','language_nm','language_parent','language_time','del_flag'];
    public $timestamps = false;
}

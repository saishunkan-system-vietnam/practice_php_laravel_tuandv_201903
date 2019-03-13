<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $table        = 'assign';
    protected $fillable     = ['assign_id','member_id','language_id','del_flag'];
    public    $timestamps   = false;
    protected $primaryKey   = 'assign_id';
}

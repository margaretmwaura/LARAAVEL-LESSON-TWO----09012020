<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Writeup extends Model
{
    //
    protected $fillable = ['title','message','date'];
}

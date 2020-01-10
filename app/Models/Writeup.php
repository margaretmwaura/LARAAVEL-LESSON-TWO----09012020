<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
class Writeup extends Model
{
    //
    protected $fillable = ['title','message','date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class Writeup extends Model
{
    //
    protected $fillable = ['title','message','date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function scopeGetOldest($query,$id)
   {
      return $query->where('user_id', $id)->oldest()->first();
   }
    public static function scopeDeleteWriteUps($query,$id)
    {
        return $query->where('id',$id)->delete();
    }
    public static function scopeGetRecord($query,$id)
    {
        return $query->where('user_id', $id)->get();
    }
}

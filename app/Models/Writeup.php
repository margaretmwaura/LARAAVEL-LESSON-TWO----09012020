<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class Writeup extends Model
{
    //
    protected $fillable = ['title','message','date'];

    public function setTile($value)
    {
       return $this->attributes['title'] = ucfirst($value);
    }
    public function setMessage($value)
    {
       return $this->attributes['message'] = ucfirst($value);
    }
    public function setDate($value)
    {
       return $this->attributes['date'] = \Carbon\Carbon::parse($value)->format('d/m/Y');;
    }

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

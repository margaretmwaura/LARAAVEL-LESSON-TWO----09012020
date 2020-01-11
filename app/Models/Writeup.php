<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Writeup extends Model
{
    //
    protected $fillable = ['title','message','date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
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
        return $this->attributes['date'] = $value;
    }
    public function getTime()
    {
         $val =$this->attributes['date'];
      return  \Carbon\Carbon::createFromFormat('Y-m-d', $val)
            ->format('d, M D Y');
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

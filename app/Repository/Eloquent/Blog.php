<?php

namespace App\Repository\Eloquent;
use App\Repository\BlogInterface;
class Blog implements BlogInterface
{

    protected $blog;
    public function __construct(\Blog $blog)
    {
        $this->blog=$blog;
    }

    public function all()
    {
      return $this->blog->all();
    }

    public function get($id)
    {
        return $this->blog->where('id',$id)->get();
    }
}

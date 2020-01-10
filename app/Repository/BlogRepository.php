<?php


namespace App\Repository;

use App\Models\Writeup;
use App\Repository\Interfaces\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    public function all()
    {
        return Writeup::all();
    }

    public function getRecordById($id)
    {
        return Writeup::GetRecord($id);
    }

    public function find($id)
    {
        return Writeup::find($id);
    }
}

<?php


namespace App\Repository\Interfaces;



interface BlogRepositoryInterface
{
    public function all();

    public function getRecordById($id);

    public function find($id);
}

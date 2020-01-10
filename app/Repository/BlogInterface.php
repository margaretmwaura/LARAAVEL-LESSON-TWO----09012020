<?php

namespace App\Repository;

interface BlogInterface
{
    public function all();

    public function get($id);
}

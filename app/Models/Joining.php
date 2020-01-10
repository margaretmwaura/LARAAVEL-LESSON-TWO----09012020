<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\DatabaseManager;
final class Joining
{
    public function __invoke()
    {
        return $this->UserTable()
            ->union($this->WriteupsTable())
        ->get();
    }
    private function UserTable()
    {
        return DB::table('users')
            ->select("users.name"
                ,"users.id");
    }
    private function WriteupsTable()
    {
        return DB::table('writeups')
            ->select("writeups.user_id"
                ,"writeups.title"
                ,"writeups.message");
    }
}

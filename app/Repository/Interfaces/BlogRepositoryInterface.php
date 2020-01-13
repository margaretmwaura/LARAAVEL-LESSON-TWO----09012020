<?php


namespace App\Repository\Interfaces;



use Illuminate\Http\Request;

interface BlogRepositoryInterface
{
    public function all();
    public function getRecordById($id);
    public function find($id);
    public function deleteRecord($id);
    public function updateRecord(Request $request, $id);
    public function storeRecord(Request $request, $id);

}

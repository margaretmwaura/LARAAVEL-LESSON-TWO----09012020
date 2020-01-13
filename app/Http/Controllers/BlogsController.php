<?php

namespace App\Http\Controllers;
use App\Events\MoreThanTwo;
use App\Mail\MailSender;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use App\Models\Writeup;
use Illuminate\Http\Request;
use App\Repository\Interfaces\BlogRepositoryInterface;
use App\Models\Joining;
use PhpParser\Node\Scalar\String_;
use function MongoDB\BSON\toJSON;


class BlogsController extends Controller
{

    private $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository=$blogRepository;
    }

    public function index(){
            $writeups = $this->blogRepository->all();
            return view('blogs.read')->with('writeups',$writeups);
    }
    public function create()
    {
        return view('blogs.create');
    }
    public function store(Request $request)
    {
        $user=Auth::user();
        $email=$user->email;
        $name=$user->name;

       $this->blogRepository->storeRecord($request,$user->id);
       $writes=$this->blogRepository->getRecordById($user->id);
       $count = count($writes);
        if ($count >= 2){
            event(new MoreThanTwo());
        }
        $emaildata = new \stdClass();
        $emaildata->sendto = $name;

        Mail::to($email)->send(new MailSender($emaildata));
//        $query = new Joining();
//         dd($query);
        return redirect()->back()->with('success','The blog has been published , an email has been sent');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $writeup=Writeup::find($id);
        return view('blogs.edit')->with('writeup',$writeup);
    }
    public function update(Request $request, $id)
    {
        $this->blogRepository->updateRecord($request, $id);
        return redirect()->back()->with('success','The blog has been edited');
    }
    public function destroy($id)
    {
        $this->blogRepository->deleteRecord($id);
        return redirect()->back()->with('success','The blog has been deleted');

    }
}

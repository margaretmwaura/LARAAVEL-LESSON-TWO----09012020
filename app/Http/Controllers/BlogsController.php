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

        try {
            $onetodo=new Writeup();
            $onetodo->user_id=$user->id;
            $onetodo->setTile($request->input('title'));
            $onetodo->setMessage($request->input('message'));
            $onetodo->setDate(\Carbon\Carbon::now());
            echo "The data " . $request->input('dob');
            $onetodo->save();

            Log::info("The data has been saved");
        } catch (\Exception $e) {
            Log::info("An error was encountered");
        }

       $writes=$this->blogRepository->getRecordById($user->id);
       $count = count($writes);
        if ($count >= 2){
            event(new MoreThanTwo());
        }
        $emaildata = new \stdClass();
        $emaildata->sendto = $name;

        Mail::to($email)->send(new MailSender($emaildata));
        $query = new Joining();
         dd($query);
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
        $writeup=$this->blogRepository->find($id);

        try{
            $writeup->setTile($request->input('title'));
            $writeup->setMessage($request->input('message'));
            $writeup->setDate(\Carbon\Carbon::now());

            $writeup->save();
            Log::info("Data has been saved");
        }catch (\Exception $exception)
        {
            Log::info("An error was encounterd");
        }

        $this->change = 1;
        return redirect()->back()->with('success','The blog has been edited');
    }
    public function destroy($id)
    {
        $employee = $this->blogRepository->find($id);
        $employee->delete();
        $this->change =1;
        return redirect()->back()->with('success','The blog has been deleted');

    }
}

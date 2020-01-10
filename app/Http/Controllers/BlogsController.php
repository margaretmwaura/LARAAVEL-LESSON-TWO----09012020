<?php

namespace App\Http\Controllers;
use App\Events\MoreThanTwo;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


use App\Models\Writeup;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public $change = 0;
    public function index(){
            $writeups = Writeup::all();
            return view('blogs.read')->with('writeups',$writeups);
    }
    public function create()
    {
        return view('blogs.create');
    }
    public function store(Request $request)
    {//
        $user = Auth::user();
        $email = $user->email;
        $name = $user->name;
        $onetodo = new Writeup();
        $onetodo -> title = $request->input('title');
        $onetodo -> message = $request->input('message');
        $onetodo -> date = $request->input('dob');
        $onetodo -> email = $email;
        $onetodo -> save();


//       $writes =  DB::table('writeups')->where('email', $email)->get();
//       $count = count($writes);
//        if ($count >= 2){
//            event(new MoreThanTwo());
//        }



        $emaildata = new \stdClass();
        $emaildata->sendto = $name;

        Mail::to($email)->send(new MailSender($emaildata));
//        return view('blogs.read')->with('success','You have succesfully Added a blog');

        $this->change = 1;

        return redirect()->back()->with('success','The blog has been published , an email has been sent');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $writeup =  Writeup::find($id);
        $this->change = 1;
        return view('blogs.edit')->with('writeup',$writeup);
    }
    public function update(Request $request, $id)
    {
        $writeup =  Writeup::find($id);
        $writeup -> title = $request->input('title');;
        $writeup -> message = $request->input('message');;
        $writeup -> date = $request->input('dob');
        $writeup->save();
        $this->change = 1;
        return redirect()->back()->with('success','The blog has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee = Writeup::find($id);
        $employee->delete();
        $this->change =1;
        return redirect()->back()->with('success','The blog has been deleted');

    }
}

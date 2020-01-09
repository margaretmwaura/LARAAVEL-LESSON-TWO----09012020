<?php

namespace App\Http\Controllers;
use App\Events\UserNotRegistered;
use App\Events\MoreThanTwo;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;



use App\Writeup;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $writeups = Writeup::all();
         $val = event(new UserNotRegistered());
        return view('blogs.read')->with('writeups',$writeups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $email = $user->email;

        $onetodo = new Writeup();
        $onetodo -> title = $request->input('title');
        $onetodo -> message = $request->input('message');
        $onetodo -> date = $request->input('dob');
        $onetodo -> email = $email;
        $onetodo -> save();

        // Get the currently authenticated user...


       $writes =  DB::table('writeups')->where('email', $email)->get();
       $count = count($writes);
        if ($count >= 2){
            event(new MoreThanTwo());
        }

        Mail::to($email)->send(new MailSender());
//        return view('blogs.read')->with('success','You have succesfully Added a blog');


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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $writeup =  Writeup::find($id);
        return view('blogs.edit')->with('writeup',$writeup);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $writeup =  Writeup::find($id);
        $writeup -> title = $request->input('title');;
        $writeup -> message = $request->input('message');;
        $writeup -> date = $request->input('dob');
        $writeup->save();
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
        return redirect()->back()->with('success','The blog has been deleted');

    }
}

@extends('layouts.app')
@section('content')

    <h1>Welcome to blogging</h1>
    @foreach ($writeups as $note)
       <div style="width: 100% " class="container">
           <div style="width: 100% ; height: 20px ; background-color: indianred">
               <p>{{ $note->id }}</p>
           </div>
           <div style="width: 100% ; height: 20px ; background-color: indigo">
               <p>{{ $note->title  }}</p>
           </div>
           <div style="width: 100% ; height: 100px ; color: black ; font-weight: bolder">
               <p>{{ $note->message }}</p>
           </div>
           <div style="width: 100% ; height: 10px ; color: black ; font-weight: bolder">
               <p>{{ $note->getTime()}}</p>
           </div>



               @guest
               @else
               <p>{!! Form::open(['action'=> ['BlogsController@destroy'  , $note -> id], 'method' =>'POST']) !!}
                   {{Form::submit('DELETE EVENT' , ['class' => 'delete'])}}
                   {{Form::hidden('_method' ,'DELETE')}}
                   {!! Form::close() !!}
               </p>
               <p>
                   <a href="/writeups/{{$note->id}}/edit" class="btn btn-default">Edit</a>
               </p>
               @endguest

       </div>
    @endforeach

    @endsection

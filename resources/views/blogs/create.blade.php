@extends('layouts.app')
@section('content')

    <div class="createblog">
        <label><i>Create a new writeup</i></label>
        {!! Form::open(['action'=> 'BlogsController@store' , 'method' =>'POST']) !!}
        <div class ="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',' ')}}
        </div>
        <div class ="form-group">
            {{Form::label('message','Describe your To Do')}}
            {{Form::textarea('message',' ')}}
        </div>
        <div class ="form-group">
            {{Form::label('time','When is your to do due')}}
            {{Form::date('dob', \Carbon\Carbon::now())}}
        </div>
        {{Form::submit('Submit',['class' => "submit"]) }}
        {!! Form::close() !!}
    </div>
@endsection



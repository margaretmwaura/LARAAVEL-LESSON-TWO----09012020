@extends('layouts.app');
@section('content');
    <div class="createblog">
        <label><i>Create a new writeup</i></label>
        {!! Form::open(['action'=> ['BlogsController@update',$writeup->id] , 'method' =>'POST']) !!}
        <div class ="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title', $writeup->title) }}
        </div>
        <div class ="form-group">
            {{Form::label('message','Describe your To Do')}}
            {{Form::textarea('message',$writeup->message) }}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit')}}
        {!! Form::close() !!}
    </div>
@endsection


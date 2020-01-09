@extends('layouts.app')
@section('content')
    @foreach ($writeups as $note)
       <div style="width: 100% ; text-align: center">
            <p>{{ $note -> id }}</p>
            <p>{{ $note -> title  }}</p>
            <p>{{ $note -> message }}</p>
            <p>{{ $note -> date}}</p>
            <p>{!! Form::open(['action'=> ['BlogsController@destroy'  , $note -> id], 'method' =>'POST']) !!}
                {{Form::submit('DELETE EVENT' , ['class' => 'delete'])}}
                {{Form::hidden('_method' ,'DELETE')}}
                {!! Form::close() !!}
            </p>
       </div>
    @endforeach

    @endsection

@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-2 col-xs-2 col-sm-2">

    </div>
    <div class="col-md-8 col-xs-8 col-sm-8">
        {!! Form::open(['action'=>'ContentsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['id'=>'','class'=>'form-control','placeholder'=>'Enter some text here'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-lg btn-primary'])}}
    {!! Form::close() !!}
    </div>
    <div class="col-md-2 col-xs-2 col-sm-2">

    </div>
</div>

@endsection
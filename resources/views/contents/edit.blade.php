@extends('layouts.app')
@section('content')
{!! Form::open(['action'=>['ContentsController@update', $contents->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('title','Title')}}
                    {{Form::text('title',$contents->title,['class'=>'form-control','placeholder'=>'Title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body','Body')}}
                    {{Form::textarea('body',$contents->body,['class'=>'form-control','placeholder'=>'Enter some text here'])}}
                </div>
                <div class="form-group">
                        {{Form::file('cover_image')}}
                    </div>
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Submit',['class'=>'btn btn-lg btn-primary'])}}
            {!! Form::close() !!}
@endsection
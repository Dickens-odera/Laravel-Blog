@extends('layouts.app')

@section('content')
    <h3>{{$post->title}}</h3>
    <div>
        {{$post->body}}
    </div>
    <small>Written on {{$post->created_at}}</small><br>
    <a href="/posts" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-back">Back</span></a>

@endsection
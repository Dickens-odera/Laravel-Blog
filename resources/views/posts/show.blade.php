@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <img src="/storage/cover_images/{{$post->cover_image}}" alt="no image" class="img-thumbnail img-responsive">
    </div>
    <div class="col-md-8 col-sm-8 col-xs-8 col-lg-8">
            <h3>{{$post->title}}</h3>
            <div>
                {{$post->body}}
                <hr>
                <small>Written on {{$post->created_at}} by {{$post->user->name}}</small><br>

            </div>
            <a href="{{url('/posts')}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-back">Back</span></a>

    </div>
</div>

        @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
    <a href="/posts/{{$post->id}}/edit" class="btn btn-success btn-sm">Edit</a>
    {!! Form::open(['action'=>['PostsController@destroy', $post->id],'method'=>'POST', 'class' => 'pull-right']) !!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
    {!! Form::close() !!}
        @endif
    @endif
@endsection
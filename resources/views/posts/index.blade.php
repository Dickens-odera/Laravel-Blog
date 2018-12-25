@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <h3>Recent Posts</h3>
        </div>
</div>
<ul>
    @if(count($posts) > 0 )
        <ul>
            @foreach($posts as $post)
               <div class="well well-default">
                   <div class="row">
                        <div class="col-md-4">
                                <img src="/storage/cover_images/{{$post->cover_image}}" class="img-thumbnail img-responsive"alt="no image" style="width: 100%">
                           </div>
                           <div class="col-md-8">
                                <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
                           <small>Writen on {{$post->created_at}} by {{$post->user->name}}</small>
                            </div>
                   </div>  
               </div>
            @endforeach
            {{$posts->links()}}
        </ul>
    @else
        <p>No posts found, check back later for more</p>
    @endif
</ul>
@endsection
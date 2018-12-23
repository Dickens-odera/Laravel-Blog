@extends('layouts.app')
@section('content')
<h1>Recent Posts</h1>
<ul>
    @if(count($posts) > 0 )
        <ul>
            @foreach($posts as $post)
               <div class="well">
                   <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                   <small>Writen on {{$post->created_at}}</small>
               </div>
            @endforeach
            {{$posts->links()}}
        </ul>
    @else
        <p>No posts found, check back later for more</p>
    @endif
</ul>
@endsection
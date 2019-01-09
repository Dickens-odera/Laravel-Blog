@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <a href="{{url('/posts/create')}}" class="btn btn-primary btn-sm">Create Post</a> 
                   <a href="{{url('/news/create')}}" class="btn btn-success btn-sm btn-right">Create News</a>     
    
                    <h3 class="text-center">Your Blog Posts</h3>
                    <table class="table table-striped">
                        <tr>
                            <td>Title</td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                            <td>{{$post->title}}</th>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default btn-sm">Edit</a></td>
                                <td>
                                    {!! Form::open(['action'=>['PostsController@destroy', $post->id],'method'=>'POST', 'class' => 'pull-right']) !!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    </table>
                    <!--NEWS TABLE-->
                        <h3 class="text-center">Your News Feed</h3>
                    <table class="table table-striped">
                        <tr>
                            <td>Title</td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        @foreach ($contents as $content)
                            <tr>
                            <td>{{$content->title}}</th>
                                <td><a href="/news/{{$content->id}}/edit" class="btn btn-default btn-sm">Edit</a></td>
                                <td>
                                    {!! Form::open(['action'=>['ContentsController@destroy', $content->id],'method'=>'POST', 'class' => 'pull-right']) !!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    </table>

                    <!-- END NEWS TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

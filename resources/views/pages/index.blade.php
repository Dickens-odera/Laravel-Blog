@extends('layouts.app')
@section('content')
<div class="container">
     <div class="jumbotron text-center">
                        <h1>{{$title}}</h1>
                        <p>Welcome to our blog</p>
                        <a class="btn btn-primary btn-lg" href="{{route('register')}}">{{ __('Register') }}</a>
                        <a class="btn btn-success btn-lg" href="{{route('login')}}">{{ __('Login') }}</a>
        </div>
</div>

@endsection
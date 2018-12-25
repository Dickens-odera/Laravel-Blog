@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(count($content) > 0)
                    <div class="card">
                        @foreach($content as $contents)
                            <div class="card-header">
                                <h3>{{$contents->title}}</h3>
                            </div>
                            <div class="card-body">
                            {{$contents->body}}
                            <p>Written on {{$contents->created_at}}</p>
                            <a href="/contents/{{$contents->id}}" class="btn btn-sm btn-success" data-toggle="modal" data-target=".contentModal">Read More</a>
                            </div>
                             <!--MODAL SECTION -->
 <div class="modal modal-fade contentModal" tab-index="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!--@if(count($content) > 0)-->
                        {{$contents->title}}
                    <!--@endif-->
                </div>
            </div>
        </div>
    </div>
    <!--END MODAL-->
                        @endforeach
                    </div>
                    <br>
                    {{$content->links()}}
                @else
                <p>No Contents yet to be displayed<p>
                @endif
            </div>
        </div>
    </div>
@endsection
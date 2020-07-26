@extends('layouts.app')
@section('content')
@include('Events.deleteEvents')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Event</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5">
        @foreach($events as $event)
        @if($event->organizer!=1)
            <div class="card mt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-2 mt-5">
                            @if($event->startTime < 12)
                                <h3>{{$event->startTime}} AM</h3>
                            @else
                                <h3>{{$event->startTime}} PM</h3>
                            @endif
                        </div>
                        <div class="col-4 text-center mt-4">
                            <h5>{{$event->Category['name']}}</h5>
                            <h3>{{$event->title}}</h3>
                            <p>{{$event->numberOfMember}} Members going!</p>
                        </div>
                        <div class="col-3">
                            <img src="{{asset('image/'.$event->eventPicture)}}" alt="Not Found" class="img img-thumbnail m-3" style="width:150px; height:130px;">
                        </div>
                        <div class="col-3 mt-5">
                            <a href="#" class="btn btn-warning float-right">EDIT</a>
                            <a class="delete btn btn-danger float-right mr-3" id="dlEvents" data-id="{{$event->id}}" data-target="#delete_event" data-toggle="modal" >CANCEL</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')
@section('content')
@include('Events.createEvent')
@include('Events.deleteEvents')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Find your event</h2>
            <div class="row mt-3">
                <div class="col-4">
                    <input type="text" placeholder="Search" class="form-control">
                </div>
                <div class="col-4">
                    <h5 class="float-right mt-2">Not to far from</h5>
                </div>
                <div class="col-4">
                    <select name="city" required class="form-control float-right">
                        <option selected disabled>City</option>
                        @foreach($data as $item)
                        <option>{{$item['cityCountry']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="onlyEventJoined" value="option3">
                <label class="form-check-label" for="inlineCheckbox3">Event you join only</label>
            </div>
            @foreach($events as $event)
            @if($event->organizer != Auth::id())
            <div class="card mt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-2 mt-5">
                            @if($event->startTime < 12) <h3>{{$event->startTime}} AM</h3>
                                @else
                                <h3>{{$event->startTime}} PM</h3>
                                @endif
                        </div>
                        <div class="col-4 text-center mt-4">
                            <h5>{{$event->Category['name']}}</h5>
                            <h3>{{$event->title}}</h3>
                            <p>{{$event->numberOfMember}} Members going!</p>
                        </div>
                        <div class="col-4">
                            <img src="{{asset('image/'.$event->eventPicture)}}" alt="Not Found" class="img img-thumbnail m-3" style="width:150px; height:130px;">
                        </div>
                        <div class="col-2 mt-5">
                            <a href="#" class="btn btn-light"><span class="material-icons float-left">check_circle_outline</span> Join</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @endsection

@extends('layouts.app')
@section('content')
@include('Events.deleteEvents')
@include('Events.editEvent')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Event</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5">

            @foreach($events as $event)
            @if($event->organizer != 1)
            <div class="card mt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-2 mt-5">
                            @if($event->startTime < 12) <h3>{{\Carbon\Carbon::createFromFormat('H:i:s',$event->startTime)->format('h:i')}} AM</h3>
                                @else
                                <h3>{{\Carbon\Carbon::createFromFormat('H:i:s',$event->startTime)->format('h:i')}} PM</h3>
                                @endif
                                <p>{{\Carbon\Carbon::parse($event->startDate)->format('d/m/Y')}}</p>
                        </div>
                        <div class="col-4 text-center mt-4">
                            <h5>{{$event->Category['name']}}</h5>
                            <h3>{{$event->title}}</h3>
                            <p>{{$event->numberOfMember}} Members going!</p>
                            <p>{{$event->location}}</p>
                        </div>
                        <div class="col-3">
                            <img src="{{asset('images/'.$event->eventPicture)}}" alt="Not Found" class="img img-thumbnail m-3" style="width:150px; height:130px;">
                        </div>
                        <div class="col-3 mt-5">
                            <a href=""
                                    data-category="{{$event->category_id}}"
                                    data-title = "{{$event->title}}"
                                    data-startdate="{{$event->startDate}}"
                                    data-enddate="{{$event->endDate}}"
                                    data-starttime="{{$event->startTime}}"
                                    data-endtime="{{$event->endTime}}"
                                    data-description="{{$event->description}}"
                                    data-location="{{$event->location}}"
                                    data-image="{{$event->eventPicture}}"
                                    data-id ="{{$event->id}}"
                                    class="btn btn-warning btn-editEvent float-right" data-target="#editEventModal" data-toggle="modal">EDIT</a>
                            {{--===================== modal of edit your event ============--}}
                            <a class="delete btn btn-danger float-right mr-3" id="dlEvents" data-id="{{$event->id}}" data-target="#delete_event" data-toggle="modal">CANCEL</a>
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

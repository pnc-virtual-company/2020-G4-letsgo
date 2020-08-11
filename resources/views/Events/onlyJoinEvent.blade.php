@extends('layouts.app')
@section('content')
<div id="card" class="container tab-pane active"><br>
<a href="explore" class="mb-5 btn btn-primary">Back</a>
<h1>Only event that you joined</h1>
    @foreach ($events as $event)
    @if (count($event->users->pluck('id')) != 0)
    @foreach ($event->users as $user)
    @if ($user->id == auth::id())
    <div class="tab-content">
        <div id="card" class="tab-pane active">
            <div class="card mt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-10">
                            <div class="container" data-toggle="modal" data-title="{{ $event->title }}" data-image="{{ $event->eventPicture }}" data-location="{{ $event->location }}" data-members="{{ $event->numberOfMember }}" data-organizer="{{ $event->organizer }}" data-category="{{ $event->Category['name'] }}" data-decription="{{ $event->description }}" data-startdate="{{ $event->startDate }}" data-users="{{ $users }}" data-starttime="
                                         @if ($event->endTime < 12)
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->endTime)->format('h:i') }} AM
                            @else
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->endTime)->format('h:i') }} PM
                            @endif
                            " data-eventid="{{ $event->id }}" data-user="{{ $event->users->pluck('id') }}" data-target="#exampleModal">
                                <div class="row">
                                    <div class="col-2 mt-5">
                                        @if ($event->startTime < 12) <h3>{{ \Carbon\Carbon::createFromFormat('H:i:s', $event->startTime)->format('h:i') }}
                                            AM</h3>
                                            @else
                                            <h3>{{ \Carbon\Carbon::createFromFormat('H:i:s', $event->startTime)->format('h:i') }}
                                                PM</h3>
                                            @endif
                                            <p>{{ date('d-m-Y', strtotime($event->startTime)) }}</p>
                                    </div>
                                    <div class="col-5 text-center mt-4">
                                        <h5>{{ $event->Category['name'] }}</h5>
                                        <h3>{{ $event->title }}</h3>
                                        <p>{{ $event->numberOfMember }} Members going!</p>
                                        <p>{{ $event->location }}</p>
                                    </div>
                                    <div class="col-5">
                                        <img src="{{ asset('images/' . $event->eventPicture) }}" alt="Not Found" class="img img-thumbnail m-3" style="width:150px; height:130px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mt-5">
                            <a href="{{ route('quitEvent', $event->id) }}" class="btn btn-light text-danger"><span class="material-icons float-left">highlight_off</span> Quit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endif
    @endforeach
    @endsection
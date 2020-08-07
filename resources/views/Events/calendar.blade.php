@extends('layouts.app')
@section('content')
@include('Events.createEvent')
@include('Events.deleteEvents')
@include('Events.detailExplore')
<div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Find your event</h2>
                <div class="row mt-3">
                    <div class="col-4">
                        <input type="text" placeholder="Search" id="searchEvent" class="form-control">
                    </div>
                    <div class="col-4">
                        <h5 class="float-right mt-2">Not to far from</h5>
                    </div>
                    <div class="col-4">
                        <select name="city" required class="form-control float-right" id="searchLocation">
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
                    <label class="form-check-label" for="onlyEventJoined">Event you join only</label>
                </div>
                <div class="float-right">
                        <!-- Nav pills -->
                        <ul class="nav ml">
                                <li class="nav-item">
                                  <a class="nav-link" href="{{route('showExploreEventView')}}">Card</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{route('calendarView')}}">Calendar</a>
                                </li>
                              </ul>
                    </div>
        
    <h1>Calendar View</h1>
@endsection
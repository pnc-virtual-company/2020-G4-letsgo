@extends('layouts.app')
@section('content')

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
                        @foreach ($data as $item)
                        <option>{{ $item['cityCountry'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
        <form method="get" action="onlyJoinEvent" id="onlyJoinEvent">
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="onlyEventJoined" onclick="onlyJoinEvent()">
            <label class="form-check-label" for="onlyEventJoined">Event you join only</label>
            <p id="text" style="display:none">Checkbox is CHECKED!</p>
            </div>
        </form>

            <!-- Nav pills -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs ml" style="float: right;">
                            <li class="nav-item">
                                <a class="btn btn-secondary" class="nav-link" href="{{ url('explore') }}"><i class="fa fa-id-card-o" aria-hidden="true">Card</i></a>
                            </li>&nbsp;
                            <li class="nav-item">
                                <a class="btn btn-secondary" class="nav-link" href="{{route('calendarviews')}}"><i class="fa fa-calendar" aria-hidden="true">Calendar</i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="card" class="container tab-pane active"><br>
                    @foreach ($events as $event)
                    <?php               
                    $date = date('Y-m-d');
                 ?>
                 @if ( $event->startDate >= $date)



                    @if ($event->organizer != Auth::id())
                    <div class="tab-content">
                        <div id="card" class="tab-pane active">
                            <div class="card mt-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="container" data-toggle="modal" data-title="{{ $event->title }}" data-image="{{ $event->eventPicture }}" data-location="{{ $event->location }}" data-members="{{ $event->numberOfMember }}" data-organizer="{{ $event->organizer }}" data-category="{{ $event->Category['name'] }}" data-decription="{{ $event->description }}" data-startdate="{{ $event->startDate }}" data-users="{{ $users }}" data-starttime="
                                                @if ($event->startTime < 12)
                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->startTime)->format('h:i') }} AM
                                                @else
                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->startTime)->format('h:i') }} PM
                                                @endif
                                                    "data-endtime="                                            
                                                @if ($event->endTime < 12)
                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->endTime)->format('h:i') }} AM
                                                @else
                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->endTime)->format('h:i') }} PM
                                                @endif                                              
                                                "data-eventid="{{ $event->id }}" data-user="{{ $event->users->pluck('id') }}" data-target="#exampleModal">
                                                <div class="row">
                                                    <div class="col-2 mt-5">
                                                        @if ($event->startTime < 12) <h3>{{ \Carbon\Carbon::createFromFormat('H:i:s', $event->startTime)->format('h:i') }}
                                                            AM</h3>
                                                            @else
                                                            <h3>{{ \Carbon\Carbon::createFromFormat('H:i:s', $event->startTime)->format('h:i') }}
                                                                PM</h3>
                                                            @endif
                                                            <p>{{\Carbon\Carbon::parse($event->startDate)->format('d/m/Y')}}</p>    
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
                                            @if (count($event->users->pluck('id')) != 0)
                                            @foreach ($event->users as $user)
                                            @if ($user->id == auth::id())
                                            <a href="{{ route('quitEvent', $event->id) }}" class="btn btn-light text-danger"><span class="material-icons float-left">highlight_off</span> Quit</a>

                                            @else
                                            <form action="{{ route('joinEvent', $event->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-light text-primary"><span class="material-icons float-left">check_circle_outline</span> Join</button>
                                            </form>
                                            @endif

                                            @endforeach
                                            @else
                                            <form action="{{ route('joinEvent', $event->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-light text-primary"><span class="material-icons float-left">check_circle_outline</span> Join</button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif
                    @endif
                    @endforeach
                </div>
                <br>
                <div id="calendar" class="container tab-pane fade"><br>

                    @yield('content')
                </div>

            </div>




        </div>
        <script>
            //search event
            $(document).ready(function() {
                $("#searchEvent").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $(".card").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                //search location
                $("#searchLocation").on("change", function() {
                    var value = $(this).val().toLowerCase();
                    $(".card").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });

            function onlyJoinEvent() {
                // Get the checkbox
                var checkBox = document.getElementById("onlyEventJoined");
                // Get the output text
                var text = document.getElementById("text");

                // If the checkbox is checked, display the output text
                if (checkBox.checked == true) {
                $('#onlyJoinEvent').submit();
                }
            }
        </script>
        @endsection
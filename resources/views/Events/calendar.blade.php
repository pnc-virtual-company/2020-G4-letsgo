
@extends('layouts.app')
@section('content')
    



<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.2.0/main.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.2.0/main.min.css">
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
                        {{-- @foreach ($data as $item)
                            <option>{{ $item['cityCountry'] }}</option>
                        @endforeach --}}
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
        </div>
    </div>
    
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
<div class="container mt-3">
  <div class="row">
      <div class="col-12">
          <div id="calendar"></div>
      </div>
  </div>
</div>
@endsection
<script>
  document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
  timeZone: 'UTC',
  initialView: 'dayGridMonth',
  events:[
    @foreach($events as $event)
      {
        title: '{{$event->title}}: <?php $date = new DateTime($event->start_time); echo date_format($date, 'g:iA');?>',
        start: '{{$event->startDate}}',
        end: '{{$event->endDate}}'
      },
    @endforeach
  ] ,
  editable: true,
  selectable: true
});

calendar.render();
});
</script>
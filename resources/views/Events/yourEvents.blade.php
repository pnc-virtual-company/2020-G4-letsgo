@extends('layouts.app')

@section('content')
@include('Events.createEvent')
<div class="container">
    <div class="col-12">
        <button class="btn btn-primary float-right"  data-toggle="modal" data-target="#eventModal">Create</button>
    </div>
</div>
@endsection

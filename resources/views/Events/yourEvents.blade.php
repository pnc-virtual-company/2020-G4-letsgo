@extends('layouts.app')

@section('content')
@include('Events.createEvent')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Your Event</h2>
            <button class="btn btn-primary float-right"  data-toggle="modal" data-target="#eventModal">Create</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card mt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-2 mt-5">
                            <h3></h3>
                        </div>
                        <div class="col-4 text-center mt-4">
                            <h5></h5>
                            <h3></h3>
                            <p></p>
                        </div>
                        <div class="col-3">
                            <img src="" alt="Not Found" class="img img-thumbnail m-3" style="width:150px; height:130px;">
                        </div>
                        <div class="col-3 mt-5">
                            <a href="#" class="btn btn-warning float-right">EDIT</a>
                            <a href="#" class="btn btn-danger float-right mr-3">CANCEL</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

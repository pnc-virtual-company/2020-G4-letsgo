@extends('layouts.app')

@section('content')
@include('Events.createEvent')
@include('Events.editEvent')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Your Event</h2>
            <button class="btn btn-primary float-right"  data-toggle="modal" data-target="#eventModal">Create</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5">
        @foreach($events as $event)
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
                            <a href="" data-toggle="modal" data-target="#editEventModal{{$event->id}}" class="btn btn-warning btn-editEvent  float-right">EDIT</a>
                            {{--===================== modal of edit your event ============--}}
                            
 <!-- The Modal -->
 <div class="modal" id="editEventModal{{$event->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <h5>Edit an event</h5>
                    
                    <form action="{{route('events.update',$event->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-8">
                               {{--======= Category =====--}}
                            <select class="form-control" name="categoryid" required>
                                @foreach($categories as $category)
                                <option value={{$category->id}} {{($category->id == $event->category_id) ? 'selected' : ''}} required>{{$category->name}}</option>
                                @endforeach
                            </select>
                               {{--=======end Category =====--}}
                            <input type="text" required name="title"  value="{{$event->title}}" class="form-control mt-2">
                                <div class="row mt-2">
                                    <div class="col-7">
                                        <input type="date" required name="startDate" value="{{$event->startDate}}" class="form-control" placeholder="Start date">
                                    </div>
                                    <div class="col-5">
                                        <input type="time" required name="startTime" value="{{$event->startTime}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-7">
                                    <input type="date" required name="endDate" value="{{$event->endDate}}" class="form-control" placeholder="End date" > 
                                    </div>
                                    <div class="col-5">
                                        <input type="time" required name="endTime"  value="{{$event->endTime}}" class="form-control">
                                    </div>
                                </div>
                                {{$event->location}}
                               <select name="city" required class="form-control mt-2" value="{{$event->city}}">
                                @foreach($data as $item)
                                   <option <?php if($event->location == $item['cityCountry']){ ?> selected="selected" <?php } ?> value={{$event->location}}>{{$item['cityCountry']}}</option>
                               @endforeach
                               </select>
                               <textarea class="form-control mt-2" name="description"  placeholder="Description">{{$event->description}}</textarea>
                            </div>
                            <div class="col-4">
                                <div class="img">
                                    <img src="{{asset('image/'. $event->eventPicture)}}" alt="Not found" class="img-thumbnail">
                                    {{-- <div class="text-center image-upload"> --}}
                                        {{-- <label for="file-input">
                                            <i class="material-icons m-2 text-primary">create</i>
                                        </label> --}}
    
                                        <input id="file-input" class="col-12" type="file" name="eventPicture" />
                                       
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn text-primary float-right">SUBMIT</button>
                        <a href="#" data-dismiss="modal" class="btn float-right">DISCARD</a>
                   </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    $(document).on('click', '.btn-editEvent', function() {
  
    
    $tr = $(this).closest('.card');
    var data = $tr.children(".container").map(function() {
    return $(this).text();
    }).get();
    console.log(data);
    
    // $('#cateid').val(data[1]);
    // $('#category').val(data[0]);
    // var id = $("#cateid").val();
    // $('#formEditCategory').attr("action", "{{ url('editCategory') }}" + "/" + id);
    
    });
    
    </script> --}}

                            {{--=====================end modal of edit your event ============--}}
                            <a href="#" class="btn btn-danger float-right mr-3">CANCEL</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection

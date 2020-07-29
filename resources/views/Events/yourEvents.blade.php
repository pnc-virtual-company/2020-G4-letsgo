@extends('layouts.app')

@section('content')
@include('Events.createEvent')
@include('Events.deleteEvents')
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
        @if(Auth::id() == $event->organizer)
            <div class="card mt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-2 mt-5">
                            @if($event->startTime < 12)
                                <h3>{{\Carbon\Carbon::createFromFormat('H:i:s',$event->startTime)->format('h:i')}} AM</h3>
                            @else
                                <h3>{{\Carbon\Carbon::createFromFormat('H:i:s',$event->startTime)->format('h:i')}} PM</h3>
                            @endif
                            <p>{{date('d-m-Y', strtotime($event->startTime))}}</p>
                        </div>
                        <div class="col-4 text-center mt-4">
                            <h5>{{$event->Category['name']}}</h5>
                            <h3>{{$event->title}}</h3>
                            <p>{{$event->numberOfMember}} Members going!</p>
                            <p>{{$event->location}}</p>
                        </div>
                        <div class="col-3">
                            <img src="{{asset('image/'.$event->eventPicture)}}" alt="Not Found" class="img img-thumbnail m-3" style="width:150px; height:130px;">
                        </div>
                        <div class="col-3 mt-5">
                            <a href="" 
                            data-category="{{$event->category_id}}" 
                            data-title = "{{$event->title}}"
                            data-toggle="modal" data-target="#editEventModal" class="btn btn-warning btn-editEvent  float-right">EDIT</a>
                            
                            {{--===================== modal of edit your event ============--}}
                            
 
                            <a href="#" class="btn btn-danger float-right mr-3">CANCEL</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
</div>
<!-- The Modal -->
<!-- The Modal -->
<div class="modal" id="editEventModal">
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
                            <select id="category" class="form-control" name="categoryid" required>
                                @foreach($categories as $category)
                                <option value={{$category->id}} {{($category->id == $event->category_id) ? 'selected' : ''}} required>{{$category->name}}</option>
                                @endforeach
                            </select>
                               {{--=======end Category =====--}}
                            <input id="title" type="text" required name="title"  class="form-control mt-2">
                                <div class="row mt-2">
                                    <div class="col-7">
                                        <input type="date" required name="startDate"  class="form-control" placeholder="Start date">
                                    </div>
                                    <div class="col-5">
                                        <input type="time" required name="startTime" class="form-control" >
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-7">
                                    <input type="date" required name="endDate" class="form-control" placeholder="End date" > 
                                    </div>
                                    <div class="col-5">
                                        <input type="time" required name="endTime"  class="form-control">
                                    </div>
                                </div>
                                {{$event->location}}
                               <select name="city" required class="form-control mt-2" >
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
<script>
$(document).ready(function(){
    $('#editEventModal').on('show.bs.modal', function (event) {
    console.log('hello');
  var button = $(event.relatedTarget) // Button that triggered the modal
  var category = button.data('category') // Extract info from data-* attributes
console.log(category)
  var title = button.data('title') // Extract info from data-* attributes
console.log(title)
//   // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
//   // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
//   modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('#title').val(title)
  modal.find('select[name=categoryid]').val(category)
})
});
</script>

@endsection

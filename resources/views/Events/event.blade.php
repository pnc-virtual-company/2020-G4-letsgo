@extends('layouts.app')
@section('content')
@include('Events.deleteEvents')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Event</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5">
            
        @foreach($events as $event)
        @if($event->organizer!=1)
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
                            <a href="#" 
                                data-category="{{$event->category_id}}" 
                                data-title = "{{$event->title}}"
                                data-startdate="{{$event->startDate}}"
                                data-enddate="{{$event->endDate}}"
                                data-starttime="{{$event->startTime}}"
                                data-endtime="{{$event->endTime}}"
                                data-location="{{$event->location}}"
                                data-image="{{$event->eventPicture}}"
                                data-description="{{$event->description}}"
                                data-toggle="modal" data-target="#editEventModal"
                                class="btn btn-warning btn-editEvent float-right">EDIT</a>
                                {{--===================== modal of edit your event ============--}}
                            <a class="delete btn btn-danger float-right mr-3" id="dlEvents" data-id="{{$event->id}}" data-target="#delete_event" data-toggle="modal" >CANCEL</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

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
                            <select id="cat" class="form-control" name="categoryid" required>
                                @foreach($categories as $category)
                                <option value={{$category->id}} {{($category->id == $event->category_id) ? 'selected' : ''}} required>{{$category->name}}</option>
                                @endforeach
                            </select>
                               {{--=======end Category =====--}}
                            <input id="title" type="text" required name="title"  class="form-control mt-2">
                                <div class="row mt-2">
                                    <div class="col-7">
                                    <input id="startDate" type="date" required name="startDate" class="form-control">
                                    </div>
                                    <div class="col-5">
                                        <input id="startTime" type="time" required name="startTime" class="form-control" >
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-7">
                                    <input type="date" required name="endDate" id="endDate" class="form-control" > 
                                    </div>
                                    <div class="col-5">
                                        <input type="time" required name="endTime" id="endTime" class="form-control">
                                    </div>
                                </div>
                                
                               <select id="city" name="location" required class="form-control mt-2">
                                @foreach($data as $item)
                                   <option <?php if($event->location == $item['cityCountry']){ ?> selected="selected" <?php } ?> >{{$item['cityCountry']}}</option>
                               @endforeach
                               </select>
                               <textarea id="description" class="form-control mt-2" name="description"  placeholder="Description">{{$event->description}}</textarea>
                            </div>
                            <div class="col-4">
                                <div class="img">
                                <img src="{{asset('image/'.$event->eventPicture)}}" id="image-preview" alt="Not found" class="img-thumbnail">
                                    {{-- <div class="text-center image-upload"> --}}
                                        {{-- <label for="file-input">
                                            <i class="material-icons m-2 text-primary">create</i>
                                        </label> --}}
    
                                        <input id="file-input" class="col-12" id="img" type="file" name="eventPicture" />
                                       
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
        
      var button = $(event.relatedTarget) // Button that triggered the modal
      var category = button.data('category') // Extract info from data-* attributes
   
    var location = button.data('location') // Extract info from data-* attributes
    
    var title = button.data('title') // Extract info from data-* attributes
    
    var startDate = button.data('startdate')// Extract info from data-* attributes
    
    var endDate = button.data('enddate')// Extract info from data-* attributes
   
    var startTime = button.data('starttime')// Extract info from data-* attributes
  
    var endTime = button.data('endtime')// Extract info from data-* attributes
   
    var description = button.data('description') // Extract info from data-* attributes

    var picture = button.data('image') // Extract info from data-* attributes
   
    var showProfile = "{{asset('image/')}}/" + picture

    const inpFile = document.getElementById('input-file');

    const preview = document.getElementById(".img");

    const previewImage = document.querySelector("#image-preview");

    inpFile.addEventListener("change", function() {
        const file = this.files[0];
        console.log(file);
        if (file) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                previewImage.setAttribute('src', this.result);
            });
                reader.readAsDataURL(file);
           }

        });
    
    //   // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    //   // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('select[name=categoryid]').val(category)

      modal.find('#title').val(title)

      modal.find('#startDate').val(startDate)

      modal.find('#endDate').val(endDate)

      modal.find('#startTime').val(startTime)

      modal.find('#endTime').val(endTime)

      modal.find('select[name=location]').val(location)

      modal.find('#img').attr("src",showProfile)

      modal.find('#description').text(description)

    
    })
    });
    </script>

@endsection


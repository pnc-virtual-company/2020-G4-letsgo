<!-- The Modal -->
<div class="modal" id="editEventModal">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <!-- Modal body -->
    <div class="modal-body">
    <div class="container">
    <h5>Edit an event</h5>
    
    <form action="" method="post" id="updateEventModal" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
    <div class="col-8">
    {{--======= Category =====--}}
    <select id="cat" class="form-control" name="categoryid" required>
    @foreach($categories as $category)
    <option value={{$category->id}} required>{{$category->name}}</option>
    @endforeach
    </select>
    {{--=======end Category =====--}}
    <input id="title" type="text" required name="title" class="form-control mt-2">
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
    <option >{{$item['cityCountry']}}</option>
    @endforeach
    </select>
    <textarea id="description" class="form-control mt-2" name="description" placeholder="Description"></textarea>
    </div>
    <div class="col-4">
    <div class="img">
    <img src="" id="img" alt="Not found" class="img-thumbnail">
    {{-- <div class="text-center image-upload"> --}}
    {{-- <label for="file-input">
    <i class="material-icons m-2 text-primary">create</i>
    </label> --}}
    
    <input id="file-input" id="image-preview" class="col-12" type="file" name="eventPicture" />
    
    {{-- </div> --}}
    </div>
    </div>
    </div>
    <button type="submit" id="editEvent" class="btn text-primary float-right">SUBMIT</button>
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
    console.log('hello')
    
    var category = button.data('category') // Extract info from data-* attributes
    
    var location = button.data('location') // Extract info from data-* attributes
    
    var title = button.data('title') // Extract info from data-* attributes
    
    var startDate = button.data('startdate')// Extract info from data-* attributes
    
    var endDate = button.data('enddate')// Extract info from data-* attributes
    
    var startTime = button.data('starttime')// Extract info from data-* attributes
    
    var endTime = button.data('endtime')// Extract info from data-* attributes
    
    var picture = button.data('image') // Extract info from data-* attribute
    
    var showProfile = "{{asset('image/')}}/" + picture
    
    const inpFile = document.getElementById('input-file');
    
    const preview = document.getElementById(".img");
    
    const previewImage = document.querySelector("#img");
    
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
    
    var description = button.data('description') // Extract info from data-* attributes
    
    var eventId = button.data('id') // Extract info from data-* attributes
    
    var route = "{{url('updateEvent')}}/" + eventId
    
    // // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
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
    
    modal.find('#updateEventModal').attr("action",route)
    
    
    })
    });
</script>
    
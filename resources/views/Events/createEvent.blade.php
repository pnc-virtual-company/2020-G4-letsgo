 <!-- The Modal -->
 <div class="modal" id="eventModal">
     <div class="modal-dialog">
         <div class="modal-content">
             <!-- Modal body -->
             <div class="modal-body">
                 <div class="container">
                     <h5>Creat an event</h5>
                     <form action="{{route('events.store')}}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                         <div class="col-12">
                             <select class="form-control" name="categoryid" required>
                                 <option value="" disabled selected>Event Category</option>
                                 @foreach($categories as $category)
                                 <option value={{$category->id}} required>{{$category->name}}</option>
                                 @endforeach
                             </select>
                             <input type="text" required name="title" id="title" placeholder="Title" class="form-control mt-2">
                             <div class="row mt-2">
                                 <div class="col-7">
                                     <input type="date" required name="startDate" class="form-control" placeholder="Start date">
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
                                     <input type="time" required name="endTime" class="form-control">
                                 </div>
                             </div>
                            <select name="city" required class="form-control mt-2">
                                <option selected disabled value="">City</option>
                             @foreach($data as $item)
                                <option>{{$item['cityCountry']}}</option>
                            @endforeach
                            </select>
                            <input type="file" class="form-control mt-2" id="eventPicture" name="eventPicture">                            <textarea class="form-control mt-2" name="description" placeholder="Description"></textarea>
                            <button type="submit" class="btn text-primary float-right">SUBMIT</button>
                            <a href="#" data-dismiss="modal" class="btn float-right">DISCARD</a>
                         </div>
                     </div>
                </form>
                 </div>
             </div>
         </div>
     </div>
 </div>

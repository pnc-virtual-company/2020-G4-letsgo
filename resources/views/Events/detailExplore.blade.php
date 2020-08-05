<div class="modal fade" id="exampleModal" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
              <div class="row">
                <div class="col-6 mt-3 text-center">
                    <img id="imageDetail" src=""  class="img img-thumbnail m-3" style="width:230px; height:180px;">
                </div>

                <div class="col-6">
                    <p id="category"></p>
                    <b><h2 id="title"></h2></b>
                    <i class="fas fa-map-marker"><p id="location_countries" style="display: inline-block"></p></i><br>
                    <i class="fas fa-user" >Organized By: <p id="userName" style="display: inline-block"></p></i><br>
                    <i class="fas fa-users"><p id="numberOfMember" style="display: inline-block"></p>members</i><br>
                    <i class="fas fa-clock"><p id="times_start" style="display: inline-block"></p></i><br>
  
                    <a href="#" class="btn btn-light float-right"><span class="material-icons">check_circle_outline</span> Join</a>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <p id="paragraph"></p>
        </div>
      </div>
    </div>
  </div>
<script>
    $(document).ready(function(){
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button      = $(event.relatedTarget) 
            var recipient   = button.data('title') 
            var category    = button.data('category') 
            var images      = button.data('image') 
            var locations   = button.data('location') 
            var username    = button.data('user')  
            var nbOfMembers = button.data('members')  
            var description = button.data('decription')
            var startTime   = button.data('starttime')  
            var endTime     = button.data('endtime')  
            var startDate   = button.data('startdate')
            var getTime     = startTime + "-" + endTime ;
            var getDate     = startDate + " = "  + getTime;
           
          
            var modal = $(this)
            modal.find('#title').text(recipient);
            modal.find('#category').text(category);
            modal.find('#imageDetail').attr('src','/image/'+ images);
            modal.find('#location_countries').text(locations);
            modal.find('#userName').text(username);
            modal.find('#numberOfMember').text(nbOfMembers);
            modal.find('#times_start').text(getDate);
            modal.find('#paragraph').text(description);
        });
    })
</script>
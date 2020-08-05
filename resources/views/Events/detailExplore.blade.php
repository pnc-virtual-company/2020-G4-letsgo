<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <img id="imageDetail" src="" class="img img-thumbnail m-3" style="width:230px; height:180px;">
            </div>

            <div class="col-6">
              <p id="category"></p>
              <b>
                <h2 id="title"></h2>
              </b>
              <i class="fas fa-map-marker">&nbsp;<p id="location_countries"></p></i><br>
              <i class="fas fa-user">&nbsp;Organized By: <p id="userName"></p></i><br>
              <i class="fas fa-users">&nbsp;<p id="numberOfMember"></p>members</i><br>
              <i class="fas fa-clock">&nbsp;<p id="times_start"></p></i><br>

              <div class="text-right" id="joinEvent">
                <form action="#" method="post" id="join">
                  @csrf
                  @method('put')
                </form>
              </div>
              <div id="quit">

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="container" style="text-align:left" id="paragraph"></div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var recipient = button.data('title')
      var category = button.data('category')
      var images = button.data('image')
      var locations = button.data('location')
      var organizer = button.data('organizer')
      var nbOfMembers = button.data('members')
      var description = button.data('decription')
      var startTime = button.data('starttime')
      var endTime = button.data('endtime')
      var startDate = button.data('startdate')
      var users = button.data('users')
      var currentuser = button.data('currentuser');
      var user = button.data('user')
      var userevent = button.data('userevent')
      var getTime = startTime + "-" + endTime;
      var getDate = startDate + " = " + getTime;
      var events = button.data('events');
      var eventid = button.data('eventid');
      var modal = $(this)
      modal.find('#title').text(recipient);
      modal.find('#category').text(category);
      modal.find('#imageDetail').attr('src', '/image/' + images);
      modal.find('#location_countries').text(locations);
      users.forEach(user => {
        if (user.id == organizer) {
          modal.find('#userName').text(user.firstName);
        }
      });
      modal.find('#numberOfMember').text(nbOfMembers);
      modal.find('#times_start').text(getDate);
      modal.find('#paragraph').text(description);
      if (user.length != 0) {
        userevent.forEach(userid => {
          if (userid.id == currentuser) {
            modal.find('#quit').html('<a href="#" class="btn btn-light text-danger"><span class="material-icons float-left">highlight_off</span> Quit</a>')
          } else {
            modal.find('#join').html('<button id="joinBtn" type="submit" class="btn btn-light text-primary"><span class="material-icons float-left">check_circle_outline</span> Join</button>')
          }
        })
      } else {
        modal.find('#join').html('<button type="submit" id="joinBtn" class="btn btn-light text-primary"><span class="material-icons float-left">check_circle_outline</span> Join</button>')
      }
    });
    $('#joinBtn').on('click', function(){
      $('#join').attr("action", "{{ url('joinEvent') }}" + "/" + eventid);
    })
  })
</script>
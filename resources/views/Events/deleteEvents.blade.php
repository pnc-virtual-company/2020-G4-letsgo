<!--Modal massage delete-->
<div class="modal fade" id="delete_event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Cancel Event ?</h5>
                <p>Do you want to cancel this Events now ?</p>
                <form action="" method="POST" id="deleteEventsInfo">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger mt-3" data-dismiss="modal">No</button>
                    <button onclick="document.getElementById('deleteEventsInfo').submit()" class="btn btn-primary float-right mt-3">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '.delete', function(dl) {
var id = $(this).data('id');
$('#deleteEventsInfo').attr("action", "{{ url('deleteEvent') }}" + "/" + id);
});
</script>
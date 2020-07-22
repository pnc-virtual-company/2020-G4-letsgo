<!--Modal massage delete-->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Remove Item?</h5>
                <p>Are you sure you want to remove this select item?</p>
                <form action="" method="post" id="formRemoveCategory">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger mt-3" data-dismiss="modal">DON'T REMOVE</button>
                    <button onclick="document.getElementById('formRemoveCategory').submit()" class="btn btn-primary float-right mt-3">REMOVE</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '.delete', function(e) {
var id = $(this).data('id');
$('#formRemoveCategory').attr("action", "{{ url('removeCategory') }}" + "/" + id);
});
</script>
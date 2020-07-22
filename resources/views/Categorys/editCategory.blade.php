<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Edit Category</h4>
    </div>
    <div class="modal-body">
    <form action="" method="POST" id="formEditCategory">
    <input type="hidden" id="cateid" name="cateid">
    @csrf
    @method('PUT')
    <input type="text" name="category" id="category" class="form-control" value="">
    <a href="{{route('categories.index')}}" class="btn btn-danger mt-2">Cancel</a>
    <a onclick="document.getElementById('formEditCategory').submit()" class="btn btn-primary text-light float-right mt-2">Edit</a>
    </form>
    </div>
    </div>
    </div>
    </div>
    
    <script>
    $(document).on('click', '.editCategory', function() {
    $('#editModal').modal('show');
    
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
    return $(this).text();
    }).get();
    console.log(data);
    
    $('#cateid').val(data[1]);
    $('#category').val(data[0]);
    var id = $("#cateid").val();
    $('#formEditCategory').attr("action", "{{ url('editCategory') }}" + "/" + id);
    
    });
    
    </script>
    
    
    
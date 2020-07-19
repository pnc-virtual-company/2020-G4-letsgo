@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-12">
        <form action="/search" method="GET">
            <div class="input-group mb-5">
                <input type="text" name="search" id="search" class="form-control">
            </div>
        </form>
        {{-- View categories all --}}
        <h3>Categories</h3>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#myModal">
            Create
        </button>
        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create category</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('categories.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="category" placeholder="Enter name category here" name="category" class="form-control">
                            </div>
                            <button href="" class="btn btn-default text-warning mt-3 float-right" type="submit">CREATE</button>
                            <button href="" class="btn btn-default text-dark mt-3 float-right ml-3" data-dismiss="modal">DISCARD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover mt-5">
            <tbody>
                @foreach ($categories as $categ)
                <tr>
                    <td>{{$categ->name}}</td>
                    <td>
                        <div class="action">
                            <a href="" class="hoverbtn float-right text-danger"><i class="fas fa-trash fa-lg"></i></a>
                            <a href="" class="hoverbtn float-right">|</a>
                            <a href="" class="hoverbtn float-right"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    var msg = '{{Session::get('
    alert ')}}';
    var exist = '{{Session::has('
    alert ')}}';
    if (exist) {
        alert(msg);
    }

    $(document).on('keyup', '#search', function() {
        var data = $(this).val();
        fetch_category_data(data);
    });
    fetch_category_data();

    function fetch_category_data(data) {
        $.ajax({
            url: "{{ route('search')}}"
            , method: 'get'
            , data: {
                data: data
            }
            , dataType: 'json'
            , success: function(data) {
                var result = "";
                data.forEach(element => {
                    result += `
                      <table class="table table-striped table-hover mt-5">
                              <tr>
                                <td><b>${element.name}</b></td>
                                <td>
                                      <div class="action">
                                          <a href="" class="hoverbtn float-right text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                          <a href="" class="hoverbtn float-right">|</a>
                                          <a href="" class="hoverbtn float-right"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
                                      </div>
                                  </td>
                              </tr>
                      </table>
                      `;
                $('table').html(result);
                });
            }
        })
    }

</script>

@endsection

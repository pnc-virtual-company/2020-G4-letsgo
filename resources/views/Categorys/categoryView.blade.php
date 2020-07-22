@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-12">
        <form action="/search" method="GET">
            <div class="input-group mb-5">
                <input class="form-control" id="search" type="text" placeholder="Search..">
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
                                <span id="message" class="text-danger"></span>
                            </div>
                            <button href="" class="btn btn-default text-primary mt-3 float-right" type="submit">CREATE</button>
                            <button href="" class="btn btn-default text-danger mt-3 float-right ml-3" data-dismiss="modal">DISCARD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover mt-5">
            <tbody id="myTable">
                @foreach ($categories as $categ)
                <tr>
                    <td>{{$categ->name}}</td>
                    <td>
                        <div class="action">
                            <a class="hoverbtn float-right text-danger" data-target="#delete" data-toggle="modal"><i class="fas fa-trash fa-lg"></i></a>
                            <!--Modal massage delete-->
                            <div class="modal fade" id="delete">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h5>Remove Item?</h5>
                                            <p>Are you sure you want to remove this select item?</p>
                                            <form action="{{route('remove', $categ->id)}}" method="Get">
                                                @csrf
                                                <button class="btn btn-default text-warning mt-3 float-right" type="submit">REMOVE</button>
                                                <button class="btn btn-default text-dark mt-3 float-right ml-3" data-dismiss="modal">DON'T REMOVE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn float-right" data-toggle="modal" style="margin-top: -8px;" data-target="#editModal{{$categ->id}}" style="float:right;"><i class="fas fa-edit fa-lg"></i></button>
                            <div id="editModal{{$categ->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Category</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('categories.update',$categ->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="category" id="category" class="form-control" value="{{$categ->name}}">

                                                <button type="submit" class="btn btn-warning float-right mt-2">Edit</button>
                                                <a href="{{route('categories.index')}}" class="btn btn-danger mt-2">Cancel</a>

                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function(){
        $(document).on('keyup','#category',function(){
            var result = $(this).val();
            message_exist(result);
        });

        message_exist();
        function message_exist(result){
            $.ajax({
                url:"{{route('existCategory')}}",
                method:"get",
                data:{result:result},
                dataType:'json',
                success:function(message){
                    if(message != ''){
                        $('#message').html('This category already existed.');
                    }else{
                        $('#message').html('');
                    }
                }
            });
        }
    });

    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

</script>

@endsection

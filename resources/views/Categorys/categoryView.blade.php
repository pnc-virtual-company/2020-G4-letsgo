@extends('layouts.app')
@section('content')
@include('Categorys.editCategory')
@include('Categorys.removeCategory')
<div class="container">
    <div class="col-12">
 
        <div class="input-group mb-5">
            <input class="form-control" id="search" type="text" placeholder="Search..">
        </div>
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
                            <button href="" class="btn btn-default text-primary mt-2 float-right" type="submit"​​​ id="create">CREATE</button>
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
                    <td style="opacity:0">{{$categ->id}}</td>
                    <td>
                        <div class="action">
                            <a class="delete float-right text-danger" id="deleteCategory" data-id="{{$categ->id}}" data-target="#delete" data-toggle="modal"><i class="fas fa-trash fa-lg"></i></a>
                            <button type="button" class="btn float-right editCategory" style="float:right;"><i class="fas fa-edit fa-lg"></i></button>
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
                        $('#create').html('<button href="" class="btn btn-default text-primary float-right" type="submit"​​​ disabled>CREATE</button>');
                    }else{
                        $('#message').html('');
                        $('#create').html('<button href="" class="btn btn-default text-primary float-right" type="submit"​​​>CREATE</button>');
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

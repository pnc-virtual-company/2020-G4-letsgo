@extends('layouts.app')

@section('content')
    <div class="container mt-3">
    <div class="col-sm-4 col-md-6 col-lg-12">
            <form action="" method="POST" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class=""></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="container mt-3">
        <div class="col-sm-4 col-md-6 col-lg-12">
                <h3><strong>Categories</strong></h3>
    
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#myModal">
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
                    <span class="" id="#message" class="text-warning"></span>
                    <button href="" class="btn btn-default text-warning mt-3 float-right" type="submit">CREATE</button>
                    <button href="" class="btn btn-default text-dark mt-3 float-right ml-3" data-dismiss="modal">DISCARD</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="col-sm-4 col-md-6 col-lg-12">
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item">{{$category->name}}</li><i class="fa fa-pencil" aria-hidden="true"></i>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
          alert(msg);
        }
    </script>
@endsection
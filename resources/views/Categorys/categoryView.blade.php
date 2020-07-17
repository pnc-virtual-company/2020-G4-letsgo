@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-12">
            <form action="/search" method="GET">
                <div class="input-group mb-5">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-success">Search</button>
                    </span>
                </div>
            </form>
            {{-- View categories all --}}
            <h3>Categories</h3>
            <a href="" class="btn btn-warning float-right "></a>
            <table class="table table-striped table-hover mt-5">
                <tbody>
                   @foreach ($categories as $categ)
                    <tr>
                        <td>{{$categ->name}}</td>
                        <td>
                           <div class="action">
                                <a href="" class="hoverbtn float-right" style="display: none;"><i class="fa fa-trash fa-lg"   style="color: red" aria-hidden="true"></i></a>
                                <a href="" class="hoverbtn float-right" style="display: none;">|</a>
                                <a href="" class="hoverbtn float-right" style="display: none;"><i class="fa fa-pencil fa-lg " aria-hidden="true"></i></a>
                           </div>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
    $(document).ready(function() { 
      $("tr").mouseover(function(){$(".hoverbtn").show();});
      $("tr").mouseleave(function(){$(".hoverbtn").hide();});
    }); 
    </script>
@endsection

@extends('layout/app')
@section('main')

<div class="container">
  <h2>Users</h2>
    <a class="btn btn-info" href="{{ URL::to('user/create') }}">New User</a>
    <a class="btn btn-info" href="/ajax-crud-datatable">Ajax Crud</a>
    <br>
    <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control">
        <br>
        <button class="btn btn-success">Import User Data</button>
    </form>
    @if(session()->has('success'))
      <div class="alert alert-info" role="alert">
        <strong>{{session()->get('success')}}</strong>
      </div>
    @endif
  <table class="table table-bordered">
    <thead>
    <tr>
        <th colspan="3">
            List Of Users
            <a class="btn btn-warning float-end" href="{{ route('user.export') }}">Export User Data</a>
        </th>
    </tr>
      <tr>
        <th>Sr.No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Country</th>
        <th>State</th>
        <th>City</th>
        <th>Image</th>
        <!-- <th>Files</th> -->
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->email}}</td>
                <td>{{$category->address}}</td>
                <td>{{$category->phone}}</td>
                <td>{{$category->country_name}}</td>
                <td>{{$category->state_name}}</td>
                <td>{{$category->city_name}}</td>
                <td>
                    <img src="images/{{$category->image}}" alt="error" class="rounded-circle" width="50px" height="50px" />
                </td>
                <!-- <td>{{$category->data}}</td> -->
                <td>
                    <!-- <a href="/user/{{$category->id}}/edit" class="btn btn-info">Edit</a> -->

                    <form action="{{ route('user.destroy',$category->id) }}" method="Post">
                        <a class="btn btn-info" href="{{ route('user.edit',Crypt::encrypt($category->id)) }}">Edit</a>
                            @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete record?')">Delete</button>
                   </form>




                    <!-- <a href="/user/{{$category->id}}" onclick="return confirm('Are you sure to delete record?')" class="btn btn-danger">Delete</a> -->
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
{{$categories->links()}}
</div>

@endsection

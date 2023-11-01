@extends('layout/app')
@section('main')

<div class="container">
  <h2>Users</h2>
    <a class="btn btn-info" href="{{ URL::to('user/create') }}">New User</a><br><br>
    <a class="btn btn-info" href="/ajax-crud-datatable">Ajax Crud</a>
    <a class="btn btn-info" href="/stripe">Stripe</a>
    <a class="btn btn-info" href="/custom-validation">Custome Validation</a>
    <a class="btn btn-info" href="/generate-pdf">Generate PDF</a>
    <a class="btn btn-info" href="/file-upload">Multiple File Uploading</a>
    <a class="btn btn-info" href="/dropzone">Upload Multiple Images</a><br><br>
    <a class="btn btn-info" href="/welcome">Sweet Alert</a>
    <a class="btn btn-info" href="/google-autocomplete">Google Map</a>
    <a class="btn btn-info" href="/social-media-share">Social Media Buttons</a>
    <a class="btn btn-info" href="/feed">RSS Feed</a>
    <a class="btn btn-info" href="/chart">Chart/Graph</a>
    <br><br>
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
                        <button type="submit" class="btn btn-danger a1" onclick="return confirm('Are you sure to delete record?')">Delete</button>
                        <!-- <button type="submit" class="btn btn-danger" id="delete">Delete</button> -->
                   </form>




                    <!-- <a href="/user/{{$category->id}}" onclick="return confirm('Are you sure to delete record?')" class="btn btn-danger">Delete</a> -->
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
{{$categories->links()}}
</div>

<!-- <script>

  $('button').click(function(){

      Swal.fire({

        title: 'Are you sure?',

        text: "You won't be able to revert this!",

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#3085d6',

        cancelButtonColor: '#d33',

        confirmButtonText: 'Yes, delete it!'

      }).then((result) => {

        if (result.isConfirmed) {

          Swal.fire(

            'Deleted!',

            'Your file has been deleted.',

            'success'

          )

        }

      });

  });

</script> -->

@endsection

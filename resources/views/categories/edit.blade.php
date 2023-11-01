@extends('layout/app')
@section('main')

<div class="container">
  <h2>Edit Users</h2>
    <a class="btn btn-info" href="{{ URL::to('/user') }}">Back</a>
    <br><br>
    <div class="row">
        <div class="cal-sm-4">
            <form method="post" name="myForm" onsubmit="return validateForm()" action="/user/{{$category->id}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <label for="name">Name</label>
            <input type="text" name="name" value="{{$category->name}}" class="form-control" />
                @if($errors->has('name'))
                    <p class="text-danger">{{$errors->first('name')}}</p>
                @endif

            <label for="email">Email</label>
            <input type="email" name="email" value="{{$category->email}}" class="form-control" />
                @if($errors->has('email'))
                    <p class="text-danger">{{$errors->first('email')}}</p>
                @endif

            <label for="address">Address</label>
            <input type="text" name="address" value="{{$category->address}}" class="form-control" />
                @if($errors->has('address'))
                    <p class="text-danger">{{$errors->first('address')}}</p>
                @endif
            <label for="phone">phone</label>
            <input type="text" name="phone" value="{{$category->phone}}" class="form-control" />
                @if($errors->has('phone'))
                    <p class="text-danger">{{$errors->first('phone')}}</p>
                @endif

            <label for="image">Upload</label>
            <input type="file" name="image" class="form-control" />
                @if($errors->has('image'))
                    <p class="text-danger">{{$errors->first('image')}}</p>
                @endif

            <br>
            <button class="btn btn-info mt-4" type="submit">Update</button>
            </form>

        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script>
    $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
   });

   $(document).ready(function(){
        $("#country").change(function(){
            var country_id = $(this).val();

            if (country_id == "") {
                var country_id = 0;
            }

            $.ajax({
                url: '{{ url("/fetch_states/") }}/'+country_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    $('#state').find('option:not(:first)').remove();
                    $('#city').find('option:not(:first)').remove();

                    if (response['states'].length > 0) {
                        $.each(response['states'], function(key,value){
                            $("#state").append("<option value='"+value['id']+"'>"+value['name']+"</option>")
                        });
                    }
                }
            });
        });


        $("#state").change(function(){
            var state_id = $(this).val();

            console.log(state_id);

            if (state_id == "") {
                var state_id = 0;
            }

            $.ajax({
                url: '{{ url("/fetch_cities/") }}/'+state_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    $('#city').find('option:not(:first)').remove();

                    if (response['cities'].length > 0) {
                        $.each(response['cities'], function(key,value){
                            $("#city").append("<option value='"+value['id']+"'>"+value['name']+"</option>")
                        });
                    }
                }
            });
        });
    });

    function validateForm() {
        let a = document.forms["myForm"]["name"].value;
        if (a == "") {
            alert("Name must be filled out");
            return false;
        }
        if (!isNaN(a)) {
            alert("Only characters are allow");
            return false;
        }
        if (((a.length)<2) || ((a.length)>20)) {
            alert("Name must be between 2 to 20 character");
            return false;
        }


        let b = document.forms["myForm"]["email"].value;
        if (b == "") {
            alert("Email must be filled out");
            return false;
        }



        let c = document.forms["myForm"]["address"].value;
        if (c == "") {
            alert("Address must be filled out");
            return false;
        }

        let d = document.forms["myForm"]["phone"].value;
        if (d == "") {
            alert("Phone must be filled out");
            return false;
        }
        if (isNaN(d)) {
            alert("Only Numbers are allow");
            return false;
        }

        let f = document.forms["myForm"]["image"].value;
        if (f == "") {
            alert("Image must be filled out");
            return false;
        }
    }

</script>
@endsection

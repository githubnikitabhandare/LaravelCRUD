@extends('layout/app')
@section('main')

<div class="container">
  <h2>Add Users</h2>
    <a class="btn btn-info" href="{{ URL::to('/user') }}">Back</a>
    <br><br>
    <div class="container">
    <div class="row d-flex">
        <div class="col-sm-4">
            <form method="post" id="demo-form" data-parsley-validate="" action="{{ URL::to('/user') }}" enctype="multipart/form-data">
            @csrf

            <label for="name">Name</label>
            <input type="text" name="name" value="" class="form-control" minlength="2" maxlength="20" data-parsley-length="[2, 20]" data-parsley-pattern="^[a-zA-Z]+$" required=""/>
                @if($errors->has('name'))
                    <p class="text-danger">{{$errors->first('name')}}</p>
                @endif

            <label for="email">Email</label>
            <input type="email" name="email" value="" data-parsley-trigger="change" required="" class="form-control" />
                @if($errors->has('email'))
                    <p class="text-danger">{{$errors->first('email')}}</p>
                @endif

            <label for="address">Address</label>
            <textarea name="address" value="" class="form-control" required=""></textarea>
                @if($errors->has('address'))
                    <p class="text-danger">{{$errors->first('address')}}</p>
                @endif

            <label for="phone">phone</label>
            <input type="text" name="phone" value="" class="form-control" required="" data-parsley-type="digits" data-parsley-pattern="^\d{4} \d{4} \d{4}$" />
                @if($errors->has('phone'))
                    <p class="text-danger">{{$errors->first('phone')}}</p>
                @endif

            <label for="country">Country</label>
            <select name="country" id="country" class="form-control" required="">
                <option value="">Select Country</option>

                    @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach

            </select>
                @if($errors->has('country'))
                    <p class="text-danger">{{$errors->first('country')}}</p>
                @endif

            <label for="state">State</label>
            <select name="state" id="state" class="form-control" required="">
                <option value="">Select State</option>
            </select>
            @if($errors->has('state'))
                    <p class="text-danger">{{$errors->first('state')}}</p>
            @endif

            <label for="city">City</label>
            <select name="city" id="city" class="form-control" required="">
                <option value="">Select City</option>
            </select>
            @if($errors->has('city'))
                    <p class="text-danger">{{$errors->first('city')}}</p>
            @endif

            <label for="image">Upload Image</label>
            <input type="file" name="image" value="" class="form-control" required="" />
                @if($errors->has('image'))
                    <p class="text-danger">{{$errors->first('image')}}</p>
                @endif

            <label for="data">Upload Files</label>
            <input type="file" name="data" value="" class="form-control" required="" />
                @if($errors->has('data'))
                    <p class="text-danger">{{$errors->first('data')}}</p>
                @endif



            <br>
            <button class="btn btn-info mt-4" type="submit">Create</button>
            </form>

        </div>
    </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/parsley.min.js') }}"></script>
<script>
//     $.ajaxSetup({
//          headers: {
//             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//          }
//    });

   $(document).ready(function(){
        $("#country").change(function(){
            var country_id = $(this).val();

            if (country_id == "") {
                var country_id = 0;
            }

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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


    $(function () {
    $('#demo-form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    })
    .on('form:submit', function() {
        return false; // Don't submit form for this demo
    });
    });


</script>

@endsection

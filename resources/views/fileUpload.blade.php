<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container">

    <div class="panel panel-primary">

      <div class="panel-heading">
        <h2></h2>
      </div>

      <div class="panel-body">

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="inputFile">Name:</label>
                <input type="text" name="name" id="inputFile" class="form-control @error('files') is-invalid @enderror">

                @error('files')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="inputFile">Select Files:</label>
                <input type="file" name="files[]" id="files" multiple class="form-control @error('files') is-invalid @enderror">

                @error('files')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="filenames"></div>
            <!-- <h4></h4> -->

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>

        </form>

      </div>
    </div>
</div>
    <script>
        $(function() {
            $('input:file').change(function(){
                for(var i = 0 ; i < this.files.length ; i++){
                var fileName = this.files[i].name;
                $('.filenames').append(
                    '<div class="name">' +
                        fileName +
                    '</div>');
                }
            });
        });


        // $(document).on ('click', '.remove', function () {
        //     var span_id = $(this.parentNode).text();
        //     $(this).closest('div').remove();
        // });
    </script>
</body>
</html>

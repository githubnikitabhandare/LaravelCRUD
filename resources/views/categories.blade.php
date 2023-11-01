@extends('layout/app')
@section('main')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right mb-2">
                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create User</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <input type="text" name="email" class="form-control searchEmail" placeholder="Search for Email Only...">
    <br>
    <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control">
        <br>
        <button class="btn btn-success">Import User Data</button>
    </form>
    <br>
    <div class="card-body">
        <table class="table table-bordered" id="ajax-crud-datatable">
            <thead>
            <a class="btn btn-warning float-end" href="{{ route('user.export') }}">Export User Data</a>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>

                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="company-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="CompanyModal"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required="">
                        </div>
                    </div>



                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                    </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready( function ()
    {
        var table = $('#ajax-crud-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:
            {
            url: "{{ url('ajax-crud-datatable') }}",
            data: function (d) {
                    d.email = $('.searchEmail').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $(".searchEmail").keyup(function(){
            table.draw();
        });

    });

    function add()
    {
        $('#CompanyForm').trigger("reset");
        $('#CompanyModal').html("Add Company");
        $('#company-modal').modal('show');
        $('#id').val('');
    }

    function editFunc(id){
        $.ajax({
        type:"POST",
        url: "{{ url('edit-company') }}",
        data: { id: id ,_token: '{{csrf_token()}}'},
        dataType: 'json',
            success: function(res){
                $('#CompanyModal').html("Edit Company");
                $('#company-modal').modal('show');
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#email').val(res.email);
                $('#address').val(res.address);
                $('#phone').val(res.phone);
            }
        });
    }

    function deleteFunc(id){
        if (confirm("Delete Record?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('delete-company') }}",
                data: { id: id, _token: '{{csrf_token()}}'},
                dataType: 'json',
                success: function(res){
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }

    $('#CompanyForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ url('store-company')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#company-modal").modal('hide');
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
            },
            error: function(data){
            console.log(data);
            }
        });
    });
</script>

@endsection

@extends('layouts.app')


@section('content')
@section('title', 'Roles & Permissions')

@push('header-scripts')
<link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.css')}}">
@endpush
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            @if(Session::has('success_msg'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {!!Session::get('success_msg')!!}
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <h4 class="mb-2 page-title">Roles & Permissions</h4>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" onclick="addRoleForm()">Add Role</button>
                </div>
            </div>

            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <!-- table -->
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $key => $role)
                                    <tr class="role_{{$role->id}}">
                                        <td>{{$key+1}}</td>
                                        <td>{{ ucfirst($role->name) }}</td>
                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:;"
                                                    onclick="editRole({{$role->id}})">Edit</a>
                                                <a class="dropdown-item" href="javascript:;" onclick="setPermission({{$role->id}})">Set Permission</a>
                                                <a class="dropdown-item" href="javascript:;"
                                                    onclick="deleteRole({{$role->id}})">Remove</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- simple table -->
            </div> <!-- end section -->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->

<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Loading...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@push('footer-scripts')
<script src='{{ asset('admin/js/jquery.dataTables.min.js')}}'></script>
<script src='{{ asset('admin/js/dataTables.bootstrap4.min.js')}}'></script>
<script src="{{ asset('admin/sweet-alert/sweetalert.min.js')}}"></script>
<script>
$('#dataTable-1').DataTable({
    autoWidth: true,
    "lengthMenu": [
        [16, 32, 64, -1],
        [16, 32, 64, "All"]
    ]
});

function addRoleForm() {
    var url = '{{ route('roles.create')}}';
    $.ajaxModal('#roleModal', url);
}

function editRole(id) 
{
    var url = '{{ route('roles.edit', ':id')}}';
    url = url.replace(':id', id);
    $.ajaxModal('#roleModal', url);
}

function saveRole()
{      
    var roleID = $('#roleID').val();  
    if(roleID) {            

        var url  = "{{route('roles.update', ':id')}}";
            url  = url.replace(':id',roleID);   
    }
    else
        var url = "{{ route('roles.store') }}";
        
    $.easyAjax({
        url: url,
        container: '#roleForm',
        type: "POST",
        data: $('#roleForm').serialize(),
        success: function (response) {
            $('#roleModal').modal('hide');                
            $.showToastr(response.message, 'success');
            location.reload(); 
        }
    });
    
}

function deleteRole(id) 
{        
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover the deleted item!",
        icon: "warning",
        buttons: ["No, cancel please!", "Yes, delete it!"],
        dangerMode: true
    }).then((willDelete) => {
        if (willDelete) {

            var url = "{{ route('roles.destroy',':id') }}";
                url = url.replace(':id', id);

            var token = "{{ csrf_token() }}";

            $.easyAjax({
                type: 'POST',
                url: url,
                data: {'_token': token, '_method': 'DELETE'},
                success: function (response) {
                    if (response.status == true) {
                        $('tr.role_'+id).remove();
                        $.showToastr(response.message, 'success');
                    }
                }
            });
        }
    });            
}

function setPermission(id)
{
    var url = '{{ route('roles.modules', ':id')}}';
    url = url.replace(':id', id);
    $.ajaxModal('#roleModal', url);
}

function savePermission(id)
{   
    var url  = "{{route('roles.update-permission', ':id')}}";
        url  = url.replace(':id',id);           
        
    $.easyAjax({
        url: url,
        container: '#moduleForm',
        type: "POST",
        data: $('#moduleForm').serialize(),
        success: function (response) {
            $('#roleModal').modal('hide');                
            $.showToastr(response.message, 'success');
        }
    });
    
}

</script>
@endpush

@endsection
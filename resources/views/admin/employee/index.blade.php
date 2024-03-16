@extends('layouts.app')


@section('content')
@section('title', 'Employees')

@push('header-scripts')
<link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.css')}}">
@endpush
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h4 class="mb-2 page-title">Employees</h4>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" onclick="employeeCreateForm()">Add Employee</button>
                </div>
            </div>

            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <!-- table -->
                            <table class="table datatables" id="listingTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>  
                                        <th>Email</th> 
                                        <th>Phone</th> 
                                        <th>Role</th>                                               
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- simple table -->
            </div> <!-- end section -->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->

<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
    
$(function () {   

    var table = $('#listingTable').DataTable({

        processing: true,
        serverSide: true,
        ajax: "{{ route('employees.index') }}",
        columns: [                
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'name', name: 'name'},    
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'role', name: 'role'},            
            {data: 'action', name: 'action', orderable: true, searchable: false},
        ],
        "order": [[2, "desc" ]],
        'lengthMenu': [
            [10, 25, 50, 100],
            ['Show 10', 'Show 25', 'Show 50', 'Show 100']
        ],

        language: {
            searchPlaceholder: "Search...",
            sSearch: '_INPUT_',
            lengthMenu: "_MENU_"
        }

    });

});

function employeeCreateForm()
{
    var url = '{{ route('employees.create')}}';
    $.ajaxModal('#employeeModal', url);
}

function editEmp(id) 
{
    var url = '{{ route('employees.edit', ':id')}}';
    url = url.replace(':id', id);
    $.ajaxModal('#employeeModal', url);
}

function saveEmployee()
{      
    var empID = $('#empID').val();  
    if(empID) {            

        var url  = "{{route('employees.update', ':id')}}";
            url  = url.replace(':id',empID);   
    }
    else
        var url = "{{ route('employees.store') }}";
        
    $.easyAjax({
        url: url,
        container: '#employeeForm',
        type: "POST",
        data: $('#employeeForm').serialize(),
        success: function (response) {
            $('#employeeModal').modal('hide');
            $('#listingTable').DataTable().ajax.reload();
            $.showToastr(response.message, 'success');
        }
    });
    
}

function deleteEmp(id) 
{
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover the deleted item!",
        icon: "warning",
        buttons: ["No, cancel please!", "Yes, delete it!"],
        dangerMode: true
    }).then((willDelete) => {
        if (willDelete) {

            var url = "{{ route('employees.destroy',':id') }}";
                url = url.replace(':id', id);

            var token = "{{ csrf_token() }}";

            $.easyAjax({
                type: 'POST',
                url: url,
                data: {'_token': token, '_method': 'DELETE'},
                success: function (response) {
                    if (response.status == true) {
                        $('#listingTable').DataTable().ajax.reload();
                        $.showToastr(response.message, 'success');
                    }
                }
            });
        }
    });            
}

</script>
@endpush

@endsection
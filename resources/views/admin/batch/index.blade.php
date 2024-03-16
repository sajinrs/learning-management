@extends('layouts.app')


@section('content')
@section('title', 'Batches')

@push('header-scripts')
<link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.css')}}">
@endpush
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h4 class="mb-2 page-title">Centers</h4>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" onclick="batchCreateForm()">Add Batch</button>
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
                                        <th>Batch#</th>
                                        <th>Center Name</th>  
                                        <th>Batch Name</th>                                                                                      
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

<div class="modal fade" id="addFormModal" tabindex="-1" role="dialog" aria-hidden="true">
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
    
$(function () {       

    var table = $('#listingTable').DataTable({

        processing: true,
        serverSide: true,
        ajax: "{{ route('batches.index') }}",
        columns: [                
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'batch_num', name: 'batch_num'},
            {data: 'center', name: 'center'}, 
            {data: 'name', name: 'name'},                
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

function batchCreateForm()
{
    var url = '{{ route('batches.create')}}';
    $.ajaxModal('#addFormModal', url);
}

function editBatch(id) 
{
    var url = '{{ route('batches.edit', ':id')}}';
    url = url.replace(':id', id);
    $.ajaxModal('#addFormModal', url);
}

function saveBatch()
{      
    var formID = $('#formID').val();  
    if(formID) {            

        var url  = "{{route('batches.update', ':id')}}";
            url  = url.replace(':id',formID);   
    }
    else
        var url = "{{ route('batches.store') }}";
        
    $.easyAjax({
        url: url,
        container: '#batchForm',
        type: "POST",
        data: $('#batchForm').serialize(),
        success: function (response) {
            $('#addFormModal').modal('hide');
            $('#listingTable').DataTable().ajax.reload();
            $.showToastr(response.message, 'success');
        }
    });
    
}

function deleteBatch(id) 
{
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover the deleted item!",
        icon: "warning",
        buttons: ["No, cancel please!", "Yes, delete it!"],
        dangerMode: true
    }).then((willDelete) => {
        if (willDelete) {

            var url = "{{ route('batches.destroy',':id') }}";
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
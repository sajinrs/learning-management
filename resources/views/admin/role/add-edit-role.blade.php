{!! Form::open(['id'=>'roleForm','class'=>'ajax-form']) !!}
<div class="modal-header">
    <h4 class="modal-title">{{ isset($role) ? 'Edit' : 'Add'}} Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
    <div class="box-body">
        <div class="col-md-12">
            <div class="form-group">
            @if(isset($role->id)) 
                <input type="hidden" name="_method" value="PUT"> 
                <input type="hidden" name="id" id="roleID" value="{{$role->id ?? ''}}" />
            @endif                
                <label class="required">Role Name</label>
                <input type="text" name="name" class="form-control" placeholder="Role Name" value="{{$role->name ?? ''}}" required />
            </div>
        </div>
        
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" onclick="saveRole()" class="btn btn-primary">Submit</button>    
</div>
{!! Form::close() !!}


{!! Form::open(['id'=>'employeeForm','class'=>'ajax-form']) !!}
<div class="modal-header">
    <h4 class="modal-title">@if(isset($employee)) Edit @else Add @endif Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
    <div class="box-body row">
        <div class="col-md-6">
            <div class="form-group">
            @if(isset($employee->id)) 
                <input type="hidden" name="_method" value="PUT"> 
                <input type="hidden" name="id" id="empID" value="{{$employee->id ?? ''}}" />
            @endif
                
                <label class="required">Employee Name</label>                
                <input type="text" name="name" class="form-control" placeholder="Employee Name" value="{{$employee->name ?? ''}}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Email</label>
                <input type="text" name="email" autocomplete="off" class="form-control" placeholder="Email" value="{{$employee->email ?? ''}}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{$employee->phone ?? ''}}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Role</label>
                <select name="role" class="form-control">
                    <option value="">---SELECT---</option>
                    @foreach($roles as $role)
                        <option @if(isset($employee) && $employee->roles[0]->id == $role->id) selected @endif 
                                value="{{$role->id}}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Password</label>
                <input type="password" name="password" class="form-control" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="required">Confirm Password</label>
                <input type="password" name="cpassword" class="form-control" />
            </div>
        </div>
        
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" onclick="saveEmployee()" class="btn btn-primary">Submit</button>    
</div>
{!! Form::close() !!}


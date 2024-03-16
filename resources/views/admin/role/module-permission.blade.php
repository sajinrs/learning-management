{!! Form::open(['id'=>'moduleForm','class'=>'ajax-form']) !!}
<div class="modal-header">
    <h4 class="modal-title">Set Permission for {{$role->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
    <div class="box-body">
        

        <div class="col-md-12">
            <div class="form-group">
                <h6>Modules</h6>
                @foreach($modules as $key=> $module)
                    @php $items = explode(',',$module->subModule[0]->items) @endphp
                    <h6 class="module-label">{{$module->name}}</h6>
                    @foreach($items as $item)
                    <div class="checkbox inline-block ">
                        <label> <input type="checkbox" name="module[]" @if(in_array($module->name.' '.$item, $permissions)) checked @endif value="{{$module->name}} {{$item}}"> {{$item}}</label>
                    </div>
                    @endforeach 
                @endforeach                
            </div>               
        </div>
        
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" onclick="savePermission({{$role->id}})" class="btn btn-primary">Submit</button>    
</div>
{!! Form::close() !!}


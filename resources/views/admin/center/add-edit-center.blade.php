{!! Form::open(['id'=>'centerForm','class'=>'ajax-form']) !!}
<div class="modal-header">
    <h4 class="modal-title">@if(isset($center)) Edit @else Add @endif Center</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
    <div class="box-body row">
        <div class="col-md-12">
            <div class="form-group">
            @if(isset($center->id)) 
                <input type="hidden" name="_method" value="PUT"> 
                <input type="hidden" name="id" id="empID" value="{{$center->id ?? ''}}" />
            @endif
                
                <label class="required">Center Name</label>                
                <input type="text" name="center_name" class="form-control" placeholder="Center Name" value="{{$center->center_name ?? ''}}" />
            </div>
        </div>

        
        <div class="col-md-12">
            <div class="form-group">
                <label class="required">Manager</label>
                <select name="managers[]" class="form-control select2-multi" id="multi-select2" multiple="multiple">
                    @foreach($managers as $key => $manager)
                        <option @if(isset($center) && in_array($manager->id, $mnagerIDs)) selected @endif 
                                value="{{$manager->id}}">{{ ucfirst($manager->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
                
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" onclick="saveCenter()" class="btn btn-primary">Submit</button>    
</div>
{!! Form::close() !!}

<script>
    $('.select2-multi').select2({
        theme: 'bootstrap4',
    });
</script>


{!! Form::open(['id'=>'batchForm','class'=>'ajax-form']) !!}
<div class="modal-header">
    <h4 class="modal-title">@if(isset($batch)) Edit @else Add @endif Batch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
    <div class="box-body row">
        <div class="col-md-12">
            <div class="form-group">
            @if(isset($batch->id)) 
                <input type="hidden" name="_method" value="PUT"> 
                <input type="hidden" name="id" id="formID" value="{{$batch->id ?? ''}}" />
            @endif
                <label class="required">Batch#</label>                
                <input type="text" name="batch_num" readonly class="form-control" placeholder="Batch Number" value="{{$batch->batch_num ?? $batch_num}}" />
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="required">Center</label>
                <select name="center_id" class="form-control select2">
                <option value="">Select Center</option>
                    @foreach($centers as $key => $center)
                        <option @if(isset($batch) && $batch->center_id == $center->id) selected @endif 
                                value="{{$center->id}}">{{ ucfirst($center->center_name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>   

        <div class="col-md-12">
            <div class="form-group">
                <label class="required">Batch Name</label>                
                <input type="text" name="name" class="form-control" placeholder="Batch Name" value="{{$batch->name ?? ''}}" />
            </div>
        </div>       
                
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" onclick="saveBatch()" class="btn btn-primary">Submit</button>    
</div>
{!! Form::close() !!}

<script>
    $('.select2').select2({
        theme: 'bootstrap4',
    });
</script>


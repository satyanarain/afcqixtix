<div class="row">
    <div class="col-md-3">
        @php $depots_value=displayList('depots','name')@endphp
        {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'control-label']) !!}<span class="label-required">*</span>
        {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => ' form-control','required' => 'required','placeholder'=>"Select Depot"]) !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('from_date', Lang::get('From'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
        {!! Form::text('from_date', date('d-m-Y'), ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('to_date', Lang::get('To'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
        {!! Form::text('to_date', date('d-m-Y'), ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('bus_no', Lang::get('Bus No.'), ['class' => 'control-label']) !!}    
        {!! Form::select('bus_no', [], null, ['class' => 'form-control', 'placeholder'=>'All']) !!}
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    (function(){
        var depot_id = $('#depot_id').val();
        var vehicle_id = "{{$_GET['bus_no']}}";
        if(vehicle_id && depot_id)
        {
            getVehiclesByDepotId(depot_id, 'bus_no', "", vehicle_id);
        }
    })();

    $(document).on('change', '#depot_id', function(){
        var depot_id = $('#depot_id').val();
        if(depot_id)
        {
            getVehiclesByDepotId(depot_id, 'bus_no', "All", "");
        }else{
            $('#bus_no').val("");
            return alert('Please select a depot.');
        }
    });
});
</script>
@endpush



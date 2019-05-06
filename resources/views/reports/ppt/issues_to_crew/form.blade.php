<div class="row">
    <div class="col-md-3">
        @php $depots_value=displayList('depots','name')@endphp
        {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'control-label']) !!}<span class="label-required">*</span>
        {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => ' form-control','placeholder'=>"Select Depot"]) !!}
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
        @php $denominations=displayList('denominations','description')@endphp
        {!! Form::label('denomination_id', Lang::get('Denomination'), ['class' => 'control-label']) !!}
        {!! Form::select('denomination_id', $denominations, null, ['class' => 'form-control','placeholder'=>"Select Denomination"]) !!}  
    </div>

    <div class="col-md-3">
        {!! Form::label('conductor_id', Lang::get('Conductor ID'), ['class' => 'control-label']) !!}    
        {!! Form::select('conductor_id', [], null, ['class' => 'form-control', 'placeholder'=>'All']) !!}
    </div>

    <div class="col-md-3">
        @php $orders=['created_at'=>'By Date', 'denom_id'=>'By Denomination']@endphp
        {!! Form::label('order_by', Lang::get('Order By'), ['class' => 'control-label']) !!}
        {!! Form::select('order_by', $orders, 'created_at', ['class' => 'form-control','placeholder'=>"Select Order By"]) !!}  
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
        var conductor_id = "{{$_GET['conductor_id']}}";
        if(conductor_id && conductor_id)
        {
            getConductorsByDepotId(depot_id, 'conductor_id', "", conductor_id);
        }
    })();

    $(document).on('change', '#depot_id', function(){
        var depot_id = $('#depot_id').val();
        if(depot_id)
        {
            getConductorsByDepotId(depot_id, 'conductor_id', "All", "");
        }else{
            $('#conductor_id').html("");
            return alert('Please select a depot.');
        }
    });
});
</script>
@endpush



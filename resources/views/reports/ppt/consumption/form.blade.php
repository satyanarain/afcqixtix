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
        @php $types = displayList('denomination_masters','name')@endphp
        {!! Form::label('ticket_type', Lang::get('Ticket Type'), ['class' => 'control-label']) !!}
        {!! Form::select('ticket_type', $types, null, ['class' => 'form-control', 'placeholder'=>'Select Ticket Type']) !!}  
    </div>

    <div class="col-md-3">
        @php $denominations=displayList('denominations','description')@endphp
        {!! Form::label('denomination_id', Lang::get('Denomination'), ['class' => 'control-label']) !!}
        {!! Form::select('denomination_id', [], null, ['class' => 'form-control','placeholder'=>"All"]) !!}  
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change', '#ticket_type', function(){
        var ticket_type = $(this).val();
        if(ticket_type)
        {
            var url = "{{route('reports.getdenominationsbytickettype', ':ticket_type')}}";
            url = url.replace(':ticket_type', ticket_type); 
            $.ajax({
                url: url, 
                type: "GET",
                data: {
                    ticket_type: ticket_type
                },
                dataType: "JSON",
                success: function(response)
                {
                    var str = "<option value=''>All<option>";
                    $.each(response, function(index, denomination){
                        str += "<option value='"+denomination.id+"'>"+denomination.description+"</option>";
                    });

                    $('#denomination_id').html(str);

                },
                error: function(error)
                {
                    console.log(error);
                }
            });
        }else{

        }
    });
});
</script>
@endpush


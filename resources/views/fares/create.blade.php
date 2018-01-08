@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
   
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{headingMain()}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      {!!Form::label('service', 'Service', ['class'=>'control-label'])!!}
                      {!!Form::select('service', $services, null, ['placeholder'=>'Select a service', 'class'=>'form-control'])!!}
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      {!!Form::label('number_of_units', 'Number of Units', ['class'=>'control-label'])!!}
                      {!!Form::number('number_of_units', null, ['min'=>0, 'class'=>'form-control'])!!}
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      {!!Form::label('', '', ['class'=>'control-label'])!!}
                      <button class="btn btn-success form-control" id="create_fares">Submit</button>
                    </div>
                  </div>
                </div>
                {!! Form::open([
                'route' => 'fares.store',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'id' => 'create_fares_form'
                 ]) !!}

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<script>
    $(document).on('click', '#create_fares', function(){
        //alert('K');
        var service = $('#service').val();
        if(!service)
        {
            return alert('Select a service.');
        }

        var number_of_units = $('#number_of_units').val();
        if(!number_of_units)
        {
            return alert('Enter number of units.')
        }
        var str = '<table class="table table-bordered table-striped">';
        str += '<thead>';
        str += '<tr style="background:#eee;">';
        str += '<th>Stage</th>';
        str += '<th>Adult Ticket Amount (Rs.)</th>';
        str += '<th>Child Ticket Amount (Rs.)</th>';
        str += '<th>Luggage Ticket Amount (Rs.)</th>';
        str += '</tr>';
        str += '</thead>';
        str += '<tbody>';
        for(var i=0; i<number_of_units; i++)
        {
            str += '<tr>';
            str += '<td>'+(i+1)+'<input type="hidden" value="'+(i+1)+'" name="stage[]" min="0" class="form-control"></td>';
            str += '<td><input type="number" name="adult_ticket_amount[]" min="0" class="form-control"></td>';
            str += '<td><input type="number" name="child_ticket_amount[]" min="0" class="form-control"></td>';
            str += '<td><input type="number" name="luggage_ticket_amount[]" min="0" class="form-control"></td>';
            str += '</tr>';
        }
        str += '<tr>';
        str += '<td><button type="submit"  class="btn btn-success">Save</button></td>';
        str += '<td><input type="hidden" value="'+service+'" name="service" class="form-control"></td>';
        str += '<td><input type="hidden" value="'+number_of_units+'" name="number_of_units" class="form-control"></td>';
        str += '<td></td>';
        str += '</tr>';
        str += '</tbody>';
        str += '</table>';
        $('#create_fares_form').empty();
        $('#create_fares_form').html(str);
    });
</script>
@stop



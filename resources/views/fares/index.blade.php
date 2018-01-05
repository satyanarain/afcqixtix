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
              @if(Entrust::hasRole('administrator'))
                <a href="{{ route('fares.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
              @endif
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
                      <button class="btn btn-success form-control" id="get_fares">Search</button>
                    </div>
                  </div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-right">@lang('Stage')</th>
                            <th class="text-right">@lang('Adult Ticket Amount (Rs.)')</th>
                            <th class="text-right">@lang('Child Ticket Amount (Rs.)')</th>
                            <th class="text-right">@lang('Luggage Ticket Amount (Rs.)')</th>
                        </tr>
                    </thead>
                    <tbody id="fares_table_tbody">
                        @foreach($stops as $value)
                        <tr class="nor_f">
                            <td>{{$value->stop}}</td>
                            <td>{{$value->stop_id}}
                            </td>
                            <td>{{$value->short_name}}
                            </td>
                            <td> <a  class="btn btn-primary" href="{{ route('stops.show', $value->id) }}"><span class="glyphicon glyphicon-search"></span>View</a>
                            </td>
                              @if(Entrust::hasRole('administrator'))
                            <td>
                                <a  href="{{ route('stops.edit', $value->id) }}" class="btn btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                            </td>
                            @endif                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<script>
    $(function () {
        $("#example1").DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
    });

    $(document).on('click', '#get_fares', function(){
        var service = $('#service').val();
        if(!service)
        {
          return alert('Select a service.');
        }
        var number_of_units = $('#number_of_units').val();

        if(!number_of_units)
        {
          return alert('Enter number of units.');
        }

        $.ajax({
          url:"{{route('fares.data')}}",
          data:
          {
            service:service,
            number_of_units:number_of_units
          },
          type:"POST",
          dataType:"JSON",
          success: function(response)
          {
            var fares = response;
            var str = '';
            $.each(fares, function(index, fare){
              str += '<tr>';
              str += '<td class="text-right">'+fare.stage+'</td>';
              str += '<td class="text-right">'+fare.adult_ticket_amount+'</td>';
              str += '<td class="text-right">'+fare.child_ticket_amount+'</td>';
              str += '<td class="text-right">'+fare.luggage_ticket_amount+'</td>';
              str += '</tr>';
            });

            $('#fares_table_tbody').empty();
            $('#fares_table_tbody').html(str);
          }
        });
    });
</script>  
@stop
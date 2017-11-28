@extends('layouts.master')
@section('heading')
<div class="well">
	@lang('user.titles.all')
	<a href="{{ route('users.create')}}"><button style="background-color:#2a216e" class="btn btn-primary pull-right-button"><span class="glyphicon glyphicon-plus"></span> Add New</button></a>
</div>
	
@stop

@section('content')
   <table  width="100%" >
         <tr>
            <th align="right"> </th>               
            </tr>
         <tr>
            <th align="right" height="10">&nbsp; </th>               
        </tr>
    </table>
   <table class="table table-hover " id="users-table">
        <thead>
            <tr>
                <th>@lang('user.headers.name')</th>
                <th>@lang('user.headers.mail')</th>
                <th>@lang('user.headers.contact_number')</th>
                <th>@lang('user.headers.type')</th>
                <th>Status</th>
                <th>Edit</th>
                <th>View</th>
            </tr>
        </thead>
    </table>
  
@stop

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('users.data') !!}',
        columns: [
            
            { data: 'namelink', name: 'namelink' },
            { data: 'email', name: 'email' },
            { data: 'contact', name: 'contact' },
            { data: 'display_name', name: 'display_name' },
            {data: 'status', name: 'status'},
            @if(Entrust::can('user-update'))  
            {data: 'edit', name: 'edit', orderable: false, searchable: false  },
            @endif
            {data: 'view', name: 'view'}
        ]
    });
});
</script>
@endpush

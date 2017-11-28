@extends('layouts.master')

@section('content')
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top

$('.popoverOption').each(function() {
    var $this = $(this);
    $this.popover({
      trigger: 'hover',
      placement: 'left',
      container: $this,
      html: true,
  
    });
});
});
</script>

<div class="div">   
@if(Entrust::hasRole('administrator'))
  @include('pages.admindashboard')
@elseif (Entrust::hasRole('accountant'))
  @include('pages.accountantdashboard')
@elseif (Entrust::hasRole('kipg_general_user'))
  @include('pages.kipguserdashboard')
@elseif (Entrust::hasRole('client_associate'))
  @include('pages.associateandclientuserdashboard')
@elseif (Entrust::hasRole('associate_user'))
  @include('pages.associateuserdashboard')
@elseif (Entrust::hasRole('client_user'))
  @include('pages.clientuserdashboard')
@elseif (Entrust::hasRole('group_admin'))
  @include('pages.groupadmindashboard')
@endif
</div>

@endsection

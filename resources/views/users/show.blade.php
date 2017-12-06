@extends('layouts.master')
@section('heading')

<script>$('#pagination a').on('click', function(e){
    e.preventDefault();
    var url = $('#search').attr('action')+'?page='+page;
    $.post(url, $('#search').serialize(), function(data){
        $('#posts').html(data);
    });
});</script>
@stop

@section('content')
@include('partials.userheader')
@stop
  
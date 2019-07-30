@extends('layouts.master')
@section('header')
<h1>View Roster Details</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('roasters.index')}}">Rosters</a></li>
    <li class="active">Roster Details</li>
</ol>
@stop
@section('content')
<div class="col-md-12 no-padding">
    <div class="callout callout-info">
        View Roster Details
    </div>
</div>
<div class="col-md-12">
<div class="row">

        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-3">
                    {!! Form::label('dated_on', Lang::get('Dated On'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
                        : <?=date( 'd-m-Y', strtotime($roasters->dated_on))?>
                </div>
                <div class="col-md-3">
                    {!! Form::label('shift', Lang::get('Shift'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
                        : <?=$roasters->shift?>
                </div>

                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">


                <div class="row">
                    <div class="col-md-12">
                    @foreach($crew_on_duty as $crew)
                        <div class="col-md-3 custom-control custom-checkbox">
                            <label class="custom-control-label"><?=$crew['crew_name']?>(<?=($crew['role']=="Conductor")?'C':'D';?> - <?=$crew['crewid'];?>)</label>
                        </div>
                    @endforeach
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>

</div>
</div>        <!-- /.box -->

    <!-- /.col -->


@stop

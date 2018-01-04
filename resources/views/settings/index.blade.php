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
          <div class="box-body">
                <table class="table table-responsive table-hover table_wrapper" id="clients-table">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach($permission as $perm)

                            <th>{{$perm->display_name}}</th>

                            @endforeach  
                            <th></th>
                        </tr>
                    </thead> 
                    @foreach($roles as $role) 
                    <tr>
                    <div class="col-lg-4"> 
                        {!! Form::model($permission, [
                        'method' => 'PATCH',
                        'url'    => 'settings/permissionsUpdate',
                        ]) !!}

                        <th>{{$role->display_name}}</th>
                        <input type="hidden" name="role_id" value="{{ $role->id }}" />
                        @foreach($permission as $perm)
                        <?php
                        $isEnabled = !current(
                                        array_filter(
                                                $role->permissions->toArray(), function($element) use($perm) {
                                            return $element['id'] === $perm->id;
                                        }
                                        )
                        );
                        ?>
                        <td> 
                          <input type="checkbox" <?php if (!$isEnabled) echo 'checked' ?> name="permissions[ {{ $perm->id }} ]"  value="1" >

                            
                            <span class="perm-name"></span><br /></td>
                        @endforeach
                        </tr>
                    </div>
                    <td>{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}</td>  
                    {!! Form::close() !!}
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

@stop
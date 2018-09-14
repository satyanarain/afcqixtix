<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                                   <h1>Create Password</h1>
                                     {{BreadCrumb()}}
                </section>

<section class="content">
          <!-- Notifications -->
          <div class="row">
                      <div class="col-md-12">
                      <div class="callout callout-info">
                       Create Password
                      </div>
                  </div>
              </div>


          <!-- Content -->
            <div id="webui">
          
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-default">
            <div class="box-header with-border">
            <h3 class="box-title">
                        </h3>
                          <div class="box-tools pull-right">
                        <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                    </div>
             </div><!-- /.box-header -->

            <div class="box-body">
         
   {!! Form::open([
                    'route' => 'create_passwords.store',
                    'files'=>true,
                    'enctype' => 'multipart/form-data',
                    'id'=>'create-form',
                    'class'=>'form-horizontal'
                    ]) !!}
  <!-- Warranty -->
  
 <div class="form-group ">
    {!! Form::label('password', Lang::get('Password'), ['class' => 'col-md-3 control-label']) !!}
       <div class="col-md-7 col-sm-12 required">
      
        {{ Form::password('password', array('class' => 'col-md-6 form-control','required' => 'required')) }}
    </div>
</div> 
 <div class="form-group ">
    {!! Form::label('password', Lang::get('Confirm Password'), ['class' => 'col-md-3 control-label']) !!}
       <div class="col-md-7 col-sm-12 required">
       {{ Form::password('password', array('class' => 'col-md-6 form-control','required' => 'required')) }}
    </div>
</div> 
  

<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
       {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
       <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
    <div class="col-md-9">
           <div class="col-md-7 col-sm-12">
         </div>
        <div class="col-md-9" style="padding-left: 0px;">
         </div>
    </div>
</div>  
    {!! Form::close() !!}


</div>
</div>
</div>
</div>

</section>
 </div>
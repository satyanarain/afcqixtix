<div class="form-group">
    @php $notifications_type_master = displayList('notifications_type_master','notifications_type_name')@endphp
      {!! Form::label('notification_type', Lang::get('Notification Type'), ['class' => 'col-md-3 control-label']) !!}
       <div class="col-md-7 col-sm-12 required">
       {!! Form::select('notification_type',$notifications_type_master,isset($notification->notification_type) ? $notification->notification_type : selected,['class' => 'form-control','required' => 'required','placeholder'=>"Select Notification Type"]) !!}
</div> 
</div> 

<div class="form-group">
        {!! Form::label('email', Lang::get('Email'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('email', null, ['class' => 'col-md-6 form-control','required' => 'required','id'=>'search-box']) !!}
        <div id="suggesstion-box"></div>
</div>
</div>
<div class="form-group">
        {!! Form::label('name', Lang::get('Name'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('name', null, ['class' => 'col-md-6 form-control','required' => 'required','id'=>'search-box']) !!}
        <div id="suggesstion-box"></div>
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

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var APP_URL = {!! json_encode(url('/')) !!}
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "getAllUsersEmail",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url("+APP_URL+"/images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
    });
    //To select country name
    function selectEmail(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
    }
</script>
@endpush

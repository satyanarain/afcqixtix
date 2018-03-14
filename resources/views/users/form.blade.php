<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Information</a></li>
             @if($user>id!='')
             <li><a href="#timeline" data-toggle="tab" 
                     @if($user>id!='')
                    style='display:block;' 
                    @else
                     style='display:none;' 
                     @endif
                    id="activetab">Permission</a></li>
            @else
            <li><a href="#timeline" data-toggle="tab" style='display:none;' id="activetab">Permission</a></li>
            <li><a  id="inactivetab" onclick="activeTabWarning()" style="margin-top:10px;cursor:pointer;display:block;">Permission</a></li>
            @endif
        </ul>
<div class="tab-content">
    <div class="active tab-pane" id="activity">
<div class="form-group">
        {!! Form::label('name', Lang::get('user.headers.name'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
@if($user->user_name!='')
<div class="form-group">
        {!! Form::label('user_name', Lang::get('User Name'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('user_name', null, ['class' => 'col-md-6 form-control','readonly'=>'readonly']) !!}
</div>
</div>
@else
<div class="form-group">
        {!! Form::label('user_name', Lang::get('Username'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('user_name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
@endif
<div class="form-group">
{!! Form::label('email', Lang::get('user.headers.email'), ['class' => 'col-md-3 control-label']) !!}
 <div class="col-md-7 col-sm-12 required">
    {!! Form::email('email', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('address', Lang::get('user.headers.address'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12">
    {!! Form::text('address', null, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>
<div class="form-group">
    @php $countries=displayList('countries','country_name');@endphp
     {!! Form::label('country', Lang::get('user.headers.country'), ['class' => 'col-md-3 control-label']) !!}
      <div class="col-md-7 col-sm-12 required">
     {!! Form::select('country', $countries,isset($user->country) ? $user->country : selected,
    ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Country','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('city', Lang::get('user.headers.city'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
    {!! Form::text('city',  null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div> 
</div> 
<div class="form-group">
  {!! Form::label('mobile', Lang::get('user.headers.mobile'), ['class' => 'col-md-3 control-label']) !!}
   <div class="col-md-7 col-sm-12 required">
    {!! Form::text('mobile', null, ['class' => 'col-md-6 form-control','required' => 'required','maxlength'=>10,'pattern'=>"[0-9]{10}"]) !!}
</div>
</div>
 @php 
 if($user->date_of_birth!='')
 {
 $date_of_birth = date('d-m-Y', strtotime($user->date_of_birth));
 }
 @endphp
<div class="form-group">
    {!! Form::label('date_of_birth', Lang::get('user.headers.date_of_birth'), ['class' => 'col-md-3 control-label']) !!}
 <div class="col-md-7 col-sm-12">
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_of_birth', $date_of_birth, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
      </div>
    <!-- /.input group -->
</div>
  @if($user->image_path!='')
<div class="form-group">
@if($user->image_path!='')
{!! Form::label('image_path', Lang::get('Existing Image'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-7 col-sm-12 required">
{{Html::image('images/photo/'.$user->image_path, 'a picture', array('width' => '100','height'=>'100'))}}
</div>
@else
{!! Form::label('image_path', Lang::get('Existing Image'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-7 col-sm-12 required">
{{Html::image('images/photo/noimage.png', 'a picture', array('width' => '100','height'=>'100'))}}
</div>
@endif
</div>
@endif
 
<div class="form-group">
    {!! Form::label('image_path', Lang::get('user.headers.image_path'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12">
    {!! Form::file('image_path',['class' => 'col-md-6 form-control','onchange'=>'loadFile(event)',]) !!}
</div>
</div>
 <div class="form-group" style="display:none;" id="output_display">
    {!! Form::label('image_path', Lang::get('&nbsp;'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
   <img id="output" width="100" height="100"/>
</div>
</div>
 
<div class="form-group">
       @php $role=displayList('permissions','role');@endphp
    {!! Form::label('role_id', Lang::get('Role'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
    {!! Form::select('role_id',$role,isset($user->role_id) ? $user->role_id : selected,['class' => 'col-md-6 form-control','onchange'=>'loadFile(event)','onchange'=>'activeTab(this.value)','placeholder'=>'Please select role','required'=>'required']) !!}
</div>
</div>
</div>
    <?php print_r($value); ?>
<div class="tab-pane" id="timeline">
   @include('partials.menuheader_create')
 </div>
</div>     
@if($permissions->role_id=='')
  <script>
  $(document).ready(function()  
  {
 var role_id = $("#role_id").val('');
});</script>
  @endif
 <script>    
function activeTab(id)
{
    if(id!='')
    {
    $("#inactivetab").hide();
    $("#activetab").show();
    //alert(id);
    $.ajax({
    type:'get',
    url:"/users/roleupdate/"+id,
    success:function(data)
    {
      $("#timeline").html(data);
     }
    });
     }else{
        
    $("#inactivetab").show();
    $("#activetab").hide();  
     }
  }
function activeTabWarning()
{
alert("Please select role first")
}

$('#image_path').change(function () {
  var ext = $('#image_path').val().split('.').pop().toLowerCase();
 if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
    $("#output").hide();
    $("#output_display").hide();
    alert('Only JPG, JPEG, PNG &amp; GIF files are allowed.' );
    return false;
    
}

});
 var loadFile = function(event) {
     
       $("#output_display").show();
       $("#output").show();
       
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };  
 
     function validateForm(){
      var usernane=   $("#user_name").val();
     nospace = usernane.split(' '); //we split the string in an array of strings using     whitespace as separator
     
     if(nospace.length>1)
     {
         alert("Space is not allowed in user name");
           return false; 
     }
     
     var ext = $('#image_path').val().split('.').pop().toLowerCase();
     if(ext!='')
     {
      if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
       $("#output").hide();
       alert('invalid extension!');
       return false;

       }
     }
 }  
</script>
<div class="row">
<div class="col col-lg-6">

<div class="form-group">
        {!! Form::label('salutation', Lang::get('user.headers.salutation'), ['class' => 'control-label required']) !!}
        {!!
            Form::select('salutation',
             ['Dr'=>'Dr', 'Miss'=>'Miss', 'Mr'=>'Mr', 'Mrs'=>'Mrs', 'Others'=>'Others', 'Prof'=>'Prof'], isset($user->salutation) ? $user->salutation :null,
            ['class' => 'form-control', 'placeholder'=>'Select Salutation']) !!}
    </div>
<div class="form-group">
        {!! Form::label('name', Lang::get('user.headers.name'), ['class' => 'control-label required']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>


<div class="form-group">
        {!! Form::label('middle_name', Lang::get('user.headers.middle_name'), ['class' => 'control-label']) !!}
        {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
    </div>

<div class="form-group">
        {!! Form::label('last_name', Lang::get('user.headers.last_name'), ['class' => 'control-label required']) !!}
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>



@if($user->email!='')
<div class="form-group">
    {!! Form::label('email', Lang::get('user.headers.mail'), ['class' => 'control-label required']) !!}
    {!! Form::email('email', null, ['class' => 'form-control','readonly'=>'readonly']) !!}
</div>
@else
<div class="form-group">
    {!! Form::label('email', Lang::get('user.headers.mail'), ['class' => 'control-label required']) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
@endif
<div class="form-group">
    {!! Form::label('address', Lang::get('user.headers.address'), ['class' => 'control-label required']) !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('country', Lang::get('user.headers.country'), ['class' => 'control-label required']) !!}
    {!! Form::select('country', $countries, isset($user->country) ? $user->country :null,
    ['class' => 'form-control', 'placeholder'=>'Select Country']) !!}
</div>

<div class="form-group kiperda-custom-label">
	        {!! Form::label('contact_number', Lang::get('user.headers.contact_number'), ['class' => 'control-label required']) !!}
		</div>
		
		<div class="row user-form-calling-code">
		    <div class="form-group col-md-5">
		        {{Form::select('calling_code_contact', $telephone_codes, isset($user->calling_code_contact) ? $user->calling_code_contact :null, ['class' => 'form-control', 'placeholder'=>'Country code'])}}
		    </div> 
		    <div class="form-group col-md-7">
		        {!! Form::text('contact_number',  null, ['class' => 'form-control']) !!}
		    </div>
		</div>
		
        <div class="form-group kiperda-custom-label">
	        {!! Form::label('telephone_number', Lang::get('user.headers.telephone_number'), ['class' => 'control-label']) !!}
		</div>
		
		<div class="row user-form-calling-code">
		    <div class="form-group col-md-5">
		        {{Form::select('calling_code_telephone', $telephone_codes, isset($user->calling_code_telephone) ? $user->calling_code_telephone : null, ['class' => 'form-control', 'placeholder'=>'Country code'])}}
		    </div> 
		    <div class="form-group col-md-7">
		        {!! Form::text('telephone_number',  null, ['class' => 'form-control']) !!}
		    </div>
		</div>
		
        <div class="form-group kiperda-custom-label">
	        {!! Form::label('alternate_contact_number', Lang::get('associate.form.alternate_contact_number'), ['class' => 'control-label']) !!}
		</div>
		
		<div class="row user-form-calling-code">
		    <div class="form-group col-md-5">
		        {{Form::select('calling_code_alternate', $telephone_codes, isset($user->calling_code_alternate) ? $user->calling_code_alternate : null, ['class' => 'form-control', 'placeholder'=>'Country code'])}}
		    </div> 
		    <div class="form-group col-md-7">
		        {!! Form::text('alternate_contact_number',  null, ['class' => 'form-control']) !!}
		    </div>
		</div>

        <div class="form-group kiperda-custom-label">
            {!! Form::label('fax', 'Fax', ['class' => 'control-label']) !!}
        </div>
   <div class="row user-form-calling-code">
            <div class="form-group col-md-5">
                {{Form::select('calling_code_fax', $telephone_codes, isset($user->calling_code_fax) ? $user->calling_code_fax : null, ['class' => 'form-control', 'placeholder'=>'Country code'])}}
            </div> 
            <div class="form-group col-md-7">
                {!! Form::text('fax',  null, ['class' => 'form-control']) !!}
            </div>
        </div>


{{--<div class="form-group kiperda-custom-label">
        {!! Form::label('contact_number', Lang::get('user.headers.contact_number'), ['class' => 'control-label required']) !!}
</div> 

<div class="row">
    <div class="form-group col-md-5">
        <select name="calling_code_contact" class="form-control">
            <option value="" selected>Select Country Code</option>
            @foreach($calling_codes as $calling_code)
            <option @if(isset($user->calling_code_contact)) @if($user->calling_code_contact == $calling_code->calling_code) {{'selected'}} @else {{""}} @endif  @endif value="{{$calling_code->calling_code}}">({{$calling_code->calling_code}}) {{$calling_code->country_name}}</option>
            @endforeach
        </select>
    </div> 
    <div class="form-group col-md-7">
        {!! Form::text('contact_number',  null, ['class' => 'form-control', 'min'=>'0']) !!}
    </div> 
</div>

<div class="form-group kiperda-custom-label">
        {!! Form::label('telephone_number', Lang::get('user.headers.telephone_number'), ['class' => 'control-label']) !!}
</div>

<div class="row">
    <div class="form-group col-md-5">
        <select name="calling_code_telephone" class="form-control">
            <option value="" selected>Select Country Code</option>
            @foreach($calling_codes as $calling_code)
            <option @if(isset($user->calling_code_telephone)) @if($user->calling_code_telephone == $calling_code->calling_code) {{'selected'}} @else {{""}} @endif  @endif value="{{$calling_code->calling_code}}">({{$calling_code->calling_code}}) {{$calling_code->country_name}}</option>
            @endforeach
        </select>
    </div> 
    <div class="form-group col-md-7">
        {!! Form::text('telephone_number',  null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group kiperda-custom-label">
        {!! Form::label('alternate_contact_number', Lang::get('user.headers.alternate_contact_number'), ['class' => 'control-label']) !!}
</div>

<div class="row">
    <div class="form-group col-md-5">
        <select name="calling_code_alternate" class="form-control">
            <option value="" selected>Select Country Code</option>
            @foreach($calling_codes as $calling_code)
            <option @if(isset($user->calling_code_alternate)) @if($user->calling_code_alternate == $calling_code->calling_code) {{'selected'}} @else {{""}} @endif @endif value="{{$calling_code->calling_code}}">({{$calling_code->calling_code}}) {{$calling_code->country_name}}</option>
            @endforeach
        </select>
    </div> 
    <div class="form-group col-md-7">
        {!! Form::text('alternate_contact_number',  null, ['class' => 'form-control']) !!}
    </div> 
</div>--}}

<div class="form-group">
    {!! Form::label('city', Lang::get('user.headers.city'), ['class' => 'control-label required']) !!}
    {!! Form::text('city',  null, ['class' => 'form-control']) !!}
</div> 

<div class="form-group">
    {!! Form::label('pin', Lang::get('user.headers.pin'), ['class' => 'control-label required']) !!}
    {!! Form::text('pin',  null, ['class' => 'form-control']) !!}
</div>  

<div class="row" style="margin-bottom: 23px;">
    <div class="col col-lg-6">
        {!! Form::label('image_path', Lang::get('user.headers.image_path'), ['class' => 'control-label']) !!}
        {!! Form::file('image_path', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col col-lg-6">
        <div id="image_previewUser">
        @if(isset($user->image_path))
        <img id="previewingUser"  src="../../images/Media/{{$user->image_path}}" width="50" height="50"/>
        @endif
        </div>
        <p class="help-block" id="messageUser" style="display:none;"></p>
    </div>
</div>

<div class="row" style="margin-bottom: 23px;">
    <div class="col col-lg-6">
        {!! Form::label('business_card', Lang::get('user.headers.business_card'), ['class' => 'control-label']) !!}
        {!! Form::file('business_card', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col col-lg-6">
        <div id="image_previewBusinessCard">
        @if(isset($user->business_card))
        <img id="previewingBusinessCard"  src="../../images/Media/{{$user->business_card}}" width="50" height="50"/>
        @endif
        </div>
        <p class="help-block" id="messageBusinessCard" style="display:none;"></p>
    </div>
</div>

<div class="form-group">
    <?php
    if($user->dob=='0000-00-00') 
             {
                $user->dob=''; 
            }
            else {
             $user->dob = date('d-m-Y', strtotime($user->dob)); 
         }
         ?>
    {{ Form::label('dob', Lang::get('user.headers.dob'), ['class' => 'control-label']) }}
    {!! Form::text('dob',  null, ['class' => 'datepicker_recurring_start','readonly'=>'readonly']) !!}
  </div>  

<div id="national_id_box" style="display: none;">
    <div class="form-group">
        {!! Form::label('national_id', Lang::get('user.headers.national_id'), ['class' => 'control-label']) !!}
        {!! Form::text('national_id',  null, ['class' => 'form-control']) !!}
    </div> 
    <div class="form-group" style="display: none;" id="national_id_document_box">
        {!! Form::label('national_id_document', Lang::get('user.headers.national_id_document'), ['class' => 'control-label required']) !!}
         <br><a href="{{ URL::to('/images/Media/'.$user->national_id_document)}}" download="download">Download</a>
        {!! Form::file('national_id_document') !!}
    </div> 
    <div class="form-group">
        {!! Form::label('passport_number', Lang::get('user.headers.passport_number'), ['class' => 'control-label required']) !!}
        {!! Form::text('passport_number',  null, ['class' => 'form-control']) !!}
    </div> 

    <div class="form-group">
   <!--   <a href="http://localhost:8000/images/Media/BBS74uZx_kiperda (3).sql" download="download">Download</a> -->
        
        {!! Form::label('passport_document', Lang::get('user.headers.passport_document'), ['class' => 'control-label required']) !!}
        <br><a href="{{ URL::to('/images/Media/'.$user->passport_document)}}" download="download">Download</a>
        {!! Form::file('passport_document') !!}
    </div>


</div>    


{!! Form::submit($submitButtonText, ['class' => 'btn btn-success']) !!}
</div>
<div class="col col-lg-6">
@if(isset($user->id))
<div class="form-group">
	{!! Form::label('status', Lang::get('user.headers.status'), ['class' => 'control-label required']) !!}
	{!! Form::select('status', ['0' => 'Pending Activation', '1' => 'Active', '2' => 'In-active'], isset($user->status) ? $user->status :null, ['class' => 'form-control']) !!}
</div> 
@endif
<div class="form-group">
{!! Form::label('user_type', Lang::get('user.headers.user_type'), ['class' => 'control-label required']) !!}
{!!
    Form::select('user_type',
    $roles, isset($user->userRole->role_id) ? $user->userRole->role_id : null,
    ['placeholder' => 'Choose User Type', 'class' => 'form-control']) !!}

</div>
<div class="form-group" id="company_select_dropdown" style="display: none;">
{!! Form::label('group_company_id', Lang::get('user.headers.group_company_id'), ['class' => 'control-label block']) !!}
{!!
    Form::select('group_company_id[]',
    $group_companies, isset($user->group_company_id)? explode(',', $user->group_company_id) : null,
    ['class' => 'form-control', 'multiple', 'id'=>'group_company_id','style'=>'height:34px;']) !!}

</div>

<div class="form-group form-inline" id="clientsDropdown" style="display:none;">
{!! Form::label('client_id', Lang::get('user.headers.client'), ['class' => 'control-label required']) !!}
{!!
    Form::select('client_id',
    $clients, isset($user->client_id) ? $user->client_id : null,
    ['placeholder' => 'Choose Client', 'class' => 'form-control']) !!}

</div>

<div class="form-group form-inline" id="associatesDropdown" style="display:none;">
    {!! Form::label('associate_id', Lang::get('user.headers.associate'), ['class' => 'control-label required']) !!}
    {!! Form::select('associate_id', $associates, isset($user->associate_id) ? $user->associate_id : null,
    ['placeholder' => 'Choose associate', 'class' => 'form-control']) !!}

</div>

<div id="bankProfile" style="display: none;">
<div class="form-group">
    <h4 class="well well-sm" style="margin: 14px 0px;">Bank Details</h4>
</div>

<div class="form-group">
    {!! Form::label('beneficiary_name', Lang::get('user.bank.beneficiary_name'), ['class' => 'control-label required']) !!}
    {!! Form::text('beneficiary_name',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('beneficiary_address', Lang::get('user.bank.beneficiary_address'), ['class' => 'control-label required']) !!}
    {!! Form::text('beneficiary_address',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('beneficiary_pin_code', Lang::get('user.bank.beneficiary_pin_code'), ['class' => 'control-label']) !!}
    {!! Form::text('beneficiary_pin_code',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('beneficiary_country', 'Beneficiary Country', ['class' => 'control-label required']) !!}
{!!
    Form::select('beneficiary_country',
     $countries, isset($user->beneficiary_country) ? $user->beneficiary_country :null,
    ['class' => 'form-control', 'placeholder'=>'Select Beneficiary Country']) !!}
</div>

<div class="form-group">
    {!! Form::label('account_type', Lang::get('user.bank.account_type'), ['class' => 'control-label required']) !!}
    {!! Form::text('account_type',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('account_number', Lang::get('user.bank.account_number'), ['class' => 'control-label required']) !!}
    {!! Form::text('account_number',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('swift_code', Lang::get('user.bank.swift_code'), ['class' => 'control-label required']) !!}
    {!! Form::text('swift_code',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('ifsc_code', Lang::get('user.bank.ifsc_code'), ['class' => 'control-label']) !!}
    {!! Form::text('ifsc_code',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('routing_code', Lang::get('user.bank.routing_code'), ['class' => 'control-label']) !!}
    {!! Form::text('routing_code',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <h4 class="well well-sm" style="margin: 34px 0px 8px 0px;">Bank Branch Details</h4>
</div>

<div class="form-group">
    {!! Form::label('bank_name', Lang::get('user.bank.bank_name'), ['class' => 'control-label required']) !!}
    {!! Form::text('bank_name',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('branch_name', Lang::get('user.bank.branch_name'), ['class' => 'control-label']) !!}
    {!! Form::text('branch_name',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('branch_address', Lang::get('user.bank.branch_address'), ['class' => 'control-label required']) !!}
    {!! Form::text('branch_address',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('bank_pin_code', Lang::get('user.bank.bank_pin_code'), ['class' => 'control-label']) !!}
    {!! Form::text('bank_pin_code',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('bank_country', Lang::get('user.bank.bank_country'), ['class' => 'control-label required']) !!}
{!!
    Form::select('bank_country',
     $countries, isset($bank_country_id) ? $bank_country_id :null,
    ['class' => 'form-control', 'placeholder'=>'Select Bank Country']) !!}
</div>

</div>

</div>
</div>

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    var national_id = $('#national_id').val();
    if(national_id != ''){
        $('#national_id_document_box').show();
    }else{
        $('#national_id_document_box').hide();
    }

    var currentRole = $('#user_type').val();
    if(currentRole == 7){
        $('#clientsDropdown').show();
        $('#company_select_dropdown').hide();
    }else if(currentRole == 9){
        $('#company_select_dropdown').show();
        $('#bankProfile').show();
        $('#associatesDropdown').hide();
        $('#clientsDropdown').hide();
         $('#national_id_box').hide();
    }else if(currentRole == 6){
    	//$('#bankProfile').show();
    	$('#associatesDropdown').show();
        $('#company_select_dropdown').hide();
         $('#national_id_box').hide();
    }else if(currentRole == 5){
        //$('#bankProfile').show();
    	$('#associatesDropdown').show();
    	$('#clientsDropdown').show();
        $('#company_select_dropdown').hide();
         $('#national_id_box').hide();
    }else if(currentRole == 1 || currentRole == 4 || currentRole == 9){
        $('#company_select_dropdown').show();
        $('#bankProfile').show();
        $('#associatesDropdown').hide();
        $('#clientsDropdown').hide();
        $('#national_id_box').show();
    }
});    
    $(document).on('change', '#user_type', function(){
        /*travel profile is required only for KIPG users*/
        var roleId = $(this).val();
        if(roleId == 1 || roleId == 4){
            $('#kipgUserProfile').show();
            $('#associatesDropdown').hide();
            $('#clientsDropdown').hide();
            $('#bankProfile').show();
            $('#company_select_dropdown').show();
            $('#national_id_box').show();

        }else if(roleId == 6){
            $('#associatesDropdown').show();
            $('#kipgUserProfile').hide();
            $('#clientsDropdown').hide();
            $('#bankProfile').hide();
            $('#company_select_dropdown').hide();
            $('#national_id_box').hide();
        }else if(roleId == 7){
            $('#clientsDropdown').show();
            $('#associatesDropdown').hide();
            $('#kipgUserProfile').hide();
            $('#bankProfile').hide();
            $('#company_select_dropdown').hide();
            $('#national_id_box').hide();
        }else if(roleId == 5){
            $('#associatesDropdown').show();
            $('#clientsDropdown').show();
            $('#kipgUserProfile').hide();
            $('#bankProfile').hide();
            $('#company_select_dropdown').hide();
            $('#national_id_box').hide();
        }else if(roleId == 9){
            $('#associatesDropdown').hide();
            $('#clientsDropdown').hide();
            $('#kipgUserProfile').hide();
            $('#bankProfile').show();
            $('#company_select_dropdown').show();
            $('#national_id_box').show();
        }else{
            $('#associatesDropdown').hide();
            $('#clientsDropdown').hide();
            $('#kipgUserProfile').hide();
            $('#bankProfile').hide();
            $('#company_select_dropdown').hide();
            $('#national_id_box').hide();
        }
        
    });

    $(document).on('change', '#image_path', function(){
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
        {
            $('#previewingUser').attr('src','../../images/no-image-box.png');
            $("#messageUser").html("<p class='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span class='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            $("#messageUser").show();
            return false;
        }
        else
        {
            var reader = new FileReader();
            reader.onload = imageIsLoadedUser;
            reader.readAsDataURL(this.files[0]);
        }
    });

    function imageIsLoadedUser(e) {
        $("#messageUser").hide();
        $("#file").css("color","green");
        $('#image_previewUser').css("display", "block");
        $('#previewingUser').attr('src', e.target.result);
        $('#previewingUser').attr('width', '50px');
        $('#previewingUser').attr('height', '50px');
    };

    $(document).on('change', '#business_card', function(){
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
        {
            $('#previewingBusinessCard').attr('src','../../images/no-image-box.png');
            $("#messageBusinessCard").html("<p class='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span class='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            $("#messageBusinessCard").show();
            return false;
        }
        else
        {
            var reader = new FileReader();
            reader.onload = imageIsLoadedBusinessCard;
            reader.readAsDataURL(this.files[0]);
        }
    });

    function imageIsLoadedBusinessCard(e) {
        $("#messageBusinessCard").hide();
        $("#file").css("color","green");
        $('#image_previewBusinessCard').css("display", "block");
        $('#previewingBusinessCard').attr('src', e.target.result);
        $('#previewingBusinessCard').attr('width', '50px');
        $('#previewingBusinessCard').attr('height', '50px');
    };

    $('#group_company_id').multiselect({
        placeholder: 'Select Companies',
        search: true
    });

    $(document).on('keyup', '#national_id', function(){
        var national_id = $(this).val();
        if(national_id != ''){
            $('#national_id_document_box').show();
        }else{
            $('#national_id_document_box').hide();
        }
    });

    $('body').on('focus',".datepicker_recurring_start",function(){

         $(this).datepicker({
    dateFormat: 'dd-mm-yy'
 });

    })
</script>
@endpush
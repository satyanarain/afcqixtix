<div class="box-header">
    
    @if ($message = Session::get('flash_message'))
    <div class="alert-new-success" id="successMessage">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('flash_message_warning'))
    <div class="alert alert-warning alert-block" id="successMessage">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-warning alert-block" id="successMessage">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif
</div>
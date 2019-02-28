<div class="row">
    <div class="col-md-12">
    @foreach($crews as $crew)
        <div class="col-md-3 custom-control custom-checkbox">
            <input name="roaster[]" value="<?=$crew->id?>" <?php if(in_array($crew->id,$crew_on_duty)){echo 'checked="checked"';}?> type="checkbox" class="custom-control-input" id="<?=$i?><?=$shift->id?>-crew-<?=$crew->id?>">
            <label class="custom-control-label" for="<?=$i?><?=$shift->id?>-crew-<?=$crew->id?>"><?=$crew->crew_name?>(<?=($crew->role=="Conductor")?'C':'D';?> - <?=$crew->crew_id;?>)</label>
        </div>
    @endforeach
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
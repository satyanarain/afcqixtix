<div class="row">
    <input type="hidden" id="depot_id" name="depot_id" value="<?=$depot_id?>" />
    
    <div class="col-xs-12">
        <table class="col-sm-12 roaster_table">
            <thead>
            <tr>
                <th>Date</th>
                @foreach($shifts as $shift)
                <th><?=$shift->shift;?></th>
                @endforeach
                <th>Weekly Off</th>
            </tr>
            </thead>
            <tbody>
            <?php $j=0;for ( $i = $effectFromTime; $j < $days; $j++ ) {$converted_date = date("Y-m-d",$startTime+86400*$j);?>
                <tr>
                    <td><?=date( 'd-m-Y', $i )?></td>
                    @foreach($shifts as $shift)
                    <td class="roaster_crew_container_td">
                        <div class="roaster_crew_container">
                            @foreach($crews as $crew)
                                <div class="custom-control custom-checkbox">
                                    <input <?php if(in_array($crew->id,$data[$converted_date]['on-duty'][$shift->id]['crew_on_duty'])){echo 'checked="checked"';}?> name="roaster[<?=$i?>][on-duty][<?=$shift->id?>][]" value="<?=$crew->id?>" type="checkbox" class="custom-control-input" id="<?=$i?><?=$shift->id?>-crew-<?=$crew->id?>">
                                    <label class="custom-control-label" for="<?=$i?><?=$shift->id?>-crew-<?=$crew->id?>"><?=$crew->crew_name?>(<?=($crew->role=="Conductor")?'C':'D';?> - <?=$crew->crew_id;?>)</label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    @endforeach
                    <td class="roaster_crew_container_td">
                        <div class="roaster_crew_container">
                            @foreach($crews as $crew)
                                    <div class="custom-control custom-checkbox">
                                        <input <?php if(in_array($crew->id,$data[$converted_date]['off-duty'])){echo 'checked="checked"';}?> name="roaster[<?=$i?>][off-duty][]" value="<?=$crew->id?>" type="checkbox" class="custom-control-input" id="<?=$i?><?=$shift->id?>-crew-off-<?=$crew->id?>">
                                        <label class="custom-control-label" for="<?=$i?><?=$shift->id?>-crew-off-<?=$crew->id?>"><?=$crew->crew_name?>(<?=($crew->role=="Conductor")?'C':'D';?> - <?=$crew->crew_id;?>)</label>
                                    </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            <?php $i = $i + 86400;}?>
            </tbody>
        </table>
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
    </div>
</div>
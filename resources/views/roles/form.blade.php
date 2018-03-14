<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Role</a></li>
            <li><a href="#timeline" data-toggle="tab">Permission</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <div class="form-group">
                    {!! Form::label('role', Lang::get('Role'), ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-7 col-sm-12 required">
                        {!! Form::text('role', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('description', Lang::get('Description'), ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-7 col-sm-12 required">
                        {!! Form::textarea('description', null, ['class' => 'col-md-6 form-control','required' => 'required','rows'=>3]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3" style="margin-right: 15px;"></div>
                    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
                    <div class="col-md-9">
                        <div class="col-md-7 col-sm-12">
                        </div>
                        <div class="col-md-9" style="padding-left: 0px;">
                        </div>
                    </div>
                </div> 
            </div>
            <div class="tab-pane" id="timeline">
                @include('partials.menuheader_create')
            </div>

        </div>
    </div>
</div>

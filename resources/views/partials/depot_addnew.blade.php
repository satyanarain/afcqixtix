<div class="modal fade" id="depots" role="dialog">
  <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-plus"></span>&nbsp;Add New</h4>
            </div>
            <div class="modal-body-view">
                 <div class="alert-new-success" id="add_new_data" style="display:none;"></div>
                 <div class="list-group-item alert alert-danger" id="add_new_data_danger" style="display:none;"></div>
                 <table class="table table-responsive.view">
                    <tr><td class="table_normal">Name</td>
                        <td class="table_normal">
                       <div class="col-md-12 col-sm-12 required"> {!! Form::text('name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}</div>
                        </td>
                    </tr>
                    <tr><td class="table_normal">Depot ID</td>
                        <td class="table_normal">
                        <div class="col-md-12 col-sm-12 required">{!! Form::number('depot_id', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}</div>
                        </td>
                    </tr>
                    <tr><td class="table_normal">Short Name</td>
                        <td class="table_normal">
                           <div class="col-md-12 col-sm-12 required">{!! Form::text('short_name', null, ['class' => 'col-md-6 form-control']) !!}</div>
                        </td>
                    </tr>
                  
                    <tr><td class="table_normal">Depot Location</td>
                        <td class="table_normal">
                       <div class="col-md-12 col-sm-12 required"> {!! Form::text('depot_location', null, ['class' => 'col-md-6 form-control']) !!}</div>
                        </td>
                    </tr>
                    <tr><td class="table_normal">Defaut Service</td>
                        <td class="table_normal">
                        <div class="col-md-12 col-sm-12 required"> {!! Form::select('default_service',  ['A-G-Holidays' => "A-G-Holidays", 'Apple-Travels' => 'Apple-Travels'],isset($depot->default_service) ? $depot->default_service : selected,
    ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Default Service','required' => 'required']) !!}</div>
                        </td>
                    </tr>
                    
                   </table>  
                  <div class="modal-footer">
                     <div  class="btn btn-success pull-left" onclick="AddNew()">Add New</div><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
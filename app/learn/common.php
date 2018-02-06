<div class="row fix-gutters-six">
<div class="col-sm-6">

,'onkeypress'=>"return isNumberKey(event)
{{ createButton('create','Add') }}
{{  actionHeading('Action', $newaction='') }}
{{ actionEdit('edit',$value->id)}}
http://fontawesome.io/examples/
@include('partials.depotsheader')
@include('partials.table_script')
@stop
public function companydocumentsubtypes($id)
{ 
  $companydocumentsubtypes= DB::table('companydocumentsubtypes')->select('*')->where('companydocument_id',$id)->get();
 ?>

<label>Select Company Document Sub Types</label>

 <select class="form-control">
<?php
foreach($companydocumentsubtypes as $value)
        {?>
          <option value="<?php echo $value->id ; ?>"><?php echo $value->companydocumemtsubtype_name ; ?></option>

          <?php  } ?>
       </select> 

<?php
}


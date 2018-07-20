<?php
error_reporting(0);
use App\Models\Permission;
use App\Models\PermissionDetail;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function displayIdBaseName($table = '', $id = '', $fieldname = '') {
    echo $sql = DB::table($table)->where('id', '=', $id)->first();
    if ($sql->$fieldname != '') {
        echo $sql->$fieldname;
    } else {
        echo "N/A";
    }
}

function displayView($fieldname) {
    if ($fieldname != '') {
        echo $fieldname;
    } else {
        echo "N/A";
    }
}

function dateView($date_blank) {
    if ($date_blank == "0000-00-00" || $date_blank == '') {
        echo "N/A";
    } else {
        echo $date_blank = date("d-m-Y", strtotime($date_blank));
        ;
    }
}

function changeDateFromYMDToDMY($dateToConvert = "") {
    if ($dateToConvert == '0000-00-00' || $dateToConvert == '') {
        $result = '';
    } else {
        $result = date('d-m-Y', strtotime($dateToConvert));
    }

    return $result;
}
function maxId($table='',$fieldname='')
{
$maxid = DB::table($table)->where($fieldname, DB::raw("(select max($fieldname) from $table)"))->first();

if($fieldname!='')
{
if($maxid->$fieldname!='')
{
   return $maxid->$fieldname+1;
} else {
 return $maxid->$fieldname=1;
}
} else {

 return  $maxid;  
}


}

function orderList($table='',$id='',$field1='',$field2='',$field3='',$field4='',$t1='',$t1_id='',$t2='',$t2_id='')
{
    
     if($t1!='') 
     {
       $sql = DB::table('concessions')->select('*','concessions.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concession_masters.name as con_name','concessions.order_number as order_number')
                ->leftjoin('users', 'users.id', '=', 'concessions.user_id')
                ->leftjoin('services', 'concessions.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'concessions.concession_provider_master_id')
                ->leftjoin('concession_masters', 'concession_masters.id', '=', 'concessions.concession_master_id')
                ->orderby('concessions.order_number')       
                ->get();
     } 
     else {
      $sql = DB::table($table)->select('*')->orderby('order_number')->get() ;
     }
            
    ?>
    <?php foreach($sql as $value) 
      { ?>
        <li id="<?php echo "order".$value->$id; ?>" class="list-group-order-sub">
                        
             <?php
             if($field1!='')
             { ?>
                <a href="javascript:void(0);" ><?php echo $value->$field1; ?></a>
             <?php } ?>
           <?php
             if($field2!='')
             { ?>
        <a href="javascript:void(0);"><?php echo $value->$field2; ?></a>
       
        <?php } 
             if($field3!='')
             { ?>
       
        <a href="javascript:void(0);"><?php echo $value->$field3; ?></a>
           <?php
             }
             if($field4!='')
             { ?>
       <a href="javascript:void(0);"><?php echo $value->$field4; ?></a>
         <?php } ?>
       </li>
		
      <?php } ?>   
       
<?php
}

function BreadCrumb() {
    $segments = '';
    $segments = Request::segments();
    $segments_value = str_replace("_", " ", $segments[0]);
    ?>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <?php
    if ($segments[0] != '') {
        
        ?>
            <li><a href="<?php echo route($segments[0] . '.index') ?>"><?php echo ucwords($segments_value); ?></a></li>
        <?php } ?>
        <?php
        if ($segments[1] != '') {
            if (is_numeric($segments[1])) {
                ?>
                <?php if ($segments[2] == 'edit') {
                    ?>
                    <li class="active"><?php echo substr(ucwords($segments_value), 0, -1) ?> Update</li>
                <?php } else { ?>
                    <li class="active"><?php echo substr(ucwords($segments_value), 0, -1) ?> Profile</li>
                <?php } ?>   
            <?php
            } else {
                $segments_value = str_replace("_", "&nbsp", $segments[0]);
                ?>

                <li class="active"><?php echo ucwords($segments[1]) . " " . substr(ucwords($segments_value), 0, -1) ?></li>
            <?php }
        }
        ?>     
    </ol>
        <?php } ?>
        <?php

        function headingBold() {
            $segments = '';
            $segments = Request::segments();
            $segments_value = str_replace("_", " ", $segments[0]);
             if(is_numeric(end($segments)) && empty($segments[2]) && $segments[0]=='users')
             {
                 echo substr(ucwords($segments_value), 0, -1)."&nbsp;Profile ";     
             } else {
              echo "Manage ".substr(ucwords($segments_value), 0, -1);
             }
            ?> 
    <?php
}

function headingMain() {
    $segments = '';
    $segments = Request::segments();
    if (count($segments) >= 2) {
        if (is_numeric($segments[1])) {
            $segments_value = str_replace("_", " ", $segments[0]);
        echo substr(ucwords($segments_value), 0, -1) . " Update";
        } else {
            $segments_value = str_replace("_", " ", $segments[0]);
            echo ucwords($segments[1]) . " " . substr(ucwords($segments_value), 0, -1);
        }
    } else {
        
        $segments_value = str_replace("_", " ", $segments[0]);
        echo "List of All " . ucwords($segments_value);
    }
}
function headingMainOrder() {
    $segments = '';
    $segments = Request::segments();
    if (count($segments) >= 2) {
        if (is_numeric($segments[1])) {
            $segments_value = str_replace("_", " ", $segments[0]);
        echo substr(ucwords($segments_value), 0, -1) . " Update";
        } else {
            $segments_value = str_replace("_", " ", $segments[0]);
            echo ucwords($segments[1]) . " " . substr(ucwords($segments_value), 0, -1);
        }
    } else {
        
        $segments_value = str_replace("_", " ", $segments[0]);
        echo substr(ucwords($segments_value),0,-1);
    }
}

function PopUpheadingMain($result) {
    $segments = '';
    $segments = Request::segments();
 
        $areay=array('-','_');
        $segments_value = str_replace($areay, " ", $segments[0]);
       return $result= substr(ucwords($segments_value), 0, -1);
  
}
?>
<?php

function displayList($table = '', $fieldname = '', $orderby_fieldname='',$asc_dsc='') {
    
        if($orderby_fieldname!='')
         {
            $result = DB::table($table)->orderBy($orderby_fieldname,$asc_dsc)->pluck($fieldname, 'id');
         }else
         {
          $result = DB::table($table)->pluck($fieldname, 'id');    
         }
            
    return $result;
}
function displayPath($fieldname = '',$path_id='',$deviated_path='') {
    if($path_id!='')
    {
     $selected= $path_id;  
    }
     if($deviated_path!='')
    {
     $selected= $deviated_path;  
    }
    
   //$selected;
        $routes = DB::table('routes')
        ->select('*','route_details.stop_id','routes.route','stops.stop','routes.id as id')
        ->leftjoin('route_details', 'route_details.stop_id', '=', 'routes.id')
        ->leftjoin('stops', 'route_details.stop_id', '=', 'stops.id')->get();
        
?>
<select name="<?php echo htmlentities($fieldname); ?>" class="form-control"><option value="">Select Path</option><?php foreach($routes as $value){ ?><option value="<?php echo $value->id; ?>"<?php if($value->id==$selected){ ?>selected="selected"<?php } ?>><?php echo htmlentities($value->route); ?><?php echo ucfirst(substr($value->direction,0,1));?> : <?php htmlentities(displayIdBaseName('stops',$value->source,'stop')); ?> - <?php htmlentities(displayIdBaseName('stops',$value->destination,'stop')); ?> via- <?php htmlentities(displayIdBaseName('stops',$value->via,'stop')); ?></option> <?php } ?></select><?php   }

function dispalyImage($imagepath = '', $imagename, $class = '', $alt = '', $style = '') {
 if (file_exists($path)) {
         if ($imagename) {
            
            echo Html::image($imagepath .$imagename,'',array('class'=>$class,'alt'=>$alt,'style'=>$style));
            } else { 
            echo Html::image('images/photo/no_image.png','',array('class'=>$class,'alt'=>$alt,'style'=>$style));
        }
    } else {
        echo Html::image('images/photo/no_image.png','',array('class'=>$class,'alt'=>$alt,'style'=>$style));
    }
}


function menuPermission($controllerName) {
 $user_id = Auth::id();
 $result= DB::table('permission_details')->where('user_id',$user_id)->first();
 $array_all=explode(',',$result->$controllerName);
if(in_array('view',$array_all)){ 
 return true;
} else {
 return false;
}
}

function actionEdit($action = '', $id = '',$status='') {
 $segments = '';
 $segments = Request::segments();
 $user= $segments[0];
 $user_id = Auth::id();
 $result= DB::table('permission_details')->where('user_id',$user_id)->first();
 $array_all=explode(',',$result->$user);
 ?>
        <td>
          <?php  if(in_array('edit',$array_all)){ ?>
             <a  href="<?php echo route($segments[0] . "." . $action, $id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
          <?php } ?>
    <?php if($segments[0]=='users'){?>
               <?php  if(in_array('view',$array_all)){ ?>
              <a  class="btn btn-small btn-primary" href="<?php echo route('users.show', $id); ?>" ><span class="glyphicon glyphicon-search"></span>&nbsp;View</a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <?php } ?>
                  <?php }else{ ?>
                <?php  if(in_array('view',$array_all)){ ?>
               <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#<?php echo $id ?>"  onclick="viewDetails(<?php echo $id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;
              <?php } ?>
               <?php } ?>
              <?php if($segments[0]=='users'){?>
             <div 
                 <?php if($status==1)
                 { ?>
                 class="btn btn-small btn-success" 
               <?php }else{ ?>
                    class="btn btn-small btn-danger" 
              <?php } ?>
                 id="<?php echo $id; ?>" onclick="statusUpdate(this.id)">
                   <?php if($status==1)
                 { ?>
                    <span id="<?php echo "ai".$id; ?>"><i class="fa fa-check-circle"></i>&nbsp;Active</span>
               <?php }else{ ?>
                     <span id="<?php echo "ai".$id; ?>"><i class="fa fa-times-circle"></i>&nbsp;Inctive</span>
              <?php } ?></div>
          <?php } ?>
        </td>

    <?php
}

function actionHeading($action = '', $newaction='') {
            ?>
             <th class="no-sort"><?php echo htmlentities("Action"); ?></th>
            <?php
}

function menuDisplayByUser($result,$menuname='',$action='') {
 $userid_menu = Auth::id();
     $sql = DB::table('users')->select('*', 'users.id as id')->leftjoin('permissions', 'users.id', '=', 'permissions.user_id')
            ->where('users.id', '=', $userid_menu)
            ->first();
    $array_value = $sql->$menuname;
    $array = explode(',', $array_value);
    if (in_array($action, $array)) {
        return $result = "true";
    } else {
        return $result = "false";
    }
}

function createButton($action = '', $title='',$order='',$order_id='',$privious='') {
   $segments = '';
   $segments = Request::segments();
   $menu_dis = $segments[0];
   $userid_menu = Auth::id();
   $sql = PermissionDetail::where('user_id', '=', $userid_menu)->first();
   $dem_menu=$result = $sql[$menu_dis];  
   $array_menu= explode(',', $dem_menu);
   
  if(in_array('create',$array_menu) && in_array($segments[0],$array_menu)){
  ?>
   <a href="<?php  echo route($segments[0].".".$action) ?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;<?php echo $title; ?></button></a>
   <?php if($order!=''){ ?>
 </br>
 </br>
      <button  class="btn btn-primary pull-left"  onclick="orderList('order_id','order_list')"><span class="fa fa-sort-desc"></span>&nbsp;Update Order</button>&nbsp;&nbsp;&nbsp;&nbsp;
 <?php 
   }
}   
}

function pagePermissionView($result)
{
    $segments = '';
    $segments = Request::segments();
    $userid_menu = Auth::id();
    $menu_dis = $segments[0];
    $sql = PermissionDetail::where('user_id', '=', $userid_menu)->first();
    return $result = $sql[$menu_dis];
}

function menuCreate($controllerName,$create='',$edit='',$view='',$id='',$controllerName_Value)
{ ?>

   <tr>
     <td align="center" width="15%">
       <input type="checkbox" id="<?php echo "checkAll".$controllerName . $id; ?>" onclick="checkAll(this,this.id);">&nbsp;
      
         <?php
                  $array=array('_','-');
                 $controllerName_heading= str_replace($array,' ', $controllerName);
               ?></td>
                <td width="30%">
                    <b>
                   <input  class="<?php echo "checkAll". $controllerName . $id; ?>" type="checkbox" name="<?php echo $controllerName . "[]"; ?>" value="<?php echo $controllerName;?>" <?php if (in_array($controllerName, explode(',', $controllerName_Value))) { ?> checked <?php } ?> onchange="showMenu(this.id)" id="<?php echo $controllerName . $id; ?>">
                   &nbsp;&nbsp;
                  <?php
                  $array=array('_','-');
                 $controllerName_heading= str_replace($array,' ', $controllerName);
                 if($controllerName_heading=='Changepassword')
                 {
                    echo  "Change Password";
                 }else{
                   echo ucwords(substr($controllerName_heading,0,-1)); 
                  }
                   ?></b>
   </td>
                 <td align="left" valign="top" width="55%">
                    <span id="<?php echo "show" . $controllerName . $id; ?>"<?php if (in_array($controllerName, explode(',', $controllerName_Value))) { ?>  <?php } else { ?>class="display_none"<?php } ?>>
                     <table class="table_normal_100">
                       <tr>
                           <?php if($create!='')
                           { ?>
                          <td><input class="<?php echo "checkAll".$controllerName . $id; ?>" type="checkbox" name="<?php echo $controllerName . "[]" ?>" value="<?php echo $create; ?>" <?php if (in_array('create', explode(',', $controllerName_Value))) { ?> checked="checked" <?php } ?>>&nbsp;&nbsp;Add</td>
                         <?php  } ?>
                           <?php if($edit!='')
                           { ?>
                          <td><input class="<?php echo "checkAll".$controllerName . $id; ?>" type="checkbox" name="<?php echo $controllerName . "[]" ?>" value="<?php echo $edit; ?>" <?php if (in_array('edit', explode(',', $controllerName_Value))) { ?> checked="checked" <?php } ?>>&nbsp;&nbsp;Edit</td>
                          <?php  } ?>
                              <?php if($view!='')
                           { ?>
                          <td><input class="<?php echo "checkAll".$controllerName . $id; ?>" type="checkbox" name="<?php echo $controllerName . "[]" ?>" value="<?php echo $view; ?>"  <?php if (in_array('view', explode(',', $controllerName_Value))) { ?> checked="checked" <?php } ?> id="<?php echo "showview" . $controllerName . $id; ?>">&nbsp;&nbsp;View</td>
                           <?php  } ?>
                       </tr>   
                   </table>  
               </span>
           </td>
       </tr>  
    
    <?php
}

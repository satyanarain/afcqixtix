<?php
error_reporting(0);
use App\Models\Permission;

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
function maxId($table='',$result='')
{
$bus_types_id = DB::table($table)->where('order_number', DB::raw("(select max(`order_number`) from bus_types)"))->first();
if($bus_types_id->order_number!='')
{
   return $bus_types_id->order_number+1;
} else {
 return $bus_types_id->order_number=1;
}
}

function orderList($table='',$field1='',$field2='',$field3='',$field4='',$field5='')
{
    $sql = DB::table($table)->select('*')->get() ;
    
    ?>


  

    <div class="gallery">
        <ul class="list-group-order">
            <li class="order-sub"><a href="javascript:void(0);">Bus Type</a>
          <a href="javascript:void(0);">Order Number</a>
         <a href="javascript:void(0);">Abbreviation</a>
         </li>     
      <?php foreach($sql as $value) 
      { ?>
        <li id="<?php echo $value->$field1; ?>" class="list-group-order-sub">
                        
             <?php
             if($field2!='')
             { ?>
                <a href="javascript:void(0);" ><?php echo $value->$field2; ?></a>
             <?php } ?>
           <?php
             if($field3!='')
             { ?>
        <a href="javascript:void(0);"><?php echo $value->$field3; ?></a>
       
        <?php } 
             if($field4!='')
             { ?>
       
        <a href="javascript:void(0);"><?php echo $value->$field4; ?></a>
           <?php
             }
             if($field5!='')
             { ?>
       <a href="javascript:void(0);"><?php echo $value->$field5; ?></a>
         <?php } ?>
      
                    </li>
		
      <?php } ?>   
       	</ul>
    </div>
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
function PopUpheadingMain($result) {
    $segments = '';
    $segments = Request::segments();
 
        $areay=array('-','_');
        $segments_value = str_replace($areay, " ", $segments[0]);
       return $result= substr(ucwords($segments_value), 0, -1);
  
}
?>
<?php

function displayList($table = '', $fieldname = '') {
    $result = DB::table($table)->pluck($fieldname, 'id');
    return $result;
}

function dispalyImage($imagepath = '', $imagename, $class = '', $alt = '', $style = '') {
    if (file_exists($imagepath . Auth::user()->image_path)) {
        if (Auth::user()->image_path) {
            ?>
            <img src="<?php echo $imagepath . Auth::user()->image_path; ?>" class="<?php echo $class; ?>" alt="<?php echo $alt; ?>" style="<?php echo $style; ?>">
        <?php } else { ?>
            <img src="/images/photo/no_image.png" class="<?php echo $class; ?>" alt="<?php echo $alt; ?>" style="<?php echo $style; ?>">
        <?php
        }
    } else {
        ?>
        <img src="/images/photo/no_image.png" class="<?php echo $class; ?>" alt="<?php echo $alt; ?>" style="<?php echo $style; ?>">
        <?php
    }
}

function actionEdit($action = '', $id = '') {
    $segments = '';
    $segments = Request::segments();
    
        ?>
        <td>
             <a  href="<?php echo route($segments[0] . "." . $action, $id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
             <?php if($segments[0]=='users'){?>
              <a  class="btn btn-small btn-primary" href="<?php echo route('users.show', $id); ?>" ><span class="glyphicon glyphicon-search"></span>&nbsp;View</a>&nbsp;&nbsp;&nbsp;&nbsp;
             <?php }else{ ?>
               <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#<?php echo $id ?>"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;
              <?php } ?>
              <?php if($segments[0]=='users'){?>
             <div  class="btn btn-small btn-success"   id="<?php echo $id; ?>" onclick="statusUpdate(this.id)"><i class="fa fa-check-circle"></i>&nbsp;<span id="<?php echo "ai".$id; ?>">Active</span></div>
          <?php } ?>
        </td>

    <?php
}

function actionHeading($action = '', $newaction='') {
            ?>
             <th><?php echo htmlentities("Action"); ?></th>
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
   $sql = Permission::where('user_id', '=', $userid_menu)->first();
   $dem_menu=$result = $sql[$menu_dis];  
   $array_menu= explode(',', $dem_menu);
   
  if(in_array('create',$array_menu) && in_array($segments[0],$array_menu)){
  ?>
   <a href="<?php  echo route($segments[0].".".$action) ?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;<?php echo $title; ?></button></a>
   <?php if($order!=''){ ?>
 </br>
 </br>
      <button  class="btn btn-primary pull-left"  data-toggle="modal" data-target="#<?php echo $order_id ?>"><span class="fa fa-sort-desc"></span>&nbsp;Update Order</button>&nbsp;&nbsp;&nbsp;&nbsp;
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
    $sql = Permission::where('user_id', '=', $userid_menu)->first();
    return $result = $sql[$menu_dis];
}

function menuCreate($controllerName,$create='',$edit='',$view='',$id='',$controllerName_Value)
{ ?>

   <tr>
     <td align="center">
       <input type="checkbox" id="<?php echo "checkAll".$controllerName . $id; ?>" onclick="checkAll(this,this.id);">&nbsp;
      
         <?php
                  $array=array('_','-');
                 $controllerName_heading= str_replace($array,' ', $controllerName);
               ?></td>
                <td>
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
                 <td align="left" valign="top">
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
                          <td><input class="<?php echo "checkAll".$controllerName . $id; ?>" type="checkbox" name="<?php echo $controllerName . "[]" ?>" value="<?php echo $view; ?>" checked="checked" readonly="readonly">&nbsp;&nbsp;View</td>
                           <?php  } ?>
                       </tr>   
                   </table>  
               </span>
           </td>
       </tr>  
    
    <?php
}

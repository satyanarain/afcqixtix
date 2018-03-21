<?php

namespace App\Traits;
use App\Models\Fare;
use App\Brand;

trait activityLog {

	function createLog($controllerModel='',$controllerModelLog='',$id='')
	{
	$fares_log = $controllerModel::where('id', '=', $id )->get()->toArray();
       unset($fares_log[0]['id']);
     //  unset($fares_log[0]['created_at']);
       unset($fares_log[0]['updated_at']);
       foreach ($fares_log as $item) 
        {
          return  $controllerModelLog::insert($item);
        }
        
	}
        
        function mySqlDate($date='')
	{ 
        if ($date!= '') {
           return date('Y-m-d', strtotime($date));
        } else {
           return NULL;
        
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

function displayIdBaseName($table = '', $id = '', $fieldname = '') {
    echo $sql = DB::table($table)->where('id', '=', $id)->first();
    if ($sql->$fieldname != '') {
        echo $sql->$fieldname;
    } else {
        echo "N/A";
    }
}


function userHistory($user='',$created_at='',$updated_at='')
{ ?>
<tr>
    <td><b>Created By</b></td>
    <td class="table_normal"><?php echo $user; ?></td>
</tr>
<tr>
    <td><b>Created On</b></td>
    <td class="table_normal"><?php echo $this->dateView($created_at); ?></td>
</tr>
<tr>
    <td><b>Last Updated At</b></td>
    <td class="table_normal"><?php echo $this->dateView($updated_at); ?></td>
</tr>
<?php

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

function displayPath($fieldname = '',$path_id='',$deviated_path='') {
 $routes = DB::table('routes')
        ->select('*','route_details.stop_id','routes.route','stops.stop','routes.id as id')
        ->leftjoin('route_details', 'route_details.stop_id', '=', 'routes.id')
        ->leftjoin('stops', 'route_details.stop_id', '=', 'stops.id')->get();
        
?>
<?php echo htmlentities($value->route); ?><?php echo ucfirst(substr($value->direction,0,1));?> : <?php htmlentities(displayIdBaseName('stops',$value->source,'stop')); ?> - <?php htmlentities(displayIdBaseName('stops',$value->destination,'stop')); ?> via- <?php htmlentities(displayIdBaseName('stops',$value->via,'stop')); ?>
        
<?php }

}
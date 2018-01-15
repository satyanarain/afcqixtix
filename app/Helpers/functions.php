<?php
error_reporting(0);
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
            echo substr(ucwords($segments_value), 0, -1);
            
            ?> Management
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
        echo "All " . ucwords($segments_value);
    }
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

function actionEdit($action = '', $id='') {
            $segments = '';
            $segments = Request::segments();
            ?>
                               <td>
                                    <a  href="<?php echo route($segments[0].".".$action, $id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#<?php echo $id ?>"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>
                               </td>

    <?php
}


function actionHeading($action = '', $newaction='') {
            ?>
                               <th><?php echo htmlentities("Action"); ?></th>

    <?php
}
function createButton($action = '', $title='') {
            $segments = '';
            $segments = Request::segments();
           ?>
                <a href="<?php  echo route($segments[0].".".$action) ?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;<?php echo $title ?></button></a>
    <?php      
}

function pagePermissionView($result)
{
    $segments = '';
    $segments = Request::segments();
    $userid_menu = Auth::id();
    $menu_dis = $segments[0];
    $sql = App\Models\Permission::where('user_id', '=', $userid_menu)->first();
    return $result = $sql[$menu_dis];
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

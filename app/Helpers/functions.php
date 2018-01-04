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
    ?>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <?php
    if ($segments[0] != '') {
        $segments_value = str_replace("_", " ", $segments[0]);
        ?>
            <li><a href="<?php echo route($segments[0] . '.index') ?>"><?php echo ucwords($segments_value); ?></a></li>
        <?php } ?>
        <?php
        if ($segments[1] != '') {
            if (is_numeric($segments[1])) {
                ?>
                <?php if ($segments[2] == 'edit') {
                    ?>
                    <li class="active"><?php echo substr(ucwords($segments[0]), 0, -1) ?> Update</li>
                <?php } else { ?>
                    <li class="active"><?php echo substr(ucwords($segments[0]), 0, -1) ?> Profile</li>
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
             
            
            
            // $segments_value1=  str_replace('ies','y', $segments_value) ; 
         
             echo substr(ucwords($segments_value), 0, -1);
            
            ?> Management
    <?php
}

function headingMain() {
    $segments = '';
    $segments = Request::segments();
    if (count($segments) >= 2) {
        if (is_numeric($segments[1])) {

            echo substr(ucwords($segments[0]), 0, -1) . " Update";
        } else {
            echo ucwords($segments[1]) . " " . substr(ucwords($segments[0]), 0, -1);
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

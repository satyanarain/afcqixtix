<?php
error_reporting(0);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function BreadCrumb() {
    $segments = '';
    $segments = Request::segments();
    ?>
    <ol class="breadcrumb">
       <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <?php
    if ($segments[0] != '') {
        ?>
            <li><a href="<?php echo route($segments[0] . '.index') ?>"><?php echo ucfirst($segments[0]); ?></a></li>
    <?php } ?>
    <?php if ($segments[1] != '') {
        ?>
            <li class="active"><?php echo ucfirst($segments[1]) . "&nbsp;" . substr(ucfirst($segments[0]), 0, -1) ?></li>
    <?php } ?>
    </ol>
<?php } ?>
<?php 
function headingBold() {
$segments = '';
    $segments = Request::segments();
?>
<h1>
<?php echo substr(ucfirst($segments[0]), 0, -1); ?> Management
</h1>
<?php } ?>
<?php
function headingMain() {
$segments = '';
    $segments = Request::segments();
?>
 <h3 class="box-title">All <?php echo ucfirst($segments[0]); ?></h3>
 <?php } ?>
<?php
 if (is_file('/path/to/foo.txt')) {
    /* The path '/path/to/foo.txt' exists and is a file */
} else {
    /* The path '/path/to/foo.txt' does not exist or is not a file */
}
?>
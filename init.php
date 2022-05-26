<?php 
ini_set('display_errors' , 'on');
error_reporting(E_ALL);

include 'admin/connect.php';

$sessionUser = '';
if(isset($_SESSION['user']) ){
    $sessionUser = $_SESSION['user'];
}

$lang = 'includes/languages/';
$tpl = 'includes/templates/';
$func = 'includes/functions/';
$css = 'layout/css/';
$js = 'layout/js/';

include $func . 'functions.php';
include $lang . 'english.php';
include $tpl . 'header.php';


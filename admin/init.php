<?php 
include 'connect.php';

$func = 'includes/functions/';
$lang = 'includes/languages/';
$tpl = 'includes/templates/';
$css = 'layout/css/';
$js = 'layout/js/';

include $func . 'functions.php';
include $lang . 'english.php';
include $tpl . 'header.php';

if(!isset($nonavbar)){include $tpl . 'navbar.php';}
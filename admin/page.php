
<?php
ob_start();
$do = isset($_GET['do'])  ?  $_GET['do'] : 'manage';

if ($do == 'manage'){
    echo 'welcome you are in manage category page';
    echo '<a href = "?do=insert">add new category + </a>';
}elseif ($do == 'add'){
    echo 'welcome you are in add category page';
}elseif ($do == 'insert'){
    echo 'welcome you are in insert category page';
}else{
    echo 'error there\'s no page with this name';
}
ob_end_flush();
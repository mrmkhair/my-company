<?php

function getAllFrom($field , $table , $where = NULL, $and = NULL, $orderField, $ordering ="DESC"){
    global $con;
   
    $getAll = $con->prepare ("SELECT $field FROM $table $where $and ORDER BY $orderField $ordering ");
    $getAll->execute();
    $all = $getAll->fetchAll();
    return $all;
}


function gettitle(){
    global $pagetitle;
    if (isset ($pagetitle)){
        echo $pagetitle;
    }else {
        echo 'default';
    }
}
function redirectHome($theMsg ,$url = null , $seconds = 3){
    if ($url === null){
        $url= 'index.php';
        $link = 'homepage';
    }else{
        
        if(isset($_SERVER['HTTP_REFERER']) &&$_SERVER['HTTP_REFERER'] !== '' ){
            $url=$_SERVER['HTTP_REFERER'];
            $link = 'previuos page';
        }else{
            $url= 'index.php';
            $link = 'homepage';
        }
        
    }
    echo  $theMsg ;
    echo "<div class = 'alert alert-info'> you will be redirected to $link after $seconds seconds. </div>";
    header ("refresh:$seconds;url=$url");
    exit();
}
function checkItem($select,$from,$value){
    global $con;
    $statement = $con->prepare ("SELECT $select FROM $from  WHERE $select=?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;
}

function countItems($item,$table){
    global $con;
    $stmtc = $con->prepare("SELECT COUNT($item) FROM $table");
    $stmtc->execute();
    return $stmtc->fetchColumn();
}

function getLatest($select,$table,$order,$limit = 5){
    global $con;
    $getstmt = $con->prepare ("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $getstmt->execute();
    $rows = $getstmt->fetchAll();
    return $rows;
}


function countLessItems($item,$table,$where){
    global $con;
    $stmtL = $con->prepare("SELECT COUNT($item) FROM $table WHERE $where ");
    $stmtL->execute();
    return $stmtL->fetchColumn();
}
/*
function avgTotal($item,$table){
    global $con;
    $stmtT = $con->prepare("SELECT AVG($item) FROM $table");
    $stmtT->execute();
    return $stmtT->fetchColumn();
}

function maxTotal($item,$table){
    global $con;
    $stmtT = $con->prepare("SELECT MAX($item) FROM $table");
    $stmtT->execute();
    return $stmtT->fetchColumn();
}

function minTotal($item,$table){
    global $con;
    $stmtT = $con->prepare("SELECT MIN($item) FROM $table");
    $stmtT->execute();
    return $stmtT->fetchColumn();
}

function countTotal($item,$table){
    global $con;
    $stmtT = $con->prepare("SELECT SUM($item) FROM $table");
    $stmtT->execute();
    return $stmtT->fetchColumn();
}

*/
function varTotal($var,$item,$table){
    global $con;
    $stmtv = $con->prepare("SELECT $var($item) FROM $table");
    $stmtv->execute();
    return $stmtv->fetchColumn();
}

function countItems2($item,$table){
    global $con;
    $stmtc2 = $con->prepare("SELECT COUNT($item) FROM $table WHERE Add_Date BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()");
    $stmtc2->execute();
    return $stmtc2->fetchColumn();
}

function countItems3($item,$table){
    global $con;
    $stmtc3 = $con->prepare("SELECT COUNT($item) FROM $table WHERE Add_Date BETWEEN DATE_FORMAT(NOW() ,'%Y-01-01') AND NOW()");
    $stmtc3->execute();
    return $stmtc3->fetchColumn();
}

function countItems4($item,$table){
    global $con;
    $stmtc4 = $con->prepare("SELECT COUNT($item) FROM $table WHERE Add_Date BETWEEN DATE_SUB(NOW(),INTERVAL 1 WEEK) AND NOW()");
    $stmtc4->execute();
    return $stmtc4->fetchColumn();
}

function countItems5($item,$table){
    global $con;
    $stmtc5 = $con->prepare("SELECT COUNT($item) FROM $table WHERE Add_Date BETWEEN DATE_SUB(NOW(),INTERVAL 1 DAY) AND NOW()");
    $stmtc5->execute();
    return $stmtc5->fetchColumn();
}


function varTotal2($var,$item,$table){
    global $con;
    $stmtv2 = $con->prepare("SELECT $var($item) FROM $table WHERE Add_Date BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()");
    $stmtv2->execute();
    return $stmtv2->fetchColumn();
}

function varTotal3($var,$item,$table){
    global $con;
    $stmtv3 = $con->prepare("SELECT $var($item) FROM $table WHERE Add_Date BETWEEN DATE_FORMAT(NOW() ,'%Y-01-01') AND NOW()");
    $stmtv3->execute();
    return $stmtv3->fetchColumn();
}

function varTotal4($var,$item,$table){
    global $con;
    $stmtv4 = $con->prepare("SELECT $var($item) FROM $table WHERE Add_Date BETWEEN DATE_SUB(NOW(),INTERVAL 1 WEEK) AND NOW()");
    $stmtv4->execute();
    return $stmtv4->fetchColumn();
}

function varTotal5($var,$item,$table){
    global $con;
    $stmtv5 = $con->prepare("SELECT $var($item) FROM $table WHERE Add_Date BETWEEN DATE_SUB(NOW(),INTERVAL 1 DAY) AND NOW()");
    $stmtv5->execute();
    return $stmtv5->fetchColumn();
}

function countLessItems2($var,$item,$table,$where){
    global $con;
    $stmtL2 = $con->prepare("SELECT $var($item) FROM $table  WHERE Add_Date BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() AND $where ");
    $stmtL2->execute();
    return $stmtL2->fetchColumn();
}

function countLessItems3($var,$item,$table,$where){
    global $con;
    $stmtL3 = $con->prepare("SELECT $var($item) FROM $table  WHERE Add_Date BETWEEN DATE_FORMAT(NOW() ,'%Y-01-01') AND NOW() AND $where ");
    $stmtL3->execute();
    return $stmtL3->fetchColumn();
}

function countLessItems4($var,$item,$table,$where){
    global $con;
    $stmtL4 = $con->prepare("SELECT $var($item) FROM $table  WHERE Add_Date BETWEEN DATE_SUB(NOW(),INTERVAL 1 WEEK) AND NOW() AND $where ");
    $stmtL4->execute();
    return $stmtL4->fetchColumn();
}

function countLessItems5($var,$item,$table,$where){
    global $con;
    $stmtL5 = $con->prepare("SELECT $var($item) FROM $table  WHERE Add_Date BETWEEN DATE_SUB(NOW(),INTERVAL 1 DAY) AND NOW() AND $where ");
    $stmtL5->execute();
    return $stmtL5->fetchColumn();
}


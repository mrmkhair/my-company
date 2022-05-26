<?php

function getAllFrom($tableName , $orderBy ,$where = NULL){
    global $con;
   
    $getAll = $con->prepare ("SELECT * FROM $tableName $where ORDER BY $orderBy DESC ");
    $getAll->execute();
    $all = $getAll->fetchAll();
    return $all;
}

function getAllFrom2($field , $table , $orderField , $where = NULL, $and = NULL, $ordering ="DESC"){
    global $con;
   
    $getAll = $con->prepare ("SELECT $field FROM $table $where $and ORDER BY $orderField $ordering ");
    $getAll->execute();
    $all = $getAll->fetchAll();
    return $all;
}

function getCat(){
    global $con;
    $getCat = $con->prepare ("SELECT * FROM categories ORDER BY ID ASC ");
    $getCat->execute();
    $cats = $getCat->fetchAll();
    return $cats;
}

function getItems($where,$value,$approve = NULL){
    global $con;
    $sql = $approve == NULL ? 'AND Approve = 1' : '';
   
    $getItems = $con->prepare ("SELECT * FROM items WHERE $where = ? $sql ORDER BY Item_ID DESC ");
    $getItems->execute(array($value));
    $items = $getItems->fetchAll();
    return $items;
}

function chechUserStatus($user){
    global $con;
    $stmtx = $con->prepare("SELECT  Username, RegStatus FROM users WHERE Username = ? AND RegStatus = 0 ");
    $stmtx->execute(array($user));

    $status = $stmtx->rowCount();
    return $status;
}

function checkItem($select,$from,$value){
    global $con;
    $statement = $con->prepare ("SELECT $select FROM $from  WHERE $select=?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;
}
function gettitle(){
    global $pagetitle;
    if (isset ($pagetitle)){
        echo $pagetitle;
    }else {
        echo 'افتراضي';
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


function countItems($item,$table){
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}

function getLatest($select,$table,$order,$limit = 5){
    global $con;
    $getstmt = $con->prepare ("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $getstmt->execute();
    $rows = $getstmt->fetchAll();
    return $rows;
}

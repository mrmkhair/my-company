<?php
$dsn = 'mysql:host=localhost;dbname=mycompany';
$user = 'root';
$pass = '';
$option = array (
    PDO::MYSQL_ATTR_INIT_COMMAND =>'set names utf8');
try { 
    $con = new PDO($dsn,$user,$pass,$option);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo 'connected';

    }

    catch (PDOException $e){
     echo 'faild to connect' . $e->getMessage();
    }
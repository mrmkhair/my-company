<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* * {
  box-sizing: border-box;
} */

#myInput {
  
  background-position: 10px 10px;
  background-repeat: no-repeat; 
  width: 100%;
  /* font-size: 16px; */
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  /* margin-bottom: 12px; */
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  /* font-size: 18px; */
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</head>
<?php
ob_start();
session_start();
$pagetitle = 'الادارة';
if (isset($_SESSION['Username'])){
include 'init.php';
$do = isset($_GET['do'])? $_GET['do'] : 'manage';

if ($do == 'manage'){
 $query ='';
 if (isset($_GET['page'])){
  $query ='AND GroupID = 0 ';
 }
 
 $stmt = $con->prepare ("SELECT * FROM users WHERE GroupID = 1 $query  ORDER BY UserID DESC");
  $stmt->execute();
  $rows = $stmt->fetchAll();
 if (! empty($rows)){

  ?>
    <h1 class="text-center">الادارة  </h1>
      
        <div class="table-responsive">

          <!-- <table class="main-table manage-members text-center table table-bordered">
           <tr> -->
           <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

          <table id="myTable"  class="main-table manage-members text-center table table-bordered">
          <tr class="header">
             <td> الرقم </td>
             <td> اسم المستخدم </td>
             <td> الاسم الكامل </td>
             <td> تاريخ التعيين </td>
             <td> الوظيفة </td>
             <td> الراتب </td>
             <td> الهاتف </td>
             <td> البريد الالكترونى </td>
             <td> ملاحظات </td>
             <td> الصورة </td>
             <td> التحكم </td>
          </tr> 
          <?php 
          foreach($rows as $row){
           echo"<tr>";
           echo"<td style='display:none'>" .  $row['UserID'] . $row['Username'] . $row['FullName'] . $row['Date'] . $row['Position'] . $row['Salary'] .  $row['Phone'] . $row['Email'] . $row['Notes'] ."</td>";
              echo"<td>" . $row['UserID'] ."</td>";
              echo"<td>" . $row['Username'] ."</td>";
              echo"<td>" . $row['FullName'] ."</td>";
              echo"<td>" . $row['Date'] ."</td>";
              echo"<td>" . $row['Position'] ."</td>";
              echo"<td>" . $row['Salary'] ." K.D</td>";
              echo"<td>" . $row['Phone'] ."</td>";
              echo"<td>" . $row['Email'] ."</td>";
              echo"<td>" . $row['Notes'] ."</td>";
              echo"<td>";
              if(empty( $row['avatar'])){
                echo '<img src="../img.png" alt=" " />';
              }else{
               echo "<img src='uploads/avatars/" . $row['avatar'] ." ' alt=' ' />";
              }
              
              echo "</td>";
              echo "<td> <a href='members.php?do=edit&userid=" . $row['UserID'] . " 'class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
                         <a href='members.php?do=delete&userid=" . $row['UserID'] . " 'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>";
                          if($row['GroupID']== 1){
                          echo "<a href='members.php?do=deleteadmin&userid=" . $row['UserID'] . " 'class='btn btn-info activate '><i class='fa fa-close'></i>  الغاء  </a>";
                         }
               echo "</td>";
           echo"</tr>";
          }
          
             
          ?>
          </table>
        </div>
        <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
       
     
     <?php

        
            
}}    
        
    include $tpl .'footer.php';

}else{
   header ('location:index.php');
   exit();
}
ob_end_flush();
?>
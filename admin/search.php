<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

#myInput {
 
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
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
$pagetitle = 'البحث';
if (isset($_SESSION['Username'])){
include 'init.php';

$stmt = $con->prepare ("SELECT items.*,categories.Name AS category_name,users.Username FROM items
INNER JOIN categories ON categories.ID = items.Cat_ID
INNER JOIN users ON users.UserID = items.Member_ID ORDER BY Item_ID DESC ");
$stmt->execute();
$items = $stmt->fetchAll();
?>

<h2>البحث فى العقود  </h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

<table id="myTable"  class="main-table text-center table table-bordered">
<tr class="header">
<td> الرقم </td>
<td> رقم العقد </td>
<td> اسم العميل </td>
<td>  الهاتف </td>
<td> السعر </td>
<td> العنوان </td>
<td> تاريخ التعاقد </td>
<td>نوع العقد </td>
<td> الموظف </td>
<td> نسخة العقد </td>
<td> نسخة الكيل </td>

</tr> 
<?php 
foreach($items as $item){
echo"<tr>";
echo"<td style='display:none'>" . $item['Item_ID'] .$item['Item_ID'] . $item['Name'] . $item['Description'] . $item['Price'] . $item['Country_Made'] .  $item['Add_Date'] . $item['category_name'] . $item['Username'] ."</td>";
 echo"<td>" . $item['Item_ID'] ."</td>";
 echo"<td>" . $item['Number'] ."</td>";
 echo"<td>" . $item['Name'] ."</td>";
  echo"<td>" . $item['Description'] ."</td>";
  echo"<td>" . $item['Price'] .' K.D'."</td>";
 echo"<td>" . $item['Country_Made'] ."</td>";
 echo"<td>" . $item['Add_Date'] ."</td>";
 echo"<td>" . $item['category_name'] ."</td>";
 echo"<td>" . $item['Username'] ."</td>";
 echo"<td>";
 if(empty( $item['Image'])){
  echo 'لا يوجد';
 }else{
  echo "<a href='uploads/avatars/" . $item['Image'] ." ' alt=' ' download> <button>تحميل</button></a>";
 }
 
 echo "</td>";
 echo"<td>";
 if(empty( $item['Measure'])){
   echo 'لا يوجد';
}else{
 echo "<a href='uploads/avatars/" . $item['Measure'] ." ' alt=' ' download> <button>تحميل</button></a>";
}
 
 echo "</td>";

echo"</tr>";
}

?>


</table>

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

    include $tpl .'footer.php';

}else{
   header ('location:index.php');
   exit();
}
ob_end_flush();
?>

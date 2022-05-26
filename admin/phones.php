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
$pagetitle = 'الهواتف';
if (isset($_SESSION['Username'])){
include 'init.php';
$do = isset($_GET['do'])? $_GET['do'] : 'manage';

if ($do == 'manage'){
 
   $stmt = $con->prepare ("SELECT * FROM phones ");
   $stmt->execute();
   $phones = $stmt->fetchAll();
 
   if (! empty($phones)){
   ?>
     <h1 class="text-center"> ادارة الهواتف </h1>
       
         <div class="table-responsive">
          
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

              <table id="myTable"  class="main-table text-center table table-bordered">
              <tr class="header">
              <td> الرقم </td>
              <td> الاسم </td>
              <td>  الهاتف </td>
              <td> القسم </td>
              <td> ملاحظات </td>
              <td> التحكم </td>
           </tr> 
           <?php 
           foreach($phones as $phone){
            echo"<tr>";
            
            echo"<td style='display:none'>" . $phone['id'] .$phone['name'] . $phone['phone'] . 
            $phone['section'] . $phone['notes']  ."</td>";

               echo"<td>" . $phone['id'] ."</td>";
               echo"<td>" . $phone['name'] ."</td>";
               ?> <td><a href="callto:<?php echo $phone['phone'] ?>"><?php echo $phone['phone'] ?></a></td><?php
               echo"<td>" . $phone['section'] ."</td>";
               echo"<td>" . $phone['notes'] ."</td>";
              
               echo "<td> <a href='phones.php?do=edit&phoneid=" . $phone['id'] . " 'class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
                          <a href='phones.php?do=delete&phoneid=" . $phone['id'] . " 'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>";
                         
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
         <a href="phones.php?do=add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> هاتف جديد</a>
      
       <?php
         }else{
          echo '<div class="container">';
             echo '<div class="nice-message">';
               echo 'لا يوجد هواتف لعرضها';
              echo '<a href="phones.php?do=add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> هاتف جديد</a>';
             echo '</div>';
          echo '</div>';
      }
       ?>
 <?php

    
} elseif ($do=='add'){

   ?>

   <h1 class="text-center">اضافة هاتف جديد </h1>
         <div class="container">
           <form class="form-horizontal" action ="?do=insert" method ="POST" >
           
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">الاسم :</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="name" class="form-control" required ="required" placeholder=" الاسم "  />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">رقم الهاتف:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="phone" class="form-control" required ="required" placeholder=" رقم الهاتف"  />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">القسم :</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="section" class="form-control" required ="required" placeholder="  القسم"  />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">ملاحظات :</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="notes" class="form-control"  placeholder=" ملاحظات"  />
               </div>
             </div>
             
             <div class="form-group form-group-lg">
                     <div class ="col-sm-offset-2 col-sm-10">
                       <input class="btn btn-primary btn-sm" type="submit" value=" اضافة هاتف" />
                     </div>
             </div>
           </form>
         </div>
   
   
   <?php
   
}elseif ($do =='insert'){

   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      echo "<h1 class ='text-center'>اضافة هاتف جديد</h1> ";
      echo "<div class='container'> ";

    
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $section = $_POST['section'];
      $notes = $_POST['notes'];
    
      $formErrors = array();
     
      if(empty($name)) {
        $formErrors[] = ' الاسم لا يمكن ان يكون  <strong> فارغ</strong> ';
      }
  
      if(empty($phone)) {
        $formErrors[] = ' رقم الهاتف لا يمكن ان يكون  <strong> فارغ</strong> ';
      }

      if(empty($section)) {
        $formErrors[] = 'القسم لا يمكن ان يكون <strong> فارغ</strong> ';
      }
  
      if(empty($formErrors)){
        
       $stmt = $con->prepare ("INSERT INTO phones (name , phone , section, notes)
       VALUES(:zname,:zphone,:zsection,:znotes)");
       $stmt-> execute(array(
         
         'zname' => $name,
         'zphone' => $phone,
         'zsection' => $section,
         'znotes'  => $notes
          ));
        $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم الادخال</div>';
        redirectHome($theMsg,'back');
      }
   
    }else {
      echo "<div class = 'container'>";
      $theMsg='<div class="alert alert-danger"> لا يمكن تصفح هذه الصفحة مباشرا</div>';
      redirectHome($theMsg);
      echo "</div>";
    }
    echo "</div>";
    
    
}elseif ($do == 'edit'){ 

  $phoneid = isset($_GET['phoneid']) && is_numeric($_GET['phoneid']) ? intval($_GET['phoneid']):0;
  $stmt = $con->prepare("SELECT  * FROM phones WHERE id = ? limit 1");
  $stmt->execute(array($phoneid));
  $phone = $stmt->fetch();
  $count = $stmt->rowCount();

  if ($count > 0){ ?>

      <h1 class="text-center">تعديل هاتف</h1>
      <div class="container">
        <form class="form-horizontal" action ="?do=update" method ="POST" >
          <input type = "hidden" name = "phoneid" value = "<?php echo $phoneid ?>" />

             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">الاسم :</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="name" class="form-control" required ="required" placeholder=" الاسم " 
                  value=" <?php echo $phone['name'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">رقم الهاتف:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="phone" class="form-control" required ="required" placeholder=" رقم الهاتف" 
                value=" <?php echo $phone['phone'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">القسم:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="section" class="form-control" required ="required" placeholder="  القسم" 
                value=" <?php echo $phone['section'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> ملاحظات:</label>
               <div class="col-sm-10 col-md-6">
                <input  type="text" name="notes" class="form-control"  value="<?php echo $phone['notes']?>"/>
               </div>
             </div>
            
             <div class="form-group form-group-lg">
                     <div class ="col-sm-offset-2 col-sm-10">
                       <input class="btn btn-primary btn-sm" type="submit" value=" تحديث هاتف" />
                     </div>
             </div>
           </form>
           <?php
    } else {
      echo "<div class = 'container'>";
      $theMsg='<div class="alert alert-danger"> لا يوجد هذا الرقم</div>';
      redirectHome($theMsg);
      echo "</div>";
      

    } 
}elseif ($do =='update'){
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "<h1 class ='text-center'>تحديث هاتف</h1> ";
    echo "<div class='container'> ";

    $id = $_POST['phoneid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $section = $_POST['section'];
    $notes = $_POST['notes'];
    
    $formErrors = array();
   
        
    if(empty($name)) {
      $formErrors[] = ' الاسم لايمكن ان يكون <strong> فارغ</strong> ';
    }

    if(empty($phone)) {
      $formErrors[] = ' الهاتف لايمكن ان يكون <strong> فارغ</strong> ';
    }

    if(empty ($section)) {
      $formErrors[] = 'القسم لا يمن ان يكون <strong> فارغ </strong> ';
    }

   
    if(empty($formErrors)){

    
    $stmt = $con->prepare ("UPDATE phones SET name = ? , phone = ? , section = ? , notes = ?  WHERE id =? ");
    $stmt-> execute(array($name, $phone, $section, $notes, $id));
    $theMsg= "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم التحديث</div>';
    redirectHome($theMsg,'back');
    }
  }else {
    $theMsg='<div class="alert alert-danger"> لا يمكن تصفح هذه الصفحة مباشرا</div>';
    redirectHome($theMsg);
  }
  echo "</div>";

}elseif ($do =='delete'){
  echo "<h1 class ='text-center'>حذف هاتف</h1> ";
  echo "<div class='container'> ";
  $phoneid = isset($_GET['phoneid']) && is_numeric($_GET['phoneid']) ? intval($_GET['phoneid']):0;
  
  $check = checkItem('id','phones',$phoneid);

  if ($check > 0){ 
    $stmt = $con->prepare("DELETE FROM phones WHERE id = :zid ");
    $stmt->bindParam(":zid" , $phoneid);
    $stmt->execute();

    echo "<div class = 'container'>";
    $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم الحذف</div>';
    redirectHome($theMsg,'back');
    echo "</div>";
   

  } else {
    echo "<div class = 'container'>";
    $theMsg='<div class="alert alert-danger">لا يوجد هذا الرقم</div>';
    redirectHome($theMsg);
    echo "</div>";
   
  }
  echo "</div>";

           
 }
 
    include $tpl .'footer.php';

}else{
   header('location:index.php');
   exit();
}
ob_end_flush();
?>

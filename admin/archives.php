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
$pagetitle = 'السجلات';
if (isset($_SESSION['Username'])){
include 'init.php';
$do = isset($_GET['do'])? $_GET['do'] : 'manage';

if ($do == 'manage'){

    
   $stmt = $con->prepare ("SELECT * FROM files");
   $stmt->execute();
   $files = $stmt->fetchAll();
 
   if (! empty($files)){
   ?>
     <h1 class="text-center"> ادارة السجلات </h1>
       
         <div class="table-responsive">
        
           <!-- <table class="main-table text-center table table-bordered">
            <tr> -->
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

              <table id="myTable"  class="main-table text-center table table-bordered">
              <tr class="header">
              <td> الرقم </td>
              <td> اسم الملف </td>
              
              <td>  حجم الملف </td>
              <td>  قسم الملف </td>
              <td> تاريخ الملف </td>
              <td> ملاحظات </td>
              <td> نسخة الملف </td>
              <td> التحكم </td>
           </tr> 
           <?php 
           foreach($files as $file){
            echo"<tr>";
            
            echo"<td style='display:none'>" . $file['id'] .$file['name'] . $file['size'] . $file['kind'] . $file['date'] . "</td>";

               echo"<td>" . $file['id'] ."</td>";
               echo"<td>" . $file['name'] ."</td>";
              
                echo"<td>" . $file['size'] ."</td>";
               
               echo"<td>" . $file['kind'] ."</td>";
               echo"<td>" . $file['date'] ."</td>";
               echo"<td>" . $file['notes'] ."</td>";
               echo"<td>";
          
               if(empty( $file['file'])){
                echo 'لا يوجد';
               }else{
                echo "<a href='uploads/avatars/" . $file['file'] ." ' alt=' ' download> <button>تحميل</button></a>";
               }
               echo "</td>";
          
               echo "<td> <a href='archives.php?do=edit&fileid=" . $file['id'] . " 'class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
                          <a href='archives.php?do=delete&fileid=" . $file['id'] . " 'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>";
                        
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
         <a href="archives.php?do=add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> ملف جديد</a>
      
       <?php
         }else{
          echo '<div class="container">';
             echo '<div class="nice-message">';
               echo 'لا يوجد ملفات لعرضها';
              echo '<a href="archives.php?do=add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> ملف جديد</a>';
             echo '</div>';
          echo '</div>';
      }
       ?>
 <?php

    
} elseif ($do=='add'){

   ?>

   <h1 class="text-center">اضافة ملف جديد </h1>
         <div class="container">
           <form class="form-horizontal" action ="?do=insert" method ="POST" enctype="multipart/form-data">
          
             
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> القسم:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="kind" class="form-control" required ="required" placeholder=" القسم"  />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> تاريخ الملف:</label>
               <div class="col-sm-10 col-md-6">
                <input type="date" name="date" class="form-control" required ="required" placeholder=" تاريخ الملف"  />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> ملاحظات:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="notes" class="form-control"  placeholder=" ملاحظات الملف"  />
               </div>
             </div>
           
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">نسخة الملف:</label>
               <div class="col-sm-10 col-md-6">
                <input type="file" name="file" class="form-control"  required ="required" />
               </div>
             </div>
             <div class="form-group form-group-lg">
                     <div class ="col-sm-offset-2 col-sm-10">
                       <input class="btn btn-primary btn-sm" type="submit" value=" اضافة ملف" />
                     </div>
             </div>
           </form>
         </div>
   
   
   <?php
   
}elseif ($do =='insert'){

   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      echo "<h1 class ='text-center'>ادخال ملف</h1> ";
      echo "<div class='container'> ";

      $avatar_Name = $_FILES['file']['name'];
      $avatarSize = $_FILES['file']['size'];
      $avatarTmp = $_FILES['file']['tmp_name'];
      $avatarType = $_FILES['file']['type'];
      $avatarAllaowedExtention = array("pdf", "png","txt","xlsx","docx","doc", "jpg" ,"jpeg", "gif", "mpg", "mp4");
      $avatarExtention = strtolower(end(explode('.',$avatar_Name)));
      
      

      $kind = $_POST['kind'];
      
      $date = $_POST['date'];
      $notes = $_POST['notes'];
    
      $formErrors = array();
     
            
      if(empty($kind)) {
        $formErrors[] = ' الاسم لا يمكن ان يكون  <strong> فارغ</strong> ';
      }
  
      if(empty ($date)) {
        $formErrors[] = 'التاريخ لايمكن ان يكون <strong> فارغ </strong> ';
      }
      
       if(! empty($avatar_Name) && ! in_array( $avatarExtention, $avatarAllaowedExtention)){
        $formErrors[] = ' هذا الامتداد غير  <strong> صالح</strong> ';
      }
      if(empty($avatar_Name) ){
        $formErrors[] = ' الصورة لا يمكن ان تكون فارغة <strong> فارغ</strong> ';
      }
      if($avatarSize > 41943040){
        $formErrors[] = ' الصورة لايجب ان تكون اكبر من<strong> 40 ميجا</strong> ';
      }
      
      foreach( $formErrors as $error){
        echo '<div class = "alert alert-danger " >' . $error ;
      }

      if(empty($formErrors)){
        $file = rand(0,1000000) . '-' . $avatar_Name;
        move_uploaded_file($avatarTmp,"uploads\avatars\\" . $file);

  
       $stmt = $con->prepare ("INSERT INTO files (name , type , size, kind, date, notes , file )
       VALUES(:zname,:ztype,:zsize,:zkind,:zdate,:znotes ,:zfile)");
       $stmt-> execute(array(
         
         'zname' => $avatar_Name,
         'ztype' => $avatarType,
         'zsize' => $avatarSize,
         
         'zkind' => $kind,
        
         'zdate' => $date,
         'znotes' => $notes,
        
         'zfile'  => $file
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

  $fileid = isset($_GET['fileid']) && is_numeric($_GET['fileid']) ? intval($_GET['fileid']):0;
  $stmt = $con->prepare("SELECT  * FROM files WHERE id = ? ");
  $stmt->execute(array($fileid));
  $file = $stmt->fetch();
  $count = $stmt->rowCount();

  if ($count > 0){ ?>

      <h1 class="text-center">تعديل عقد</h1>
      <div class="container">
        <form class="form-horizontal" action ="?do=update" method ="POST" enctype="multipart/form-data">
          <input type = "hidden" name = "fileid" value = "<?php echo $fileid ?>" />

          <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">  القسم:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="kind" class="form-control" required ="required" placeholder="  القسم " 
                  value=" <?php echo $file['kind'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> تاريخ الملف:</label>
               <div class="col-sm-10 col-md-6">
                <input type="date" name="date" class="form-control" required ="required" 
                  value="<?php echo $file['date'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> ملاحظات:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="notes" class="form-control"  placeholder="  الملاحظات" 
                value=" <?php echo $file['notes'] ?>" />
               </div>
             </div>
                     
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> نسخة الملف:</label>
               <div class="col-sm-10 col-md-6">
                <input type="hidden" name="oldfile" value=" <?php echo $file['file'] ?>" />
                <input type="file" name="file" class="form-control"  />
               </div>
             </div>
             <div class="form-group form-group-lg">
                     <div class ="col-sm-offset-2 col-sm-10">
                       <input class="btn btn-primary btn-sm" type="submit" value=" تحديث عقد" />
                     </div>
             </div>
           </form>
          
          </table>
        </div>
            <?php } 
            

}elseif ($do =='update'){
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "<h1 class ='text-center'>تحديث ملف</h1> ";
    echo "<div class='container'> ";

      $avatar_Name = $_FILES['file']['name'];
      $avatarSize = $_FILES['file']['size'];
      $avatarTmp = $_FILES['file']['tmp_name'];
      $avatarType = $_FILES['file']['type'];
      $avatarAllaowedExtention = array("pdf", "png","txt","xlsx","docx","doc", "jpg" ,"jpeg", "gif", "mpg", "mp4");
      $avatarExtention = strtolower(end(explode('.',$avatar_Name)));
   
       $file=$_FILES['file']['name'];
       if($file== NULL){
           $file=$_POST['oldfile'];
       }else{
         unlink("uploads/avatars/".$_POST['oldfile']);
        $wattachmenttmp=$_FILES['file']['tmp_name'];
        $upload_file='uploads/avatars/';
        move_uploaded_file($wattachmenttmp,$upload_file.$file);
    
     
      }
      $id = $_POST['fileid'];
      $kind = $_POST['kind'];
      
      $date = $_POST['date'];
      $notes = $_POST['notes'];
    
      $formErrors = array();
     
            
      if(empty($kind)) {
        $formErrors[] = ' الاسم لا يمكن ان يكون  <strong> فارغ</strong> ';
      }
  
      if(empty ($date)) {
        $formErrors[] = 'التاريخ لايمكن ان يكون <strong> فارغ </strong> ';
      }
      
       if(! empty($avatar_Name) && ! in_array( $avatarExtention, $avatarAllaowedExtention)){
        $formErrors[] = ' هذا الامتداد غير  <strong> صالح</strong> ';
      }
      if(empty($avatar_Name) ){
        $formErrors[] = ' الصورة لا يمكن ان تكون فارغة <strong> فارغ</strong> ';
      }
      if($avatarSize > 41943040){
        $formErrors[] = ' الصورة لايجب ان تكون اكبر من<strong> 40 ميجا</strong> ';
      }
      
      foreach( $formErrors as $error){
        echo '<div class = "alert alert-danger " >' . $error ;
      }

      if(empty($formErrors)){
        
            
    $stmt = $con->prepare ("UPDATE files SET  kind = ? , date = ? , notes = ? , file = ?  WHERE id =? ");
    $stmt-> execute(array($kind, $date, $notes, $file, $id));
    $theMsg= "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم التحديث</div>';
    redirectHome($theMsg,'back');
    }
  }else {
    $theMsg='<div class="alert alert-danger"> لا يمكن تصفح هذه الصفحة مباشرا</div>';
    redirectHome($theMsg);
  }
  echo "</div>";

}elseif ($do =='delete'){
  echo "<h1 class ='text-center'>حذف عقد</h1> ";
  echo "<div class='container'> ";
  $fileid = isset($_GET['fileid']) && is_numeric($_GET['fileid']) ? intval($_GET['fileid']):0;
  
  $check = checkItem('id','files',$fileid);

  if ($check > 0){ 
    $stmt = $con->prepare("DELETE FROM files WHERE id = :zid ");
    $stmt->bindParam(":zid" , $fileid);
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


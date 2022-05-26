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
$pagetitle = 'الموظفين';
if (isset($_SESSION['Username'])){
include 'init.php';
$do = isset($_GET['do'])? $_GET['do'] : 'manage';

if ($do == 'manage'){
 $query ='';
 if (isset($_GET['page']) && $_GET['page'] == 'pending'){
  $query ='AND RegStatus = 0';
 }
 
  $stmt = $con->prepare ("SELECT * FROM users WHERE TrustStatus !=1 $query  ORDER BY UserID ");
  $stmt->execute();
  $rows = $stmt->fetchAll();
 if (! empty($rows)){

  ?>
    <h1 class="text-center">ادارة الموظفين </h1>
      
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
                        if($row['RegStatus']== 0){
                         echo "<a href='members.php?do=activate&userid=" . $row['UserID'] . " 'class='btn btn-info activate '><i class='fa fa-check'></i> تفعيل </a>";
                        }
                        if($row['GroupID']== 0){
                          echo "<a href='members.php?do=admin&userid=" . $row['UserID'] . " 'class='btn btn-info activate '><i class='fa fa-check'></i>  ادمن </a>";
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
        <a href="members.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i> موظف جديد</a>
     
      <?php
         }else{
          echo '<div class="container">';
             echo '<div class="nice-message">';
               echo 'لا يوجد موظفين لعرضها';
               echo '<a href="members.php?do=add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> موظف جديد</a>';
             echo '</div>';
          echo '</div>';
      }
       ?>
<?php
} elseif ($do=='add'){?>

  <h1 class="text-center">اضافة موظف جديد</h1>
      <div class="container">
        <form class="form-horizontal" action ="?do=insert" method ="POST" enctype="multipart/form-data" >
          
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">اسم المستخدم:</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="username" class="form-control" required ="required"  autocomplete="off" placeholder="اسم المستخدم لدخول الموقع" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الرقم السري:</label>
            <div class="col-sm-10 col-md-6">
           
            <input type="password" name="password" class="password form-control" required ="required"  autocomplete="new-password" placeholder =" الرقم السري يجب ان يكون صعب ومعقد " />
            <i class="show-pass fa fa-eye fa-2x"> </i>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">البريد الالكترونى:</label>
            <div class="col-sm-10 col-md-6">
            <input  type="email" name="email" class="form-control"  required ="required" placeholder="البريد الالكتروني يجب ان يكون صالح" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الاسم الكامل:</label>
            <div class="col-sm-10 col-md-6">
            <input  type="text" name="full" class="form-control"  required ="required" placeholder="الاسم الكامل الذي سيظهر فى الصفحة الشخصية" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> الوظيفة:</label>
            <div class="col-sm-10 col-md-6">
            <input  type="text" name="position" class="form-control"  required ="required" placeholder=" الوظيفة الذي سيظهر فى الصفحة الشخصية" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> الراتب:</label>
            <div class="col-sm-10 col-md-6">
            <input  type="text" name="salary" class="form-control"  required ="required" placeholder="الراتب  الذي سيظهر فى الصفحة الشخصية" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> رقم الهاتف:</label>
            <div class="col-sm-10 col-md-6">
            <input  type="text" name="phone" class="form-control"  required ="required" placeholder="رقم الهاتف الذي سيظهر فى الصفحة الشخصية" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> تاريخ التعيين:</label>
            <div class="col-sm-10 col-md-6">
            <input  type="date" name="date" class="form-control"  required ="required" placeholder="تاريخ التعيين الذي سيظهر فى الصفحة الشخصية" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> ملاحظات:</label>
            <div class="col-sm-10 col-md-6">
            <input  type="text" name="notes" class="form-control"  required ="required" placeholder=" الملاحظات الذي سيظهر فى الصفحة الشخصية" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">صورة المستخدم:</label>
            <div class="col-sm-10 col-md-6">
            <input  type="file" name="avatar" class="form-control"  required ="required"  />
            </div>
          </div>
          <div class="form-group form-group-lg">
                  <div class ="col-sm-offset-2 col-sm-10">
                    <input class="btn btn-primary btn-lg" type="submit" value=" اضافة موظف" />
                  </div>
          </div>
        </form>
      </div>
<?php

}elseif ($do =='insert'){

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "<h1 class ='text-center'>ادخال موظف</h1> ";
    echo "<div class='container'> ";

    
    
     $avatarName = $_FILES['avatar']['name'];
     $avatarSize = $_FILES['avatar']['size'];
     $avatarTmp = $_FILES['avatar']['tmp_name'];
     $avatarType = $_FILES['avatar']['type'];
     $avatarAllaowedExtention = array("pdf", "png","txt","xlsx","docx", "jpg" ,"jpeg", "gif");
     $avatarExtention = strtolower(end(explode('.',$avatarName)));
     
    
     $user = $_POST['username'];
     $pass = $_POST['password'];
     $email = $_POST['email'];
     $name = $_POST['full'];
     $date = $_POST['date'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $phone = $_POST['phone'];
    $notes = $_POST['notes'];
    
    $hashpass= sha1($_POST['password']);
    $formErrors = array();
   
    if(strlen($user) < 4 ){
      $formErrors[] = ' اسم المستخد يجب ان يكون اكثر من <strong> 3 حروف</strong> ';
    }
    
    if(strlen($user) > 20 ){
      $formErrors[] = 'اسم المستخد يجب ان يكون اقل من <strong>20 حرف </strong> ';
    }
    
    if(empty($user)) {
      $formErrors[] = ' اسم المستخدم لايمكن ان يكون<strong> فارغ</strong> ';
    }

    if(empty($pass)) {
      $formErrors[] = 'الرقم السري لا يمكن ان يكون<strong> فارغ</strong> ';
    }

    if(empty ($name)) {
      $formErrors[] = ' الاسم الكامل لا يمكن ان يكون<strong> فارغ</strong> ';
    }

    if(empty($position)) {
      $formErrors[] = ' اسم الوظيفة لايمكن ان يكون<strong> فارغ</strong> ';
    }

    if(empty($salary)) {
      $formErrors[] = ' الراتب لا يمكن ان يكون<strong> فارغ</strong> ';
    }

    if(empty ($phone)) {
      $formErrors[] = ' رقم الهاتف لا يمكن ان يكون<strong> فارغ</strong> ';
    }
    if(empty($date)) {
      $formErrors[] = ' تاريخ التعيين لايمكن ان يكون<strong> فارغ</strong> ';
    }

    if(empty($notes)) {
      $formErrors[] = ' الملاحظات لا يمكن ان يكون<strong> فارغ</strong> ';
    }

     if(empty ($email)) {
      $formErrors[] = ' البريد الالكتروني <strong> فارغ</strong> ';
    }
    if(! empty($avatarName) && ! in_array( $avatarExtention, $avatarAllaowedExtention)){
      $formErrors[] = ' هذا الامتداد غير  <strong> صالح</strong> ';
    }
    if(empty($avatarName) ){
      $formErrors[] = ' الصورة لا يمكن ان تكون فارغة <strong> فارغ</strong> ';
    }
    if($avatarSize > 4194304){
      $formErrors[] = ' الصورة لايجب ان تكون اكبر من<strong> 4 ميجا</strong> ';
    }
    foreach( $formErrors as $error){
      echo '<div class = "alert alert-danger " >' . $error . '</div>';
    }
    
    if(empty($formErrors)){
      $avatar = rand(0,1000000) . '-' . $avatarName;
      move_uploaded_file($avatarTmp,"uploads\avatars\\" . $avatar);

      $check = checkItem("Username","users",$user);
      if ($check==1){
        $theMsg= '<div class = "alert alert-danger " > هذا الاسم المستخدم موجود من قبل  </div>';
        redirectHome($theMsg,'back');
      }else{
     $stmt = $con->prepare ("INSERT INTO users (Username , Password, Email, FullName, RegStatus, Date , avatar, Position, Salary, Phone, Notes )
     VALUES(:zuser,:zpass,:zmail,:zname,1,:zdate,:zavatar,:zposition,:zsalary,:zphone,:znotes)");
     $stmt-> execute(array(
       'zuser' => $user,
       'zpass' => $hashpass,
       'zmail' => $email,
       'zname' => $name,
       'zdate' => $date,
       'zavatar' =>$avatar,
       'zposition' => $position,
       'zsalary' => $salary,
       'zphone' => $phone,
       'znotes' =>$notes
       ));
      $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم الادخال</div>';
      redirectHome($theMsg,'back');
    }
  } 
 
  }else {
    echo "<div class = 'container'>";
    $theMsg='<div class="alert alert-danger"> لا يمكن تصفح هذه الصفحة مباشرا</div>';
    redirectHome($theMsg);
    echo "</div>";
  }
  echo "</div>";
   

}elseif ($do == 'edit'){ 
  $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;
  $stmt = $con->prepare("SELECT  * FROM users WHERE UserID = ? limit 1");
  $stmt->execute(array($userid));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();

  if ($count > 0){ ?>

      <h1 class="text-center">تعديل موظف</h1>
      <div class="container">
        <form class="form-horizontal" action ="?do=update" method ="POST" enctype="multipart/form-data" >
          <input type = "hidden" name = "userid" value = "<?php echo $userid ?>" />
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">اسم المستخدم:</label>
            <div class="col-sm-10 col-md-6">
             <input type="text" name="username" class="form-control"  value="<?php echo $row['Username']?>" autocomplete="off"  required ="required"/>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الرقم السري:</label>
            <div class="col-sm-10 col-md-6">
             <input type="hidden" name="oldpassword" value="<?php echo $row['Password']?>" />
             <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder =" اتركه فارغ اذا اردت عدم تحديث الرقم السري" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">البريد الالكترونى:</label>
            <div class="col-sm-10 col-md-6">
             <input  type="email" name="email" class="form-control"  value="<?php echo $row['Email']?>" required ="required"/>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الاسم الكامل:</label>
            <div class="col-sm-10 col-md-6">
             <input  type="text" name="full" class="form-control"  value="<?php echo $row['FullName']?>" required ="required" />
            </div>
          </div>
       
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> الوظيفة:</label>
            <div class="col-sm-10 col-md-6">
             <input type="text" name="position" class="form-control"   value="<?php echo $row['Position']?>" required ="required"/>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> الراتب:</label>
            <div class="col-sm-10 col-md-6">
             <input  type="text" name="salary" class="form-control"  value="<?php echo $row['Salary']?>" required ="required"/>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> رقم الهاتف:</label>
            <div class="col-sm-10 col-md-6">
             <input  type="text" name="phone" class="form-control"  value="<?php echo $row['Phone']?>" required ="required" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> تاريخ التعيين:</label>
            <div class="col-sm-10 col-md-6">
            <input  type="date" name="date" class="form-control"  value="<?php echo $row['Date']?>" required ="required" />
          </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> ملاحظات:</label>
            <div class="col-sm-10 col-md-6">
             <input  type="text" name="notes" class="form-control"  value="<?php echo $row['Notes']?>" required ="required"/>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">صورة المستخدم :</label>
            <div class="col-sm-10 col-md-6">
             <input type="hidden" name="oldavatar" value="<?php echo $row['avatar']?>" />
             <input type="file" name="avatar">
            </div>
          </div>
          <div class="form-group form-group-lg">
                  <div class ="col-sm-offset-2 col-sm-10">
                    <input class="btn btn-primary btn-lg" type="submit" value="تعديل" />
                  </div>
          </div>
          <img src="uploads/avatars/<?php echo $row['avatar'] ?>">
        </form>
      </div>
         
          
            <?php
             } else {
              echo "<div class = 'container'>";
              $theMsg='<div class="alert alert-danger"> لا يوجد هذا الرقم</div>';
              redirectHome($theMsg);
              echo "</div>";
              

            } 

}elseif ($do =='update'){
            echo "<h1 class ='text-center'>تحديث موظف</h1>";
            echo "<div class='container'> ";
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
              $id = $_POST['userid'];
              $user = $_POST['username'];
              $email = $_POST['email'];
              $name = $_POST['full'];
              $position = $_POST['position'];
              $salary = $_POST['salary'];
              $phone = $_POST['phone'];
              $date = $_POST['date'];
              $notes = $_POST['notes'];
              $pass = empty ($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
 
              $avatar=$_FILES['avatar']['name'];
              if($avatar== NULL){
                  $avatar=$_POST['oldavatar'];
              }else{
                unlink("uploads/avatars/".$_POST['oldavatar']);
               $wattachmenttmp=$_FILES['avatar']['tmp_name'];
               $upload_file='uploads/avatars/';
               move_uploaded_file($wattachmenttmp,$upload_file.$avatar);
              }
              $formErrors = array();
              if(strlen($user) < 4 ){
                $formErrors[] = '<div class = "alert alert-danger " > اسم المستخدم لا يمكن ان يكون اقل من  <strong>  3 حروف</strong> </div>';
              }
              
              if(empty($user)) {
                $formErrors[] = '<div class = "alert alert-danger " > اسم المستخدم لا يمكن ان يكون<strong> فارغ</strong> </div>';
              }
            
              if(empty ($name)) {
                $formErrors[] = '<div class = "alert alert-danger " >  الاسم الكامل لا يمكن ان يكون <strong> فارغ</strong> </div>';
              }
             
              if(empty ($email)) {
                $formErrors[] = '<div class = "alert alert-danger " > البريد الالكترونى لا يمكن ان يكون <strong> فارغ</strong> </div>';
              }
              if(empty($position)) {
                $formErrors[] = '<div class = "alert alert-danger " > اسم لبوظيفة لا يمكن ان يكون<strong> فارغ</strong> </div>';
              }
            
              if(empty ($salary)) {
                $formErrors[] = '<div class = "alert alert-danger " >   الراتب لا يمكن ان يكون <strong> فارغ</strong> </div>';
              }
             
              if(empty ($phone)) {
                $formErrors[] = '<div class = "alert alert-danger " > رقم الهاتف لا يمكن ان يكون <strong> فارغ</strong> </div>';
              }
              if(empty($date)) {
                $formErrors[] = '<div class = "alert alert-danger " > تاريخ التعيين لا يمكن ان يكون<strong> فارغ</strong> </div>';
              }
            
              if(empty ($notes)) {
                $formErrors[] = '<div class = "alert alert-danger " >   الملاحظات لا يمكن ان يكون <strong> فارغ</strong> </div>';
              }

               foreach( $formErrors as $error){
                echo $error ;
              }
              if(empty($formErrors)){
              

                $stmt2 = $con->prepare("SELECT * FROM users WHERE Username = ? AND UserID != ?");
                $stmt2->execute(array($user,$id));
                $count = $stmt2->rowCount();
                if ($count == 1){
                
                 $theMsg= "<div class = 'alert alert-danger'> " . $stmt2->rowCount() . 'هذا الاسم مستخدم من قبل</div>';
              redirectHome($theMsg,'back');
                }else{
                    
              $stmt = $con->prepare ("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ?, Position = ?, Salary = ?, Phone = ?, Date = ?, Notes = ?, avatar = ? WHERE UserID =?");
              $stmt-> execute(array($user, $email, $name, $pass, $position ,$salary, $phone, $date, $notes,$avatar, $id));
              $theMsg= "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم التحديث</div>';
              redirectHome($theMsg,'back');
              
                }

              
              }
            }else {
              $theMsg='<div class="alert alert-danger"> لا يمكن تصفح هذه الصفحة مباشرا</div>';
              redirectHome($theMsg);
            }
            echo "</div>";

 }elseif ($do =='delete'){
            echo "<h1 class ='text-center'>حذف موظف</h1> ";
            echo "<div class='container'> ";
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;
            
            $check = checkItem('userid','users',$userid);
          
            if ($check > 0){ 
              $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser AND UserID !=1  ");
              $stmt->bindParam(":zuser" , $userid);
              $stmt->execute();

              echo "<div class = 'container'>";
              $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم الحذف</div>';
              redirectHome($theMsg,'back');
              echo "</div>";
             
            } else {
              echo "<div class = 'container'>";
              $theMsg='<div class="alert alert-danger">هذا الرقم غير موجود</div>';
              redirectHome($theMsg);
              echo "</div>";
             
            }
            echo "</div>";
  }elseif ($do == 'activate'){
          echo "<h1 class ='text-center'>تفعيل موظف</h1> ";
          echo "<div class='container'> ";
          $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;
          
          $check = checkItem('userid','users',$userid);
        
          if ($check > 0){ 
            $stmt = $con->prepare("UPDATE  users SET RegStatus = 1  WHERE UserID = ? ");
            
            $stmt->execute(array($userid));

            echo "<div class = 'container'>";
            $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم التفعيل</div>';
            redirectHome($theMsg);
            echo "</div>";
           
          } else {
            echo "<div class = 'container'>";
            $theMsg='<div class="alert alert-danger">هذا الرقم غير موجود</div>';
            redirectHome($theMsg);
            echo "</div>";
           
          }
          echo "</div>";
        
   }elseif ($do == 'admin'){
        echo "<h1 class ='text-center'>تفعيل ادمن</h1> ";
        echo "<div class='container'> ";
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;
        
        $check = checkItem('userid','users',$userid);
      
        if ($check > 0){ 
          $stmt = $con->prepare("UPDATE  users SET GroupID = 1  WHERE UserID = ? ");
          
          $stmt->execute(array($userid));

          echo "<div class = 'container'>";
          $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم التفعيل</div>';
          redirectHome($theMsg,'back');
          echo "</div>";
         
        } else {
          echo "<div class = 'container'>";
          $theMsg='<div class="alert alert-danger">هذا الرقم غير موجود</div>';
          redirectHome($theMsg);
          echo "</div>";
         
        }
        echo "</div>";
 }elseif ($do == 'deleteadmin'){
        echo "<h1 class ='text-center'>الغاء ادمن</h1> ";
        echo "<div class='container'> ";
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;
        
        $check = checkItem('userid','users',$userid);
      
        if ($check > 0){ 
          $stmt = $con->prepare("UPDATE  users SET GroupID = 0  WHERE UserID = ? AND UserID !=1");
          
          $stmt->execute(array($userid));

          echo "<div class = 'container'>";
          $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم الالغاء</div>';
          redirectHome($theMsg,'back');
          echo "</div>";
         
        } else {
          echo "<div class = 'container'>";
          $theMsg='<div class="alert alert-danger">هذا الرقم غير موجود</div>';
          redirectHome($theMsg);
          echo "</div>";
         
        }
        echo "</div>";
      }
    include $tpl .'footer.php';

}else{
   header ('location:index.php');
   exit();
}
ob_end_flush();
?>
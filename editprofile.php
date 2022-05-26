<?php
ob_start();
session_start();


if (isset($_SESSION['user'])) {
    $pagetitle = 'الصفحة الشخصية';

include 'init.php';
    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['userid'];
       
        $email = $_POST['email'];
        $name = $_POST['full'];
        
        $phone = $_POST['phone'];
      
        $pass = empty ($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

        $avatar=$_FILES['avatar']['name'];
        if($avatar== NULL){
            $avatar=$_POST['oldavatar'];
        }else{
          unlink("admin/uploads/avatars/".$_POST['oldavatar']);
         $wattachmenttmp=$_FILES['avatar']['tmp_name'];
         $upload_file='admin/uploads/avatars/';
         move_uploaded_file($wattachmenttmp,$upload_file.$avatar);
        }
        $formErrors = array();
    
      
        if(empty ($name)) {
          $formErrors[] = '<div class = "alert alert-danger " >  الاسم الكامل لا يمكن ان يكون <strong> فارغ</strong> </div>';
        }
       
        if(empty ($email)) {
          $formErrors[] = '<div class = "alert alert-danger " > البريد الالكترونى لا يمكن ان يكون <strong> فارغ</strong> </div>';
        }
        
        if(empty ($phone)) {
          $formErrors[] = '<div class = "alert alert-danger " > رقم الهاتف لا يمكن ان يكون <strong> فارغ</strong> </div>';
        }
          
         foreach( $formErrors as $error){
          echo $error ;
        }
        if(empty($formErrors)){
        

            $stmt = $con->prepare ("UPDATE users SET  Email = ?, FullName = ?, Password = ?, Phone = ?, avatar = ? WHERE UserID =?");
            $stmt-> execute(array($email, $name, $pass, $phone, $avatar, $id));
            $theMsg= "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم التحديث</div>';
            redirectHome($theMsg,'back');
        
        }
      }

    $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
    $count = $getUser->rowCount();

    if ($count > 0){ ?>
  
        <h1 class="text-center">تعديل البيانات</h1>
        <div class="container">
        <form class="form-horizontal main-form" action ="<?php echo $_SERVER['PHP_SELF']?>" method ="POST" enctype="multipart/form-data">
        <input type = "hidden" name = "userid" value = "<?php echo $userid ?>" />
          
            <div class="form-group form-group-lg">
              <label class="control-label col-sm-2">الرقم السري:</label>
              <div class="col-sm-10 col-md-6">
               <input type="hidden" name="oldpassword" value="<?php echo $info['Password']?>" />
               <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder =" اتركه فارغ اذا اردت عدم تحديث الرقم السري" />
              </div>
            </div>
            <div class="form-group form-group-lg">
              <label class="control-label col-sm-2">البريد الالكترونى:</label>
              <div class="col-sm-10 col-md-6">
               <input  type="email" name="email" class="form-control"  value="<?php echo $info['Email']?>" required ="required"/>
              </div>
            </div>
            <div class="form-group form-group-lg">
              <label class="control-label col-sm-2">الاسم الكامل:</label>
              <div class="col-sm-10 col-md-6">
               <input  type="text" name="full" class="form-control"  value="<?php echo $info['FullName']?>" required ="required" />
              </div>
            </div>
         
            <div class="form-group form-group-lg">
              <label class="control-label col-sm-2"> رقم الهاتف:</label>
              <div class="col-sm-10 col-md-6">
               <input  type="text" name="phone" class="form-control"  value="<?php echo $info['Phone']?>" required ="required" />
              </div>
            </div>
            
            <div class="form-group form-group-lg">
              <label class="control-label col-sm-2">صورة المستخدم :</label>
              <div class="col-sm-10 col-md-6">
               <input type="hidden" name="oldavatar" value="<?php echo $info['avatar']?>" />
               <input type="file" name="avatar">
              </div>
            </div>
            <div class="form-group form-group-lg">
                    <div class ="col-sm-offset-2 col-sm-10">
                      <input class="btn btn-primary btn-lg" type="submit" value="تعديل" />
                    </div>
            </div>
            <img src="admin/uploads/avatars/<?php echo $info['avatar'] ?>">
          </form>
        </div>
           
            
              <?php
               } else {
                echo "<div class = 'container'>";
                $theMsg='<div class="alert alert-danger"> لا يوجد هذا الرقم</div>';
                redirectHome($theMsg);
                echo "</div>";
                
  
              } 

} else {
    header('location:login.php');
    exit();
}
include $tpl . 'footer.php';
ob_end_flush();
 
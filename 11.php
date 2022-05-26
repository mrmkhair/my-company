<?php
ob_start();
session_start();


 if (isset($_SESSION['user'])) {
    $pagetitle = 'تعديل البيانات الشخصية';
    include 'init.php';
  
  $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;
  $stmt = $con->prepare("SELECT  * FROM users WHERE UserID = ? limit 1");
  $stmt->execute(array($userid));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();

  if ($count > 0){ ?>
   
      
 <h1 class="text-center"> <?php echo $pagetitle ?></h1>
 <div class="create-ad block" >
     <div class="container">
        <div class="panel panel-primary">
         <div class="panel-heading"> <?php echo $pagetitle ?> </div>
          <div class="panel-body">
               <div class="row">
                <div class="col-md-8">
              <form class="form-horizontal" action ="<?php echo $_SERVER['PHP_SELF']?>" method ="POST" enctype="multipart/form-data" >
                <input type = "hidden" name = "userid" value = "<?php echo $userid?>" />
                <input type="hidden" name="username"  value="<?php echo $row['Username']?>" />
                
                <div class="form-group form-group-lg">
                  <label class="control-label col-sm-3">الرقم السري:</label>
                  <div class="col-sm-10 col-md-9">
                   <input type="hidden" name="oldpassword" value="<?php echo $row['Password']?>" />
                   <input type="password" name="newpassword" class="form-control " autocomplete="new-password" placeholder =" اتركه فارغ اذا اردت عدم تحديث الرقم السري" />
                  </div>
                </div>
                <div class="form-group form-group-lg">
                  <label class="control-label col-sm-3">البريد الالكترونى:</label>
                  <div class="col-sm-10 col-md-9">
                   <input  type="email" name="email" class="form-control "  value="<?php echo $row['Email']?>" required ="required"  />
                  </div>
                </div>
                <div class="form-group form-group-lg">
                  <label class="control-label col-sm-3">الاسم الكامل:</label>
                  <div class="col-sm-10 col-md-9">
                   <input  type="text" name="full" class="form-control live"  value="<?php echo $row['FullName']?>" required ="required" data-class=".live-title"/>
                  </div>
                </div>
             
                <div class="form-group form-group-lg">
                  <label class="control-label col-sm-3"> الوظيفة:</label>
                  <div class="col-sm-10 col-md-9">
                   <input type="text" name="position" class="form-control live"   value="<?php echo $row['Position']?>" required ="required" data-class=".live-desc"/>
                  </div>
                </div>
                <div class="form-group form-group-lg">
                  <label class="control-label col-sm-3"> الراتب:</label>
                  <div class="col-sm-10 col-md-9">
                   <input  type="text" name="salary" class="form-control live"  value="<?php echo $row['Salary']?>" required ="required"data-class=".live-price" />
                  </div>
                </div>
                <div class="form-group form-group-lg">
                  <label class="control-label col-sm-3"> رقم الهاتف:</label>
                  <div class="col-sm-10 col-md-9">
                   <input  type="text" name="phone" class="form-control live"  value="<?php echo $row['Phone']?>" required ="required" data-class=".live-desc1"/>
                  </div>
                </div>
                <div class="form-group form-group-lg">
                  <label class="control-label col-sm-3"> تاريخ التعيين:</label>
                  <div class="col-sm-10 col-md-9">
                  <input  type="date" name="date" class="form-control live"  value="<?php echo $row['Date']?>" required ="required" data-class=".live-desc2"/>
                </div>
                </div>
                <div class="form-group form-group-lg">
                  <label class="control-label col-sm-3"> ملاحظات:</label>
                  <div class="col-sm-10 col-md-9">
                   <input  type="text" name="notes" class="form-control "  value="<?php echo $row['Notes']?>" required ="required" />
                  </div>
                </div>
                <div class="form-group form-group-lg">
                  <label class="control-label col-sm-3">صورة المستخدم :</label>
                  <div class="col-sm-10 col-md-9">
                   <input type="hidden" name="oldavatar" value="<?php echo $row['avatar']?>" />
                   <input type="file" name="avatar">
                  </div>
                </div>
                <div class="form-group form-group-lg">
                        <div class ="col-sm-offset-3 col-sm-9">
                          <input class="btn btn-primary btn-lg" type="submit" value="تحديث" />
                        </div>
                </div>
             
              </form>
              
            </div>
                   <div class="col-md-4">
                          <div class="thumbnail item-box live-preview">
                            <span class="price-tag"><span class="live-price"> 0 </span></span>
                               <img class="img-responsive" src="admin/uploads/avatars/<?php echo $row['avatar'] ?>" alt=" " />
                                <div class="caption">
                                  <h3 class="live-title" > الاسم الكامل</h3>
                                   <p class="live-desc"> الوظيفة </p>
                                   <p class="live-price"> الراتب </p>
                                   <p class="live-desc1"> الهاتف </p>
                                   <p class="live-desc2"> تاريخ التعيين </p>

                                </div>
                            </div>
                          </div> 
            </div>
        </div>
     </div>
 </div>

            <?php
             } 
      
                  
                  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $id = $_POST['userid'];
                   
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
                    
      
                 
                    $stmt = $con->prepare ("UPDATE users SET  Email = ?, FullName = ?, Password = ?, Position = ?, Salary = ?, Phone = ?, Date = ?, Notes = ?, avatar = ? WHERE UserID =?");
                    $stmt-> execute(array( $email, $name, $pass, $position ,$salary, $phone, $date, $notes,$avatar, $id));
                    $theMsg= "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم التحديث</div>';
                    redirectHome($theMsg,'back');
                    
                  
      
                    
                    }
                  }
      
               
                        include $tpl .'footer.php';
        }else{
          header ('location:login.php');
          exit();
       }
       ob_end_flush();
       ?>

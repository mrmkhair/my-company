<?php
ob_start();
session_start();

if(isset($_SESSION['user'])){
  $nonavbar = '';
$pagetitle = 'دخول';
    header('location: index.php');
}
 include 'init.php';
 if ($_SERVER['REQUEST_METHOD']== 'POST'){
     if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    $hashedPass = sha1($pass);

    $stmt = $con->prepare("SELECT UserID, Username, Password FROM users WHERE Username = ? AND Password = ? AND RegStatus = 1 ");
    $stmt->execute(array($user, $hashedPass));
    $get = $stmt->fetch();
    $count = $stmt->rowCount();
    
    if ($count > 0){
        $_SESSION['user'] = $user;
        $_SESSION['uid'] = $get['UserID'];  
            header('location: index.php');
          exit();
    }
  }else{
     $formErrors = array();
     $username = $_POST['username'];
     $password = $_POST['password'];
     $password2 = $_POST['password2'];
     $email = $_POST['email'];

     if (isset($username)){
         $filteredUser = filter_var($username,FILTER_SANITIZE_STRING);
         if(strlen( $filteredUser)<4){
             $formErrors[] = 'username must be larger than 4 characters';
         }
        
     }
     if (isset($password) && isset($password2)){
         
        if(empty($password)){
            $formErrors[] = 'sorry password can not be empty';
        }
        
        if(sha1($password) !== sha1($password2)){
            $formErrors[] = 'sorry password is not match';
        }
       
    }
    if (isset($email)){
        $filteredEmail = filter_var($email,FILTER_SANITIZE_EMAIL);
        if(filter_var($filteredEmail,FILTER_VALIDATE_EMAIL) != true){
            $formErrors[] = 'this email is not valid';
        }
       
    }
    if(empty($formErrors)){
        $check = checkItem("Username","users",$username);
        if ($check == 1){
            $formErrors[] = 'sorry this user is exist';
         
        }else{
       $stmt = $con->prepare ("INSERT INTO users (Username , Password, Email, RegStatus, Date)
       VALUES(:zuser,:zpass,:zmail,0,now())");
       $stmt-> execute(array(
         'zuser' => $username,
         'zpass' => sha1($password),
         'zmail' => $email
          ));
        $successMsg = "congrats you are registered user now waiting  the approve " ;
      
      }
    }
  }
}

 ?>

<div class="container login-page">
    <h1 class ="text-center"> <span class="login selected" data-class="login">دخول </span> | <span data-class="signup">تسجيل </span></h1>
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
        <div class="input-container">
          <input class="form-control" type="text" name="username" placeholder="type your username" autocomplete="off" required="required"/>
        </div>
        <div class="input-container">
          <input class="form-control" type="password" name="password" placeholder="type your password" autocomplete="new-password" required="required"/>
          </div>
         <input class="btn btn-primary btn-block" type="submit"  name="login" value="دخول" />
    </form>

    <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
        <div class="input-container">
         <input pattern=".{4,20}" title="username must be between 4 and 19 characters" class="form-control" type="text" name="username" placeholder="type your username" autocomplete="off"  required="required"/>
         </div>
        <div class="input-container">
         <input minlength="4" class="form-control" type="password" name="password" placeholder="type your complex password" autocomplete="new-password" required="required"/>
         </div>
        <div class="input-container">
         <input minlength="4" class="form-control" type="password" name="password2" placeholder="type your complex password again" autocomplete="new-password" required="required" />
         </div>
        <div class="input-container">
         <input class="form-control" type="email" name="email" placeholder="type a valid email" required="required"/>
         </div>
        <input class="btn btn-success btn-block" type="submit" name="signup" value="تسجيل" />
    </form>
    <div class="the-errors text-center">
      <?php
      if(!empty($formErrors)){
          foreach($formErrors as $error){
              echo '<div class ="msg error">'. $error . '</div>';
          }
      } 
      if (isset($successMsg)){
        echo '<div class ="msg success">'. $successMsg . '</div>';
      }
      ?>
    </div>
</div>
<?php  
include $tpl . 'footer.php'; 
ob_end_flush();
?>
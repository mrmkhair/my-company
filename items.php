<?php
ob_start();
session_start();


if(isset($_SESSION['user'])){
  $pagetitle = ' صفحة العقود';

include 'init.php';

$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;
$stmt = $con->prepare("SELECT items.*,categories.Name AS category_name,users.Username FROM items 
INNER JOIN categories ON categories.ID = items.Cat_ID 
INNER JOIN users ON users.UserID = items.Member_ID
WHERE Item_ID = ? AND Approve = 1");
$stmt->execute(array($itemid));
$count = $stmt->rowCount();
if($count > 0){


$item = $stmt->fetch();

    ?>
<h1 class="text-center"> <?php echo $item['Name']?></h1>
 <div class="container">
     <div class="row">
         <div class="col-md-3">
          <?php 
     
         echo "<a href='admin/uploads/avatars/" . $item['Image'] ." ' alt=' ' download>";?> <button class='btn btn-info btn-lg' >تحميل نسخة العقد</button>
         <?php echo "</a>";
         //echo "<iframe class='img-responsive img-thumbnail center-block' src='admin/uploads/avatars/" . $item['Image'] ." ' alt=' نسخة العقد' /></iframe>";
        
     
         echo "<a href='admin/uploads/avatars/" . $item['Measure'] ." ' alt=' ' download>";?> <button class='btn btn-info btn-lg' >تحميل نسخة الكيل</button>
         <?php echo "</a>";
        // echo "<iframe class='img-responsive img-thumbnail center-block' src='admin/uploads/avatars/" . $item['Measure'] ." ' alt='نسخة الكيل ' /></iframe>";
         ?>
        
        </div>
        <div class="col-md-9 item-info">
        
        <ul class="list-unstyled">
        <li><i class="fa fa-list-ol fa-fw"></i><span> رقم العقد </span>:<?php echo $item['Number']?></li>
        <li><i class="fa fa-user fa-fw"></i><span> اسم العميل </span>:<?php echo $item['Name']?></li>
        <li><i class="fa fa-mobile fa-fw"></i><span>رقم الهاتف  </span>:<?php echo $item['Description']?></li>
        <li><i class="fa fa-calendar fa-fw"></i><span>تاريخ التعاقد </span> : <?php echo $item['Add_Date']?></li>
        <li><i class="fa fa-money fa-fw"></i><span>اجمالى العقد</span>: <?php echo $item['Price']?> K.D</li>
        
        <li><i class="fa fa-map-marker fa-fw"></i><span>العنوان </span>: <?php echo $item['Country_Made']?></li>
        <li><i class="fa fa-random fa-fw"></i><span>نوع العقد</span>: <a href="categories.php?pageid=<?php echo $item['Cat_ID']?>"><?php echo $item['category_name']?></a></li>
        <li><i class="fa fa-user-plus fa-fw"></i><span> مراقب التنفيذ </span>:<a href="#"> <?php echo $item['Username']?></a></li>
        <li class="tags-items"><i class="fa fa-tags fa-fw"></i><span>العلامات</span>:
        <?php
          $allTags = explode(",", $item['Tags']);
          foreach($allTags as $tag){
              $tag = str_replace(' ','',$tag);
              $lowertag = strtolower($tag);
              if(! empty($tag)){
              echo "<a href='tags.php?name={$lowertag}'>" . $tag . ' </a>';
            }
          }
        ?>
        </ul>
        </div>
     </div>
     <hr class="custom-hr">
     <?php if (isset($_SESSION['user'])) { ?>
     <div class="row">
         <div class="col-md-offset-3">
             <div class="add-comment">
             <h2>  اضافة طلب شراء جديد </h2>
             <form action ="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['Item_ID']?>" method ="POST" >
                 <textarea name="comment" required="required"></textarea>
                 <input class="btn btn-primary" type="submit" value=" طلب شراء">
             </form>
             <?php 
             if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $comment = filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
              $itemid = $item['Item_ID'];
              $userid = $_SESSION['uid'];
              
              if(!empty($comment)){
                $stmt = $con->prepare ("INSERT INTO comments (comment , status, comment_date, item_id, user_id)
                VALUES(:zcomment,0,now(),:zitemid,:zuserid)");
                $stmt-> execute(array(
                  'zcomment' => $comment,
                  'zitemid' => $itemid,
                  'zuserid' => $userid
                  
                   ));
                   if($stmt){
                    echo "<div class = 'container'>";
                       echo "<div class = 'alert alert-success'>  تم الاضافة بنجاح </div>";
                       echo '</div>';
                   }
              }

             }
             ?>
             </div>
         </div>
      </div>
      <?php } else{
          echo '<a href="login.php">دخول</a> او <a href="login.php">تسجيل</a> لاضافة طلب شراء';
      } ?>
     <hr class="custom-hr">
     <?php
               $stmt = $con->prepare ("SELECT comments.*,users.Username AS Member FROM comments
              
               INNER JOIN users ON users.UserID = comments.user_id WHERE item_id = ?
               AND status = 1 ORDER BY c_id DESC ");
               $stmt->execute(array($item['Item_ID']));
               $comments = $stmt->fetchAll();
               
               $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
               $getUser->execute(array($sessionUser));
               $info = $getUser->fetch();
             ?>
     
         
             <?php
             
               foreach($comments as $comment){ ?>
               <div class="comment-box">
                   <div class="row">
                   <div class="col-sm-2 text-center"><img class="img-responsive img-thumbnail img-circle center-block" src="admin/uploads/avatars/<?php echo $info['avatar'] ?>" alt=" " /><?php echo $comment['Member']?> </div>
                   <div class="col-sm-10 ">
                   <p class="lead"><?php echo$comment['comment'] ?></p>  

                   </div>
                </div>
                   </div>
                   <hr class="custom-hr">
              <?php }
             ?>
        
    
  </div>
<?php
}else {
    echo '<div class="container">';
    echo '<div class="alert alert-danger">هذا الرقم لايوجد او فى انتظار الاعتماد</div>';
    echo '</div>';
}

} else {
    header('location:login.php');
    exit();
}
include $tpl . 'footer.php';
ob_end_flush();
?>
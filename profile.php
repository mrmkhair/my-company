<?php
ob_start();
session_start();


if (isset($_SESSION['user'])) {
    $pagetitle = 'الصفحة الشخصية';

include 'init.php';
    $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();

    ?>
 
               
                <h1 class="text-center"> <?php echo $pagetitle ?></h1>
 <div class="information block" >
     <div class="container">
        <div class="panel panel-primary">
                 <div class="panel-heading">  البيانات الشخصية </div>
                     <div class="panel-body">
                     <div class="row">
                     <div class="col-md-8">
                       <ul class="list-unstyled">
                        <li><i class="fa fa-user fa-fw"></i><span> اسم المستخدم </span> <?php echo $info['Username'] ?></li>
                        <li><i class="fa fa-envelope-o fa-fw"></i><span>البريد الالكترونى</span> : <?php echo $info['Email']  ?></li>
                        <li><i class="fa fa-user fa-fw"></i><span> الاسم الكامل </span>: <?php echo $info['FullName']  ?></li>
                        <li><i class="fa fa-calendar fa-fw"></i><span> الوظيفة</span> : <?php echo $info['Position']  ?></li>
                        <li><i class="fa fa-money fa-fw"></i><span> الراتب </span> <?php echo $info['Salary'] ?></li>
                        <li><i class="fa fa-mobile fa-fw"></i><span>رقم الهاتف</span> : <?php echo $info['Phone']  ?></li>
                        <li><i class="fa fa-tags fa-fw"></i><span> ملاحظات </span>: <?php echo $info['Notes']  ?></li>
                        <li><i class="fa fa-calendar fa-fw"></i><span> تاريخ التعيين</span> : <?php echo $info['Date']  ?></li>
                       
                       </ul>
                       <!-- <a href="editprofile.php" class="btn btn-default"> تعديل البيانات الشخصية</a> -->
                   </div>
                   <div class="col-md-4">
                          
                               <img class="img-responsive" src="admin/uploads/avatars/<?php echo $info['avatar'] ?>" alt=" " />
                               </div>
                   </div>
        </div>
     </div>
 </div>
 <div id="my-items" class="my-items block" >
     <div class="container">
        <div class="panel panel-primary">
                 <div class="panel-heading"> عقودي  </div>
                     <div class="panel-body">
                        
                          <?php
                          if(!empty(getItems('Member_ID',$info['UserID']))){
                              echo '<div class="row">';
                            foreach (getItems('Member_ID',$info['UserID'],1) as $item) {
                                    echo '<div class="col-sm-6 col-md-3">';
                                        echo '<div class="thumbnail item-box">';
                                        if($item['Approve'] == 0){echo '<span class="approve-status">waiting approval</span>';}
                                        echo "<a href='admin/uploads/avatars/" . $item['Image'] ." ' alt=' ' download> <button>تحميل العقد</button></a>";
            
                                       echo "<a href='admin/uploads/avatars/" . $item['Measure'] ." ' alt=' ' download> <button>تحميل الكيل</button></a>";
                                        //  echo '<span class="price-tag">$' . $item['Price'] . '</span>';
                                        //   echo '<img class="img-responsive" src="img.png" alt=" " />';
                                             echo '<div class="caption">';
                                                     echo '<h3><a href="items.php?itemid=' . $item['Item_ID'] .'">' . $item['Name'] . '</a></h3>';
                                                    // echo '<p>' . $item['Description'] . '</p>';
                                                    // echo '<div class="date">رقم العقد:' . $item['Number'] . '</div>';
                                                    // echo '<div class="date">' . $item['Add_Date'] . '</div>';
                                                    // echo '<h3><a href="items.php?itemid=' . $item['Item_ID'] .'">'. $item['Name'] .'</a></h3>';
                                                        echo '<div class="date">رقم العقد:' . $item['Number'] . '</div>';
                                                        echo '<div class="date">رقم الهاتف:' . $item['Description'] . '</div>';
                                                        echo '<div class="date">السعر:' . $item['Price'] . ' د.ك </div>';
                                                        echo '<div class="date">العنوان:' . $item['Country_Made'] . '</div>';
                                                        echo '<div class="date">العلامات:' . $item['Tags'] . '</div>';
                                                        echo '<div class="date">تاريخ التعاقد:' . $item['Add_Date'] . '</div>';
                                          echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                   
                           }
                           echo'</div>';
                        }else{
                            echo 'there is no ads to show, create <a href="newad.php"> new advertise</a>';
                        }
                           ?>
                     
                </div>
        </div>
     </div>
 </div>
 <div id="my-comments" class="my-comments block" >
     <div class="container">
        <div class="panel panel-primary">
                 <div class="panel-heading">طلبات الشراء  </div>
                     <div class="panel-body">
                     <?php
                        $stmt = $con->prepare ("SELECT comment FROM comments
                        
                        WHERE status = 1 AND user_id = ? ");
                        $stmt->execute(array($info['UserID']));
                        $comments = $stmt->fetchAll();
                        if(!empty($comments)){
                          foreach($comments as $comment){
                              echo '<p>' . $comment['comment'] . '</p>';
                          }
                        }else{
                            echo 'there is no comment to show';
                        }
                    ?>
                   </div>
        </div>
     </div>
     <div class="container">
        <div class="panel panel-primary">
                 <div class="panel-heading"> طلبات شراء لم تعتمد    </div>
                     <div class="panel-body">
                     <?php
                        $stmt = $con->prepare ("SELECT comment FROM comments
                        
                        WHERE status = 0 AND user_id = ? ");
                        $stmt->execute(array($info['UserID']));
                        $comments = $stmt->fetchAll();
                        if(!empty($comments)){
                          foreach($comments as $comment){
                              echo '<p>' . $comment['comment'] . '</p>';
                          }
                        }else{
                            echo 'لا يوجد';
                        }
                    ?>
                   </div>
        </div>
     </div>
 </div>
<?php
} else {
    header('location:login.php');
    exit();
}
include $tpl . 'footer.php';
ob_end_flush();
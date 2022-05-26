<?php
ob_start();
session_start();

if(isset($_SESSION['Username'])){
   $pagetitle =  'لوحة التحكم';
   include  'init.php';

   $numUsers = 6 ; 
   $theLatestUsers = getLatest("*","users","UserID",$numUsers);

   $numItems = 6 ; 
   $theLatestItems = getLatest("*","items","Item_ID",$numItems);

   $numComments = 6 ; 
   $theLatestComments = getLatest("*","comments","c_id",$numComments);

   $numFiles = 6 ; 
   $theLatestFiles = getLatest("*","files","id",$numFiles);

   ?>
 <div class="home-stats ">
        <div class="container text-center">
            <h1> لوحة التحكم</h1>
            <div class="row>">
                    <div class="col-md-3">
                        <div class = "stat st-members"> 
                            <i class=" fa fa-users"></i>
                       <div class="info">
                            عدد الموظفين
                             <span><a href="members.php "><?php echo countItems('UserID','users')?></a> 
                            </span>
                        </div>
                        </div>
                    </div>  
                    <div class="col-md-3">
                        <div class = "stat st-pending"> <i class=" fa fa-user-plus"></i><div class="info"> موظفين فى انتظار التفعيل
                            <span><a href="members.php?do=manage&page=pending">
                                <?php echo checkItem('RegStatus','users',0) ?></a></span></div>
                                </div>
                        </div>
                    </div>  
                    <div class="col-md-3">
                        <div class = "stat st-items ">  <i class=" fa fa-tag"></i><div class="info">عدد العقود 
                            <span><a href="items.php "><?php echo countItems('Item_ID','items')?></a></span></div>
                            </div> 
                    </div>  
                    <div class="col-md-3">
                        <div class = "stat st-comments"> <i class=" fa fa-comments"></i><div class="info">
                             عدد طلبات الشراء <span><a href="comments.php "><?php echo countItems('c_id','comments')?></a></span></div>
                              </div>     
                    </div>  
            </div>
        </div>
     
 </div>
 <div class="latest">
    <div class="container ">
        <div class="row>">
            <div class="col-md-6">
                <div class="panel panel-default">
                   
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> اخر <?php echo $numUsers ?> موظفين مسجلين
                        <span class="toggle-info pull-right">
                          <i class=" fa fa-plus fa-lg"></i>      
                        </span>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled latest-users">
                    <?php
                        if(! empty($theLatestUsers)){
                        foreach($theLatestUsers as $user){
                            echo '<li>';
                                echo $user['FullName'];
                                echo '<a href="members.php?do=edit&userid=' . $user['UserID'] .' ">';
                                    echo '<span class ="btn btn-success pull-right" >';
                                        echo '<i class="fa fa-edit"></i> edit';
                                        if($user['RegStatus']== 0){
                                            echo "<a href='members.php?do=activate&userid=" . $user['UserID'] . " 'class='btn btn-info pull-right activate '><i class='fa fa-close'></i> تفعيل </a>";
                                           }
                                    echo '</span>';
                                echo'</a>';
                            echo'</li>';
                           }
                        }else{
                        echo 'لا يوجد موظفين لعرضها';
                    }
                    ?>
                    </ul>
                </div>
            </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-tag"></i> اخر <?php echo $numItems ?> عقود
                        <span class="toggle-info pull-right">
                          <i class=" fa fa-plus fa-lg"></i>      
                        </span>
                    </div>
                    <div class="panel-body">
                    <ul class="list-unstyled latest-users">
                    <?php
                        if(! empty($theLatestItems)){
                        foreach($theLatestItems as $item){
                            echo '<li>';
                                echo $item['Name'];
                                echo '<a href="items.php?do=edit&itemid=' . $item['Item_ID'] .' ">';
                                    echo '<span class ="btn btn-success pull-right" >';
                                        echo '<i class="fa fa-edit"></i> edit';
                                        if($item['Approve']== 0){
                                            echo "<a href='items.php?do=approve&itemid=" . $item['Item_ID'] . " 'class='btn btn-info pull-right activate '><i class='fa fa-check'></i> اعتماد </a>";
                                           }
                                    echo '</span>';
                                echo'</a>';
                            echo'</li>';
                        }
                    }else{
                    echo 'لا يوجد عقود لعرضها';
                }
                ?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
        <div class="row>">
            <div class="col-md-6">
                <div class="panel panel-default">
                   
                    <div class="panel-heading">
                        <i class="fa fa-comments-o"></i> اخر <?php echo $numComments ?> طلبات شراء
                        <span class="toggle-info pull-right">
                          <i class=" fa fa-plus fa-lg"></i>      
                        </span>
                    </div>
                    <div class="panel-body">
                    <?php
                        $stmt = $con->prepare ("SELECT comments.*,users.Username AS member FROM comments
                        
                        INNER JOIN users ON users.UserID = comments.user_id 
                        ORDER BY c_id DESC LIMIT $numComments ");
                        $stmt->execute();
                        $comments = $stmt->fetchAll();
                        if (! empty($comments)){
                        foreach($comments as $comment){
                            echo '<div class="comment-box">';
                              echo '<span class ="member-n">' . $comment['member'] . '</span>';
                              echo '<p class ="member-c">' . $comment['comment'] . '</p>';
                            echo '</div>';
                        }
                        }else{
                       
                              echo 'لا يوجد طلبات شراء لعرضها';
                            echo '</div>';
                         
                        }
                      ?>
                            
                       
                </div>
            </div>
            </div>
            
        </div>
        <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-tag"></i> اخر <?php echo $numFiles ?> مستندات
                        <span class="toggle-info pull-right">
                          <i class=" fa fa-plus fa-lg"></i>      
                        </span>
                    </div>
                    <div class="panel-body">
                    <ul class="list-unstyled latest-users">
                    <?php
                        if(! empty($theLatestFiles)){
                        foreach($theLatestFiles as $file){
                            echo '<li>';
                                echo $file['name'];
                                echo '<a href="archives.php?do=edit&fileid=' . $file['id'] .' ">';
                                    echo '<span class ="btn btn-success pull-right" >';
                                        echo '<i class="fa fa-edit"></i> edit';
                                        
                                    echo '</span>';
                                echo'</a>';
                            echo'</li>';
                        }
                    }else{
                    echo 'لا يوجد عقود لعرضها';
                }
                ?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
    
 </div>   

  <?php
    include $tpl . 'footer.php';
}else{
    header('location: index.php');
    exit();
   
}
ob_end_flush();
?>
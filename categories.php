<?php
session_start();
$pagetitle = 'انواع العقود';

 if(isset($_SESSION['user'])){
  include 'init.php';
 ?>

<div class="container">
  <h1 class="text-center">عرض العقود</h1>
  <div class="row">
      <?php
      if (isset($_GET['pageid']) && is_numeric($_GET['pageid'])){
       $category = intval($_GET['pageid']);
      
         $allItems =  getAllFrom2("*" , "items" , "Item_ID" , "where Cat_ID = {$category}", "AND Approve = 1");
          foreach ($allItems as $item){
            echo '<div class="col-sm-6 col-md-3">';
               echo '<div class="thumbnail item-box">';
               
               echo "<a href='admin/uploads/avatars/" . $item['Image'] ." ' alt=' ' download> <button>تحميل العقد</button></a>";
               //echo "<iframe src='admin/uploads/avatars/" . $item['Image'] ." ' alt=' ' /></iframe>";
               echo "<a href='admin/uploads/avatars/" . $item['Measure'] ." ' alt=' ' download> <button>تحميل الكيل</button></a>";
              // echo "<iframe src='admin/uploads/avatars/" . $item['Measure'] ." ' alt=' ' /></iframe>";
                  
                  echo '<div class="caption">';
                    echo '<h3><a href="items.php?itemid=' . $item['Item_ID'] .'">'. $item['Name'] .'</a></h3>';
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
          }else{
           echo 'you must add page id';          
        }
        ?>
  </div>
 </div>
 <?php
} else {
    header('location:login.php');
    exit();
}
 include $tpl . 'footer.php'; ?>
 
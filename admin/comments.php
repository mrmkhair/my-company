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
$pagetitle = 'طلبات الشراء';
if (isset($_SESSION['Username'])){
include 'init.php';
$do = isset($_GET['do'])? $_GET['do'] : 'manage';

if ($do == 'manage'){
 
  $stmt = $con->prepare ("SELECT comments.*,items.Country_Made AS address,users.FullName AS member FROM comments
  INNER JOIN items ON items.Item_ID = comments.item_id
  INNER JOIN users ON users.UserID = comments.user_id
  ORDER BY c_id DESC ");
  $stmt->execute();
  $comments = $stmt->fetchAll();
  if (! empty($comments)){

  ?>
    <h1 class="text-center"> ادارة طلبات الشراء </h1>
      
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

          <table id="myTable"  class="main-table text-center table table-bordered">
          <tr class="header">
             <td> الرقم </td>
             <td> طلب الشراء </td>
             <td> عنوان القسيمة  </td>
             <td> اسم المستخدم </td>
             <td> تاريخ الاضافة </td>
             <td> التحكم </td>
          </tr> 
          <?php 
          foreach($comments as $comment){
           echo"<tr>";
           echo"<td style='display:none'>" . $comment['c_id'] .$comment['comment'] . $comment['address'] . $comment['member'] . $comment['comment_date']  ."</td>";
              echo"<td>" . $comment['c_id'] ."</td>";
              echo"<td>" . $comment['comment'] ."</td>";
              echo"<td>" . $comment['address'] ."</td>";
              echo"<td>" . $comment['member'] ."</td>";
              echo"<td>" . $comment['comment_date'] ."</td>";
              echo "<td> <a href='comments.php?do=edit&comid=" . $comment['c_id'] . " 'class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
                         <a href='comments.php?do=delete&comid=" . $comment['c_id'] . " 'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>";
                        if($comment['status']== 0){
                         echo "<a href='comments.php?do=approve&comid=" . $comment['c_id'] . " 'class='btn btn-info activate '><i class='fa fa-check'></i> اعتماد </a>";
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
    
      <?php
         }else{
          echo '<div class="container">';
             echo '<div class="nice-message">';
               echo 'لا يوجد طلبات شراء لعرضها';
              
             echo '</div>';
          echo '</div>';
      }
       ?> 
<?php


}elseif ($do == 'edit'){ 
  $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']):0;
  $stmt = $con->prepare("SELECT  * FROM comments WHERE c_id = ? limit 1");
  $stmt->execute(array($comid));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();

  if ($count > 0){ ?>

      <h1 class="text-center">تعديل طلب شراء</h1>
      
        <form class="form-horizontal" action ="?do=update" method ="POST" >
          <input type = "hidden" name = "comid" value = "<?php echo $comid ?>" />
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">comment:</label>
            <div class="col-sm-10 col-md-6">
               <textarea class="form-control" name="comment" required="required"><?php echo $row['comment']?>
            </textarea>
            
            </div>
          </div>
          
          <div class="form-group form-group-lg">
                  <div class ="col-sm-offset-2 col-sm-10">
                    <input class="btn btn-primary btn-lg" type="submit" value="save" />
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
            echo "<h1 class ='text-center'>تحديث طلب شراء</h1>";
            echo "<div class='container'> ";
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

              $comid = $_POST['comid'];
              
              $comment = $_POST['comment'];
              
              $stmt = $con->prepare ("UPDATE comments SET comment = ? WHERE c_id =?");
              $stmt-> execute(array($comment, $comid));
              $theMsg= "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم التحديث</div>';
              redirectHome($theMsg,'back');
              
            }else {
              $theMsg='<div class="alert alert-danger"> لا يمكن تصفح هذه الصفحة مباشرا</div>';
              redirectHome($theMsg);
            }
            echo "</div>";

          }elseif ($do =='delete'){
            echo "<h1 class ='text-center'>حذف طلب شراء</h1> ";
            echo "<div class='container'> ";
            $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']):0;
            
            $check = checkItem('c_id','comments',$comid);
          
            if ($check > 0){ 
              $stmt = $con->prepare("DELETE FROM comments WHERE c_id = :zid ");
              $stmt->bindParam(":zid" , $comid);
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
        }elseif ($do == 'approve'){
          echo "<h1 class ='text-center'>اعتماد طلب شراء</h1> ";
          echo "<div class='container'> ";
          $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']):0;
          
          $check = checkItem('c_id','comments',$comid);
        
          if ($check > 0){ 
            $stmt = $con->prepare("UPDATE  comments SET status = 1  WHERE c_id = ? ");
            
            $stmt->execute(array($comid));

            echo "<div class = 'container'>";
            $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم الاعتماد</div>';
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
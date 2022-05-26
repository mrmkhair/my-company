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
$pagetitle = 'العقود';
if (isset($_SESSION['Username'])){
include 'init.php';
$do = isset($_GET['do'])? $_GET['do'] : 'manage';

if ($do == 'manage'){

    
   $stmt = $con->prepare ("SELECT items.*,categories.Name AS category_name,users.FullName FROM items
                          INNER JOIN categories ON categories.ID = items.Cat_ID
                          INNER JOIN users ON users.UserID = items.Member_ID ORDER BY Item_ID DESC ");
   $stmt->execute();
   $items = $stmt->fetchAll();
 
   if (! empty($items)){
   ?>
      <h1 class="text-center">  البحث والتعديل </h1>
       
       <div class="table-responsive">
     
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

            <table id="myTable"  class="main-table text-center table table-bordered">
            <tr class="header">
            <td> الرقم </td>
            <td> رقم العقد </td>
            <td> اسم العميل </td>
            <td>  الهاتف </td>
            <td> السعر </td>
            <td> العنوان </td>
            <td> تاريخ التعاقد </td>
            <td>نوع العقد </td>
            <td> الموظف </td>
           
            <td> دفعة1 </td>
            <td> دفعة2  </td>
            <td> دفعة3  </td>
            <td>  معاينة </td>
            <td> بودرة الجور </td>
            <td> بودرة السرداب </td>
            <td>  حوائط خارجية </td>
            <td>حوائط داخلية  </td>
            <td> ارضيات وجور </td>
            <td>  فوم اسطح </td>
            <td> فوم حمامات  </td>
            <td> بوليوريثين </td>
            <td> مساح حمامات  </td>
            <td> دهان سطح  </td>
            <td>  دهان حمامات </td>
            <td> طربال حمامات </td>
            <td> فحص سطح </td>
            <td>  فحص حمامات </td>
            <td> فلتر واوتار </td>
            <td>  مساح حماية </td>
            <td> سكريد </td>
            <td>  تنعيم وشربتة </td>
            <td>  نعلات </td>
            <td> تشققات </td>
            <td>  ملاحظات </td>
            <td> نسخة العقد </td>
            <td> نسخة الكيل </td>
            <td> التحكم </td>
         </tr> 
         <?php 
         foreach($items as $item){
          echo"<tr>";
          
          echo"<td style='display:none'>" . $item['Item_ID'] .$item['Item_ID'] . $item['Name'] . $item['Description'] . 
          $item['Price'] . $item['Country_Made'] .  $item['Add_Date'] . $item['category_name'] . $item['FullName'] .
           $item['pay1'] . $item['pay2'] . $item['pay3'] .$item['start'] .
          $item['pstage1'] . $item['pstage2'] . $item['pstage3'] . $item['pstage4'] . $item['pstage5'] .
          $item['plot1'] .$item['plot2'] .$item['plot3'] .$item['plot4'] .$item['plot5'] .
          $item['plot6'] .$item['plot7'] .$item['plot8'] .$item['plot9'] .$item['plot10'] .
          $item['plot11'] .$item['plot12'] .$item['plot13'] .$item['plot14'] .$item['plot15'] .
          $item['notes'] . "</td>";

             echo"<td>" . $item['Item_ID'] ."</td>";
             echo"<td>" . $item['Number'] ."</td>";
             echo"<td>" . $item['Name'] ."</td>";
             echo"<td>" . $item['Description'] ."</td>";
             echo"<td>" . $item['Price'] .' K.D'."</td>";
             echo"<td>" . $item['Country_Made'] ."</td>";
             echo"<td>" . $item['Add_Date'] ."</td>";
             echo"<td>" . $item['category_name'] ."</td>";
             echo"<td>" . $item['FullName'] ."</td>";
       
              echo"<td>" . $item['pay1'] ."</td>";
              echo"<td>" . $item['pay2'] ."</td>";
              echo"<td>" . $item['pay3'] ."</td>";
              echo"<td>" . $item['start'] ."</td>";
              echo"<td>" . $item['pstage1'] ."</td>";
              echo"<td>" . $item['pstage2'] ."</td>";
              echo"<td>" . $item['pstage3'] ."</td>";
              echo"<td>" . $item['pstage4'] ."</td>";
              echo"<td>" . $item['pstage5'] ."</td>";
              echo"<td>" . $item['plot1'] ."</td>";
              echo"<td>" . $item['plot2'] ."</td>";
              echo"<td>" . $item['plot3'] ."</td>";
              echo"<td>" . $item['plot4'] ."</td>";
              echo"<td>" . $item['plot5'] ."</td>";
              echo"<td>" . $item['plot6'] ."</td>";
              echo"<td>" . $item['plot7'] ."</td>";
              echo"<td>" . $item['plot8'] ."</td>";
              echo"<td>" . $item['plot9'] ."</td>";
              echo"<td>" . $item['plot10'] ."</td>";
              echo"<td>" . $item['plot11'] ."</td>";
              echo"<td>" . $item['plot12'] ."</td>";
              echo"<td>" . $item['plot13'] ."</td>";
              echo"<td>" . $item['plot14'] ."</td>";
              echo"<td>" . $item['plot15'] ."</td>";
              echo"<td>" . $item['notes'] ."</td>";
              echo"<td>";
            
              if(empty( $item['Image'])){
               echo 'لا يوجد';
              }else{
               echo "<a href='uploads/avatars/" . $item['Image'] ." ' alt=' ' download> <button>تحميل</button></a>";
              }
              echo "</td>";
              echo"<td>";
            
              if(empty( $item['Measure'])){
               echo 'لا يوجد';
            }else{
             echo "<a href='uploads/avatars/" . $item['Measure'] ." ' alt=' ' download> <button>تحميل</button></a>";
            }
               echo "</td>";
              echo "<td> <a href='itemsf.php?do=edit&itemid=" . $item['Item_ID'] . " 'class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>";
              
    echo "</td>";
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
               echo 'لا يوجد عقود لعرضها';
            
             echo '</div>';
          echo '</div>';
      }
       ?>
 <?php

    
} elseif ($do == 'edit'){ 

  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;
  $stmt = $con->prepare("SELECT  * FROM items WHERE Item_ID = ? ");
  $stmt->execute(array($itemid));
  $item = $stmt->fetch();
  $count = $stmt->rowCount();

  if ($count > 0){ ?>

<h1 class="text-center">تعديل عقد</h1>
      <div class="container">
        <form class="form-horizontal" action ="?do=update" method ="POST" enctype="multipart/form-data">
          <input type = "hidden" name = "itemid" value = "<?php echo $itemid ?>" />

          <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> رقم العقد:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="number" class="form-control" required ="required" placeholder=" رقم العقد " 
                  value=" <?php echo $item['Number'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">اسم العميل:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="name" class="form-control" required ="required" placeholder=" اسم المتعاقد" 
                  value=" <?php echo $item['Name'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">رقم الهاتف:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="description" class="form-control" required ="required" placeholder=" رقم الهاتف" 
                value=" <?php echo $item['Description'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">السعر:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="price" class="form-control" required ="required" placeholder=" سعر العقد" 
                value=" <?php echo $item['Price'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">تاريخ التعاقد:</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="date" class="form-control"  value="<?php echo $item['Add_Date']?>" required ="required" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">عنوان العقد:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="country" class="form-control" required ="required" placeholder="عنوان العقد"
                value=" <?php echo $item['Country_Made'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">الحالة:</label>
               <div class="col-sm-10 col-md-6">
                  <select name="status" >
                     
                     <option value="1" <?php if ($item['Status'] == 1){echo 'selected';}?> >جديد</option>
                     <option value="2" <?php if ($item['Status'] == 2){echo 'selected';}?> > اضافة</option>
                     <option value="3" <?php if ($item['Status'] == 3){echo 'selected';}?> >امر عمل</option>
                     <option value="4" <?php if ($item['Status'] == 4){echo 'selected';}?> > صيانة </option>
                  </select>
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">الموظف:</label>
               <div class="col-sm-10 col-md-6">
                  <select class="form-control" name="member" >
                     <option value="0">...</option>
                    <?php 
                    $stmt = $con->prepare("SELECT * FROM users");
                    $stmt->execute();
                    $users = $stmt->fetchAll();
                    foreach($users as $user){
                       echo "<option value='" . $user['UserID'] . "'"; 
                        if ($item['Member_ID'] == $user['UserID']){echo 'selected';} 
                        echo ">" . $user['Username'] ."</option>";
                    }
                    ?>
                  </select>
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">نوع العقد:</label>
               <div class="col-sm-10 col-md-6">
                  <select class="form-control" name="category" >
                     
                    <?php 
                    $stmt2 = $con->prepare("SELECT * FROM categories");
                    $stmt2->execute();
                    $cats = $stmt2->fetchAll();
                    foreach($cats as $cat){
                       echo "<option value='" . $cat['ID'] . "'";
                       if ($item['Cat_ID'] == $cat['ID']){echo 'selected';} 
                      echo ">" . $cat['Name'] ."</option>";
                    }
                    ?>
                  </select>
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">العلامات:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="tags" class="form-control" placeholder="separate tags with comma (,)"  value=" <?php echo $item['Tags'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> نسخة العقد:</label>
               <div class="col-sm-10 col-md-6">
                <input  type="hidden" name="oldImage" value="<?php echo $item['Image']?>" />
                <input  type="file" name="Image" class="form-control" />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> نسخة الكيل:</label>
               <div class="col-sm-10 col-md-6">
                <input type="hidden" name="oldMeasure" value=" <?php echo $item['Measure'] ?>" />
                <input type="file" name="Measure" class="form-control"  />
               </div>
             </div>
             <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">الدفعة الاولى:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="pay1" class="form-control" 
                value=" <?php echo $item['pay1'] ?>" />
               </div>
               </div>
               <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">الدفعة الثانية:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="pay2" class="form-control"   
                value=" <?php echo $item['pay2'] ?>" />
               </div>
              </div>

               <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">الدفعة الثالثة:</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="pay3" class="form-control"  
                value=" <?php echo $item['pay3'] ?>" />
               </div>
               </div>
               <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> معاينة:</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="start" class="form-control"  value="<?php echo $item['start']?>" />
               </div>
                  </div>
                  <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> رشة نظافة الجور:</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="pstage1" class="form-control"  value="<?php echo $item['pstage1']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> رشة نظافة السرداب:</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="pstage2" class="form-control"  value="<?php echo $item['pstage2']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">  عزل حوائط خارجية:</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="pstage3" class="form-control"  value="<?php echo $item['pstage3']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">  عزل حوائط داخلية:</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="pstage4" class="form-control"  value="<?php echo $item['pstage4']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> عزل ارضيات وجور :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="pstage5" class="form-control"  value="<?php echo $item['pstage5']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2">  صب فوم اسطح :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot1" class="form-control"  value="<?php echo $item['plot1']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> صب فوم حمامات :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot2" class="form-control"  value="<?php echo $item['plot2']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> رش بوليوريثين :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot3" class="form-control"  value="<?php echo $item['plot3']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> مساح حمامات :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot4" class="form-control"  value="<?php echo $item['plot4']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> دهان سطح :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot5" class="form-control"  value="<?php echo $item['plot5']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> دهان حمامات :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot6" class="form-control"  value="<?php echo $item['plot6']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> تركيب طربال حمامات :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot7" class="form-control"  value="<?php echo $item['plot7']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> فحص السطح :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot8" class="form-control"  value="<?php echo $item['plot8']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> فحص حمامات :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot9" class="form-control"  value="<?php echo $item['plot9']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> فلتر واوتار :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot10" class="form-control"  value="<?php echo $item['plot10']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> مساح حمامات حماية :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot11" class="form-control"  value="<?php echo $item['plot11']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> صب سكريد :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot12" class="form-control"  value="<?php echo $item['plot12']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> تنعيم وشربتة :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot13" class="form-control"  value="<?php echo $item['plot13']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> تركيب نعلات :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot14" class="form-control"  value="<?php echo $item['plot14']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> صيانة تشققات :</label>
               <div class="col-sm-10 col-md-6">
                <input  type="date" name="plot15" class="form-control"  value="<?php echo $item['plot15']?>" />
               </div>
                </div>
                <div class="form-group form-group-lg">
               <label class="control-label col-sm-2"> الملاحظات :</label>
               <div class="col-sm-10 col-md-6">
                <input type="text" name="notes" class="form-control"  value=" <?php echo $item['notes'] ?>" />
               </div>
             </div>
             <div class="form-group form-group-lg">
                     <div class ="col-sm-offset-2 col-sm-10">
                       <input class="btn btn-primary btn-sm" type="submit" value=" تحديث عقد" />
                     </div>
             </div>
           </form>
           <?php
  $stmt = $con->prepare ("SELECT comments.*,users.FullName AS member FROM comments
  
  INNER JOIN users ON users.UserID = comments.user_id 
  WHERE item_id = ? ");
  $stmt->execute(array($itemid));
  $rows = $stmt->fetchAll();
 if(!empty($rows)){
  ?>
    <h1 class="text-center"> ادارة [<?php echo $item['Name'] ?>]طلبات شراء </h1>
     
        <div class="table-responsive">

          <table class="main-table text-center table table-bordered">
           <tr>
            
             <td> طلب الشراء </td>
             
             <td> المستخدم </td>
             <td> تاريخ الاضافة </td>
             <td> التحكم </td>
          </tr> 
          <?php 
          foreach($rows as $row){
           echo"<tr>";
              
              echo"<td>" . $row['comment'] ."</td>";
             
              echo"<td>" . $row['member'] ."</td>";
              echo"<td>" . $row['comment_date'] ."</td>";
              echo "<td> <a href='comments.php?do=edit&comid=" . $row['c_id'] . " 'class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
                         <a href='comments.php?do=delete&comid=" . $row['c_id'] . " 'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>";
                        if($row['status']== 0){
                         echo "<a href='comments.php?do=approve&comid=" . $row['c_id'] . " 'class='btn btn-info activate '><i class='fa fa-check'></i> اعتماد </a>";
                        }
               echo "</td>";
           echo"</tr>";
          }
        
          ?>
          </table>
        </div>
            <?php } ?> 
         </div>
   
          
            <?php
             } else {
              echo "<div class = 'container'>";
              $theMsg='<div class="alert alert-danger"> لا يوجد هذا الطلب</div>';
              redirectHome($theMsg);
              echo "</div>";
              
            } 

}elseif ($do =='update'){
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "<h1 class ='text-center'>تحديث عقد</h1> ";
    echo "<div class='container'> ";

    

    $id = $_POST['itemid'];
    $number = $_POST['number'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $country = $_POST['country'];
    $status = $_POST['status'];
    $cat = $_POST['category'];
    $member = $_POST['member'];
    $tags = $_POST['tags'];
    $pay1 = $_POST['pay1'];
    $pay2 = $_POST['pay2'];
    $pay3 = $_POST['pay3'];
    $start = $_POST['start'];
    $pstage1 = $_POST['pstage1'];
    $pstage2 = $_POST['pstage2'];
    $pstage3 = $_POST['pstage3'];
    $pstage4 = $_POST['pstage4'];
    $pstage5 = $_POST['pstage5'];
    $plot1 = $_POST['plot1'];
    $plot2 = $_POST['plot2'];
    $plot3 = $_POST['plot3'];
    $plot4 = $_POST['plot4'];
    $plot5 = $_POST['plot5'];
    $plot6 = $_POST['plot6'];
    $plot7 = $_POST['plot7'];
    $plot8 = $_POST['plot8'];
    $plot9 = $_POST['plot9'];
    $plot10 = $_POST['plot10'];
    $plot11 = $_POST['plot11'];
    $plot12 = $_POST['plot12'];
    $plot13 = $_POST['plot13'];
    $plot14 = $_POST['plot14'];
    $plot15 = $_POST['plot15'];
    $notes = $_POST['notes'];

    $Image=$_FILES['Image']['name'];
    if($Image== NULL){
        $Image=$_POST['oldImage'];
    }else{
      unlink("uploads/avatars/".$_POST['oldImage']);
     $wattachmenttmp=$_FILES['Image']['tmp_name'];
     $upload_file='uploads/avatars/';
     move_uploaded_file($wattachmenttmp,$upload_file.$Image);
    }

    $Measure=$_FILES['Measure']['name'];
    if($Measure== NULL){
        $Measure=$_POST['oldMeasure'];
    }else{
      unlink("uploads/avatars/".$_POST['oldMeasure']);
     $wattachmenttmp=$_FILES['Measure']['tmp_name'];
     $upload_file='uploads/avatars/';
     move_uploaded_file($wattachmenttmp,$upload_file.$Measure);
    }

    $formErrors = array();
   
    if(empty($number)) {
      $formErrors[] = ' رقم العقد لايمكن ان يكون <strong> فارغ</strong> ';
    }
          
    if(empty($name)) {
      $formErrors[] = ' الاسم لايمكن ان يكون <strong> فارغ</strong> ';
    }

    if(empty($desc)) {
      $formErrors[] = ' الهاتف لايمكن ان يكون <strong> فارغ</strong> ';
    }

    if(empty ($price)) {
      $formErrors[] = 'السعر لا يمن ان يكون <strong> فارغ </strong> ';
    }

    if(empty ($date)) {
      $formErrors[] = 'تاريخ التعاقد لا يمن ان يكون <strong> فارغ </strong> ';
    }

    if(empty ($country)) {
      $formErrors[] = 'العنوان لا يمكن ان يكون <strong> فارغ </strong> ';
    }
    if($status === 0) {
       $formErrors[] = 'يجب ان تختار <strong> الحالة </strong> ';
     }
     if($member === 0) {
       $formErrors[] = 'يجب ان تختار <strong> الموظف </strong> ';
     }
     if($cat === 0) {
       $formErrors[] = 'يجب ان تختار <strong> النوع </strong> ';
     }
    foreach( $formErrors as $error){
      echo '<div class = "alert alert-danger " >' . $error ;
    }
    if(empty($formErrors)){

    
    $stmt = $con->prepare ("UPDATE items SET Number = ? ,Name = ?, Description = ?, Price = ?,  Add_Date = ?, Country_Made = ?, Status = ?, Cat_ID = ? , 
    Member_ID = ? , Tags = ? , Image = ? , Measure = ? , pay1 = ? ,pay2 = ?, pay3 = ?, start = ?,  pstage1 = ?, pstage2 = ?, pstage3 = ?, pstage4 = ? , pstage5 = ? ,
     plot1 = ?, plot2 = ?, plot3 = ?, plot4 = ? , plot5 = ? ,  plot6 = ?, plot7 = ?, plot8 = ?, plot9 = ? , plot10 = ? ,
     plot11 = ?, plot12 = ?, plot13 = ?, plot14 = ? , plot15 = ? , notes = ? WHERE Item_ID =? ");
    $stmt-> execute(array($number, $name, $desc, $price, $date, $country, $status, $cat, $member, $tags, $Image, $Measure,$pay1, $pay2, $pay3, $start,
     $pstage1, $pstage2, $pstage3, $pstage4, $pstage5, $plot1, $plot2, $plot3, $plot4, $plot5,
    $plot6, $plot7, $plot8, $plot9, $plot10,$plot11, $plot12, $plot13, $plot14, $plot15, $notes, $id));
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
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;
  
  $check = checkItem('Item_ID','items',$itemid);

  if ($check > 0){ 
    $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zid ");
    $stmt->bindParam(":zid" , $itemid);
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

           
 }elseif ($do == 'approve'){
  echo "<h1 class ='text-center'> اعتماد عقد</h1> ";
  echo "<div class='container'> ";
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;
  
  $check = checkItem('Item_ID','items',$itemid);

  if ($check > 0){ 
    $stmt = $con->prepare("UPDATE  items SET Approve = 1  WHERE Item_ID = ? ");
    
    $stmt->execute(array($itemid));

    echo "<div class = 'container'>";
    $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم الاعتماد </div>';
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

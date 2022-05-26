<?php
ob_start();
session_start();
$pagetitle = 'انواع العقود';
if (isset($_SESSION['Username'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

    if ($do == 'manage') {
        $sort ="ASC";
        $sort_array=array('ASC','DESC');
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){
           $sort = $_GET['sort'];

        }

      $stmt2 = $con->prepare("SELECT  * FROM categories WHERE parent = 0 ORDER BY Ordering  $sort ");
      $stmt2->execute();
      $cats = $stmt2->fetchAll(); 
      if (! empty($cats)){
      ?>
      <h1 class="text-center">ادارة انواع العقود</h1>
      <div class="container categories">
          <div class="panel panel-default">
                    <div class="panel-heading"> <i class="fa fa-edit"></i>ادارة انواع العقود
                       <div class="option pull-right">
                         <i class="fa fa-sort"></i> الترتيب:
                          [<a class="<?php if ($sort == 'ASC'){echo 'active';} ?>" href="?sort=ASC">تصاعدى</a>
                          <a class="<?php if ($sort == 'DESC'){echo 'active';} ?>" href="?sort=DESC">تنازلى</a>]
                          <i class="fa fa-eye"></i> الرؤية:
                         [ <span class="active" data-view="full"> كامل</span>|
                          <span data-view="classic"> كلاسيك</span>]
                       </div>
                    </div>
                       <div class="panel-body">
                          <?php
                          foreach($cats as $cat){
                             echo "<div class='cat'>";
                             echo "<div class='hidden-buttons'>";
                               echo "<a href='categories.php?do=edit&catid=" . $cat['ID'] . " 'class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> تعديل </a>";
                               echo "<a href='categories.php?do=delete&catid=" . $cat['ID'] . " 'class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i> حذف </a>";
                             echo  "</div>";
                             echo "<h3>" . $cat['Name'] . '</h3>';
                             echo  "<div class='full-view'>";
                               echo "<p>"; if ($cat['Description'] == '') {echo 'لا يوجد وصف لهذا النوع '; } else { echo $cat['Description'] ;}echo "</p>";
                            
                               if($cat['Visibility'] == 1 ){echo'<span class="visibility cat-span"><i class="fa fa-eye"></i>مخفى </span>';}
                               if($cat['Allow_Comment'] == 1 ){echo'<span class="commenting cat-span"> <i class="fa fa-close"></i>معطل الطلبات </span>';}
                              //  if($cat['Allow_Ads'] == 1 ){echo'<span class="advertises cat-span"><i class="fa fa-close"></i> معطل الاعلانات </span>';}
                               echo  "</div>";

                               $childCats = getAllFrom("*" , "categories" , "where parent = {$cat['ID']}", "","ID", "ASC");
                               if(! empty($childCats)){
                               echo "<h4 class='child-head'>انواع تابعة</h4>";
                               echo "<ul class='list-unstyled child-cats'>";
                               foreach ($childCats as $c){
                                   echo "<li class='child-link'><a href='categories.php?do=edit&catid=" . $c['ID'] . "'>" . $c['Name'] . "</a>

                                   <a href='categories.php?do=delete&catid=" . $c['ID'] . " 'class='show-delete confirm'> حذف </a>
                                   </li>";
                               }
                               echo "</ul>";
  
                              }
                             echo  "</div>";
                          
                            echo  "<hr>";
                          }
                          
                          ?>
                       </div>    
          </div>
          <a  class="add-category btn btn-primary" href="categories.php?do=add"><i class="fa fa-plus"></i> اضافة نوع عقد </a>
      </div>
      <?php
         }else{
          echo '<div class="container">';
             echo '<div class="nice-message">';
               echo 'لا يوجد انواع لعرضها';
               echo '<a href="categories.php?do=add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> نوع جديد</a>';
             echo '</div>';
          echo '</div>';
      }
       ?>

<?php
  
} elseif ($do == 'add') {

        ?>

<h1 class="text-center">اضافة نوع جديد </h1>
      <div class="container">
        <form class="form-horizontal" action ="?do=insert" method ="POST" >

          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الاسم:</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="name" class="form-control" required ="required" placeholder=" اسم نوع العقد"  />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الوصف:</label>
            <div class="col-sm-10 col-md-6">

            <input type="text" name="description" class="form-control"  placeholder =" وصف نوع العقد "  />

            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الترتيب:</label>
            <div class="col-sm-10 col-md-6">
              <input  type="text" name="ordering" class="form-control"  placeholder="ترتيب نوع العقد"  />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> النوع الاساسي ?:</label>
            <div class="col-sm-10 col-md-6">
              <select name="parent">
              <option value="0"> لا يوجد</option>
              <?php
              $allCats = getAllFrom("*", "categories" , "where parent = 0"," ", "ID", "ASC");
              foreach($allCats as $cat){
                echo "<option value='" . $cat['ID'] ."'>" . $cat['Name'] . "</option>";
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الرؤية:</label>
            <div class="col-sm-10 col-md-6">
               <div>
                 <input id="vis-yes" type="radio" name="visibility" value ="0" checked />
                   <lable for="vis-yes">نعم </lable>
               </div>
               <div>
                 <input id="vis-no" type="radio" name="visibility" value ="1"  />
                   <lable for="vis-no">لا </lable>
                 </div>
             </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">طلبات الشراء:</label>
            <div class="col-sm-10 col-md-6">
               <div>
                 <input id="com-yes" type="radio" name="commenting" value ="0" checked />
                   <lable for="com-yes">نعم </lable>
               </div>
               <div>
                 <input id="com-no" type="radio" name="commenting" value ="1" />
                   <lable for="com-no">لا </lable>
                   </div>
            </div>
          </div>
          <!-- <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الاعلان:</label>
            <div class="col-sm-10 col-md-6">
               <div>
                 <input id="ads-yes" type="radio" name="ads" value ="0"  checked />
                   <lable for="ads-yes">نعم </lable>
               </div>
               <div>
                 <input id="ads-no" type="radio" name="ads" value ="1" />
                   <lable for="ads-no">لا </lable>
               </div>
            </div>
          </div> -->
          <div class="form-group form-group-lg">
                  <div class ="col-sm-offset-2 col-sm-10">
                    <input class="btn btn-primary btn-lg" type="submit" value=" اضافة نوع" />
                  </div>
          </div>
        </form>
      </div>


<?php

    } elseif ($do == 'insert') {

      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
         echo "<h1 class ='text-center'>ادخال نوع جديد</h1> ";
         echo "<div class='container'> ";
         
         $name   = $_POST['name'];
         $desc   = $_POST['description'];
         $parent   = $_POST['parent'];
         $order  = $_POST['ordering'];
         $visible = $_POST['visibility'];
         $comment = $_POST['commenting'];
         $ads     = $_POST['ads'];
         
                 
           $check = checkItem("Name","categories",$name);
           if ($check==1){
             $theMsg= '<div class = "alert alert-danger " >لا يوجد هذا النوع</div>';
             redirectHome($theMsg,'back');
           }else{
          $stmt = $con->prepare ("INSERT INTO categories (Name , Description, Parent, Ordering, Visibility, Allow_Comment, Allow_Ads)
          VALUES(:zname,:zdesc,:zparent,:zorder,:zvisible,:zcomment,:zads)");
          $stmt-> execute(array(
            'zname'    => $name,
            'zdesc'    => $desc,
            'zparent'  => $parent,
            'zorder'   => $order,
            'zvisible' => $visible ,
            'zcomment' => $comment,
            'zads'     => $ads,

         ));

           $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم الادخال</div>';
         redirectHome($theMsg,'back');
         }
       }else {
         echo "<div class = 'container'>";
         $theMsg='<div class="alert alert-danger"> لا يمكن تصفح هذه الصفحة مباشرا</div>';
         redirectHome($theMsg,'back');
         echo "</div>";
       }
       echo "</div>";
         

    } elseif ($do == 'edit') {
      $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']):0;
      $stmt = $con->prepare("SELECT  * FROM categories WHERE ID = ? ");
      $stmt->execute(array($catid));
      $cat = $stmt->fetch();
      $count = $stmt->rowCount();
    
      if ($count > 0){ ?>
      <h1 class="text-center">تعديل نوع العقد </h1>
      <div class="container">
        <form class="form-horizontal" action ="?do=update" method ="POST" >
        <input type = "hidden" name = "catid" value = "<?php echo $catid ?>" />
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الاسم:</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="name" class="form-control" required ="required"  autocomplete="off" placeholder=" نوع العقد"value="<?php echo $cat['Name']?>" />
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الوصف:</label>
            <div class="col-sm-10 col-md-6">

            <input type="text" name="description" class="form-control"  placeholder =" وصف العقد " value="<?php echo $cat['Description']?>"/>

            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الترتيب:</label>
            <div class="col-sm-10 col-md-6">
              <input  type="text" name="ordering" class="form-control"  placeholder="ترتيب نوع العقد"  value="<?php echo $cat['Ordering']?>"/>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2"> النوع الاساسى ?:</label>
            <div class="col-sm-10 col-md-6">
              <select name="parent">
              <option value="0"> لا يوجد</option>
              <?php
              $allCats = getAllFrom("*", "categories" , "where parent = 0"," ", "ID", "ASC");
              foreach($allCats as $c){
                echo "<option value='" . $c['ID'] ."'";
                if($cat['Parent'] == $c['ID']){echo 'selected';}
                echo">" . $c['Name'] . "</option>";
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الرؤية:</label>
            <div class="col-sm-10 col-md-6">
               <div>
                 <input id="vis-yes" type="radio" name="visibility" value ="0" <?php if ($cat['Visibility'] == 0) {echo 'checked';} ?> />
                   <lable for="vis-yes">نعم </lable>
               </div>
               <div>
                 <input id="vis-no" type="radio" name="visibility" value ="1"  <?php if ($cat['Visibility'] == 1) {echo 'checked';} ?>/>
                   <lable for="vis-no">لا </lable>
                 </div>
             </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">طلبات الشراء:</label>
            <div class="col-sm-10 col-md-6">
               <div>
                 <input id="com-yes" type="radio" name="commenting" value ="0" <?php if ($cat['Allow_Comment'] == 0) {echo 'checked';} ?> />
                   <lable for="com-yes">نعم </lable>
               </div>
               <div>
                 <input id="com-no" type="radio" name="commenting" value ="1" <?php if ($cat['Allow_Comment'] == 1) {echo 'checked';} ?> />
                   <lable for="com-no">لا </lable>
                   </div>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label class="control-label col-sm-2">الاعلان:</label>
            <div class="col-sm-10 col-md-6">
               <div>
                 <input id="ads-yes" type="radio" name="ads" value ="0" <?php if ($cat['Allow_Ads'] == 0) {echo 'checked';} ?> />
                   <lable for="ads-yes">نعم </lable>
               </div>
               <div>
                 <input id="ads-no" type="radio" name="ads" value ="1" <?php if ($cat['Allow_Ads'] == 1) {echo 'checked';} ?> />
                   <lable for="ads-no">لا </lable>
               </div>
            </div>
          </div>
          <div class="form-group form-group-lg">
                  <div class ="col-sm-offset-2 col-sm-10">
                    <input class="btn btn-primary btn-lg" type="submit" value=" تحديث نوع العقد" />
                  </div>
          </div>
        </form>
      </div>
  
              
        <?php
            } else {
             echo "<div class = 'container'>";
              $theMsg='<div class="alert alert-danger"> لايوجد هذا النوع</div>';
             redirectHome($theMsg);
              echo "</div>";
                  
    
                } 
    } elseif ($do == 'update') {
      echo "<h1 class ='text-center'>تحديث نوع</h1>";
      echo "<div class='container'> ";
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['catid'];
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $order = $_POST['ordering'];
        $parent = $_POST['parent'];
        $visible = $_POST['visibility'];
        $comment = $_POST['commenting'];
        $ads = $_POST['ads'];
        
        $stmt = $con->prepare ("UPDATE categories SET Name = ?, Description = ?, Ordering = ?, Parent =?, Visibility = ? , Allow_Comment = ?, Allow_Ads = ?
        WHERE ID =?");
        $stmt-> execute(array($name, $desc, $order,$parent, $visible, $comment, $ads, $id));
        $theMsg= "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم التحديث</div>';
        redirectHome($theMsg,'back');
       
      }else {
        $theMsg='<div class="alert alert-danger"> لا يمكن تصفح هذه الصفحة مباشرا</div>';
        redirectHome($theMsg);
      }
      echo "</div>";

    }elseif ($do =='delete'){
      echo "<h1 class ='text-center'>حذف نوع</h1> ";
      echo "<div class='container'> ";
      $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']):0;
      
      $check = checkItem('ID','categories',$catid);
    
      if ($check > 0){ 
        $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid ");
        $stmt->bindParam(":zid", $catid);
        $stmt->execute();

        echo "<div class = 'container'>";
        $theMsg = "<div class = 'alert alert-success'> " . $stmt->rowCount() . 'تم الحذف</div>';
        redirectHome($theMsg,'back');
        echo "</div>";
       
      } else {
        echo "<div class = 'container'>";
        $theMsg='<div class="alert alert-danger">لا يوجد هذا النوع</div>';
        redirectHome($theMsg);
        echo "</div>";
      }
     
      echo "</div>";
    
    }
    include $tpl . 'footer.php';
  } else {
    header('location:index.php');
    exit();
}
ob_end_flush();
?>

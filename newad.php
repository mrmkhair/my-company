<?php
ob_start();
session_start();


if (isset($_SESSION['user'])) {
    $pagetitle = 'اضافة عقد جديد';

    include 'init.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $avatar_Name = $_FILES['Image']['name'];
        $avatarSize = $_FILES['Image']['size'];
        $avatarTmp = $_FILES['Image']['tmp_name'];
        $avatarType = $_FILES['Image']['type'];
        $avatarAllaowedExtention = array("pdf", "png","txt","xlsx","docx", "jpg" ,"jpeg", "gif");
        $avatarExtention = strtolower(end(explode('.',$avatar_Name)));
        
        $mavatar_Name = $_FILES['Measure']['name'];
        $mavatarSize = $_FILES['Measure']['size'];
        $mavatarTmp = $_FILES['Measure']['tmp_name'];
        $mavatarType = $_FILES['Measure']['type'];
        $mavatarAllaowedExtention = array("pdf", "png","txt","xlsx","docx", "jpg" ,"jpeg", "gif");
        $mavatarExtention = strtolower(end(explode('.',$mavatar_Name)));
  
        $number = $_POST['number'];
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        $country = $_POST['country'];
        $status = $_POST['status'];
       
        $cat = $_POST['category'];
        $tags = $_POST['tags'];
        $formErrors = array();
       
              
        if(empty($name)) {
          $formErrors[] = ' الاسم لا يمكن ان يكون  <strong> فارغ</strong> ';
        }
    
        if(empty($number)) {
          $formErrors[] = ' رقم العقد لا يمكن ان يكون  <strong> فارغ</strong> ';
        }
  
        if(empty($desc)) {
          $formErrors[] = 'الوصف لا يمكن ان يكون <strong> فارغ</strong> ';
        }
    
        if(empty ($price)) {
          $formErrors[] = 'السعر لايمكن ان يكون <strong> فارغ </strong> ';
        }
        if(empty ($date)) {
          $formErrors[] = 'التاريخ لايمكن ان يكون <strong> فارغ </strong> ';
        }
        if(empty ($country)) {
          $formErrors[] = 'العنوان لا يمكن ان يكون <strong> فارغ </strong> ';
        }
        if($status === 0) {
           $formErrors[] = 'يجب ان تختار <strong> الحالة </strong> ';
         }
        
         if($cat === 0) {
           $formErrors[] = 'يجب ان تختار <strong> النوع </strong> ';
         }
         if(! empty($avatar_Name) && ! in_array( $avatarExtention, $avatarAllaowedExtention)){
          $formErrors[] = ' هذا الامتداد غير  <strong> صالح</strong> ';
        }
        if(empty($avatar_Name) ){
          $formErrors[] = ' الصورة لا يمكن ان تكون فارغة <strong> فارغ</strong> ';
        }
        if($avatarSize > 4194304){
          $formErrors[] = ' الصورة لايجب ان تكون اكبر من<strong> 4 ميجا</strong> ';
        }
        if(! empty($mavatar_Name) && ! in_array( $mavatarExtention, $mavatarAllaowedExtention)){
          $formErrors[] = ' هذا الامتداد غير  <strong> صالح</strong> ';
        }
        if(empty($mavatar_Name) ){
          $formErrors[] = ' الصورة لا يمكن ان تكون فارغة <strong> فارغ</strong> ';
        }
        if($mavatarSize > 4194304){
          $formErrors[] = ' الصورة لايجب ان تكون اكبر من<strong> 4 ميجا</strong> ';
        }
        foreach( $formErrors as $error){
          echo '<div class = "alert alert-danger " >' . $error ;
        }
  
        if(empty($formErrors)){
          $Image = rand(0,1000000) . '-' . $avatar_Name;
          move_uploaded_file($avatarTmp,"admin/uploads/avatars/" . $Image);
  
          $Measure = rand(0,1000000) . '-' . $mavatar_Name;
          move_uploaded_file($mavatarTmp,"admin/uploads/avatars/" . $Measure);
  
         $stmt = $con->prepare ("INSERT INTO items (Number , Name , Description, Price, Country_Made, Status, Add_Date , Cat_ID , Member_ID,Tags,Image,Measure)
         VALUES(:znumber,:zname,:zdescription,:zprice,:zcountry,:zstatus,:zdate,:zcat ,:zmember,:ztags,:zimage,:zmeasure)");
         $stmt-> execute(array(
           'znumber' => $number,
           'zname' => $name,
           'zdescription' => $desc,
           'zprice' => $price,
           
           'zcountry' => $country,
           'zstatus' => $status,
           'zdate' => $date,
           'zcat' => $cat,
           'zmember' => $_SESSION['uid'],
           'ztags'  => $tags,
           'zimage'  => $Image,
           'zmeasure'  => $Measure
            ));
                if($stmt){
                $successMsg ="<div class ='alert alert-success'>تم الاضافة</div>";
                
               }
            
           }
    }

    ?>
<h1 class="text-center"> <?php echo $pagetitle ?> </h1>
 <div class="create-ad block" >
     <div class="container">
        <div class="panel panel-primary">
                 <div class="panel-heading"> <?php echo $pagetitle ?> </div>
                  <div class="panel-body">
                      <div class="row">
                          <div class="col-md-8">
                          <form class="form-horizontal main-form" action ="<?php echo $_SERVER['PHP_SELF']?>" method ="POST" enctype="multipart/form-data">
                          <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-3">رقم العقد :</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="number" class="form-control" required ="required" placeholder=" رقم العقد"  />
                                    </div>
                                    </div>
                                    <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-3">اسم العميل:</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="name" id="Name" class="form-control" required ="required" placeholder=" اسم المتعاقد"  />
                                    </div>
                                    </div>
                                    <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-3">رقم الهاتف:</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="description" class="form-control" required ="required" placeholder=" رقم الهاتف"  />
                                    </div>
                                    </div>
                                    <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-3">السعر:</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="price" class="form-control" required ="required" placeholder=" سعر العقد"  />
                                    </div>
                                    </div>
                                    <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-3">تاريخ التعاقد:</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="date" name="date" class="form-control" required ="required" placeholder=" تاريخ التعاقد"  />
                                    </div>
                                    </div>
                                    <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-3">عنوان العقد:</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="country" class="form-control" required ="required" placeholder=" عنوان العقد"  />
                                    </div>
                                    </div>
                                          <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-3">حالة العقد:</label>
                                    <div class="col-sm-10 col-md-9">
                                        <select name="status" >
                                            <option value="0">...</option>
                                            <option value="1">جديد</option>
                                            <option value="2">اضافة</option>
                                            <option value="3">امر عمل</option>
                                            <option value="4"> صيانة</option>
                                        </select>
                                    </div>
                                </div>
                              
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-3">نوع العقد :</label>
                                    <div class="col-sm-10 col-md-9">
                                        <select class="form-control" name="category" required ="required">
                                        <option value="0">...</option>
                                        <?php 
                                        $cats = getAllFrom('categories' , 'ID');
                                        
                                        foreach($cats as $cat){
                                            echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] ."</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                <label class="control-label col-sm-3">العلامات:</label>
                                <div class="col-sm-10 col-md-9">
                                    <input type="text" name="tags" class="form-control" placeholder="برجاء فصل العلامات ب (,)"  />
                                </div>
                                </div>
                                <div class="form-group form-group-lg">
                                <label class="control-label col-sm-3">نسخة العقد:</label>
                                <div class="col-sm-10 col-md-9">
                                    <input type="file" name="Image" class="form-control"  required ="required"/>
                                </div>
                                </div>
                                <div class="form-group form-group-lg">
                                <label class="control-label col-sm-3">نسخة الكيل:</label>
                                <div class="col-sm-10 col-md-9">
                                    <input type="file" name="Measure" class="form-control"  required ="required" />
                                </div>
                                </div>
                                <div class="form-group form-group-lg">
                                        <div class ="col-sm-offset-3 col-sm-9">
                                            <input class="btn btn-primary btn-sm" type="submit" value="اضافة عقد جديد " />
                                        </div>
                                </div>
                                </form>
                          </div> 
                          <!-- <div class="col-md-4">
                          <div class="thumbnail item-box live-preview">
                            <span class="price-tag"> $<span class="live-price"> 0 </span></span>
                               <img class="img-responsive" src="img.png" alt=" " />
                                <div class="caption">
                                    <h3 class="live-title" > tittle</h3>
                                   <p class="live-desc"> description </p>
                                    
                                </div>
                            </div>
                          </div> -->
                   </div>
                   <?php 

                   if(!empty($formErrors)){
                    foreach( $formErrors as $error){
                        echo '<div class="alert alert-danger">'. $error .'</div>' ;
                    }
                   }
                   if (isset($successMsg)){
                    
                  redirectHome($successMsg,'back');
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
?>
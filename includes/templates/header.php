<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>jquery-ui.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>jquery.selectBoxIt.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>front.css"/>
    
    <title><?php gettitle() ?></title>
    	<!-- Favicon Icon -->
	<link rel="icon" type="image/x-icon" href="admin/uploads/avatars/logo.png">
	<link rel="shortcut icon" type="image/x-icon" href="admin/uploads/avatars/logo.png">
	<link rel="apple-touch-icon" type="image/x-icon" href="admin/uploads/avatars/logo.png">
	
		<!-- Open Graph data -->
	<meta property="og:site_name" content="Technical Insulation" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content=" Home Insulation Services | Technical Company For Insulation Materials" />
	<meta property="og:description" content="شركة التقنية الاصلية للمواد العازلة من الشركات الرائدة فى مجال العزل الحراري والمائى بالكويت والحاصلة على شهادة الايزو" />
	<meta property="og:url" content="https://technicalinsulation.com/" />
	<meta property="og:image width" content="630" />
	<meta property="og:image height" content="315" />
	<meta property="og:site_name" content="https://www.facebook.com/%D8%B4%D8%B1%D9%83%D8%A9-%D8%A7%D9%84%D8%AA%D9%82%D9%86%D9%8A%D8%A9-%D9%84%D9%84%D9%85%D9%88%D8%A7%D8%AF-%D8%A7%D9%84%D8%B9%D8%A7%D8%B2%D9%84%D8%A9-100470272273909" />
	<meta property="og:image" content="https://yt3.ggpht.com/FeFy3YO5H9OKc2cv33pFndo7PhLkTtgjteN6ARRnFUnnTmObxc5AUDqhWGBaO_rNNFyZz59KlM0=s600-c-k-c0x00ffffff-no-rj-rp-mo" />
	
	<!-- Twitter Card data --> 
  <meta name="twitter:card" content="summary-large-image">
  <meta name="twitter:site" content="https://twitter.com/tecinsulation">
  <meta name="twitter:title" content="Technical Company For Insulation Materials">
  <meta name="twitter:description" content="شركة التقنية الاصلية للمواد العازلة من الشركات الرائدة فى مجال العزل الحراري والمائى بالكويت والحاصلة على شهادة الايزو">
  <meta name="twitter:creator" content="mohamedramadankhair2021@gmail.com">
  <meta name="twitter:image" content="admin/uploads/avatars/logo.png">
</head>

<body>
<div class="upper-bar">
    
        <?php 
          $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
          $getUser->execute(array($sessionUser));
          $info = $getUser->fetch();
        if(isset($_SESSION['user'])){?>
        <img class="my-image img-thumbnail img-circle" src="admin/uploads/avatars/<?php echo $info['avatar'] ?>" alt=" " />
        <div class="btn-group my-info">
        
            <span class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <?php echo $sessionUser?>
                <span class="caret"></span>
                </span>
                <ul class="dropdown-menu">
                    <li><a href="profile.php">الصفحة الشخصية </a></li>
                    <li><a href="edit.php"> البحث والتعديل </a></li>
                    <li><a href="newad.php">  اضافة عقد </a></li>
                     <!-- <li><a href="editprofile.php"> تعديل البيانات الشخصية </a></li>  -->
                    <li><a href="profile.php#my-items">عقودي </a></li>
                    <li><a href="profile.php#my-comments"> طلبات الشراء</a></li>
                    <li><a href="logout.php">خروج</a></li>
                </ul>
            
        </div>
            <nav class="navbar navbar-inverse " >
        <div class="container">
            <div class="navbar-header">
            
            <a href="https://technicalinsulation.000webhostapp.com/" target="_blank"><img style="width: 50px;" src="admin/uploads/avatars/logo.png" alt="logo"></a>
            
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            
            <!-- /<a class="navbar-brand" href="index.php">الرئيسية</a>  -->
            </div>
            <div class="collapse navbar-collapse" id="app-nav">
                <ul class="nav navbar-nav navbar-right">
                <li> <a href="index.php">الرئيسية</a></li> 
                    <?php
                    $allCats = getAllFrom2("*" , "categories" ,"ID", "where parent = 0", "", "ASC");

                    foreach ($allCats as $cat){
                        echo '<li> <a href="categories.php?pageid=' . $cat['ID'] .'">' . $cat['Name'] . '</a></li>';
                    }
                    ?>
                </ul>
            
            </div>
        </div>
        </nav>
        <?php
           
        }else{
        ?>
        <a href="login.php">
            <span class="pull-right">دخول/تسجيل</span>
        </a>
        <?php } ?>
  
</div>



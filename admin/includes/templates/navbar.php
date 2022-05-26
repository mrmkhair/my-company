<?php
 
 ?>
<nav class="navbar navbar-inverse" >
    <div class="container">
        <div class="navbar-header">
        
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a  href="https://technicalinsulation.000webhostapp.com/" target="_blank"><img style="width: 50px; height: 50px;" src="uploads/avatars/logo.png" alt="logo"></a>
             <a class="navbar-brand" href="dashboard.php"><?//php// echo lang('home_admin') ?></a> 
            
        </div>
        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php"><?php echo lang('home_admin') ?></a></li>
                <li><a href="categories.php"><?php echo lang('categories') ?></a></li>
                <li><a href="items.php"><?php echo lang('items') ?> </a></li>
                <li><a href="members.php"><?php echo lang('members') ?> </a></li>
                <li><a href="comments.php"><?php echo lang('comments') ?> </a></li>
                <li><a href="statistics.php"><?php echo lang('statistics') ?> </a></li>
                <li><a href="archives.php"><?php echo lang('archives') ?> </a></li> 
                <li><a href="managers.php"><?php echo lang('managers') ?> </a></li>
                <li><a href="itemsf.php"><?php echo lang('itemsformans') ?> </a></li>
                <li><a href="phones.php"><?php echo lang('phones') ?> </a></li>
                
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['Username']?> <span class="caret"></span></a>
         
               <ul class="dropdown-menu">
                    <li><a href="../index.php" target="_blank"> ملف عرض العقود</a></li>
                    <li><a href="members.php?do=edit&userid=<?php echo $_SESSION['ID']?>"> تعديل الملف الشخصي</a></li>
                    <li><a href="https://tecinsulation.cbk.com/" target="_blank"> رابط البنك التجاري</a></li>
                    <li><a href="logout.php"> خروج</a></li>
               </ul>
           
                </ul>
              </li>
            </ul>
        </div>
    </div>
</nav>

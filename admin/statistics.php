<?php

ob_start();
session_start();

if(isset($_SESSION['Username'])){
   $pagetitle =  ' الاحصائيات';
   include  'init.php';

   ?>
 <div class="home-stats ">
       
        <div class="container text-center">
            <h1>   احصائيات عقود </h1>
                <div class="row">
                <div class="col-md-4">
                        <div class = "stat st-items"> 
                            
                       <div class="info">
                            اجمالى مبالغ العقود د.ك 
                             <span><?php echo varTotal('SUM','Price','items')?> 
                            </span>
                             </div>
                        </div>
                    </div> 
                      <div class="col-md-2">
                        <div class = "stat st-items ">  <div class="info">اجمالى عدد العقود 
                            <span><?php echo countItems('Item_ID','items')?></span></div>
                            </div> 

                    </div>
                    <div class="col-md-2">
                        <div class = "stat st-items "> <div class="info"> عدد العقود الشهر الحالى      
                            <span><?php echo countItems2('Item_ID','items')?></span></div>
                            </div> 
                    </div>  
                    <div class="col-md-2">
                        <div class = "stat st-items ">  <div class="info"> عدد العقود العام الحالى 
                            <span><?php echo countItems3('Item_ID','items')?></span></div>
                            </div> 
                    </div>
                    <div class="col-md-2">
                        <div class = "stat st-items ">  <div class="info">   اقل من  500 د.ك  
                            <span><?php echo countLessItems('Price','items','Price < 500')?></span></div>
                            </div> 
                    </div>  
                   
                   
                </div>

        </div>
        <div class="container text-center">
            <h1> احصائيات اليوم</h1>
            <div class="row">
            
                    <div class="col-md-4">
                        <div class = "stat st-members "> <div class="info"> عدد العقود اليوم      
                            <span><?php echo countItems5('Item_ID','items')?></span></div>
                            </div> 
                    </div>  
                   
                    <div class="col-md-4">
                        <div class = "stat st-members ">  <div class="info">   اصغر من  500 د.ك  
                            <span><?php echo countLessItems5('COUNT','Item_ID','items','Price < 500')?></span></div>
                            </div> 
                    </div>
                    <div class="col-md-4">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            اجمالى مبالغ العقود د.ك 
                             <span><?php  if (varTotal5('SUM','Price','items') == NULL){echo 'ZERO';}
                              echo varTotal5('SUM','Price','items')?> 
                            </span>
                             </div>
                        </div>
                    </div>  
                    <!-- <div class="col-md-3">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            اقل عقد د.ك 
                             <span><?php echo varTotal5('MIN','Price','items')?> 
                            </span>
                        </div>
                        </div>
                    </div>  -->
                    <!-- <div class="col-md-2">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            اكبر عقد د.ك 
                             <span><?php echo varTotal5('MAX','Price','items')?>
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            متوسط مبالغ العقود د.ك 
                             <span><?php echo varTotal5('AVG','Price','items')?> 
                            </span>
                        </div>
                        </div>
                    </div>  -->
                     
                </div>

        </div>

        <div class="container text-center">
            <h1> احصائيات الاسبوع</h1>
            <div class="row">
            
                    <div class="col-md-4">
                        <div class = "stat st-members "> <div class="info"> عدد عقود الاسبوع      
                            <span><?php echo countItems4('Item_ID','items')?></span></div>
                            </div> 
                    </div>  
                   
                    <div class="col-md-4">
                        <div class = "stat st-members ">  <div class="info">   اصغر من  500 د.ك  
                            <span><?php echo countLessItems4('COUNT','Item_ID','items','Price < 500')?></span></div>
                            </div> 
                    </div>
                    <div class="col-md-4">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            اجمالى مبالغ العقود د.ك 
                             <span><?php echo varTotal4('SUM','Price','items')?> 
                            </span>
                             </div>
                        </div>
                    </div>  
                    <!-- <div class="col-md-3">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            اقل عقد د.ك 
                             <span><?php echo varTotal4('MIN','Price','items')?> 
                            </span>
                        </div>
                        </div>
                    </div>  -->
                    <!-- <div class="col-md-2">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            اكبر عقد د.ك 
                             <span><?php echo varTotal4('MAX','Price','items')?>
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            متوسط مبالغ العقود د.ك 
                             <span><?php echo varTotal4('AVG','Price','items')?> 
                            </span>
                        </div>
                        </div>
                    </div>  -->
                     
                </div>

        </div>
       
        <div class="container text-center">
            <h1> احصائيات الشهر الحالى</h1>
            <div class="row">
            
                    <div class="col-md-4">
                        <div class = "stat st-members "> <div class="info"> عدد العقود الشهر الحالى        
                            <span><?php echo countItems2('Item_ID','items')?></span></div>
                            </div> 
                    </div>  
                   
                    <div class="col-md-4">
                        <div class = "stat st-members ">  <div class="info">   اصغر من  500 د.ك  
                            <span><?php echo countLessItems2('COUNT','Item_ID','items','Price < 500')?></span></div>
                            </div> 
                    </div>
                    <div class="col-md-4">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            اجمالى مبالغ العقود د.ك 
                             <span><?php echo varTotal2('SUM','Price','items')?> 
                            </span>
                             </div>
                        </div>
                    </div>  
                    <!-- <div class="col-md-3">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            اقل عقد د.ك 
                             <span><?php echo varTotal2('MIN','Price','items')?> 
                            </span>
                        </div>
                        </div>
                    </div>  -->
                    <!-- <div class="col-md-2">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            اكبر عقد د.ك 
                             <span><?php echo varTotal2('MAX','Price','items')?>
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class = "stat st-members"> 
                            
                       <div class="info">
                            متوسط مبالغ العقود د.ك 
                             <span><?php echo varTotal2('AVG','Price','items')?> 
                            </span>
                        </div>
                        </div>
                    </div> -->

        </div>
        <div class="container text-center">
            <h1> احصائيات العام</h1>
            <div class="row">
            
            <div class="col-md-4">
                <div class = "stat st-items "> <div class="info"> عدد عقود العام      
                    <span><?php echo countItems3('Item_ID','items')?></span></div>
                    </div> 
            </div>  
           
            <div class="col-md-4">
                <div class = "stat st-items ">  <div class="info">   اصغر من  500 د.ك  
                    <span><?php echo countLessItems3('COUNT','Item_ID','items','Price < 500')?></span></div>
                    </div> 
            </div>
            <div class="col-md-4">
                <div class = "stat st-items"> 
                    
               <div class="info">
                    اجمالى مبالغ العقود د.ك 
                     <span><?php echo varTotal3('SUM','Price','items')?> 
                    </span>
                     </div>
                </div>
            </div>  
            <!-- <div class="col-md-3">
                <div class = "stat st-items"> 
                    
               <div class="info">
                    اقل عقد د.ك 
                     <span><?php echo varTotal3('MIN','Price','items')?> 
                    </span>
                </div>
                </div>
            </div>  -->
            <!-- <div class="col-md-2">
                <div class = "stat st-items"> 
                    
               <div class="info">
                    اكبر عقد د.ك 
                     <span><?php echo varTotal3('MAX','Price','items')?>
                    </span>
                </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class = "stat st-items"> 
                    
               <div class="info">
                    متوسط مبالغ العقود د.ك 
                     <span><?php echo varTotal3('AVG','Price','items')?> 
                    </span>
                </div>
                </div>
            </div>  -->
             
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

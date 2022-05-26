<?php 
function lang ($phrase){
    static $lang = array(
        'message'=> 'مرحبا',
        'admin' => 'بالادمن'
    );
    return $lang [$phrase];
}
<?php
 function lang($phrase)
{
    static $lang = array(
        'home_admin' => 'الرئيسية',
        'categories' => ' انواع العقود',
        'items'      => 'العقود',
        'members'    => 'الموظفين',
        'statistics' => 'الاحصائيات',
        'comments'  => 'طلبات الشراء',
        'managers'     => 'الادارة',
        'archives'    => 'الارشيف',
        'phones'    => ' ارقام هامة',
        'itemsformans'    => 'جدول التشغيل',
    );
    return $lang[$phrase];
}

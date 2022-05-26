<?php
 function lang($phrase)
{
    static $lang = array(
        'home_admin' => 'Home',
        'categories' => 'Categories',
        'items'      => 'Items',
        'members'    => 'Members',
        'statistics' => 'Statistics',
        'comments' => 'comments',
        'logs'       => 'Logs',
        ' '          => ' ',
    );
    return $lang[$phrase];
}

<?php

//relative file positioning for non-php files
function GetRootDir()
{
    $rootaccess = "";
    $i = 1;
    while ($i < substr_count($_SERVER['PHP_SELF'],"/")) 
    {
        $rootaccess .= "../";
        $i++;
    }
    return $rootaccess;
}
define ('R', GetRootDir());



//add the settings as well as all classes and functions
require_once (ABSPATH . 'util/config.php');
require_once (ABSPATH . 'util/class.exceptions.php');
require_once (ABSPATH . 'util/functions_global.php');
require_once (ABSPATH . 'util/class.user.php');

session_start(); //this goes after class definitons (http://stackoverflow.com/questions/132194/php-storing-objects-inside-the-session)


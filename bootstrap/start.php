<?php


// for legacy compatibility
if (!defined('XIMDEX_ROOT_PATH')) {
    define('XIMDEX_ROOT_PATH', dirname(dirname(__FILE__)));
}

include_once 'extensions/vendors/autoload.php';

class_alias('Ximdex\Runtime\App', 'App');


App::setValue('XIMDEX_ROOT_PATH', dirname(dirname(__FILE__)))
    ->setValue('devel', true);



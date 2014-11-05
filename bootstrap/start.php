<?php


// for legacy compatibility
if (!defined('XIMDEX_ROOT_PATH')) {
    define('XIMDEX_ROOT_PATH', dirname(dirname(__FILE__)));
}

include_once 'extensions/vendors/autoload.php';

class_alias('Ximdex\Runtime\App', 'App');


App::setValue('XIMDEX_ROOT_PATH', dirname(dirname(__FILE__)))
    ->setValue('devel', true);


// get Config
$conf = require_once(App::getValue('XIMDEX_ROOT_PATH') . '/conf/config.php');


foreach ($conf as $key => $value) {
    App::setValue($key, $value);
}

define('DEFAULT_LOCALE', App::getValue('locale'));
date_default_timezone_set(App::getValue('timezone'));
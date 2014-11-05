<?php


// for legacy compatibility
if (!defined('XIMDEX_ROOT_PATH')) {
    define('XIMDEX_ROOT_PATH', dirname(dirname(__FILE__)));
}

include_once 'extensions/vendors/autoload.php';

class_alias('Ximdex\Runtime\App', 'App');




App::setValue('XIMDEX_ROOT_PATH', dirname(dirname(__FILE__))) ;


// get Config
$conf = require_once(App::getValue('XIMDEX_ROOT_PATH') . '/conf/config.php');
foreach ($conf as $key => $value) {
    App::setValue($key, $value);
}


// read install-modules.conf
$modulesConfString = file_get_contents( App::getValue('XIMDEX_ROOT_PATH') . '/conf/install-modules.conf' ) ;
$matches = array();
preg_match_all( '/define\(\'(.*)\',(.*)\);/iUs' , $modulesConfString, $matches );
foreach( $matches[1] as $key => $value ) {
    App::setValue( $value  , str_replace( '\'', '', $matches[2][$key ]));
}

// use config values
define('DEFAULT_LOCALE', App::getValue('locale'));
date_default_timezone_set(App::getValue('timezone'));



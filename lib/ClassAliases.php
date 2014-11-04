<?php

if (!defined('XIMDEX_ROOT_PATH')) {
    define ('XIMDEX_ROOT_PATH', dirname(dirname(__FILE__) ));
}

class Synchronizer extends \Ximdex\Synchronizer {}
class ModulesManager extends \Ximdex\Modules\Manager {}
class ModulesConfig extends \Ximdex\Modules\Config {}
class DefManager extends \Ximdex\Modules\DefManager {}
class FsUtils extends \Ximdex\Fsutils\FsUtils {}

class Utils extends \Ximdex\Helpers\Utils {}

// TODO: Refactorize XMD_LOG
require_once 'common/log/XMD_log.class.php' ;
require_once 'common/log/MN_log.class.php' ;
require_once 'common/log/Action_log.class.php' ;


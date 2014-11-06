<?php
/**
 * Created by PhpStorm.
 * User: drzippie
 * Date: 6/11/14
 * Time: 18:11
 */

namespace Ximdex ;


Class Logger  {
    private static $instance = null;

    private $logger = null;
    public function __construct( $logger ) {
        $this->logger = $logger ;
        if (self::$instance instanceof self) {
            throw new \Exception('-10, Cannot be instantiated more than once');
        } else {
            self::$instance = $this ;
        }
    }
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            throw \Exception( 'Logger need to be initilized') ;
            return  ;
        }
        return self::$instance;
    }

    public static function error( $string , $object = null ) {
        return self::getInstance()->logger->addError( $string , $object  ) ;
    }
    public static function warning( $string ) {
        return self::getInstance()->logger->addWarning( $string ) ;
    }
    public static function debug( $string ) {
        return self::getInstance()->logger->addDebug( $string ) ;
    }
    public static function fatal( $string ) {
        return self::getInstance()->logger->addFatal( $string ) ;
    }

}
<?php

namespace Ximdex\Runtime ;


Class App {
    private static $instance;
    protected $DIContainer = null ;
    protected $DIBuilder = null ;
    protected $config = null;
    public function __construct( ) {
        $this->DIBuilder = new \DI\ContainerBuilder();
        $this->DIBuilder->useAutowiring(true);
        $this->DIBuilder->useAnnotations(true);
        $this->DIBuilder->ignorePhpDocErrors(true);
        $this->DIBuilder->setDefinitionCache(new \Doctrine\Common\Cache\ArrayCache());
        $this->DIContainer = $this->DIBuilder->build();
        $this->config = array( );
    }

    public static function getInstance()
    {
        if (  !self::$instance instanceof self)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getConfig() {
        return $this->config ;
    }
    public static function config() {
        return self::getInstance()->getConfig() ;

    }
    public function getContainerObject( $class ) {
        return $this->DIContainer->get( $class ) ;

    }
    public static function getObject( $class ) {
        return self::getInstance()->getContainerObject( $class ) ;

    }
    public static function getValue( $key, $default = null ) {
        return self::getInstance()->getRuntimeValue( $key, $default );

    }
    public function getRuntimeValue( $key, $default = null  ) {
        if ( isset( $this->config[ $key ])) {
            return $this->config[ $key ];
        } else {
            return $default;
        }
    }
    public static function setValue( $key, $value , $persistent = false  ) {
        return self::getInstance()->setRuntimeValue( $key, $value );
    }
    public function setRuntimeValue( $key , $value   ) {
        $this->config[ $key ] = $value ;
        return $this ;
    }

}
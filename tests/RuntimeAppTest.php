<?php

use Ximdex\Runtime\App;
class RuntimeAppTest extends PHPUnit_Framework_TestCase
{

    public function testApp()
    {
        $app = new App;
        $this->assertInstanceOf( 'Ximdex\Runtime\App', $app  ) ;
        return $app ;
    }

    /**
     * @depends testApp
     */
    public function testStartWithEmptyConfig(App $app) {

         $this->assertCount( 0, $app->config()) ;
        return $app ;
    }

    /**
     * @depends testStartWithEmptyConfig
     */
    public function testAddConfigValue( App $app ) {

        $app->setValue( 'key', 'value');
        $this->assertEquals( $app->getValue( 'key'), 'value') ;
        return $app ;
    }

    /**
     * @depends testAddConfigValue
     */

    public function testGetDefaultConfigValue( App $app ) {
        $app->setValue( 'key', 'value');
        $this->assertEquals( $app->getValue( 'xxxxxx', 'default' ), 'default') ;
        return $app ;
    }
}
<?php

use Ximdex\Runtime\App;


class RuntimeAppTest extends PHPUnit_Framework_TestCase
{

    public function testApp()
    {
        $app = new App();
        $this->assertInstanceOf('Ximdex\Runtime\App', $app);
        return $app;
    }


    /**
     * @depends testApp
     */
    public function testExceptionUnableToGetMoreThanOneInstance(App $app)
    {
        $this->setExpectedException('\Exception');
        $app2 = New App();


    }

    /**
     * @depends testApp
     */
    public function testStartWithEmptyConfig(App $app)
    {

        $this->assertCount(0, $app->config());
        return $app;
    }

    /**
     * @depends testStartWithEmptyConfig
     */
    public function testAddConfigValue(App $app)
    {

        $app->setValue('key', 'value');
        $this->assertEquals($app->getValue('key'), 'value');
        return $app;
    }

    /**
     * @depends testAddConfigValue
     */

    public function testGetDefaultConfigValue(App $app)
    {
        $app->setValue('key', 'value');
        $this->assertEquals($app->getValue('xxxxxx', 'default'), 'default');
        return $app;
    }

    /**
     * @depends testGetDefaultConfigValue
     *
     */
    public function testGetNullConnectionException(App $app)
    {
        $this->setExpectedException('Exception', '-1');
        App::Db();
        return $app;
    }


    /**
     * @depends testAddConfigValue
     *
     */
    public function testSingletonApp(App $app)
    {
        $this->assertEquals($app, App::getInstance());
        return $app;
    }

    public function testAddDefaultDbConnection()
    {
        $pdo = $this->getMockBuilder('PDOMock')
            ->getMock();

        App::getInstance()->addDbConnection($pdo);


        $this->assertEquals($pdo, App::Db());

    }

    public function testExceptionNoDbConfig()
    {
        $this->setExpectedException('Exception', '-1');

        App::Db('non-exist');


    }
}

class PDOMock extends \PDO
{
    public function __construct()
    {
    }
}

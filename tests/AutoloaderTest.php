<?php

use PHPUnit\Framework\TestCase;

class AutoloaderTest extends TestCase
{
    //THIS loads the autoloader so the other tests would work
    public function testAutoloaderWorks(): void
    {
        require_once __DIR__ . "/../src/autoloader.php";
        MyAutoloader::startAutoloader();

        $controller = new \Defconshop\Controller\Web\IndexController();
        $this->assertNotEmpty($controller, 'failed loading controller');
        $this->assertInstanceOf(\Defconshop\Controller\AbstractController::class, $controller);
    }


//    protected function tearDown()
//    {
//        parent::tearDown();
//        $autoloadFuncs = spl_autoload_functions();
//        foreach($autoloadFuncs as $unregisterFunc)
//        {
//            if ($unregisterFunc[0] == 'MyAutoloader'){
//                spl_autoload_unregister($unregisterFunc);
//            }
//        }
//    }
}
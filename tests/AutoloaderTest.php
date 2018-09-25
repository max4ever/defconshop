<?php
use \PHPUnit\Framework\TestCase;

class AutoloaderTest extends TestCase
{
    public function testAutoloaderWorks(): void
    {
        require_once __DIR__ . "/../src/autoloader.php";
        MyAutoloader::startAutoloader();

        $controller = new \Defconshop\Controller\Web\IndexController();
        $this->assertNotEmpty($controller, 'failed loading controller');
        $this->assertInstanceOf(\Defconshop\Controller\AbstractController::class, $controller);
    }


}
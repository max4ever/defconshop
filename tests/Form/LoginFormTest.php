<?php

use PHPUnit\Framework\TestCase;

class LoginFormTest extends TestCase
{
    public function testFormatCurrency(): void
    {
        $viewHelper = new \Defconshop\Helper\ViewerHelper();
        $this->assertEquals("10.15€", $viewHelper::formatCurrency(10.1546));
    }

}
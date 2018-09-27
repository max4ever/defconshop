<?php

use PHPUnit\Framework\TestCase;

class IndexControllerTest extends TestCase
{

    public function testChangeColorFormIsPresent()
    {
        $data = file_get_contents("http://localhost:8000/");

        $actualDom = new \DomDocument();
        libxml_use_internal_errors(true);//hide HTML5 warnings
        $actualDom->loadHTML($data);
        $actualDom->preserveWhiteSpace = false;
        $form = $actualDom->getElementById('colorForm');

        $this->assertNotEmpty($form);
    }

}
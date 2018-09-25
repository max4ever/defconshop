<?php

namespace Defconshop\Controller\Web;

use \Defconshop\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $this->render("index.phtml", [
            'products' => [
                ['name' => 'rosso<>'],
                ['name' => 'verde@!'],
                ['name' => 'giallo:/\\']
            ]
        ]);
    }
}
<?php

namespace Defconshop\Controller;

abstract class AbstractController
{
    public function render(string $templateName, array $params = []){
        $fileName = \Config::$BASE_PATH . "templates" . DIRECTORY_SEPARATOR . "layout.phtml";

        if (file_exists($fileName)){
            $includeFile = \Config::$BASE_PATH . "templates" . DIRECTORY_SEPARATOR . $templateName;//for layout.phtml to include
            require_once($fileName);
        }
        else{
            die('Could not load template ' . $templateName . ' tried to look for it in '. $fileName);
        }
    }
}
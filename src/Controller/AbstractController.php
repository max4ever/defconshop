<?php

namespace Defconshop\Controller;

use Defconshop\Helper\ViewerHelper;

abstract class AbstractController
{
    public function render(string $templateName, array $params = [], bool $autoEscapeHtml = true){
        $fileName = \Config::$BASE_PATH . "templates" . DIRECTORY_SEPARATOR . "layout.phtml";

        if ($autoEscapeHtml){
            array_walk_recursive($params, array(ViewerHelper::class, "escapeHtml"));
        }

        if (file_exists($fileName)){
            $includeFile = \Config::$BASE_PATH . "templates" . DIRECTORY_SEPARATOR . $templateName;//for layout.phtml to include
            require_once($fileName);
        }
        else{
            die('Could not load template ' . $templateName . ' tried to look for it in '. $fileName);
        }
    }

}
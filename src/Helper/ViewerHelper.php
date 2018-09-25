<?php

namespace Defconshop\Helper;

class ViewerHelper{

    /**
     * Modifies the input var for html output by using pass-by-reference
     * @param string $str
     */
    public static function escapeHtml(string &$str) : void{
        $str = htmlentities($str, ENT_QUOTES, "UTF-8");
    }

}
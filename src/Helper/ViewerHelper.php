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

    public static function formatCurrency(string $money) : string{
        return money_format('%.2n', $money) . "€ \n";
    }

    public static function productImgTag(string $filename, string $alt = ""){
        return '<img src="/assets/images/products/'.$filename.'" alt="'.$alt.'"/>';
    }
}
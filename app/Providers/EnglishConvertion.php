<?php

namespace App\Providers;
use File;

class EnglishConvertion {

    // Convert to english
    public function convert($number) {
        if($number != null) {
            $newNumbers = range(0, 9);
            // 1. Persian HTML decimal
            $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
            // 2. Arabic HTML decimal
            $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
            // 3. Arabic Numeric
            $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
            // 4. Persian Numeric
            $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        
            $number =  str_replace($persianDecimal, $newNumbers, $number);
            $number =  str_replace($arabicDecimal, $newNumbers, $number);
            $number =  str_replace($arabic, $newNumbers, $number);

            return str_replace($persian, $newNumbers, $number);
        }
    }
}
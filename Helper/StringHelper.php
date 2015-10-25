<?php

namespace Wvs\CoreBundle\Helper;

class StringHelper
{

    public static function underscoreToCamelcase($str, $capitaliseFirstChar = false) {
        if($capitaliseFirstChar) {
            $str = ucfirst($str);
        }
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $str);
    }

    public static function camelcaseToUnderscore($str) {
        $str[0] = strtolower($str[0]);
        $func = create_function('$c', 'return "_" . strtolower($c[1]);');
        return preg_replace_callback('/([A-Z])/', $func, $str);
    }

}

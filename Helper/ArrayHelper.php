<?php

namespace Wvs\CoreBundle\Helper;

class ArrayHelper
{

    public static function underscoreToCamelcase($data)
    {
        $newData = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = self::underscoreToCamelcase($value);
            }
            $newKey = StringHelper::underscoreToCamelcase($key);
            $newData[$newKey] = $value;
        }

        return $newData;
    }




}

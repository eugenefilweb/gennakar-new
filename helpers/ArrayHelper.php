<?php

namespace app\helpers;

use Yii;

class ArrayHelper extends \yii\helpers\ArrayHelper
{
    public static function valueToKey($arr='')
    {
        return array_combine($arr, $arr);
    }

    public static function objectToArray($obj) 
    {
	    //only process if it's an object or array being passed to the function
	    if(is_object($obj) || is_array($obj)) {
	        $ret = (array) $obj;
	        foreach($ret as &$item) {
	            //recursively process EACH element regardless of type
	            $item = self::objectToArray($item);
	        }
	        return $ret;
	    }
		
	    return $obj;
	}

    public static function combine($array)
    {
        return array_combine($array, $array);
    }

    public static function range($start, $end)
    {
    	$data = [];

    	if ($start == $end) {
    		$data[$start] = $end;
    		return $data;
    	}

    	if ($start < $end) {
    		while ($start < $end) {
	    		$data[$start] = $start;
	    		$start++;
	    	}
	    	return $data;
    	}

    	if ($start > $end) {
    		while ($start > $end) {
	    		$data[$start] = $start;
	    		$start--;
	    	}
    		return $data;
    	}
    } 
}
<?php
function array2object($array) {
    if (is_array($array)) {
        $obj = new StdClass();

        foreach ($array as $key => $val){
            $obj->$key = $val;
        }
    }
    else { $obj = $array;
    }

    return $obj;
}

function object2array($object) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    }
    else {
        $array = $object;
    }
    return $array;
}
<?php

namespace Friday;

/**
 * Get a random value from an array.
 * @link https://github.com/spatie/array-functions
 * @param array $array
 * @param int   $numReq The amount of values to return
 *
 * @return mixed
 */
function array_rand_value(array $array, int $numReq = 1)
{
    if (! count($array)) return;
    $keyeys = array_rand($array, $numReq);

    if ($numReq === 1) {
        return $array[$keyeys];
    }

    return array_intersect_key($array, array_flip($keyeys));
}

/**
 * Remove a value from a multidimensional array
 *
 * @param array $array
 * @param $value
 */
function array_remove_value_recursive(array &$array, $needle)
{
    if (! count($array)) return;

    foreach ($array as $keyey => &$value) {
        if (is_array($value)) array_remove_value_recursive($value, $needle);
        elseif($needle == $value) unset($array[$keyey]);
    }
}

/**
 * Remove a key from a multidimensional array
 *
 * @param array $array
 * @param $keyey
 */
function array_remove_key_recursive(array &$array, string $needle)
{
    if (! count($array)) return;
    foreach ($array as $keyey => &$value) {
        if ($keyey === $needle) unset($array[$keyey]);
        elseif (is_array($value)) array_remove_key_recursive($value, $needle);
    }
}

/**
 * Transform a two-dimensional based on parent id value array to tree structure
 *
 * @param array   $array   based on id, parent index
 * @param string  $parent_key  parent id index
 * @param string  $key   id index
 * @param string  $children   children index
 * @return array
 */
function array_convert_tree($array, $parent_key = 'parent', $key = 'id', $children = 'children')
{
    if (! count($array)) return;
    $res = [];
    foreach ($array as $value) {
        isset($res[$value[$parent_key]]) ?: $res[$value[$parent_key]] = [];
        isset($res[$value[$key]]) ?: $res[$value[$key]] = [];
        $res[$value[$parent_key]][] = array_merge($value, [$children => &$res[$value[$key]]]);
    }
    return $res[0];
}




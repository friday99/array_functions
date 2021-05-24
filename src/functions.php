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

    $keys = array_rand($array, $numReq);

    if ($numReq === 1) {
        return $array[$keys];
    }

    return array_intersect_key($array, array_flip($keys));
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

    foreach ($array as $key => &$value) {
        if (is_array($value)) array_remove_value_recursive($value, $needle);
        elseif($needle == $value) unset($array[$key]);
    }
}

/**
 * Remove a key from a multidimensional array
 *
 * @param array $array
 * @param $key
 */
function array_remove_key_recursive(array &$array, string $needle)
{
    if (! count($array)) return;
    foreach ($array as $key => &$value) {
        if ($key === $needle) unset($array[$key]);
        elseif (is_array($value)) array_remove_key_recursive($value, $needle);
    }
}


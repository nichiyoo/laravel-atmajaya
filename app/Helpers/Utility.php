<?php

namespace App\Helpers;

use stdClass;

class Utility
{
  /**
   * Convert an array to object.
   *
   * @param array $array
   * @return object
   */
  public static function arrayToObject(array $array)
  {
    $object = new stdClass();
    foreach ($array as $key => $value) {
      $object->$key = is_array($value) ? self::arrayToObject($value) : $value;
    }
    return $object;
  }
}

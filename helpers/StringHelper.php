<?php

namespace app\helpers;

class StringHelper extends \yii\helpers\StringHelper
{
  public static function extractTextBetweenStrings($string, $startString, $endString) {
      $startPos = strpos($string, $startString);
      $endPos = strpos($string, $endString);

      if ($startPos !== false && $endPos !== false) {
          return substr($string, $startPos + strlen($startString), $endPos - $startPos - strlen($startString));
      }

      return false;
  }

}
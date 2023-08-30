<?php

namespace app\helpers;

use app\helpers\App;

class MapboxHelper
{
    public static function getColorScheme($data, $key)
    {
        $result = [];

        $color_schemes = App::params('mapbox')['color_scheme'];
        foreach ($color_schemes as $color => $values) {
            $label = $values[$key] ?? '';

            if ($label && in_array($label, $data)) {
                $result[$label] = [
                    'color' => $color,
                    'name' => $values['name']
                ];
            }
        }

        ksort($result);

        return $result;
    }
}
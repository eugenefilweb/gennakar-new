<?php

<?= $this->render('_map-advanced-filter', [
    'form' => $form,
    'searchModel' => $searchModel,
    'attribute' => 'user_id',
    'data' => Patrol::userFilter()
]) ?>

public function totalFilterTag($attribute)
{
    if ($this->{$attribute} && is_countable($this->{$attribute})) {
        return implode('', [
            '(',
            App::formatter('asNumber', count($this->{$attribute})),
            ')'
        ]);
    }
}

    public static function formatter($functionName='', $value='')
{
    $formatter = self::component('formatter');
    
    if ($functionName) {
        return $formatter->$functionName($value);
    }

    return $formatter;
}

public static function component($component)
{
    return self::app()->{$component};
}



public static function userFilter()
{
    $models = self::find()
        ->groupBy('user_id')
        ->all();

    $models = ArrayHelper::map($models, 'user_id', 'userFullnam');

    return $models;
}

public static function map($array, $from, $to, $group = null)
{
    $result = [];
    foreach ($array as $element) {
        $key = static::getValue($element, $from);
        $value = static::getValue($element, $to);
        if ($group !== null) {
            $result[static::getValue($element, $group)][$key] = $value;
        } else {
            $result[$key] = $value;
        }
    }

    return $result;
}

public static function getValue($array, $key, $default = null)
{
    if ($key instanceof \Closure) {
        return $key($array, $default);
    }

    if (is_array($key)) {
        $lastKey = array_pop($key);
        foreach ($key as $keyPart) {
            $array = static::getValue($array, $keyPart);
        }
        $key = $lastKey;
    }

    if (is_object($array) && property_exists($array, $key)) {
        return $array->$key;
    }

    if (static::keyExists($key, $array)) {
        return $array[$key];
    }

    if ($key && ($pos = strrpos($key, '.')) !== false) {
        $array = static::getValue($array, substr($key, 0, $pos), $default);
        $key = substr($key, $pos + 1);
    }

    if (static::keyExists($key, $array)) {
        return $array[$key];
    }
    if (is_object($array)) {
        // this is expected to fail if the property does not exist, or __get() is not implemented
        // it is not reliably possible to check whether a property is accessible beforehand
        try {
            return $array->$key;
        } catch (\Exception $e) {
            if ($array instanceof ArrayAccess) {
                return $default;
            }
            throw $e;
        }
    }

    return $default;
}

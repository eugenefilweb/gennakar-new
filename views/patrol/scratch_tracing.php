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
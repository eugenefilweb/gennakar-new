<?php

namespace app\tests\fixtures;

class CountryFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Country';
    public $dataFile = '@app/tests/fixtures/data/country.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
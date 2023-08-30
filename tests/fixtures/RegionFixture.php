<?php

namespace app\tests\fixtures;

class RegionFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Region';
    public $dataFile = '@app/tests/fixtures/data/region.php';
    public $depends = [
        'app\tests\fixtures\UserFixture',
        'app\tests\fixtures\CountryFixture',
    ];
}
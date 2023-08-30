<?php

namespace app\tests\fixtures;

class ProvinceFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Province';
    public $dataFile = '@app/tests/fixtures/data/province.php';
    public $depends = [
        'app\tests\fixtures\UserFixture',
        'app\tests\fixtures\RegionFixture',
    ];
}
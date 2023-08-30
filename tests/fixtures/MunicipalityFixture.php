<?php

namespace app\tests\fixtures;

class MunicipalityFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Municipality';
    public $dataFile = '@app/tests/fixtures/data/municipality.php';
    public $depends = [
        'app\tests\fixtures\UserFixture',
        'app\tests\fixtures\ProvinceFixture',
    ];
}
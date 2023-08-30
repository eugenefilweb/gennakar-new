<?php

namespace app\tests\fixtures;

class RefprovinceFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Refprovince';
    public $dataFile = '@app/tests/fixtures/data/refprovince.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
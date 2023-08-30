<?php

namespace app\tests\fixtures;

class RefregionFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Refregion';
    public $dataFile = '@app/tests/fixtures/data/refregion.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
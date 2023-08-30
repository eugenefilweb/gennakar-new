<?php

namespace app\tests\fixtures;

class WatershedFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Watershed';
    public $dataFile = '@app/tests/fixtures/data/watershed.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
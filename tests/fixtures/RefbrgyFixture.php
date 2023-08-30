<?php

namespace app\tests\fixtures;

class RefbrgyFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Refbrgy';
    public $dataFile = '@app/tests/fixtures/data/refbrgy.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
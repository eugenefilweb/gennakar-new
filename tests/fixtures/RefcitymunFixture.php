<?php

namespace app\tests\fixtures;

class RefcitymunFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Refcitymun';
    public $dataFile = '@app/tests/fixtures/data/refcitymun.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
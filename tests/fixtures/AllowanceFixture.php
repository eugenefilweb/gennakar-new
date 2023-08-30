<?php

namespace app\tests\fixtures;

class AllowanceFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Allowance';
    public $dataFile = '@app/tests/fixtures/data/allowance.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
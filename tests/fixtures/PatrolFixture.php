<?php

namespace app\tests\fixtures;

class PatrolFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Patrol';
    public $dataFile = '@app/tests/fixtures/data/patrol.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
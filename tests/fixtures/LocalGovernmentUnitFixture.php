<?php

namespace app\tests\fixtures;

class LocalGovernmentUnitFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\LocalGovernmentUnit';
    public $dataFile = '@app/tests/fixtures/data/local-government-unit.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
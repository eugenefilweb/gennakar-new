<?php

namespace app\tests\fixtures;

class EarlyWarningFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\EarlyWarning';
    public $dataFile = '@app/tests/fixtures/data/early-warning.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
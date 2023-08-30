<?php

namespace app\tests\fixtures;

class StatementFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Statement';
    public $dataFile = '@app/tests/fixtures/data/statement.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
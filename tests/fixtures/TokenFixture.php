<?php

namespace app\tests\fixtures;

class TokenFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Token';
    public $dataFile = '@app/tests/fixtures/data/token.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
<?php

namespace app\tests\fixtures;

class RequestFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Request';
    public $dataFile = '@app/tests/fixtures/data/request.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
<?php

namespace app\tests\fixtures;

class RequestLogFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\RequestLog';
    public $dataFile = '@app/tests/fixtures/data/request-log.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
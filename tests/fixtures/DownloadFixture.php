<?php

namespace app\tests\fixtures;

class DownloadFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Download';
    public $dataFile = '@app/tests/fixtures/data/download.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
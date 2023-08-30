<?php

namespace app\tests\fixtures;

class DirectoryFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Directory';
    public $dataFile = '@app/tests/fixtures/data/directory.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
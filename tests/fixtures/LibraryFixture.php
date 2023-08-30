<?php

namespace app\tests\fixtures;

class LibraryFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Library';
    public $dataFile = '@app/tests/fixtures/data/library.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
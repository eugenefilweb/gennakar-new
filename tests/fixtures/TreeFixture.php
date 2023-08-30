<?php

namespace app\tests\fixtures;

class TreeFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Tree';
    public $dataFile = '@app/tests/fixtures/data/tree.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
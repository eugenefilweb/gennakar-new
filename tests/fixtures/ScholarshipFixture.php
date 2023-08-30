<?php

namespace app\tests\fixtures;

class ScholarshipFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Scholarship';
    public $dataFile = '@app/tests/fixtures/data/scholarship.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
<?php

namespace app\tests\fixtures;

class PdsEducationFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\PdsEducation';
    public $dataFile = '@app/tests/fixtures/data/pds-education.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
<?php

namespace app\tests\fixtures;

class PdsTrainingProgramFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\PdsTrainingProgram';
    public $dataFile = '@app/tests/fixtures/data/pds-training-program.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
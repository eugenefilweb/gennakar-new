<?php

namespace app\tests\fixtures;

class PdsWorkExperienceFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\PdsWorkExperience';
    public $dataFile = '@app/tests/fixtures/data/pds-work-experience.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
<?php

namespace app\tests\fixtures;

class PersonalDataSheetFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\PersonalDataSheet';
    public $dataFile = '@app/tests/fixtures/data/personal-data-sheet.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
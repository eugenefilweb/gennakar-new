<?php

namespace app\tests\fixtures;

class MeetingFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Meeting';
    public $dataFile = '@app/tests/fixtures/data/meeting.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
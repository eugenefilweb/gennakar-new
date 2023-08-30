<?php

namespace app\tests\fixtures;

class EventMemberFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\EventMember';
    public $dataFile = '@app/tests/fixtures/data/event-member.php';
    public $depends = [
        'app\tests\fixtures\UserFixture',
        'app\tests\fixtures\EventFixture',
        'app\tests\fixtures\MemberFixture',
    ];
}
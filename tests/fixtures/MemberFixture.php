<?php

namespace app\tests\fixtures;

class MemberFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Member';
    public $dataFile = '@app/tests/fixtures/data/member.php';
    public $depends = [
        'app\tests\fixtures\UserFixture',
        'app\tests\fixtures\HouseholdFixture',
    ];
}
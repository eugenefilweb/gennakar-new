<?php

namespace app\tests\fixtures;

class HouseholdMemberFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\HouseholdMember';
    public $dataFile = '@app/tests/fixtures/data/household-member.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}
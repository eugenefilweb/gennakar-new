<?php

use app\models\HouseholdMember;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'household_id' => 1,
		'member_id' => 1,
		'status' => HouseholdMember::REMOVED,
		'record_status' => HouseholdMember::RECORD_ACTIVE,
		'created_by' => 1,
	    'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => HouseholdMember::RECORD_INACTIVE
]);

return $model->getData();
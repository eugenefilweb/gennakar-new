<?php

use app\models\EventMember;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'event_id' => 1,
		'member_id' => 1,
		'status' => EventMember::CLAIMED,
		'photo' => '',
		'record_status' => EventMember::RECORD_ACTIVE,
		'created_by' => 1,
	    'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'member_id' => 6,
	'record_status' => EventMember::RECORD_INACTIVE
]);

return $model->getData();
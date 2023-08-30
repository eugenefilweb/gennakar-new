<?php

use app\models\TechIssue;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'user_id' => 'User ID',
		'type' => 'Type',
		'steps' => 'Steps',
		'description' => 'Description',
		'photos' => 'Photos',
		'status' => 'Status',
		'ip' => 'Ip',
		'browser' => 'Browser',
		'os' => 'Os',
		'device' => 'Device',
		'server' => 'Server',
		'record_status' => TechIssue::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => TechIssue::RECORD_INACTIVE
]);

return $model->getData();
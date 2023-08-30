<?php

use app\models\Request;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'name' => 'Name',
		'description' => 'Description',
		'files' => '[]',
		'token' => 'token',
		'record_status' => Request::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'name' => 'inactive',
	'token' => 'token-inactive',
	'record_status' => Request::RECORD_INACTIVE
]);

return $model->getData();
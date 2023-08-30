<?php

use app\models\RequestLog;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'request_id' => 'Request ID',
		'description' => 'Description',
		'record_status' => RequestLog::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => RequestLog::RECORD_INACTIVE
]);

return $model->getData();
<?php

use app\models\TransactionLog;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'transaction_id' => 1,
		'status' => 1,
		'remarks' => 'Remarks',
		'record_status' => TransactionLog::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => TransactionLog::RECORD_INACTIVE
]);

return $model->getData();
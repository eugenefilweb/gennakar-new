<?php

use app\models\Allowance;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'semester' => 'Semester',
		'amount' => 'Amount',
		'status' => 'Status',
		'documents' => 'Documents',
		'remarks' => 'Remarks',
		'record_status' => Allowance::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Allowance::RECORD_INACTIVE
]);

return $model->getData();
<?php

use app\models\Statement;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'vehicular_accident_report_id' => 'Vehicular Accident Report ID',
		'type' => 'Type',
		'name' => 'Name',
		'statement' => 'Statement',
		'date' => 'Date',
		'plate_no' => 'Plate No',
		'signature' => 'Signature',
		'position' => 'Position',
		'address' => 'Address',
		'contact_info' => 'Contact Info',
		'record_status' => Statement::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Statement::RECORD_INACTIVE
]);

return $model->getData();
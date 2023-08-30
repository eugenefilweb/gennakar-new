<?php

use app\models\LocalGovernmentUnit;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'lgu_name' => 'Lgu Name',
		'lgu_address' => 'Lgu Address',
		'lgu_classification' => 'Lgu Classification',
		'lgu_region' => 'Lgu Region',
		'name' => 'Name',
		'position' => 'Position',
		'contact_no' => 'Contact No',
		'email' => 'Email',
		'date_of_assessment' => 'Date Of Assessment',
		'date_submitted' => 'Date Submitted',
		'record_status' => LocalGovernmentUnit::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => LocalGovernmentUnit::RECORD_INACTIVE
]);

return $model->getData();
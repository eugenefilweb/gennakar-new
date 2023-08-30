<?php

use app\models\PdsOrganization;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'pds_id' => 'Pds ID',
		'name' => 'Name',
		'address' => 'Address',
		'from' => 'From',
		'to' => 'To',
		'no_of_hours' => 'No Of Hours',
		'position' => 'Position',
		'record_status' => PdsOrganization::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => PdsOrganization::RECORD_INACTIVE
]);

return $model->getData();
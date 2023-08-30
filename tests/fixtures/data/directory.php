<?php

use app\models\Directory;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'name' => 'Name',
		'type' => 'Type',
		'address' => 'Address',
		'contact_no' => 'Contact No',
		'record_status' => Directory::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Directory::RECORD_INACTIVE
]);

return $model->getData();
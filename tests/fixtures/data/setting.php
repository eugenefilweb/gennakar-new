<?php

use app\models\EventCategory;
use app\models\Setting;
use yii\db\Expression;
use yii\helpers\Inflector;

$model = new \app\helpers\FixtureData(function($name) {
    return [
		'name' => $name,
		'value' => 'Asia/Manila',
		'slug' => Inflector::slug($name),
		'type' => Setting::TYPE_INPUT,
		'sort_order' => 0,
		'record_status' => Setting::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
	];
});

$model->add('timezone', 'timezone');
$model->add('inactive', 'inactive', [
	'value' => 'inactive',
    'record_status' => Setting::RECORD_INACTIVE,
]);

$model->add('Disaster Mitigation and Preparedness', 'Disaster Mitigation and Preparedness', [
	'value' => 'Disaster Mitigation and Preparedness',
	'type' => EventCategory::TYPE,
]);

$model->add('Disaster Response and Recovery', 'Disaster Response and Recovery', [
	'value' => 'Disaster Response and Recovery',
	'type' => EventCategory::TYPE,
]);

$model->add('Emergency Shelter Assistance', 'Emergency Shelter Assistance', [
	'value' => 'Emergency Shelter Assistance',
	'type' => EventCategory::TYPE,
]);

$model->add('Family and Community Disaster Awareness', 'Family and Community Disaster Awareness', [
	'value' => 'Family and Community Disaster Awareness',
	'type' => EventCategory::TYPE,
]);

$model->add('Crisis Intervention', 'Crisis Intervention', [
	'value' => 'Crisis Intervention',
	'type' => EventCategory::TYPE,
]);

$model->add('Training and Capacity Building', 'Training and Capacity Building', [
	'value' => 'Training and Capacity Building',
	'type' => EventCategory::TYPE,
]);

return $model->getData();
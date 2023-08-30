<?php

use app\models\EarlyWarning;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'subject' => 'Subject',
		'meteorological_conditions' => 'Meteorological Conditions',
		'impact_of_winds' => 'Impact Of Winds',
		'precautionary_measures' => 'Precautionary Measures',
		'bulletin_no' => 'Bulletin No',
		'signal_no' => 'Signal No',
		'category' => 'Category',
		'windspeed' => 'Windspeed',
		'mayor_firstname' => 'Mayor Firstname',
		'mayor_middlename' => 'Mayor Middlename',
		'mayor_lastname' => 'Mayor Lastname',
		'message' => 'Message',
		'entry_text' => 'Entry Text',
		'attachment_text' => 'Attachment Text',
		'other_text' => 'Other Text',
		'attachments' => 'Attachments',
		'record_status' => EarlyWarning::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => EarlyWarning::RECORD_INACTIVE
]);

return $model->getData();
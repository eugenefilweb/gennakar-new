<?php

use app\models\PostAccidentReport;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'location' => 'Location',
		'control_no' => 'Control No',
		'type_of_accident' => 'Type Of Accident',
		'participant_male' => 0,
		'participant_female' => 0,
		'local_male' => 0,
		'local_female' => 0,
		'national_male' => 0,
		'national_female' => 0,
		'other_name' => 'Other Name',
		'other_male' => 0,
		'other_female' => 0,
		'date_time' => date('Y-m-d h:i:s'),
		'weather_condition' => 'Weather Condition',
		'persons_of_interest' => null,
		'responders' => null,
		'witnesses' => null,
		'accident_report' => 'Accident Report',
		'prepared_by' => 'Prepared By',
		'verified_by' => 'Verified By',
		'remarks' => 'Remarks',
		'comments_by' => 'Comments By',
		'officer_in_charge' => 'Officer In Charge',
		'noted_by' => 'Noted By',
		'code' => 'Code',
		'map' => 'Map',
		'barangay' => 'barangay',
		'record_status' => PostAccidentReport::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'control_no' => 'control_no-inactive',
	'code' => 'code-inactive',
	'record_status' => PostAccidentReport::RECORD_INACTIVE
]);

return $model->getData();
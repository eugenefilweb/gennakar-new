<?php

use app\models\PostActivityReport;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'type' => PostActivityReport::TYPE_SIAD,
    	'watershed_id' => 1,
		'control_no' => 'Control No',
		'name' => 'Name',
		'location' => 'Location',
		'type_of_activity' => 'Type Of Activity',
		'beneficiary_stakeholder_male' => 1,
        'beneficiary_stakeholder_female' => 1,
        'beneficiary_local_male' => 1,
        'beneficiary_local_female' => 1,
        'beneficiary_national_male' => 1,
        'beneficiary_national_female' => 1,
		'date_started' => '2022-10-21 00:00:00',
		'date_end' => '2022-10-22 00:00:00',
		'responsible_head' => 'Responsible Head',
		'coordinators' => json_encode(['Coordinator']),
		'staff_members' => json_encode(['Staff Members']),
		'other_members' => json_encode(['Others']),
		'activity_brief' => 'Activity Brief',
		'prepared_by' => 'Prepared By',
		'verified_by' => 'Verified By',
		'remarks' => 'Remarks',
		'comments_by' => 'Comments By',
		'in_charge_of_activity' => 'In Charge Of Activity',
		'noted_by' => 'Noted By',
		'code' => 'Code',
		'record_status' => PostActivityReport::RECORD_ACTIVE,
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
	'record_status' => PostActivityReport::RECORD_INACTIVE
]);

return $model->getData();
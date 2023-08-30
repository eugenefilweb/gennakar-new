<?php

use app\models\File;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
        'name' => $params['name'] ?? 'default-image_200', 
        'tag' =>  $params['tag'] ?? 'Setting',
        'extension' => $params['extension'] ?? 'png',
        'size' => $params['size'] ?? 1606,
        'location' => $params['location'] ?? 'default/default-image_200.png',
        'token' => $params['token'] ?? 'default-6ccb4a66-0ca3-46c7-88dd-default',
        'record_status' => File::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('profile', [
    'tag' => 'User'
]);

$model->add('backup', [
    'name' => 'default-backup', 
    'tag' => 'Backup',
    'extension' => 'sql',
    'size' => 81341,
    'location' => 'default/default-backup.sql',
    'token' => 'default-OxFBeC2Dzw1624513904-default',
]);

$model->add('household', [
    'name' => 'household', 
    'tag' => 'Household',
    'extension' => 'csv',
    'size' => 8000,
    'location' => 'default/tests/household.csv',
    'token' => 'household-OxFBeC2Dzw1624513904-household',
]);
$model->add('household-test-update', [
    'name' => 'household-test-update', 
    'tag' => 'Household',
    'extension' => 'csv',
    'size' => 8000,
    'location' => 'default/tests/household-test-update.csv',
    'token' => 'household-test-update-OxFBeC2Dzw1624513904-household-test-update',
]);

$model->add('invalid-household', [
    'name' => 'invalid-household-fromat', 
    'tag' => 'Household',
    'extension' => 'csv',
    'size' => 1000,
    'location' => 'default/tests/invalid-household-fromat.csv',
    'token' => 'invalid-household-OxFBeC2Dzw1624513904-invalid-household',
]);

$model->add('members', [
    'name' => 'members', 
    'tag' => 'Member',
    'extension' => 'csv',
    'size' => 2000,
    'location' => 'default/tests/members.csv',
    'token' => 'members-OxFBeC2Dzw1624513904-members',
]);

$model->add('members-test-update', [
    'name' => 'members-test-update', 
    'tag' => 'Member',
    'extension' => 'csv',
    'size' => 8000,
    'location' => 'default/tests/members-test-update.csv',
    'token' => 'members-test-update-OxFBeC2Dzw1624513904-members-test-update',
]);


$model->add('household-map-icon', [
    'name' => 'household-map-icon', 
    'tag' => 'Setting',
    'extension' => 'png',
    'size' => 2000,
    'location' => 'default/household-map-icon.png',
    'token' => 'household-map-icon-6ccb4a66-0ca3-46c7-88dd-household-map-icon',
]);

$model->add('municipal_id-template', [
    'name' => 'municipal_id-template', 
    'tag' => 'Setting',
    'extension' => 'png',
    'size' => 2000,
    'location' => 'default/municipal_id-template.png',
    'token' => 'municipal_id-template-6ccb4a66-0ca3-46c7-88dd-municipal_id-template',
]);

$model->add('municipality-logo', [
    'name' => 'municipality-logo', 
    'tag' => 'Setting',
    'extension' => 'png',
    'size' => 2000,
    'location' => 'default/municipality-logo.png',
    'token' => 'municipality-logo-6ccb4a66-0ca3-46c7-88dd-municipality-logo',
]);

$model->add('social-welfare-logo', [
    'name' => 'social-welfare-logo', 
    'tag' => 'Setting',
    'extension' => 'png',
    'size' => 2000,
    'location' => 'default/social-welfare-logo.png',
    'token' => 'social-welfare-logo-6ccb4a66-0ca3-46c7-88dd-social-welfare-logo',
]);

$model->add('inactive', ['name' => 'default-inactive'], [
    'tag' => 'Setting',
    'record_status' => File::RECORD_INACTIVE,
    'token' => 'inactive-OxFBeC2Dzw1624513904-inactive',
]);


$model->add('survey', [
    'name' => 'survey', 
    'tag' => 'Special Survey',
    'extension' => 'csv',
    'size' => 8000,
    'location' => 'default/tests/survey.csv',
    'token' => 'survey-OxFBeC2Dzw1624513904-survey',
]);
$model->add('invalid-survey', [
    'name' => 'invalid-survey-format', 
    'tag' => 'Special Survey',
    'extension' => 'csv',
    'size' => 1000,
    'location' => 'default/tests/invalid-survey-format.csv',
    'token' => 'invalid-survey-OxFBeC2Dzw1624513904-invalid-survey',
]);

return $model->getData();
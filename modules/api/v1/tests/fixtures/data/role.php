<?php

use yii\helpers\Inflector;
use app\modules\api\v1\helpers\App;
use app\modules\api\v1\models\Role;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($name) {
    return [
        'name' => $name, 
        'role_access' => json_encode([]),
        'module_access' => json_encode(App::component('access')->controllerActions),
        'main_navigation' => json_encode(App::component('access')->defaultNavigation),
        'slug' => Inflector::slug($name), 
        'record_status' => Role::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$no_inactive_data_access = [];
foreach (App::component('access')->controllerActions as $controllerID => $actions) {
    foreach ($actions as $key => $action) {
        if ($action != 'in-active-data') {
            $no_inactive_data_access[$controllerID][] = $action;
        }

    }
}

$model->add('developer', 'developer', [
    'role_access' => json_encode([1,2,3])
]);
$model->add('superadmin', 'superadmin', [
    'role_access' => json_encode([2,3])
]);
$model->add('admin', 'admin', [
    'role_access' => json_encode([3])
]);


// $model->add('mswdo-clerk', 'mswdo-clerk', [
//     'role_access' => json_encode([Role::MSWDO_CLERK])
// ]);
// $model->add('mswdo-head', 'mswdo-head', [
//     'role_access' => json_encode([Role::MSWDO_HEAD])
// ]);
// $model->add('mho', 'mho', [
//     'role_access' => json_encode([Role::MHO])
// ]);
// $model->add('mayor', 'mayor', [
//     'role_access' => json_encode([Role::MAYOR])
// ]);
// $model->add('budget-officer', 'budget-officer', [
//     'role_access' => json_encode([Role::BUDGET_OFFICER])
// ]);
// $model->add('accounting-officer', 'accounting-officer', [
//     'role_access' => json_encode([Role::ACCOUNTING_OFFICER])
// ]);
// $model->add('disbursing-officer', 'disbursing-officer', [
//     'role_access' => json_encode([Role::DISBURSING_OFFICER])
// ]);

$model->add('inactiverole', 'inactiverole', [
    'record_status' => Role::RECORD_INACTIVE,
]);
$model->add('nouser', 'nouser');
$model->add('no_inactive_data_access', 'no_inactive_data_access', [
    'module_access' => json_encode($no_inactive_data_access),
]);

return $model->getData();
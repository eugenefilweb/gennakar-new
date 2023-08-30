<?php

use app\models\Role;
use yii\db\Expression;
use yii\helpers\Inflector;

/**
 * Handles the creation of table `{{%roles}}`.
 */
class m200912_035017_create_roles_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%roles}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull()->unique(),
            'main_navigation' => $this->text(),
            'role_access' => $this->text(),
            'module_access' => $this->text(),
            'slug' => $this->string()->notNull()->unique(),
        ]));

        $this->seed();
    }

    public function seed()
    {
        $access = \Yii::$app->access;
        $controllerActions = $access->controllerActions;
        $defaultNavigation = $access->defaultNavigation;
        
        $rows = [];
        foreach ($this->data() as $data) {
            list($name, $role_access) = $data;

            $rows[] = [
                'name' => $name,
                'role_access' => json_encode($role_access),
                'module_access' => json_encode($controllerActions),
                'main_navigation' => json_encode($defaultNavigation),
                'slug' => Inflector::slug($name), 
                'record_status' => Role::RECORD_ACTIVE,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => new Expression('UTC_TIMESTAMP'),
                'updated_at' => new Expression('UTC_TIMESTAMP'),
            ];
        }
        $this->batchInsert($this->tableName(), array_keys($rows[0]), $rows);
    }

    public function data()
    {
        return [
            ['developer', [Role::DEVELOPER, Role::SUPERADMIN, Role::ADMIN]],
            ['superadmin', [Role::SUPERADMIN, Role::ADMIN]],
            ['admin', [Role::ADMIN]],
            ['mswdo-clerk', [Role::MSWDO_CLERK]],
            ['mswdo-head', [Role::MSWDO_HEAD]],
            ['mho', [Role::MHO]],
            ['mayor', [Role::MAYOR]],
            ['budget-officer', [Role::BUDGET_OFFICER]],
            ['accounting-officer', [Role::ACCOUNTING_OFFICER]],
            ['disbursing-officer', [Role::DISBURSING_OFFICER]],
            ['treasurer', [Role::TREASURER]],
            ['planning_officer', [Role::PLANNING_OFFICER]],
            ['siad', [Role::SIAD]],
            ['drrm', [Role::DRRM]],
            ['request-approver', [Role::REQUEST_APPROVER]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName());
    }
}
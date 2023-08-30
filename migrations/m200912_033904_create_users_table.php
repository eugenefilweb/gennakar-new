<?php

use app\models\Role;
use app\models\User;
use yii\db\Expression;
use yii\helpers\Inflector;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200912_033904_create_users_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'role_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'username' => $this->string(64)->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_hint' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'verification_token' => $this->string()->unique(),
            'access_token' => $this->string()->unique(),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(10),
            'slug' => $this->string()->notNull()->unique(),
            'is_blocked' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'photo' => $this->text(),
            'login_type' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'google2fa' => $this->string(),
            'google2fa_ts' => $this->bigInteger(20)->notNull()->defaultValue(0)
        ]));

        $this->createIndexes($this->tableName(), [
            'role_id' => 'role_id',
        ]);

        $this->seed();
    }

    public function seed()
    {
        $rows = [];

        foreach ($this->data() as $data) {
            list($username, $role_id) = $data;
            $email = "{$username}@{$username}.com";

            $rows[] = [
                'role_id' => $role_id,
                'username' => $username, 
                'email' => $email,
                'auth_key' => "auth_key-{$username}",
                'password_hash' => Yii::$app->security->generatePasswordHash($email),
                'password_hint' => 'Same as Email',
                'password_reset_token' => "password_reset_token-{$username}",
                'verification_token' => "verification_token-{$username}",
                'access_token' => "access_token-{$username}",
                'status' => User::STATUS_ACTIVE,
                'slug' => Inflector::slug($username), 
                'is_blocked' => User::UNBLOCKED,
                'record_status' => User::RECORD_ACTIVE,
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
            ['developer', Role::DEVELOPER],
            ['superadmin', Role::SUPERADMIN],
            ['admin', Role::ADMIN],
            ['mswdoclerk', Role::MSWDO_CLERK],
            ['mswdohead', Role::MSWDO_HEAD],
            ['mho', Role::MHO],
            ['mayor', Role::MAYOR],
            ['budgetofficer', Role::BUDGET_OFFICER],
            ['accountingofficer', Role::ACCOUNTING_OFFICER],
            ['disbursingofficer', Role::DISBURSING_OFFICER],
            ['treasurer', Role::TREASURER],
            ['siad', Role::SIAD],
            ['drrm', Role::DRRM],
            ['requestapprover', Role::REQUEST_APPROVER],
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
<?php

use app\models\Budget;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%budgets}}`.
 */
class m220525_011342_create_budgets_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%budgets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'year' => $this->integer()->notNull(),
            'type' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'budget' => $this->decimal(11, 2),
            'action' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'specific_to' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'model_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'remarks' => $this->text(),
        ]));

        $this->createIndexes($this->tableName(), [
            'model_id' => 'model_id',
        ]);

        // $this->insert($this->tableName(), [
        //     'year' => date('Y'),
        //     'type' => Budget::EMERGENCY_WELFARE_PROGRAM,
        //     'budget' => 999999,
        //     'action' => Budget::INITIAL,
        //     'record_status' => Budget::RECORD_ACTIVE,
        //     'created_at' => new Expression('UTC_TIMESTAMP'),
        //     'updated_at' => new Expression('UTC_TIMESTAMP'),
        // ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName());
    }
}
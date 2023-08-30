<?php

/**
 * Handles the creation of table `{{%transaction_logs}}`.
 */
class m220325_075047_create_transaction_logs_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%transaction_logs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'transaction_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'status' => $this->tinyInteger(2)->notNull(),
            'remarks' => $this->text(),
        ]));

        $this->createIndexes($this->tableName(), [
            'transaction_id' => 'transaction_id',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName());
    }
}
<?php

/**
 * Handles the creation of table `{{%ledgers}}`.
 */
class m230530_052544_create_ledgers_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%ledgers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'amount' => $this->decimal(11, 2)->notNull()->defaultValue(0),
            'date' => $this->date(),
            'remarks' => $this->text(),
            'token' => $this->string(),
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName());
    }
}
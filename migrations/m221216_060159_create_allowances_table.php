<?php

/**
 * Handles the creation of table `{{%allowances}}`.
 */
class m221216_060159_create_allowances_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%allowances}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'scholarship_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'semester' => $this->string()->notNull(),
            'amount' => $this->decimal(11, 2)->notNull()->defaultValue(0),
            'status' => $this->tinyInteger(2)->notNull()->defaultValue(0),

            'documents' => $this->text(),
            'remarks' => $this->text(),
            'token' => $this->string(),

            'date' => $this->date(),
        ]));

        $this->createIndexes($this->tableName(), [
            'scholarship_id' => 'scholarship_id',
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
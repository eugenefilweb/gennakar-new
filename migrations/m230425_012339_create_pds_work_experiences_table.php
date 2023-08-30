<?php

/**
 * Handles the creation of table `{{%pds_work_experiences}}`.
 */
class m230425_012339_create_pds_work_experiences_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%pds_work_experiences}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'pds_id' => $this->bigInteger(20)->notNull(),
            'from' => $this->date(),
            'to' => $this->date(),
            'position' => $this->string()->notNull(),
            'company' => $this->string()->notNull(),
            'salary' => $this->decimal(11, 2)->defaultValue(0),
            'salary_increment' => $this->string(),
            'appointment_status' => $this->string(),
            'government_service' => $this->tinyInteger(),
        ]));

        $this->createIndexes($this->tableName(), [
            'pds_id' => 'pds_id',
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
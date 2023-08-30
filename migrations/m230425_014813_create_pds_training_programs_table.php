<?php

/**
 * Handles the creation of table `{{%pds_training_programs}}`.
 */
class m230425_014813_create_pds_training_programs_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%pds_training_programs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'pds_id' => $this->bigInteger(20)->notNull(),
            'title' => $this->string()->notNull(),
            'from' => $this->date(),
            'to' => $this->date(),
            'no_of_hours' => $this->integer(),
            'type' => $this->string(),
            'conducted' => $this->string(),
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
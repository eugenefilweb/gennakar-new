<?php

/**
 * Handles the creation of table `{{%pds_educations}}`.
 */
class m230425_011622_create_pds_educations_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%pds_educations}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'pds_id' => $this->bigInteger(20)->notNull(),
            'level' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'course' => $this->string(),
            'from' => $this->date()->notNull(),
            'to' => $this->date(),
            'highest_level' => $this->string(),
            'year_graduated' => $this->string(),
            'academic_honor' => $this->string(),
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
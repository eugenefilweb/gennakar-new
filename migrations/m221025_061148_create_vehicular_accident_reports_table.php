<?php

/**
 * Handles the creation of table `{{%vehicular_accident_reports}}`.
 */
class m221025_061148_create_vehicular_accident_reports_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%vehicular_accident_reports}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'control_no' => $this->string()->notNull()->unique(),
            'vehicles' => 'MEDIUMTEXT',
            
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
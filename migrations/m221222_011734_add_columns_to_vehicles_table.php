<?php

/**
 * Handles adding columns to table `{{%vehicles}}`.
 */
class m221222_011734_add_columns_to_vehicles_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%vehicles}}';
    }

    public function columns()
    {
        return [
            'vehicular_accident_report_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
        ];

        // FOR SETTING utf
        // ->append('CHARACTER SET utf8 COLLATE utf8_general_ci')
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumns($this->tableName(), $this->columns());
        
        $this->createIndexes($this->tableName(), [
            'vehicular_accident_report_id' => 'vehicular_accident_report_id',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumns($this->tableName(), $this->columns());
    }
}

<?php

/**
 * Handles adding columns to table `{{%passengers}}`.
 */
class m221228_083756_add_columns_to_passengers_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%passengers}}';
    }

    public function columns()
    {
        return [
            'vehicle_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
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
            'vehicle_id' => 'vehicle_id',
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

<?php

/**
 * Handles adding columns to table `{{%vehicles}}`.
 */
class m221222_065042_add_columns_to_vehicles_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%vehicles}}';
    }

    public function columns()
    {
        return [
            'photo' => $this->string(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumns($this->tableName(), $this->columns());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumns($this->tableName(), $this->columns());
    }
}

<?php

/**
 * Handles adding columns to table `{{%libraries}}`.
 */
class m221209_073551_add_columns_to_libraries_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%libraries}}';
    }

    public function columns()
    {
        return [
            'gallery' => $this->text(),
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumns($this->tableName(), $this->columns());
    }
}

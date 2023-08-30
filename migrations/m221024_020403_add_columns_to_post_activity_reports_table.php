<?php

/**
 * Handles adding columns to table `{{%post_activity_reports}}`.
 */
class m221024_020403_add_columns_to_post_activity_reports_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%post_activity_reports}}';
    }

    public function columns()
    {
        return [
            'type' => $this->tinyInteger(2)->notNull()->defaultValue(1),
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

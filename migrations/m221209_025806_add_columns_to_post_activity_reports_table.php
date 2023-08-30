<?php

/**
 * Handles adding columns to table `{{%post_activity_reports}}`.
 */
class m221209_025806_add_columns_to_post_activity_reports_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%post_activity_reports}}';
    }

    public function columns()
    {
        return [
            'barangay_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
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
            'barangay_id' => 'barangay_id',
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

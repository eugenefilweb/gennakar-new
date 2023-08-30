<?php

/**
 * Handles adding columns to table `{{%post_accident_reports}}`.
 */
class m221206_053629_add_columns_to_post_accident_reports_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%post_accident_reports}}';
    }

    public function columns()
    {
        return [
            'name_of_rescuee' => $this->string(),
            'date_of_birth' => $this->date(),
            'street_address' => $this->string(),
            'barangay_address' => $this->string(),
            'age' => $this->smallInteger(6),
            'sex' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'pre_existing_condition' => $this->string()
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

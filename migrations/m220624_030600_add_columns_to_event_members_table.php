<?php

/**
 * Handles adding columns to table `{{%event_members}}`.
 */
class m220624_030600_add_columns_to_event_members_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%event_members}}';
    }

    public function columns()
    {
        return [
            'name' => $this->string(),
            'qr_id' => $this->string(),
            'household_no' => $this->string(),
            'family_head' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'solo_parent' => $this->tinyInteger(2)->notNull()->defaultValue(2),
            'gender' => $this->string(),
            'civil_status' => $this->string(),
            'educational_attainment' => $this->string(),
            'pwd' => $this->tinyInteger(2)->notNull()->defaultValue(2),
            'pwd_type' => $this->string(),
            'barangay' => $this->string(),
            'purok_no' => $this->string(),
            'age' => $this->integer()->notNull()->defaultValue(0),
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

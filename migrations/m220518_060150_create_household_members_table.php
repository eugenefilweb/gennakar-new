<?php

/**
 * Handles the creation of table `{{%household_members}}`.
 */
class m220518_060150_create_household_members_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%household_members}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'household_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'member_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
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
<?php

/**
 * Handles the creation of table `{{%event_members}}`.
 */
class m220504_013538_create_event_members_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%event_members}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'event_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'member_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'photo' => $this->text(),
        ]));

        $this->createIndexes($this->tableName(), [
            'event_id' => 'event_id',
            'member_id' => 'member_id',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName());
    }
}
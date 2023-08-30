<?php

/**
 * Handles the creation of table `{{%events}}`.
 */
class m220427_013424_create_events_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%events}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'beneficiaries' => $this->text(),
            'token' => $this->text(),
            'status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'photo' => $this->text(),
            'date_from' => $this->datetime()->notNull(),
            'date_to' => $this->datetime()->notNull(),
            'amount' => $this->decimal(11, 2)->notNull()->defaultValue(0),
            'type' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'category_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
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
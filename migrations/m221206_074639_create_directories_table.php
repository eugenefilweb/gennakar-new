<?php

/**
 * Handles the creation of table `{{%directories}}`.
 */
class m221206_074639_create_directories_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%directories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'type' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'email' => $this->string(),
            'notes' => $this->text(),
            'position' => $this->string(),
            'address' => $this->text(),
            'contact_no' => $this->string(),
            'photo' => $this->string(),
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
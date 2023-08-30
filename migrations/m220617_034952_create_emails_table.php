<?php

/**
 * Handles the creation of table `{{%emails}}`.
 */
class m220617_034952_create_emails_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%emails}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'to' => $this->string()->notNull(),
            'from_email' => $this->string()->notNull(),
            'from_name' => $this->string(),
            'subject' => $this->string()->notNull(),
            'body' => 'LONGTEXT',
            'token' => $this->text(),
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
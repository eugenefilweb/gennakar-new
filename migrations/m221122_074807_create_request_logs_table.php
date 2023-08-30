<?php

/**
 * Handles the creation of table `{{%request_logs}}`.
 */
class m221122_074807_create_request_logs_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%request_logs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'request_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'description' => $this->text(),
            'title' => $this->string(),
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
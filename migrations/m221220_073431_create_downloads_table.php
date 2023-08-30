<?php

/**
 * Handles the creation of table `{{%downloads}}`.
 */
class m221220_073431_create_downloads_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%downloads}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->safeDown();
        $this->createTable($this->tableName(), $this->attributes([
            'user_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'file_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
        ]));

        $this->createIndexes($this->tableName(), [
            'user_id' => 'user_id',
            'file_id' => 'file_id',
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
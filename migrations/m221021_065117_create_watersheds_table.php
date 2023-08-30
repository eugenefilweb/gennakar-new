<?php

/**
 * Handles the creation of table `{{%watersheds}}`.
 */
class m221021_065117_create_watersheds_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%watersheds}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->text(),
            'map' => $this->text(),
            'slug' => $this->text(),
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
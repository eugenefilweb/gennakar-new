<?php

/**
 * Handles the creation of table `{{%inventory_items}}`.
 */
class m230419_001952_create_inventory_items_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%inventory_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            'category' => $this->string()->notNull(),
            'quantity' => $this->integer()->notNull()->notNull(),
            'unit' => $this->string()->notNull(),
            'remark' => $this->text(),
            'date' => $this->date(),
            'slug' => $this->string()->notNull(),
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
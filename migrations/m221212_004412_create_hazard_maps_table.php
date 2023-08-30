<?php

/**
 * Handles the creation of table `{{%hazard_maps}}`.
 */
class m221212_004412_create_hazard_maps_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%hazard_maps}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            'type' => $this->tinyInteger(2)->notNull()->defaultValue(1),
            'description' => $this->text(),
            'photo' => $this->string(),
            'gallery' => $this->text(),
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
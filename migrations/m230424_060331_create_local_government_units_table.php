<?php

/**
 * Handles the creation of table `{{%local_government_units}}`.
 */
class m230424_060331_create_local_government_units_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%local_government_units}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'lgu_name' => $this->string()->notNull(),
            'lgu_address' => $this->text(),
            'lgu_classification' => $this->string()->notNull(),
            'lgu_region' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'position' => $this->string()->notNull(),
            'contact_no' => $this->string()->notNull(),
            'email' => $this->string(),
            'date_of_assessment' => $this->date()->notNull(),
            'date_submitted' => $this->datetime(),
            'slug' => $this->string(),
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
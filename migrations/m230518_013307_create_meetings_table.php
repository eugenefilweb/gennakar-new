<?php

/**
 * Handles the creation of table `{{%meetings}}`.
 */
class m230518_013307_create_meetings_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%meetings}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'remarks' => $this->text(),
            'minutes' => $this->text(),
            'minutes_files' => $this->text(),
            'attendance' => $this->text(),
            'attendance_files' => $this->text(),
            'resolutions' => $this->text(),
            'resolutions_file' => $this->text(),
            'photos' => $this->text(),
            'slug' => $this->string(),
            'date_from' => $this->datetime(),
            'date_to' => $this->datetime(),
            'type' => $this->tinyInteger(2)->notNull()->defaultValue(0),
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
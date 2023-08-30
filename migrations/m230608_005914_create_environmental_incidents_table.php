<?php

/**
 * Handles the creation of table `{{%enviromental_incidents}}`.
 */
class m230608_005914_create_environmental_incidents_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%environmental_incidents}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'user_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'date_time' => $this->datetime()->notNull(),
            'longitude' => $this->string(),
            'latitude' => $this->string(),
            'watershed' => $this->string(),
            'description' => $this->text(),
            'additional_details' => $this->text(),
            'photos' => $this->text(),
        ]));

        $this->createIndexes($this->tableName(), [
            'user_id' => 'user_id',
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
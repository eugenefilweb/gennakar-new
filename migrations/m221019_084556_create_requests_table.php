<?php

/**
 * Handles the creation of table `{{%requests}}`.
 */
class m221019_084556_create_requests_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%requests}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            
            'barangay' => $this->string()->notNull(),
            'sex' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'type' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'date_time' => $this->datetime(),

            'address' => $this->text(),
            'pickup_address' => $this->text(),
            'chief_complaint' => $this->string()->notNull(),
            'other_complaints' => $this->string(),
            'destination' => $this->text(),

            'driver' => $this->string(),
            'responders' => $this->text(),
            'patient_companions' => $this->text(),

            'description' => $this->text(),

            'files' => $this->text(),
            'token' => $this->text(),

            'ambulance_dispatched' => $this->tinyInteger(2)->notNull()->defaultValue(0),

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
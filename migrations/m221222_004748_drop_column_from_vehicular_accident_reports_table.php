<?php

/**
 * Handles dropping columns from table `{{%vehicular_accident_reports}}`.
 */
class m221222_004748_drop_column_from_vehicular_accident_reports_table extends \app\migrations\Migration
{

    public function tableName()
    {
        return '{{%vehicular_accident_reports}}';
    }

    public function columns()
    {
        return [
            'responder_statement' => $this->string(),
            'responder_name' => $this->string(),
            'responder_date' => $this->string(),
            'responder_position' => $this->string(),
            'responder_signature' => $this->text(),

            'witness_statement' => $this->string(),
            'witness_name' => $this->string(),
            'witness_date' => $this->string(),
            'witness_address' => $this->string(),
            'witness_contact' => $this->string(),
            'witness_signature' => $this->text(),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumns($this->tableName(), $this->columns());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumns($this->tableName(), $this->columns());
    }
}

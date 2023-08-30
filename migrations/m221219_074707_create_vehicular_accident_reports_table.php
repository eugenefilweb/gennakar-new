<?php

/**
 * Handles the creation of table `{{%vehicular_accident_reports}}`.
 */
class m221219_074707_create_vehicular_accident_reports_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%vehicular_accident_reports}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->safeDown();
        $this->createTable($this->tableName(), $this->attributes([
            'post_accident_report_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'control_no' => $this->string(),
            'code' => $this->string(),
            'latitude' => $this->string(),
            'longitude' => $this->string(),
            'main_cause' => $this->string(),
            'vehicles_involved' => $this->string(),
            
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

            'photos' => $this->text(),
            'other_damages' => $this->text(),
            'collision_type' => $this->string(),
            'weather_condition' => $this->string(),
            'road_condition' => $this->string(),
            'barangay' => $this->string(),
            'landmarks' => $this->string(),
            'road_type' => $this->string(),

            'remarks' => $this->text(),
            'preferred_by' => $this->string(),
            'noted_by' => $this->string(),
            'date' => $this->string(),

            'sketch' => $this->string(),
        ]));

        $this->createIndexes($this->tableName(), [
            'post_accident_report_id' => 'post_accident_report_id',
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
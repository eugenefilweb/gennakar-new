<?php

/**
 * Handles the creation of table `{{%ambulance_dispatch_reports}}`.
 */
class m230428_003602_create_ambulance_dispatch_reports_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%ambulance_dispatch_reports}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'date_time' => $this->datetime()->notNull(),

            // Requesting Party Information
            'requester_name' => $this->string()->notNull(),
            'requester_contact' => $this->string(),
            'requester_relation' => $this->string(),

            // Patient Information
            'patient_name' => $this->string()->notNull(),
            'patient_contact' => $this->string(),
            'patient_age' => $this->integer(),
            'patient_gender' => $this->tinyInteger(2),

            // Incident Information
            'incident_location' => $this->string(),
            'incident_nature' => $this->string(),
            'incident_level' => $this->string(),

            // Dispatch Information
            'unit_id' => $this->string(),
            'dispatched_time' => $this->datetime(),
            'arrival_time' => $this->datetime(),
            'departure_time' => $this->datetime(),
            'arrival_time_facility' => $this->datetime(),
            'patient_condition' => $this->text(),

            // Condition Upon Arrival
            'heart_rate' => $this->string(),
            'blood_pressure' => $this->string(),
            'spo2' => $this->string(),
            'description_of_symptoms' => $this->text(),
            'treatment_administered' => $this->text(),

            // Hospital/Facility Information
            'facility_name' => $this->string(),
            'facility_contact' => $this->string(),
            'facility_receiver' => $this->string(),

            // ERT Information
            'ert_names' => $this->text(),
            'roles' => $this->text(),

            // Vehicle Information
            'vehicle_id' => $this->string(),
            'vehicle_type' => $this->string(),
            'vehicle_mileage' => $this->string(),


            'notes' => $this->text(),
            'prepared_by' => $this->string(),
            'noted_by' => $this->string(),
            'photos' => $this->text(),
            'attachments' => $this->text(),

            'token' => $this->string(),

            'mdrrmo' => $this->string(),
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
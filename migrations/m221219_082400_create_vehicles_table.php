<?php

/**
 * Handles the creation of table `{{%vehicles}}`.
 */
class m221219_082400_create_vehicles_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%vehicles}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->safeDown();
        $this->createTable($this->tableName(), $this->attributes([
            'plate_no' => $this->string(),
            'class' => $this->string(),
            'color' => $this->string(),
            'make' => $this->string(),
            'model' => $this->string(),
            'type' => $this->string(),
            'year' => $this->integer(),

            'is_commercial' => $this->tinyInteger(2)->notNull()->defaultValue(0),

            'driver_firstname' => $this->string(),
            'driver_middlename' => $this->string(),
            'driver_lastname' => $this->string(),
            'driver_suffix' => $this->string(16),
            'driver_address' => $this->string(),
            'driver_email' => $this->string(),
            'driver_contact_no' => $this->string(),
            'driver_alt_contact_no' => $this->string(),

            'company_name' => $this->string(),
            'company_address' => $this->string(),
            'company_contact_no' => $this->string(),

            'type_of_cargo' => $this->string(),
            'or_no' => $this->string(),
            'or_no_date_issued' => $this->string(),
            'cr_no' => $this->string(),
            'cr_no_date_issued' => $this->string(),
            'insurance_company' => $this->string(),

            'insurance_type' => $this->string(),

            'coverage_start_date' => $this->string(),
            'coverage_end_date' => $this->string(),
            'insurance_status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'passengers' => $this->text(),

            'driver_license_front' => $this->string(),
            'driver_license_back' => $this->string(),
            'or_photo' => $this->string(),
            'cr_photo' => $this->string(),
            'statement' => $this->text(),
            'signature' => 'MEDIUMTEXT',
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
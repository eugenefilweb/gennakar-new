<?php

/**
 * Handles the creation of table `{{%personal_data_sheets}}`.
 */
class m230425_003250_create_personal_data_sheets_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%personal_data_sheets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            // PERSONAL INFORMATION
            'surname' => $this->string()->notNull(),
            'first_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'name_extension' => $this->string(),
            'date_of_birth' => $this->date(),
            'place_of_birth' => $this->text(),
            'sex' => $this->tinyInteger(2),
            'civil_status' => $this->string(),
            'height' => $this->decimal(11, 2),
            'weight' => $this->decimal(11, 2),
            'blood_type' => $this->string(),
            'gsis_id_no' => $this->string(),
            'pagibig_id_no' => $this->string(),
            'philhealth_no' => $this->string(),
            'sss_no' => $this->string(),
            'tin_no' => $this->string(),
            'agency_employee_no' => $this->string(),
            'citizenship' => $this->tinyInteger(2),
            'citizenship_type' => $this->tinyInteger(2),
            'dual_citizenship_country' => $this->string(),
            'dual_citizenship_details' => $this->text(),
            
            // residential address
            'ra_house_block_lot_no' => $this->string(),
            'ra_street' => $this->string(),
            'ra_subdivision_village' => $this->string(),
            'ra_barangay' => $this->string(),
            'ra_city_municipality' => $this->string(),
            'ra_province' => $this->string(),
            'ra_zip_code' => $this->string(),

            // permanent address
            'pa_house_block_lot_no' => $this->string(),
            'pa_street' => $this->string(),
            'pa_subdivision_village' => $this->string(),
            'pa_barangay' => $this->string(),
            'pa_city_municipality' => $this->string(),
            'pa_province' => $this->string(),
            'pa_zip_code' => $this->string(),

            'telephone_no' => $this->string(),
            'mobile_no' => $this->string(),
            'email_address' => $this->string(),

            // FAMILY BACKGROUND
            'spouse_surname' => $this->string(),
            'spouse_first_name' => $this->string(),
            'spouse_middle_name' => $this->string(),
            'spouse_name_extension' => $this->string(),
            'spouse_occupation' => $this->string(),
            'spouse_employer' => $this->string(),
            'spouse_employer_address' => $this->text(),
            'spouse_employer_telephone_no' => $this->string(),
            'childrens' => $this->text(),
            'father_surname' => $this->string(),
            'father_first_name' => $this->string(),
            'father_middle_name' => $this->string(),
            'father_name_extension' => $this->string(),
            'mother_surname' => $this->string(),
            'mother_first_name' => $this->string(),
            'mother_middle_name' => $this->string(),
            'mother_name_extension' => $this->string(),


            'signature' => $this->text(),
            'date' => $this->date(),

            'skills' => $this->text(),
            'recognitions' => $this->text(),
            'organizations' => $this->text(),


            'consanguinity_related' => $this->text(),
            'administrative_offense' => $this->text(),
            'charged_criminally' => $this->text(),
            'crime_convicted' => $this->text(),
            'service_separated' => $this->text(),
            'election_candidate' => $this->text(),
            'government_resigned' => $this->text(),
            'other_country_resident' => $this->text(),

            'indigenous_group' => $this->text(),
            'pwd' => $this->text(),
            'solo_parent' => $this->text(),

            'references' => $this->text(),
            'photo' => $this->string(),

            'government_issued_id' => $this->string(),
            'government_id_no' => $this->string(),
            'government_id_place_of_issuance' => $this->string(),

            'right_thumbmark' => $this->text(),
            'person_administering_oath' => $this->string(),

            'father_id' => $this->bigInteger(20),
            'mother_id' => $this->bigInteger(20),
            'spouse_id' => $this->bigInteger(20),

            'token' => $this->string(),
        ]));

        $this->createIndexes($this->tableName(), [
            'father_id' => 'father_id',
            'mother_id' => 'mother_id',
            'spouse_id' => 'spouse_id',
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
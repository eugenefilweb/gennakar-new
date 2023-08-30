<?php

/**
 * Handles the creation of table `{{%scholarships}}`.
 */
class m221213_022248_create_scholarships_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%scholarships}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'first_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'last_name' => $this->string()->notNull(),
            'name_suffix' => $this->string(16),
            'sex' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'birth_date' => $this->date(),
            'age' => $this->smallInteger(6)->defaultValue(0),
            'course' => $this->string(),
            'barangay_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'street_address' => $this->string(),
            'email' => $this->string(),
            'alternate_email' => $this->string(),
            'contact_no' => $this->string(),
            'alternate_contact_no' => $this->string(),
            'house_no' => $this->string(),
            'guardian' => $this->string(),
            'first_enrollment' => $this->smallInteger(6)->defaultValue(0),
            'expected_graduation' => $this->smallInteger(6)->defaultValue(0),

            'current_year_level' => $this->smallInteger(6)->defaultValue(0),
            'school_name' => $this->string(),

            'school_year' => $this->string(),

            'subjects' => $this->text(),
            'units' => $this->text(),

            'documents' => $this->text(),
            'photo' => $this->string(),
            'token' => $this->text(),

            'educations' => $this->text(),

            'status' => $this->tinyInteger(2)->defaultValue(0),
            'notes' => $this->text(),
            'interview_date' => $this->string(),
            'interview_attachments' => $this->text(),
            'interviewer' => $this->string(),
        ]));

        $this->createIndexes($this->tableName(), [
            'barangay_id' => 'barangay_id',
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
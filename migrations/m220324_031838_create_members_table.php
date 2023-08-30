<?php

/**
 * Handles the creation of table `{{%members}}`.
 */
class m220324_031838_create_members_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%members}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'household_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'qr_id' => $this->string(128)->notNull()->unique(),
            'head' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'relation' => $this->smallInteger(6)->notNull()->defaultValue(0),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'first_name' => $this->string()->notNull(),
            'sex' => $this->tinyInteger(2)->notNull(),
            'birth_date' => $this->date()->notNull(),
            'birth_place' => $this->text(),
            'civil_status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'email' => $this->string(),
            'contact_no' => $this->string(),
            'telephone_no' => $this->string(128),
            'photo' => $this->text(),
            'income' => $this->decimal(11, 2),
            'source_of_income' => $this->string(),
            'pensioner' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'pensioner_from' => $this->string(),
            'pension_amount' => $this->decimal(11, 2),
            'educational_attainment' => $this->smallInteger(6)->defaultValue(0),
            'occupation' => $this->string(),
            'token' => $this->string()->notNull()->unique(),
            'slug' => $this->string()->notNull(),
            'living_status' => $this->tinyInteger(2)->notNull()->defaultValue(1),
            'solo_parent' => $this->tinyInteger(2)->notNull()->defaultValue(2),
            'pwd' => $this->tinyInteger(2)->notNull()->defaultValue(2),
            'pwd_type' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'senior_citizen_id' => $this->text(),
        ]));

        $this->createIndexes($this->tableName(), [
            'household_id' => 'household_id',
            'sex' => 'sex',
            'civil_status' => 'civil_status',
            'educational_attainment' => 'educational_attainment',
            'pwd_type' => 'pwd_type',
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
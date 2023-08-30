<?php

/**
 * Handles the creation of table `{{%post_activity_reports}}`.
 */
class m221020_071526_create_post_activity_reports_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%post_activity_reports}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'control_no' => $this->string(64)->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'location' => $this->text(),
            'type_of_activity' => $this->string(),
            'beneficiary_stakeholder_male' => $this->integer()->defaultValue(0),
            'beneficiary_stakeholder_female' => $this->integer()->defaultValue(0),
            'beneficiary_local_male' => $this->integer()->defaultValue(0),
            'beneficiary_local_female' => $this->integer()->defaultValue(0),
            'beneficiary_national_male' => $this->integer()->defaultValue(0),
            'beneficiary_national_female' => $this->integer()->defaultValue(0),
            'beneficiary_other_name' => $this->string(),
            'beneficiary_other_male' => $this->integer()->defaultValue(0),
            'beneficiary_other_female' => $this->integer()->defaultValue(0),
            'date_started' => $this->datetime(),
            'date_end' => $this->datetime(),
            'responsible_head' => $this->string(),
            'coordinators' => $this->text(),
            'staff_members' => $this->text(),
            'other_members' => $this->text(),
            'activity_brief' => $this->text(),
            'prepared_by' => $this->string(),
            'verified_by' => $this->string(),
            'remarks' => $this->text(),
            'comments_by' => $this->string(),
            'in_charge_of_activity' => $this->string(),
            'noted_by' => $this->string(),
            'code' => $this->string(64),
            'map' => $this->text(),
            'watershed_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'photo1' => $this->string(),
            'photo2' => $this->string(),
            'photo3' => $this->string(),
            'photo4' => $this->string(),
            'social_media_link' => $this->string(),
            'latitude' => $this->string(),
            'longitude' => $this->string(),
            'additional_photos' => $this->text(),
            'additional_files' => $this->text(),
        ]));

        $this->createIndexes($this->tableName(), [
            'watershed_id' => 'watershed_id',
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
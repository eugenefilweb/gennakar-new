<?php

/**
 * Handles the creation of table `{{%post_accident_reports}}`.
 */
class m221024_035951_create_post_accident_reports_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%post_accident_reports}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'location' => $this->text(),
            'control_no' => $this->string()->notNull()->unique(),
            'type_of_accident' => $this->string(),
            'participant_male' => $this->integer()->defaultValue(0),
            'participant_female' => $this->integer()->defaultValue(0),
            'local_male' => $this->integer()->defaultValue(0),
            'local_female' => $this->integer()->defaultValue(0),
            'national_male' => $this->integer()->defaultValue(0),
            'national_female' => $this->integer()->defaultValue(0),
            'other_name' => $this->string(),
            'other_male' => $this->integer()->defaultValue(0),
            'other_female' => $this->integer()->defaultValue(0),
            'date_time' => $this->datetime(),
            'weather_condition' => $this->string(),
            'persons_of_interest' => $this->text(),
            'responders' => $this->text(),
            'witnesses' => $this->text(),
            'accident_report' => $this->text(),
            'prepared_by' => $this->string(),
            'verified_by' => $this->string(),
            'remarks' => $this->text(),
            'comments_by' => $this->string(),
            'officer_in_charge' => $this->string(),
            'noted_by' => $this->string(),
            'code' => $this->string(),
            'map' => $this->text(),
            'barangay' => $this->text(),
            'photo1' => $this->string(),
            'photo2' => $this->string(),
            'photo3' => $this->string(),
            'photo4' => $this->string(),
            'social_media_link' => $this->string(),
            'latitude' => $this->string(),
            'longitude' => $this->string(),
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
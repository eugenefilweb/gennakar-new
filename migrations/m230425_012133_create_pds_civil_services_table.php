<?php

/**
 * Handles the creation of table `{{%pds_civil_services}}`.
 */
class m230425_012133_create_pds_civil_services_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%pds_civil_services}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'pds_id' => $this->bigInteger(20)->notNull(),
            'career_service' => $this->string()->notNull(),
            'rating' => $this->string(),
            'date_of_examination' => $this->date(),
            'place_of_examination' => $this->text(),
            'license' => $this->string(),
            'license_date' => $this->date(),
        ]));

        $this->createIndexes($this->tableName(), [
            'pds_id' => 'pds_id',
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
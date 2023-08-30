<?php

/**
 * Handles the creation of table `{{%households}}`.
 */
class m220318_081007_create_households_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%households}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'no' => $this->bigInteger(20)->notNull()->unique(),
            'transfer_date' => $this->datetime(),
            'longitude' => $this->string(),
            'latitude' => $this->string(),
            'altitude' => $this->string(),
            'region_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'province_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'municipality_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'barangay_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'zone_no' => $this->integer(),
            'purok_no' => $this->integer(),
            'blk_no' => $this->string(32),
            'lot_no' => $this->integer(),
            'street' => $this->string(),
            'token' => $this->string(),
        ]));

        $this->createIndexes($this->tableName(), [
            'region_id' => 'region_id',
            'province_id' => 'province_id',
            'municipality_id' => 'municipality_id',
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
<?php

/**
 * Handles the creation of table `{{%libraries}}`.
 */
class m221205_015702_create_libraries_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%libraries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'family' => $this->string(),
            'genus' => $this->string(),
            'species' => $this->string(),
            'sub_species' => $this->string(),
            'varieta_and_infra_var_name' => $this->string(),
            'common_name' => $this->string(),
            'taxonomic_group' => $this->string(),
            'conservation_status' => $this->string(),
            'residency_status' => $this->string(),
            'distribution' => $this->text(),
            'photo' => $this->string(),
            'notes' => $this->text(),
            
            'island_group' => $this->string(),
            'region' => $this->text(),
            'province' => 'LONGTEXT',
            'municipality' => 'LONGTEXT',
            'brgy' => 'LONGTEXT',
            'specific_area' => $this->text(),
            'location_data' => 'LONGTEXT',

            'watershed_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
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
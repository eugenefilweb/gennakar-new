<?php

/**
 * Handles the creation of table `{{%trees}}`.
 */
class m230103_030550_create_trees_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%trees}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'patrol_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'app_id' => $this->string(),
            'common_name' => $this->string(),
            'kingdom' => $this->string(),
            'family' => $this->string(),
            'genus' => $this->string(),
            'species' => $this->string(),
            'sub_species' => $this->string(),
            'varieta_and_infra_var_name' => $this->string(),
            'taxonomic_group' => $this->string(),
            'latitude' => $this->string(),
            'longitude' => $this->string(),
            'description' => $this->text(),
            'photos' => $this->text(),
            'date_encoded' => $this->string(),
            'status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'validated_by_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'notes' => $this->text(),
            'patroller_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
        ]));

        $this->createIndexes($this->tableName(), [
            'patroller_id' => 'patroller_id',
            'validated_by_id' => 'validated_by_id',
            'patrol_id' => 'patrol_id',
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
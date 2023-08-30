<?php

/**
 * Handles the creation of table `{{%pds_organizations}}`.
 */
class m230425_014610_create_pds_organizations_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%pds_organizations}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'pds_id' => $this->bigInteger(20)->notNull(),
            'name' => $this->string()->notNull(),
            'address' => $this->text(),
            'from' => $this->date(),
            'to' => $this->date(),
            'no_of_hours' => $this->integer(),
            'position' => $this->string(),
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
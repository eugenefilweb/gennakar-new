<?php

/**
 * Handles the creation of table `{{%statements}}`.
 */
class m221222_005536_create_statements_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%statements}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'vehicular_accident_report_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'type' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'statement' => 'MEDIUMTEXT',
            'date' => $this->string(),
            'plate_no' => $this->string(),
            'signature' => 'MEDIUMTEXT',
            'position' => $this->string(),
            'address' => $this->string(),
            'contact_info' => $this->string(),
        ]));

        $this->createIndexes($this->tableName(), [
            'vehicular_accident_report_id' => 'vehicular_accident_report_id',
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
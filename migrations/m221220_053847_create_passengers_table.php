<?php

/**
 * Handles the creation of table `{{%passengers}}`.
 */
class m221220_053847_create_passengers_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%passengers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->safeDown();
        $this->createTable($this->tableName(), $this->attributes([
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'first_name' => $this->string()->notNull(),
            'suffix_name' => $this->string(16),
            'address' => $this->text(),
            'email' => $this->string(),
            'contact_no' => $this->string(),
            'alternate_contact_no' => $this->string(),
            'age' => $this->smallInteger(6)->notNull()->defaultValue(0),
            'sex' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'health_condition' => $this->text(),
            'medical_complaint' => $this->string(),
            'condition' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'observation' => $this->text(),
            'prepared_by' => $this->string(),
            'noted_by' => $this->string(),
            'date' => $this->string(),
            'statement' => $this->text(),
            'signature' => 'MEDIUMTEXT',
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
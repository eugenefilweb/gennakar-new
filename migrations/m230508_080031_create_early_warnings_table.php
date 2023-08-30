<?php

/**
 * Handles the creation of table `{{%early_warnings}}`.
 */
class m230508_080031_create_early_warnings_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%early_warnings}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'subject' => $this->string()->notNull(),

            'meteorological_conditions' => $this->text(),
            'impact_of_winds' => $this->text(),
            'precautionary_measures' => $this->text(),

            'bulletin_no' => $this->string(),
            'signal_no' => $this->tinyInteger(),
            'category' => $this->string(),
            'windspeed' => $this->string(),

            'mayor_firstname' => $this->string(),
            'mayor_middlename' => $this->string(),
            'mayor_lastname' => $this->string(),

            'message' => 'MEDIUMTEXT',

            'entry_text' => $this->text(),
            'attachment_text' => $this->text(),
            'other_text' => $this->text(),

            'attachments' => $this->text(),

            'token' => $this->string(),
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
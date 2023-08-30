<?php

/**
 * Class m221222_021106_add_columns_to_vehicular_accident_reports
 */
class m221222_021106_add_columns_to_vehicular_accident_reports extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%vehicular_accident_reports}}';
    }

    public function columns()
    {
        return [
            'token' => $this->string(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumns($this->tableName(), $this->columns());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumns($this->tableName(), $this->columns());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221222_021106_add_columns_to_vehicular_accident_reports cannot be reverted.\n";

        return false;
    }
    */
}

<?php

/**
 * Handles adding columns to table `{{%transactions}}`.
 */
class m220704_023539_add_columns_to_transactions_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%transactions}}';
    }

    public function columns()
    {
        return [
            'white_card_status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'general_intake_sheet_status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'obligation_request_status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'petty_cash_voucher_status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'senior_citizen_intake_sheet_status' => $this->tinyInteger(2)->notNull()->defaultValue(0),
        ];

        // FOR SETTING utf
        // ->append('CHARACTER SET utf8 COLLATE utf8_general_ci')
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
}

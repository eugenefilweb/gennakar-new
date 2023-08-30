<?php

/**
 * Handles the creation of table `{{%transactions}}`.
 */
class m220325_054132_create_transactions_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%transactions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'member_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'transaction_type' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'emergency_welfare_program' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'amount' => $this->decimal(11, 2)->notNull()->defaultValue(0),
            'content' => $this->text(),
            'status' => $this->tinyInteger(2)->notNull(),
            'remarks' => $this->text(),
            'files' => $this->text(),
            'white_card' => $this->text(),
            'general_intake_sheet' => $this->text(),
            'obligation_request' => $this->text(),
            'petty_cash_voucher' => $this->text(),
            'token' => $this->string()->notNull()->unique(),
            'senior_citizen_intake_sheet' => $this->text(),
            'social_pension_application_form' => $this->text(),
        ]));

        $this->createIndexes($this->tableName(), [
            'member_id' => 'member_id',
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
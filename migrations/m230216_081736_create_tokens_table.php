<?php

/**
 * Handles the creation of table `{{%tokens}}`.
 */
class m230216_081736_create_tokens_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%tokens}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'user_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'code' => $this->string()->notNull(),
            'expire' => $this->integer(),
            'type' => $this->tinyInteger(2)->notNull()->defaultValue(0),
        ]));

        $this->createIndexes($this->tableName(), [
            'user_id' => 'user_id',
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
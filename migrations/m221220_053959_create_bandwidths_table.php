<?php

/**
 * Handles the creation of table `{{%bandwidths}}`.
 */
class m221220_053959_create_bandwidths_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%bandwidths}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->safeDown();
        $this->createTable($this->tableName(), $this->attributes([
            'user_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'bytes' => $this->integer()->notNull()->defaultValue(0),
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
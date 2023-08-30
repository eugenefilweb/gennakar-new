<?php

/**
 * Handles the creation of table `{{%patrols}}`.
 */
class m230130_002403_create_patrols_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%patrols}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'user_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'watershed' => $this->string(),
            'coordinates' => 'MEDIUMTEXT',
            'date' => $this->string(),
            'notes' => $this->text(),
            'distance' => $this->decimal(11, 2)->notNull()->defaultValue(0),
            'total_time' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'status' => $this->tinyInteger(2)->notNull()->defaultValue(0)
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
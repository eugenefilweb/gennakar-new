<?php

use app\models\Country;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%countries}}`.
 */
class m220318_034124_create_countries_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%countries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'no' => $this->integer()->notNull()->unique()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'alpha_code' => $this->string(8)->notNull(),
        ]));

        $this->createIndexes($this->tableName(), [
            'alpha_code' => 'alpha_code',
        ]);

        foreach ($this->data() as $data) {
            list($no, $name, $alpha_code) = $data;
            $this->insert($this->tableName(), [
                'no' => $no,
                'name' => $name,
                'alpha_code' => $alpha_code,
                'record_status' => Country::RECORD_ACTIVE,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => new Expression('UTC_TIMESTAMP'),
                'updated_at' => new Expression('UTC_TIMESTAMP'),
            ]);
        }
    }

    public function data()
    {
        return [
            array('608', 'Philippines', 'PHL'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName());
    }
}
<?php

use app\models\Municipality;
use app\models\Province;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%municipalities}}`.
 */
class m220318_035814_create_municipalities_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%municipalities}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            'province_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'no' => $this->integer()->notNull()->defaultValue(0),
        ]));

        $this->createIndexes($this->tableName(), [
            'province_id' => 'province_id',
        ]);

        foreach ($this->data() as $data) {
            list($name, $region_no, $province_no, $no) = $data;
            $province = Province::findOne(['no' => $province_no]);
            $data = [
                'name' => $name,
                'province_id' => ($province)? $province->id: 0,
                'no' => $no,
                'record_status' => Municipality::RECORD_ACTIVE,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => new Expression('UTC_TIMESTAMP'),
                'updated_at' => new Expression('UTC_TIMESTAMP'),
            ];

            $this->insert($this->tableName(), $data);
        }
    }

    public function data()
    {
        return [
            array('REAL', 4, 56, 38),
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
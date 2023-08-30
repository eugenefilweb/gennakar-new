<?php

use app\models\Province;
use app\models\Region;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%provinces}}`.
 */
class m220318_034126_create_provinces_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%provinces}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            'region_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'no' => $this->integer()->notNull()->defaultValue(0),
        ]));

        $this->createIndexes($this->tableName(), [
            'region_id' => 'region_id',
        ]);

        foreach ($this->data() as $data) {
            list($name, $region_no, $no) = $data;
            $region = Region::findOne(['no' => $region_no]);
            $data = [
                'name' => $name,
                'region_id' => ($region)? $region->id: 0,
                'no' => $no,
                'record_status' => Province::RECORD_ACTIVE,
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
            array('QUEZON', 4, 56),
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
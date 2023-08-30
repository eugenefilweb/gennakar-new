<?php

use app\models\Country;
use app\models\Region;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%regions}}`.
 */
class m220318_034125_create_regions_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%regions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            'country_id' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'no' => $this->integer()->notNull()->defaultValue(0),
        ]));

        $this->createIndexes($this->tableName(), [
            'country_id' => 'country_id',
        ]);

        foreach ($this->data() as $data) {
            list($country_no, $name, $no) = $data;

            $country = Country::findOne(['no' => $country_no]);

            $data = [
                'name' => $name,
                'country_id' => ($country)? $country->id: 0,
                'no' => $no,
                'record_status' => Region::RECORD_ACTIVE,
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
            array(608, 'IVA - SOUTHERN TAGALOG (CALABARZON)', 4),
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
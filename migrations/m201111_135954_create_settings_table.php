<?php

use yii\helpers\Inflector;
use yii\db\Expression;
use app\models\EventCategory;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m201111_135954_create_settings_table extends \app\migrations\Migration
{
    public function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName(), $this->attributes([
            'name' => $this->string()->notNull(),
            'value' => $this->text(),
            'slug' => $this->string()->notNull(),
            'type' => $this->string(128)->notNull(),
            'sort_order' => $this->integer(11)->notNull()->defaultValue(0),
        ]));

        $this->seed();
    }

    public function seed()
    {
        $rows = [];
        foreach ($this->data() as $data) {
            list($name, $type) = $data;
            $rows[] = [
                'name' => $name, 
                'value' => $name,
                'slug' => Inflector::slug($name), 
                'type' => EventCategory::TYPE,
                'sort_order' => $type,
                'record_status' => EventCategory::RECORD_ACTIVE,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => new Expression('UTC_TIMESTAMP'),
                'updated_at' => new Expression('UTC_TIMESTAMP'),
            ];
        }
        $this->batchInsert($this->tableName(), array_keys($rows[0]), $rows);
    }

    public function data()
    {
        return [
            ['Disaster Mitigation and Preparedness', EventCategory::TYPE_DISASTER],
            ['Disaster Response and Recovery', EventCategory::TYPE_DISASTER],
            ['Emergency Shelter Assistance', EventCategory::TYPE_DEFAULT],
            ['Family and Community Disaster Awareness', EventCategory::TYPE_DEFAULT],
            ['Crisis Intervention', EventCategory::TYPE_DEFAULT],
            ['Training and Capacity Building', EventCategory::TYPE_DEFAULT],
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
<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%inventory_items}}".
 *
 * @property int $id
 * @property string $name
 * @property string $category
 * @property int $quantity
 * @property string $unit
 * @property string|null $remark
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class InventoryItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inventory_items}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'inventory-item',
            'mainAttribute' => 'name',
            'paramName' => 'slug',
            'dateAttribute' => 'date'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['name', 'category', 'quantity', 'unit', 'date'], 'required'],
            [['quantity'], 'integer'],
            [['remark'], 'string'],
            [['name', 'category', 'unit'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'name' => 'Name',
            'category' => 'Category',
            'quantity' => 'Quantity',
            'unit' => 'Unit',
            'remark' => 'Remark',
            'date' => 'Date Received',
        ]);
    }

    public function getInventories()
    {
        return $this->hasMany(InventoryItem::class, ['category' => 'category']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\InventoryItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\InventoryItemQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'name' => [
                'attribute' => 'name', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->name,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'category' => ['attribute' => 'category', 'format' => 'raw'],
            'quantity' => ['attribute' => 'quantity', 'format' => 'raw'],
            'unit' => ['attribute' => 'unit', 'format' => 'raw'],
            'date' => ['attribute' => 'date', 'format' => 'raw'],
            'remark' => ['attribute' => 'remark', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'category:raw',
            'name:raw',
            'quantity:raw',
            'unit:raw',
            'date:raw',
            'remark:raw',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['SluggableBehavior'] = [
            'class' => 'yii\behaviors\SluggableBehavior',
            'attribute' => 'name',
            'ensureUnique' => true,
        ];

        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'inFormat' => 'Y-m-d',
            'outFormat' => 'm/d/Y',
            'attributes' => [
                'date'
            ]
        ];

        
        return $behaviors;
    }

    public function getFormattedQuantity()
    {
        return App::formatter()->asNumber($this->quantity);
    }

    public function getFormattedUnit()
    {
        return strtolower($this->unit);
    }
}
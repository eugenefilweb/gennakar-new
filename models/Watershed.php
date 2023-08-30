<?php

namespace app\models;

use app\helpers\Url;
use app\helpers\Html;
use app\widgets\Anchor;
use app\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%watersheds}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $map
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Watershed extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%watersheds}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'watershed',
            'mainAttribute' => 'name',
            'paramName' => 'slug',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['name'], 'required'],
            [['description', 'map'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'description' => 'Description',
            'map' => 'Map',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\WatershedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\WatershedQuery(get_called_class());
    }

    public function getDefaultGridColumns()
    {
        return [
            'serial',
            'checkbox',
            'map',
            'name',
            'created_at',
            'last_updated',
        ];
    }

    public function getGridviewMap()
    {
        return Html::image($this->map, ['w' => 50], ['class' => 'img-circle']);
    }
     
    public function gridColumns()
    {
        return [
            'map' => [
                'attribute' => 'map', 
                'value' => 'gridviewMap',
                'format' => 'raw'
            ],
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
            'description' => ['attribute' => 'description', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'name:raw',
            'description:raw',
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

        return $behaviors;
    }

    public static function toArrayData()
    {
        $models = self::find()->all();

        return ArrayHelper::toArray($models, [
            self::class => [
                'id',
                'name',
                'description',
                'map',
                'imageUrl' => function($model) {
                    return Url::image($model->map, ['w' => 500]);
                },
            ],
        ]);
    }

    public static function toJsonData()
    {
        return json_encode(self::toArrayData());
    }
}
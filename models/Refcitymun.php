<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "refcitymun".
 *
 * @property int $id
 * @property string|null $psgcCode
 * @property string|null $citymunDesc
 * @property string|null $regDesc
 * @property string|null $provCode
 * @property string|null $citymunCode
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Refcitymun extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'refcitymun';
    }

    public function config()
    {
        return [
            'controllerID' => 'refcitymun',
            'mainAttribute' => 'id',
            'paramName' => 'id',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['citymunDesc'], 'string'],
            [['psgcCode', 'regDesc', 'provCode', 'citymunCode'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'psgcCode' => 'Psgc Code',
            'citymunDesc' => 'Citymun Desc',
            'regDesc' => 'Reg Desc',
            'provCode' => 'Prov Code',
            'citymunCode' => 'Citymun Code',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RefcitymunQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RefcitymunQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'psgcCode' => [
                'attribute' => 'psgcCode', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->psgcCode,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'citymunDesc' => ['attribute' => 'citymunDesc', 'format' => 'raw'],
            'regDesc' => ['attribute' => 'regDesc', 'format' => 'raw'],
            'provCode' => ['attribute' => 'provCode', 'format' => 'raw'],
            'citymunCode' => ['attribute' => 'citymunCode', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'psgcCode:raw',
            'citymunDesc:raw',
            'regDesc:raw',
            'provCode:raw',
            'citymunCode:raw',
        ];
    }

    public static function getbyProvince($provCode)
    {
        return self::findAll(['provCode' => $provCode]);
    }
}
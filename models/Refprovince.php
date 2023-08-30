<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "refprovince".
 *
 * @property int $id
 * @property string|null $psgcCode
 * @property string|null $provDesc
 * @property string|null $regCode
 * @property string|null $provCode
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Refprovince extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'refprovince';
    }

    public function config()
    {
        return [
            'controllerID' => 'refprovince',
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
            [['provDesc'], 'string'],
            [['psgcCode', 'regCode', 'provCode'], 'string', 'max' => 255],
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
            'provDesc' => 'Prov Desc',
            'regCode' => 'Reg Code',
            'provCode' => 'Prov Code',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RefprovinceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RefprovinceQuery(get_called_class());
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
            'provDesc' => ['attribute' => 'provDesc', 'format' => 'raw'],
            'regCode' => ['attribute' => 'regCode', 'format' => 'raw'],
            'provCode' => ['attribute' => 'provCode', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'psgcCode:raw',
            'provDesc:raw',
            'regCode:raw',
            'provCode:raw',
        ];
    }

    public function getRefregion()
    {
        return $this->hasOne(Refregion::class, ['regCode' => 'regCode']);
    }

    public static function getbyRegion($regCode)
    {
        return self::findAll(['regCode' => $regCode]);
    }
}
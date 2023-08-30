<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "refregion".
 *
 * @property int $id
 * @property string|null $psgcCode
 * @property string|null $regDesc
 * @property string|null $regCode
 * @property int $island_group
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Refregion extends ActiveRecord
{
    const LUZON = 1;
    const VISAYAS = 2;
    const MINDANAO = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'refregion';
    }

    public function config()
    {
        return [
            'controllerID' => 'refregion',
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
            [['regDesc'], 'string'],
            [['island_group'], 'integer'],
            [['psgcCode', 'regCode'], 'string', 'max' => 255],
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
            'regDesc' => 'Reg Desc',
            'regCode' => 'Reg Code',
            'island_group' => 'Island Group',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RefregionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RefregionQuery(get_called_class());
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
            'regDesc' => ['attribute' => 'regDesc', 'format' => 'raw'],
            'regCode' => ['attribute' => 'regCode', 'format' => 'raw'],
            'island_group' => ['attribute' => 'island_group', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'psgcCode:raw',
            'regDesc:raw',
            'regCode:raw',
            'island_group:raw',
        ];
    }

    public static function getByIslandGroup($island_group)
    {
        return self::findAll(['island_group' => $island_group]);
    }

    public static function getLuzonRegions()
    {
        return self::findAll(['island_group' => self::LUZON]);
    }
    public static function getVisayasRegions()
    {
        return self::findAll(['island_group' => self::VISAYAS]);
    }
    public static function getMindanaoRegions()
    {
        return self::findAll(['island_group' => self::MINDANAO]);
    }
}
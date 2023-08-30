<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "refbrgy".
 *
 * @property int $id
 * @property string|null $brgyCode
 * @property string|null $brgyDesc
 * @property string|null $regCode
 * @property string|null $provCode
 * @property string|null $citymunCode
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Refbrgy extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'refbrgy';
    }

    public function config()
    {
        return [
            'controllerID' => 'refbrgy',
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
            [['brgyDesc'], 'string'],
            [['brgyCode', 'regCode', 'provCode', 'citymunCode'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'brgyCode' => 'Brgy Code',
            'brgyDesc' => 'Brgy Desc',
            'regCode' => 'Reg Code',
            'provCode' => 'Prov Code',
            'citymunCode' => 'Citymun Code',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RefbrgyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RefbrgyQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'brgyCode' => [
                'attribute' => 'brgyCode', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->brgyCode,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'brgyDesc' => ['attribute' => 'brgyDesc', 'format' => 'raw'],
            'regCode' => ['attribute' => 'regCode', 'format' => 'raw'],
            'provCode' => ['attribute' => 'provCode', 'format' => 'raw'],
            'citymunCode' => ['attribute' => 'citymunCode', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'brgyCode:raw',
            'brgyDesc:raw',
            'regCode:raw',
            'provCode:raw',
            'citymunCode:raw',
        ];
    }

    public static function getbyCityMun($citymunCode)
    {
        return self::findAll(['citymunCode' => $citymunCode]);
    }
}
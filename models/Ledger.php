<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%ledgers}}".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property float $amount
 * @property string|null $date
 * @property string|null $remarks
 * @property string|null $token
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Ledger extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ledgers}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'ledger',
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
            [['name', 'type'], 'required'],
            [['amount'], 'number'],
            [['date'], 'safe'],
            [['remarks'], 'string'],
            [['name', 'type'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'amount' => 'Amount',
            'date' => 'Date',
            'remarks' => 'Remarks',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\LedgerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LedgerQuery(get_called_class());
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
            'type' => ['attribute' => 'type', 'format' => 'raw'],
            'amount' => ['attribute' => 'amount', 'format' => 'raw'],
            'date' => ['attribute' => 'date', 'format' => 'raw'],
            'remarks' => ['attribute' => 'remarks', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'name:raw',
            'type:raw',
            'amount:raw',
            'date:raw',
            'remarks:raw',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'attributes' => [
                'date',
            ]
        ];

        return $behaviors;
    }
}
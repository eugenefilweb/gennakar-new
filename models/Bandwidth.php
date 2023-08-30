<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%bandwidths}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $bytes
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Bandwidth extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bandwidths}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'bandwidth',
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
            [['user_id', 'bytes'], 'required'],
            [['user_id', 'bytes'], 'integer'],
            ['user_id', 'exist', 'targetRelation' => 'user'],
        ]);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'user_id' => 'User ID',
            'bytes' => 'Bytes',
        ]);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['LogBehavior']);
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BandwidthQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BandwidthQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'user_id' => [
                'attribute' => 'user_id', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->user_id,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'bytes' => ['attribute' => 'bytes', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'user_id:raw',
            'bytes:raw',
        ];
    }
}
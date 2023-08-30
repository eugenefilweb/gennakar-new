<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%tokens}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property int|null $expire
 * @property int $type
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Token extends ActiveRecord
{
    const TYPE_DEFAULT = 0;
    const TYPE_TWO_FACTOR_EMAIL = 1;
    const TYPE_PASSWORD_RESET = 2;
    const PDS = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tokens}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'token',
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
            [['user_id', 'type', 'code'], 'required'],
            [['user_id', 'expire', 'type'], 'integer'],
            ['type', 'in', 'range' => [
                self::TYPE_DEFAULT,
                self::TYPE_TWO_FACTOR_EMAIL,
                self::TYPE_PASSWORD_RESET,
                self::PDS,
            ]],
            [['code'], 'safe'],
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
            'expire' => 'Expire',
            'type' => 'Type',
            'code' => 'Code',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\TokenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TokenQuery(get_called_class());
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
            'expire' => ['attribute' => 'expire', 'format' => 'raw'],
            'type' => ['attribute' => 'type', 'format' => 'raw'],
            'code' => ['attribute' => 'code', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'user_id:raw',
            'expire:raw',
            'type:raw',
            'code:raw',
        ];
    }

    public function generateCode()
    {
        // if ($this->type == self::TYPE_TWO_FACTOR_EMAIL) {
            $this->code =  rand(111111, 999999);
        // }
    }

    public function generateUniqueCode()
    {
        $code = rand(111111, 999999) . time();
        $model = self::findOne(['code' => $code]);
        if ($model) {
            return $this->generateUniqueCode();
        }

        return $code;
    }

    public function getIsNotExpired()
    {
        return ! $this->isExpired;
    }

    public function getIsExpired()
    {
        if ($this->expire === null) {
            return false;
        }
        return time() >= $this->expire;
    }

    public function generateExpiration($added=0)
    {
        $this->expire = time() + $added;
    }

    public function getCanActivate()
    {
        return true;
    }

    public function getRemaining()
    {
        $seconds = $this->expire - time();
        return $seconds > 0 ? $seconds: 0;
    }
}
<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%downloads}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $file_id
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Download extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%downloads}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'download',
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
            [['user_id', 'file_id'], 'required'],
            [['user_id', 'file_id'], 'integer'],
            ['user_id', 'exist', 'targetRelation' => 'user'],
            ['file_id', 'exist', 'targetRelation' => 'file'],
        ]);
    }

    public function getFile()
    {
        return $this->hasOne(File::class, ['id' => 'file_id']);
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
            'file_id' => 'File ID',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\DownloadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\DownloadQuery(get_called_class());
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
            'file_id' => ['attribute' => 'file_id', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'user_id:raw',
            'file_id:raw',
        ];
    }
}
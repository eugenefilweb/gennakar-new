<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%pds_training_programs}}".
 *
 * @property int $id
 * @property int $pds_id
 * @property string $title
 * @property string|null $from
 * @property string|null $to
 * @property int|null $no_of_hours
 * @property string|null $type
 * @property string|null $conducted
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class PdsTrainingProgram extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pds_training_programs}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'pds-training-program',
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
            [['pds_id', 'title'], 'required'],
            [['pds_id', 'no_of_hours'], 'integer'],
            [['from', 'to'], 'safe'],
            [['title', 'type', 'conducted'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'pds_id' => 'Pds ID',
            'title' => 'Title of Learning and Development',
            'from' => 'From',
            'to' => 'To',
            'no_of_hours' => 'Number Of Hours',
            'type' => 'Type of LD (Managerial/Supervisory/Technical/etc)',
            'conducted' => 'Conducted / Sponsored by',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PdsTrainingProgramQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PdsTrainingProgramQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'pds_id' => [
                'attribute' => 'pds_id', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->pds_id,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'title' => ['attribute' => 'title', 'format' => 'raw'],
            'from' => ['attribute' => 'from', 'format' => 'raw'],
            'to' => ['attribute' => 'to', 'format' => 'raw'],
            'no_of_hours' => ['attribute' => 'no_of_hours', 'format' => 'raw'],
            'type' => ['attribute' => 'type', 'format' => 'raw'],
            'conducted' => ['attribute' => 'conducted', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'title:raw',
            'from:raw',
            'to:raw',
            'no_of_hours:raw',
            'type:raw',
            'conducted:raw',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
      
        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'attributes' => [
                'from',
                'to',
            ]
        ];

        return $behaviors;
    }
}
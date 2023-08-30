<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%pds_civil_services}}".
 *
 * @property int $id
 * @property int $pds_id
 * @property string $career_service
 * @property string|null $rating
 * @property string|null $date_of_examination
 * @property string|null $place_of_examination
 * @property string|null $license
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class PdsCivilService extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pds_civil_services}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'pds-civil-service',
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
            [['pds_id', 'career_service'], 'required'],
            [['pds_id'], 'integer'],
            [['date_of_examination', 'license_date'], 'safe'],
            [['place_of_examination', 'license'], 'string'],
            [['career_service', 'rating'], 'string', 'max' => 255],
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
            'career_service' => 'Career Service',
            'rating' => 'Rating',
            'date_of_examination' => 'Date Of Examination',
            'place_of_examination' => 'Place Of Examination',
            'license' => 'License Number',
            'license_date' => 'Date of Validity',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PdsCivilServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PdsCivilServiceQuery(get_called_class());
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
            'career_service' => ['attribute' => 'career_service', 'format' => 'raw'],
            'rating' => ['attribute' => 'rating', 'format' => 'raw'],
            'date_of_examination' => ['attribute' => 'date_of_examination', 'format' => 'raw'],
            'place_of_examination' => ['attribute' => 'place_of_examination', 'format' => 'raw'],
            'license' => ['attribute' => 'license', 'format' => 'raw'],
            'license_date' => ['attribute' => 'license_date', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'career_service:raw',
            'rating:raw',
            'date_of_examination:raw',
            'place_of_examination:raw',
            'license:raw',
            'license_date:raw',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'attributes' => [
                'date_of_examination',
                'license_date',
            ]
        ];
        return $behaviors;
    }
}
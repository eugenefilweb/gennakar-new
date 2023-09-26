<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%environmental_incidents}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date_time
 * @property string|null $longitude
 * @property string|null $latitude
 * @property string|null $watershed
 * @property string|null $description
 * @property string|null $additional_details
 * @property string|null $photos
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class EnvironmentalIncident extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%environmental_incidents}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'environmental-incident',
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
            [['user_id','incident','incident_type'], 'integer'],
            [['date_time'], 'required'],
            [['date_time'], 'safe'],
            [['description', 'additional_details', 'photos'], 'string'],
            [['longitude', 'latitude', 'watershed'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'user_id' => 'User ID',
            'date_time' => 'Date Time',
            'incident'=>'Incidents',
            'incident_type'=>'Type',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'watershed' => 'Watershed',
            'description' => 'Description',
            'additional_details' => 'Additional Details',
            'photos' => 'Photos',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\EnvironmentalIncidentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\EnvironmentalIncidentQuery(get_called_class());
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
            'incident'=>[
                'attribute' => 'incident', 'format' => 'raw',
               'value' => function($model) {
                      $incidents = App::params('incidents');
                      $incidents = $incidents?ArrayHelper::index($incidents, 'id'):[];
                      return $incidents[$model->incident]['label'];
                    
                }
            
            ],
            'incident_type'=>[
                'attribute' => 'incident_type', 'format' => 'raw',
                'value' => function($model) {
                      $incidents = App::params('incidents');
                      $incidents = $incidents?ArrayHelper::index($incidents, 'id'):[];
                      $incidents_type = $model->incident && ($incidents_type = $incidents[$model->incident]['incident_type'])?ArrayHelper::index($incidents_type, 'id'):[];
                      
                      return $incidents_type[$model->incident_type]['label']; 
                }
            ],
            'date_time' => ['attribute' => 'date_time', 'format' => 'raw'],
            'longitude' => ['attribute' => 'longitude', 'format' => 'raw'],
            'latitude' => ['attribute' => 'latitude', 'format' => 'raw'],
            'watershed' => ['attribute' => 'watershed', 'format' => 'raw'],
            'description' => ['attribute' => 'description', 'format' => 'raw'],
            'additional_details' => ['attribute' => 'additional_details', 'format' => 'raw'],
            'photos' => ['attribute' => 'photos', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
           // 'user_id:raw',
            'incident'=>[
                'attribute' => 'incident', 'format' => 'raw',
               'value' => function($model) {
                      $incidents = App::params('incidents');
                      $incidents = $incidents?ArrayHelper::index($incidents, 'id'):[];
                      return $incidents[$model->incident]['label'];
                    
                }
            
            ],
            'incident_type'=>[
                'attribute' => 'incident_type', 'format' => 'raw',
                'value' => function($model) {
                      $incidents = App::params('incidents');
                      $incidents = $incidents?ArrayHelper::index($incidents, 'id'):[];
                      $incidents_type = $model->incident && ($incidents_type = $incidents[$model->incident]['incident_type'])?ArrayHelper::index($incidents_type, 'id'):[];
                      return  $incidents_type[$model->incident_type]['label']; 
                }
            ],
            'date_time:raw',
            'longitude:raw',
            'latitude:raw',
            'watershed:raw',
            'description:raw',
            'additional_details:raw',
            //'photos:raw',
        ];
    }
}
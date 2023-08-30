<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Url;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%vehicular_accident_reports}}".
 *
 * @property int $id
 * @property string|null $control_no
 * @property string|null $code
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $main_cause
 * @property string|null $vehicles_involved
 * @property string|null $photos
 * @property string|null $other_damages
 * @property string|null $collision_type
 * @property string|null $weather_condition
 * @property string|null $road_condition
 * @property string|null $barangay
 * @property string|null $landmarks
 * @property string|null $road_type
 * @property string|null $remarks
 * @property string|null $preferred_by
 * @property string|null $noted_by
 * @property string|null $date
 * @property string|null $sketch
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class VehicularAccidentReport extends ActiveRecord
{
    const STEP_FORM = [
        1 => [
            'id' => 1,
            'slug' => 'general-information',
            'title' => 'General Information',
            'description' => 'Accident Details & Photos',
        ],
        2 => [
            'id' => 2,
            'slug' => 'map-vicinity',
            'title' => 'Map Vicinity',
            'description' => 'Latitude & Longitude',
        ],
        3 => [
            'id' => 3,
            'slug' => 'vehicles',
            'title' => 'Vehicles Involved',
            'description' => 'Vehicles & Drivers',
        ],
        4 => [
            'id' => 4,
            'slug' => 'passengers',
            'title' => 'Passengers',
            'description' => 'Passengers Information',
        ],
        5 => [
            'id' => 5,
            'slug' => 'statements',
            'title' => 'Other Statements',
            'description' => 'Responder & Witness',
        ],
        6 => [
            'id' => 6,
            'slug' => 'review',
            'title' => 'Summary',
            'description' => 'Review & Submit',
        ],
    ];

    public $_vehicles_data;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vehicular_accident_reports}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'vehicular-accident-report',
            'mainAttribute' => 'control_no',
            'paramName' => 'token',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['date', 'control_no', 'code', 'main_cause'], 'required'],
            [['remarks'], 'string'],
            [['post_accident_report_id'], 'integer'],
            [['photos', 'other_damages'], 'safe'],
            [['control_no', 'code', 'latitude', 'longitude', 'main_cause', 'vehicles_involved', 'collision_type', 'weather_condition', 'road_condition', 'barangay', 'landmarks', 'road_type', 'preferred_by', 'noted_by', 'date', 'sketch'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'control_no' => 'Control No',
            'code' => 'Code',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'main_cause' => 'Main Cause',
            'vehicles_involved' => 'Vehicles Involved',
            'photos' => 'Photos',
            'other_damages' => 'Other Damages',
            'collision_type' => 'Collision Type',
            'weather_condition' => 'Weather Condition',
            'road_condition' => 'Road Condition',
            'barangay' => 'Barangay',
            'landmarks' => 'Landmarks',
            'road_type' => 'Road Type',
            'remarks' => 'Remarks',
            'preferred_by' => 'Prepared By',
            // 'preferred_by' => 'Preferred By',
            'noted_by' => 'Noted By',
            'date' => 'Date',
            'sketch' => 'Sketch',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\VehicularAccidentReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\VehicularAccidentReportQuery(get_called_class());
    }

    public function getDefaultGridColumns()
    {
        return [
            'serial',
            'checkbox',
            'control_no',
            'code',
            'main_cause',
            'barangay',
            'date',
            'created_at',
            'last_updated'
        ];
    }
     
    public function gridColumns()
    {
        return [
            'control_no' => [
                'attribute' => 'control_no', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->control_no,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'code' => ['attribute' => 'code', 'format' => 'raw'],
            'latitude' => ['attribute' => 'latitude', 'format' => 'raw'],
            'longitude' => ['attribute' => 'longitude', 'format' => 'raw'],
            'main_cause' => ['attribute' => 'main_cause', 'format' => 'raw'],
            'vehicles_involved' => ['attribute' => 'vehicles_involved', 'format' => 'raw'],
            // 'photos' => ['attribute' => 'photos', 'format' => 'raw'],
            // 'other_damages' => ['attribute' => 'other_damages', 'format' => 'raw'],
            'collision_type' => ['attribute' => 'collision_type', 'format' => 'raw'],
            'weather_condition' => ['attribute' => 'weather_condition', 'format' => 'raw'],
            'road_condition' => ['attribute' => 'road_condition', 'format' => 'raw'],
            'barangay' => ['attribute' => 'barangay', 'format' => 'raw'],
            'landmarks' => ['attribute' => 'landmarks', 'format' => 'raw'],
            'road_type' => ['attribute' => 'road_type', 'format' => 'raw'],
            'remarks' => ['attribute' => 'remarks', 'format' => 'raw'],
            'preferred_by' => ['attribute' => 'preferred_by', 'format' => 'raw'],
            'noted_by' => ['attribute' => 'noted_by', 'format' => 'raw'],
            'date' => ['attribute' => 'date', 'format' => 'raw'],
            'sketch' => ['attribute' => 'sketch', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'control_no:raw',
            'code:raw',
            'latitude:raw',
            'longitude:raw',
            'main_cause:raw',
            'vehicles_involved:raw',
            // 'photos:raw',
            // 'other_damages:raw',
            'collision_type:raw',
            'weather_condition:raw',
            'road_condition:raw',
            'barangay:raw',
            'landmarks:raw',
            'road_type:raw',
            'remarks:raw',
            'preferred_by:raw',
            'noted_by:raw',
            'date:raw',
            'sketch:raw',
        ];
    }

    public function setInitData()
    {
        $this->setTheControlNo();
        $this->setTheCode();
        $this->setTheNotedBy();
    }

    public function setTheNotedBy()
    {
        $this->noted_by = 'Eliseo Ruzol';
    }

    public function setTheControlNo()
    {
        if ($this->control_no == null) {
            $maxId = self::find()->max('id');

            $this->control_no = implode('-', [
                'MDRRMO',
                'VA',
                App::setting('currentYear'),
                App::formatter()->AsStrPad($maxId + 1, 5)
            ]);
        }
    }

    public function setTheCode()
    {
        if ($this->code == null) {
            $maxId = self::find()->max('id');
            $this->code = implode('-', [
                'GN',
                'DRRM',
                'VAR',
                App::formatter()->AsStrPad($maxId + 1, 3)
            ]);
        }
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['JsonBehavior']['fields'] = [
            'photos', 
            'other_damages',
        ];

        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'inFormat' => 'Y-m-d',
            'outFormat' => 'm/d/Y',
            'attributes' => [
                'date',
            ]
        ];

        return $behaviors;
    }

    public function getFilePhotos()
    {
        return File::findAll(['token' => $this->photos]);
    }

    public function getFileOtherDamages()
    {
        return File::findAll(['token' => $this->other_damages]);
    }

    public function getVehicles()
    {
        return $this->hasMany(Vehicle::class, ['vehicular_accident_report_id' => 'id']);
    }

    public function getVehiclesWithStatements()
    {
        return $this->hasMany(Vehicle::class, ['vehicular_accident_report_id' => 'id'])
            ->onCondition(['<>', 'statement', '']);
    }

    public function getPassengers()
    {
        return $this->hasMany(Passenger::class, ['vehicular_accident_report_id' => 'id']);
    }

    public function getPassengersWithStatements()
    {
        return $this->hasMany(Passenger::class, ['vehicular_accident_report_id' => 'id'])
            ->onCondition(['<>', 'statement', '']);
    }

    public function getStatements()
    {
        return $this->hasMany(Statement::class, ['vehicular_accident_report_id' => 'id']);
    }

    public function getResponderStatements()
    {
        return $this->hasMany(Statement::class, ['vehicular_accident_report_id' => 'id'])
            ->onCondition(['type' => Statement::TYPE_RESPONDER]);
    }

    public function getWitnessStatements()
    {
        return $this->hasMany(Statement::class, ['vehicular_accident_report_id' => 'id'])
            ->onCondition(['type' => Statement::TYPE_WITNESS]);
    }

    public function getNewVehicle()
    {
        return new Vehicle([
            'vehicular_accident_report_id' => $this->id,
            'is_commercial' => Vehicle::NOT_COMMERCIAL,
            'insurance_status' => Vehicle::INSURANCE_NONE
        ]);
    }

    public function getNewPassenger()
    {
        return new Passenger([
            'vehicular_accident_report_id' => $this->id,
            'preferred_by' => $this->preferred_by,
            'noted_by' => $this->noted_by,
            'date' => $this->date,
        ]);
    }

    public function getNewStatement()
    {
        return new Statement([
            'vehicular_accident_report_id' => $this->id,
            'date' => App::formatter()->asDateToTimezone('', 'm/d/Y'),
        ]);
    }

    public function getPrintableUrl($fullpath=true)
    {
        if ($this->checkLinkAccess('printable')) {
            $paramName = $this->paramName();
            $url = [
                implode('/', [$this->controllerID(), 'printable']),
                $paramName => $this->{$paramName}
            ];
            return ($fullpath)? Url::to($url, true): $url;
        }
    }

    public function getPrintableDataPrivacyUrl($fullpath=true)
    {
        if ($this->checkLinkAccess('printable-data-privacy')) {
            $paramName = $this->paramName();
            $url = [
                implode('/', [$this->controllerID(), 'printable-data-privacy']),
                $paramName => $this->{$paramName}
            ];
            return ($fullpath)? Url::to($url, true): $url;
        }
    }

    public function getPrintableAttachmentUrl($fullpath=true)
    {
        if ($this->checkLinkAccess('printable-attachment')) {
            $paramName = $this->paramName();
            $url = [
                implode('/', [$this->controllerID(), 'printable-attachment']),
                $paramName => $this->{$paramName}
            ];
            return ($fullpath)? Url::to($url, true): $url;
        }
    }

    public function getParamMainCause($index)
    {
        return App::params('var')['main_cause'][$index] ?? '';
    }

    public function getOtherMainCause()
    {
        if (!in_array($this->main_cause, App::params('var')['main_cause'])) {
            return $this->main_cause;
        }
    }

    public function getVehiclesData()
    {
        if ($this->_vehicles_data === null) {
            $data = Vehicle::find()
                ->select(['COUNT("*") AS total', 'type'])
                ->where(['vehicular_accident_report_id' => $this->id])
                ->groupBy('type')
                ->asArray()
                ->all();

            $this->_vehicles_data = ArrayHelper::map($data, 'type', 'total');
        }

        return $this->_vehicles_data;
    }

    public function getTotalVehiclesData($type)
    {
        $data = $this->vehiclesData;

        return $data[$type] ?? 0;
    }

    public function getOtherTotalVehiclesData()
    {
        $vehiclesData = $this->vehiclesData;
        $total_other_vehicle = 0;
        $data = [];

        foreach ($vehiclesData as $type => $total) {
            if (!in_array($type, App::params('var')['type'])) {
                $total_other_vehicle += $total;
                $data[] = "[{$total}]{$type}";
            }
        }

        return [
            'total_other_vehicle' => $total_other_vehicle,
            'data' => implode(', ', $data),
        ];
    }

    public function getGeneratedDate()
    {
        return App::formatter()->asDateToTimezone(null, 'F d, Y');
        // return App::formatter()->asDateToTimezone($this->created_at, 'F d, Y');
    }

    public function getParamCollisionType($index)
    {
        return App::params('var')['collision_type'][$index] ?? '';
    }

    public function getParamWeatherCondition($index)
    {
        return App::params('var')['weather_condition'][$index] ?? '';
    }

    public function getParamRoadCondition($index)
    {
        return App::params('var')['road_condition'][$index] ?? '';
    }

    public function getParamRoadType($index)
    {
        return App::params('var')['road_type'][$index] ?? '';
    }
    public function getOtherRoadType()
    {
        if (! in_array($this->road_type, App::params('var')['road_type'])) {
            return $this->road_type;
        }
    }

    public function getOtherRoadCondition()
    {
        if (! in_array($this->road_condition, App::params('var')['road_condition'])) {
            return $this->road_condition;
        }
    }

    public function getOtherCollisionType()
    {
        if (! in_array($this->collision_type, App::params('var')['collision_type'])) {
            return $this->collision_type;
        }
    }
    public function getOtherWeatherCondition()
    {
        if (! in_array($this->weather_condition, App::params('var')['weather_condition'])) {
            return $this->weather_condition;
        }
    }
}
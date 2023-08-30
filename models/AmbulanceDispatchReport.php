<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%ambulance_dispatch_reports}}".
 *
 * @property int $id
 * @property string $date_time
 * @property string $requester_name
 * @property string|null $requester_contact
 * @property string|null $requester_relation
 * @property string $patient_name
 * @property string|null $patient_contact
 * @property int|null $patient_age
 * @property int|null $patient_gender
 * @property string|null $incident_location
 * @property string|null $incident_nature
 * @property string|null $incident_level
 * @property string|null $unit_id
 * @property string|null $dispatched_time
 * @property string|null $arrival_time
 * @property string|null $departure_time
 * @property string|null $arrival_time_facility
 * @property string|null $patient_condition
 * @property string|null $heart_rate
 * @property string|null $blood_pressure
 * @property string|null $spo2
 * @property string|null $description_of_symptoms
 * @property string|null $treatment_administered
 * @property string|null $facility_name
 * @property string|null $facility_contact
 * @property string|null $facility_receiver
 * @property string|null $ert_names
 * @property string|null $roles
 * @property string|null $vehicle_id
 * @property string|null $vehicle_type
 * @property string|null $vehicle_mileage
 * @property string|null $notes
 * @property string|null $prepared_by
 * @property string|null $noted_by
 * @property string|null $photos
 * @property string|null $attachments
 * @property string|null $token
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class AmbulanceDispatchReport extends ActiveRecord
{
    const MALE = 1;
    const FEMALE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ambulance_dispatch_reports}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'ambulance-dispatch-report',
            'mainAttribute' => 'requester_name',
            'paramName' => 'token',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['date_time', 'requester_name', 'patient_name'], 'required'],
            [['date_time', 'dispatched_time', 'arrival_time', 'departure_time', 'arrival_time_facility', 'ert_names', 'photos', 'attachments', 'mdrrmo'], 'safe'],
            [['patient_age', 'patient_gender'], 'integer'],
            ['patient_gender', 'in', 'range' => [
                null,
                self::MALE,
                self::FEMALE,
            ]],
            [['patient_condition', 'description_of_symptoms', 'treatment_administered', 'roles', 'notes'], 'string'],
            [['requester_name', 'requester_contact', 'requester_relation', 'patient_name', 'patient_contact', 'incident_location', 'incident_nature', 'incident_level', 'unit_id', 'heart_rate', 'blood_pressure', 'spo2', 'facility_name', 'facility_contact', 'facility_receiver', 'vehicle_id', 'vehicle_type', 'vehicle_mileage', 'prepared_by', 'noted_by'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'date_time' => 'Date Time',
            'requester_name' => 'Requester Name',
            'requester_contact' => 'Requester Contact',
            'requester_relation' => 'Requester Relation',
            'patient_name' => 'Patient Name',
            'patient_contact' => 'Patient Contact',
            'patient_age' => 'Patient Age',
            'patient_gender' => 'Patient Gender',
            'incident_location' => 'Incident Location',
            'incident_nature' => 'Incident Nature',
            'incident_level' => 'Incident Level',
            'unit_id' => 'Unit ID',
            'dispatched_time' => 'Dispatched Time',
            'arrival_time' => 'Arrival Time',
            'departure_time' => 'Departure Time',
            'arrival_time_facility' => 'Arrival Time Facility',
            'patient_condition' => 'Patient Condition',
            'heart_rate' => 'Heart Rate',
            'blood_pressure' => 'Blood Pressure',
            'spo2' => 'Spo2',
            'description_of_symptoms' => 'Description Of Symptoms',
            'treatment_administered' => 'Treatment Administered',
            'facility_name' => 'Facility Name',
            'facility_contact' => 'Facility Contact',
            'facility_receiver' => 'Facility Receiver',
            'ert_names' => 'Ert Names',
            'roles' => 'Roles',
            'vehicle_id' => 'Vehicle ID',
            'vehicle_type' => 'Vehicle Type',
            'vehicle_mileage' => 'Vehicle Mileage',
            'notes' => 'Notes',
            'prepared_by' => 'Prepared By',
            'noted_by' => 'Noted By',
            'photos' => 'Photos',
            'attachments' => 'Attachments',
            'mdrrmo' => 'MDRRMO',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\AmbulanceDispatchReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AmbulanceDispatchReportQuery(get_called_class());
    }

    public function getDefaultGridColumns()
    {
        return [
            'serial',
            'checkbox',
            'date',
            'requester',
            'patient',
            'incident',
            'dispatch',
            'facility',
            'vehicle',
            // 'notes',
            'prepared_by',
            'noted_by',
            // 'active',
            // 'created_at',
            // 'last_updated',
        ];
    }

    public function getRequesterDetails()
    {
        return implode("", [
            Html::tag('div', Html::tag('strong', 'Name: ') . $this->theValue('requester_name')),
            Html::tag('div', Html::tag('strong', 'Contact: ') . $this->theValue('requester_contact')),
            Html::tag('div', Html::tag('strong', 'Relation: ') . $this->theValue('requester_relation')),
        ]);
    }

    public function getPatientDetails()
    {
        return implode("", [
            Html::tag('div', Html::tag('strong', 'Name: ') . $this->theValue('patient_name')),
            Html::tag('div', Html::tag('strong', 'Contact: ') . $this->theValue('patient_contact')),
            Html::tag('div', Html::tag('strong', 'Age: ') . $this->theValue('patient_age')),
            Html::tag('div', Html::tag('strong', 'Gender: ') . $this->theValue('patient_gender')),
        ]);
    }

    public function getIncidentDetails()
    {
        return implode("", [
            Html::tag('div', Html::tag('strong', 'Location: ') . $this->theValue('incident_location')),
            Html::tag('div', Html::tag('strong', 'Nature: ') . $this->theValue('incident_nature')),
            Html::tag('div', Html::tag('strong', 'Level: ') . $this->theValue('incident_level')),
        ]);
    }

    public function getDispatchDetails()
    {
        return implode("", [
            Html::tag('div', Html::tag('strong', 'Unit ID: ') . $this->theValue('unit_id')),
            Html::tag('div', Html::tag('strong', 'Dispatched Time: ') . $this->theValue('dispatched_time')),
            Html::tag('div', Html::tag('strong', 'Arrival Time: ') . $this->theValue('arrival_time')),
            Html::tag('div', Html::tag('strong', 'Departure Time: ') . $this->theValue('departure_time')),
            Html::tag('div', Html::tag('strong', 'Facility Arrival Time: ') . $this->theValue('arrival_time_facility')),
            // Html::tag('div', 'Patient Condition: ' . $this->patient_condition),
        ]);
    }

    public function getFacilityDetails()
    {
        return implode("", [
            Html::tag('div', Html::tag('strong', 'Name: ') . $this->theValue('facility_name')),
            Html::tag('div', Html::tag('strong', 'Contact: ') . $this->theValue('facility_contact')),
            Html::tag('div', Html::tag('strong', 'Receiver: ') . $this->theValue('facility_receiver')),
        ]);
    }


    public function getVehicleDetails()
    {
        return implode("", [
            Html::tag('div', Html::tag('strong', 'ID: ') . $this->theValue('vehicle_id')),
            Html::tag('div', Html::tag('strong', 'Type: ') . $this->theValue('vehicle_type')),
            Html::tag('div', Html::tag('strong', 'Mileage: ') . $this->theValue('vehicle_mileage')),
        ]);
    }


    public function exportColumns()
    {
        return [
            'date_time',

            'requester_name',
            'requester_contact',
            'requester_relation',

            // Patient Information
            'patient_name',
            'patient_contact',
            'patient_age',
            'patient_gender',

            // Incident Information
            'incident_location',
            'incident_nature',
            'incident_level',

            // Dispatch Information
            'unit_id',
            'dispatched_time',
            'arrival_time',
            'departure_time',
            'arrival_time_facility',
            'patient_condition',

            // Condition Upon Arrival:
            'heart_rate',
            'blood_pressure',
            'spo2',
            'description_of_symptoms',
            'treatment_administered',

            // Hospital/Facility Information
            'facility_name',
            'facility_contact',
            'facility_receiver',

            // ERT Information
            'ert_names:encode',
            // 'roles',

            // Vehicle Information
            'vehicle_id',
            'vehicle_type',
            'vehicle_mileage',

            'notes',
            'prepared_by',
            'noted_by',
            // 'photos',
            // 'attachments',
        ];
    }
     
    public function gridColumns()
    {
        return [
            'date' => [
                'label' => 'date',
                'attribute' => 'date_time', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->date_time,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'requester' => [
                'label' => 'requester',
                'attribute' => 'requester_name', 
                'value' => 'requesterDetails',
                'format' => 'raw'
            ],

            'patient' => [
                'label' => 'patient',
                'attribute' => 'patient_name', 
                'value' => 'patientDetails',
                'format' => 'raw'
            ],

            'incident' => [
                'label' => 'incident',
                'attribute' => 'incident_location', 
                'value' => 'incidentDetails',
                'format' => 'raw'
            ],
            
            'dispatch' => [
                'label' => 'dispatch',
                'attribute' => 'unit_id', 
                'value' => 'dispatchDetails',
                'format' => 'raw'
            ],

            'facility' => [
                'label' => 'facility',
                'attribute' => 'facility_name', 
                'value' => 'facilityDetails',
                'format' => 'raw'
            ],
            'vehicle' => [
                'label' => 'vehicle',
                'attribute' => 'vehicle_id', 
                'value' => 'vehicleDetails',
                'format' => 'raw'
            ],

            'notes' => ['attribute' => 'notes', 'format' => 'raw'],
            'prepared_by' => ['attribute' => 'prepared_by', 'format' => 'raw'],
            'noted_by' => ['attribute' => 'noted_by', 'format' => 'raw'],
            
        ];
    }

    public function detailColumns()
    {
        return [
            'date_time:raw',
            'requester_name:raw',
            'requester_contact:raw',
            'requester_relation:raw',
            'patient_name:raw',
            'patient_contact:raw',
            'patient_age:raw',
            'patient_gender:raw',
            'incident_location:raw',
            'incident_nature:raw',
            'incident_level:raw',
            'unit_id:raw',
            'dispatched_time:raw',
            'arrival_time:raw',
            'departure_time:raw',
            'arrival_time_facility:raw',
            'patient_condition:raw',
            'heart_rate:raw',
            'blood_pressure:raw',
            'spo2:raw',
            'description_of_symptoms:raw',
            'treatment_administered:raw',
            'facility_name:raw',
            'facility_contact:raw',
            'facility_receiver:raw',
            'ert_names:encode',
            'roles:raw',
            'vehicle_id:raw',
            'vehicle_type:raw',
            'vehicle_mileage:raw',
            'notes:raw',
            'prepared_by:raw',
            'noted_by:raw',
            // 'photos:raw',
            // 'attachments:raw',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['JsonBehavior']['fields'] = [
            'ert_names', 
            'photos', 
            'attachments', 
        ];

        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'inFormat' => 'Y-m-d H:i:s',
            'outFormat' => 'm/d/Y h:i A',
            'attributes' => [
                'date_time',
                'dispatched_time',
                'arrival_time',
                'departure_time',
                'arrival_time_facility',
            ]
        ];

        
        return $behaviors;
    }

    public function getFilePhotos()
    {
        return File::findAll(['token' => $this->photos]);
    }

    public function getFileAttachments()
    {
        return File::findAll(['token' => $this->attachments]);
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

    public function getGenderLabel()
    {
        switch ($this->patient_gender) {
            case self::MALE: return 'Male'; break;
            case self::FEMALE: return 'Female'; break;
            
            default:
                return 'N/A';
                break;
        }
    }

    public function getReportId()
    {
        return App::formatter()->AsStrPad($this->id, 5);
    }
}
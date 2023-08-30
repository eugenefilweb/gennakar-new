<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%passengers}}".
 *
 * @property int $id
 * @property string $last_name
 * @property string|null $middle_name
 * @property string $first_name
 * @property string|null $address
 * @property string|null $email
 * @property string|null $contact_no
 * @property string|null $alternate_contact_no
 * @property int $age
 * @property int $sex
 * @property string|null $health_condition
 * @property string|null $medical_complaint
 * @property int $condition
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property int $vehicular_accident_report_id
 * @property int $vehicle_id
 */
class Passenger extends ActiveRecord
{
    const MALE = 0;
    const FEMALE = 1;

    const NON_FATAL = 0;
    const FATAL = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%passengers}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'passenger',
            'mainAttribute' => 'id',
            'paramName' => 'id',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['updateUrl'] = 'updateUrl';

        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['last_name', 'first_name', 'sex', 'age', 'date', 'preferred_by', 'noted_by', 'address', 'medical_complaint', 'condition', 'vehicle_id'], 'required'],
            [['address', 'health_condition'], 'string'],

            [['age', 'sex', 'condition', 'vehicular_accident_report_id', 'vehicle_id'], 'integer'],

            [['last_name', 'middle_name', 'first_name', 'email', 'contact_no', 'alternate_contact_no', 'medical_complaint', 'preferred_by', 'noted_by', 'date'], 'string', 'max' => 255],
            [['observation'], 'safe'],
            ['sex', 'in', 'range' => [
                self::MALE,
                self::FEMALE,
            ]],
            ['condition', 'in', 'range' => [
                self::FATAL,
                self::NON_FATAL,
            ]],
            [['email'], 'email'],
            [['email'], 'trim'],
            [['age'], 'integer', 'min' => 0],
            [['signature', 'statement', 'suffix_name'], 'safe'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'first_name' => 'First Name',
            'address' => 'Address',
            'email' => 'Email',
            'contact_no' => 'Contact No',
            'alternate_contact_no' => 'Alternate Contact No',
            'age' => 'Age',
            'sex' => 'Sex',
            'health_condition' => 'Health Condition',
            'medical_complaint' => 'Medical Complaint',
            'condition' => 'Condition',
            'vehicular_accident_report_id' => 'Vehicular Accident Report ID',
            'vehicle_id' => 'Vehicle ID',
            'suffix_name' => 'Name Suffix'
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PassengerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PassengerQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'last_name' => [
                'attribute' => 'last_name', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->last_name,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'middle_name' => ['attribute' => 'middle_name', 'format' => 'raw'],
            'first_name' => ['attribute' => 'first_name', 'format' => 'raw'],
            'address' => ['attribute' => 'address', 'format' => 'raw'],
            'email' => ['attribute' => 'email', 'format' => 'raw'],
            'contact_no' => ['attribute' => 'contact_no', 'format' => 'raw'],
            'alternate_contact_no' => ['attribute' => 'alternate_contact_no', 'format' => 'raw'],
            'age' => ['attribute' => 'age', 'format' => 'raw'],
            'sex' => ['attribute' => 'sex', 'format' => 'raw'],
            'health_condition' => ['attribute' => 'health_condition', 'format' => 'raw'],
            'medical_complaint' => ['attribute' => 'medical_complaint', 'format' => 'raw'],
            'condition' => ['attribute' => 'condition', 'format' => 'raw'],
            'vehicular_accident_report_id' => ['attribute' => 'vehicular_accident_report_id', 'format' => 'raw'],
            'vehicle_id' => ['attribute' => 'vehicle_id', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'last_name:raw',
            'middle_name:raw',
            'first_name:raw',
            'address:raw',
            'email:raw',
            'contact_no:raw',
            'alternate_contact_no:raw',
            'age:raw',
            'sex:raw',
            'health_condition:raw',
            'medical_complaint:raw',
            'condition:raw',
            'vehicular_accident_report_id:raw',
            'vehicle_id:raw',
        ];
    }

    public function getFullname()
    {
        return ucwords(implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->last_name,
            $this->suffix_name,
        ])));
    }

    public function getName()
    {
        return ucwords(implode(' ', array_filter([
            $this->first_name,
            $this->last_name,
        ])));
    }

    public function getIsFatal()
    {
        return $this->condition == self::FATAL;
    }

    public function getVehicle()
    {
        return $this->hasOne(Vehicle::class, ['id' => 'vehicle_id']);
    }

    public function getPlateNo()
    {
        return App::if($this->vehicle, fn ($vehicle) => $vehicle->plate_no);
    }

    public function getDriverPlateNo()
    {
        return App::if($this->vehicle, fn ($vehicle) => $vehicle->driverPlateNo);
    }

    public function getDriverFullname()
    {
        return App::if($this->vehicle, fn ($vehicle) => $vehicle->driverFullname);
    }
    
    public function getType()
    {
        return App::if($this->vehicle, fn ($vehicle) => $vehicle->type);
    }

    public function getSexLabel()
    {
        return App::params('gender')[$this->sex]['label'] ?? '';
    }

    public function getConditionLabel()
    {
        return $this->condition == self::FATAL ? 'Fatal': 'Non Fatal';
    }

    public function getParamMedicalComplaint($index)
    {
        return App::params('var')['medical_complaints'][$index] ?? '';
    }

    public function getOtherMedicalComplaint()
    {
        if (!in_array($this->medical_complaint, App::params('var')['medical_complaints'])) {
            return $this->medical_complaint;
        }
    }
}
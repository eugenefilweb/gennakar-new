<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Url;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%vehicles}}".
 *
 * @property int $id
 * @property string|null $plate_no
 * @property string|null $class
 * @property string|null $color
 * @property string|null $make
 * @property string|null $model
 * @property int|null $year
 * @property int $is_commercial
 * @property string|null $driver_firstname
 * @property string|null $driver_middlename
 * @property string|null $driver_lastname
 * @property string|null $driver_suffix
 * @property string|null $driver_address
 * @property string|null $driver_email
 * @property string|null $driver_contact_no
 * @property string|null $driver_alt_contact_no
 * @property string|null $company_name
 * @property string|null $company_address
 * @property string|null $company_contact_no
 * @property int $type_of_cargo
 * @property string|null $or_no
 * @property string|null $or_no_date_issued
 * @property string|null $cr_no
 * @property string|null $cr_no_date_issued
 * @property string|null $insurance_company
 * @property string|null $insurance_type
 * @property string|null $coverage_start_date
 * @property string|null $coverage_end_date
 * @property int $insurance_status
 * @property string|null $passengers
 * @property string|null $driver_license_front
 * @property string|null $driver_license_back
 * @property string|null $or_photo
 * @property string|null $cr_photo
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property int $vehicular_accident_report_id
 */
class Vehicle extends ActiveRecord
{
    const COMMERCIAL = 1;
    const NOT_COMMERCIAL = 0;

    const INSURANCE_NONE = 0;
    const INSURANCE_COVERED = 2;
    const INSURANCE_EXPIRED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vehicles}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'vehicle',
            'mainAttribute' => 'id',
            'paramName' => 'id',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['orPhoto'] = fn ($model) => Url::image($model->or_photo, ['w' => 200]);
        $fields['crPhoto'] = fn ($model) => Url::image($model->cr_photo, ['w' => 200]);
        $fields['dlfPhoto'] = fn ($model) => Url::image($model->driver_license_front, ['w' => 200]);
        $fields['dlbPhoto'] = fn ($model) => Url::image($model->driver_license_back, ['w' => 200]);
        $fields['updateUrl'] = 'updateUrl';

        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $COMMERCIAL = self::COMMERCIAL;

        return $this->setRules([
            [['driver_firstname', 'driver_lastname', 'driver_address', 'plate_no', 'class', 'color', 'make', 'model', 'year', 'insurance_status'], 'required'],
            [['company_name', 'company_address'], 'required', 'when' => fn ($model) => $model->isCommercial, 'whenClient' => "function (attribute, value) {
                    return $('.is_commercial:checked').val() == {$COMMERCIAL};
                }"],
            [['year', 'is_commercial', 'insurance_status', 'vehicular_accident_report_id'], 'integer'],
            [['passengers'], 'string'],
            [['plate_no', 'class', 'color', 'make', 'model', 'driver_firstname', 'driver_middlename', 'driver_lastname', 'driver_address', 'driver_email', 'driver_contact_no', 'driver_alt_contact_no', 'company_name', 'company_address', 'company_contact_no', 'or_no', 'or_no_date_issued', 'cr_no', 'cr_no_date_issued', 'insurance_company', 'insurance_type', 'coverage_start_date', 'coverage_end_date', 'driver_license_front', 'driver_license_back', 'or_photo', 'cr_photo', 'type_of_cargo', 'type'], 'string', 'max' => 255],
            [['driver_suffix'], 'string', 'max' => 16],
            ['vehicular_accident_report_id', 'exist', 'targetRelation' => 'vehicularAccidentReport'],
            [['plate_no', 'vehicular_accident_report_id'], 'unique', 'targetAttribute' => ['plate_no', 'vehicular_accident_report_id']],
            ['driver_email', 'email'],
            ['driver_email', 'trim'],
            [['coverage_start_date', 'coverage_end_date'], 'validateCoverage'],
            [['signature', 'statement'], 'safe'],
        ]);
    }

    public function validateCoverage($attribute, $params)
    {
        if ($this->coverage_start_date && $this->coverage_end_date) {
            $timestamp1 = strtotime($this->coverage_start_date);
            $timestamp2 = strtotime($this->coverage_end_date);

            if ($timestamp1  > $timestamp2) {
                $this->addError($attribute, 'Start date must less than end date');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'plate_no' => 'Plate No',
            'class' => 'Class',
            'color' => 'Color',
            'make' => 'Make',
            'model' => 'Model',
            'year' => 'Year',
            'is_commercial' => 'Is Commercial',
            'driver_firstname' => 'First Name',
            'driver_middlename' => 'Middle Name',
            'driver_lastname' => 'Surname',
            'driver_suffix' => 'Name Suffix',
            'driver_address' => 'Address',
            'driver_email' => 'Email',
            'driver_contact_no' => 'Contact No',
            'driver_alt_contact_no' => 'Alt Contact No',
            'company_name' => 'Company Name',
            'company_address' => 'Company Address',
            'company_contact_no' => 'Company Contact No',
            'type_of_cargo' => 'Type of Cargo',
            'or_no' => 'OR No',
            'or_no_date_issued' => 'Date Issued',
            'cr_no' => 'CR No',
            'cr_no_date_issued' => 'Date Issued',
            'insurance_company' => 'Insurance Company',
            'insurance_type' => 'Insurance Type',
            'coverage_start_date' => 'Coverage Start Date',
            'coverage_end_date' => 'Coverage End Date',
            'insurance_status' => 'Insurance Status',
            'passengers' => 'Passengers',
            'driver_license_front' => 'Driver License Front',
            'driver_license_back' => 'Driver License Back',
            'or_photo' => 'OR Photo',
            'cr_photo' => 'CR Photo',
            'vehicular_accident_report_id' => 'Vehicular Accident Report ID',
            'driverFullname' => 'Fullname'
        ]);
    }

    public function getPassengerModels()
    {
        return $this->hasMany(Passenger::class, ['vehicle_id' => 'id']);
    }

    public function getTotalPassengers($formatted=false)
    {
        $total = Passenger::find()
            ->where(['vehicle_id' => $this->id])
            ->count();

        return $formatted ? number_format($total): $total;
    }

    public function validatePlateNo($attribute, $params)
    {
        $model = self::find()
            ->where([
                'vehicular_accident_report_id' => $this->vehicular_accident_report_id,
                'plate_no' => $this->plate_no
            ])
            ->andWhere(['<>', 'id', $this->id])
            ->one();

        if ($this->isNewRecord) {
            $model = self::findOne([
                'vehicular_accident_report_id' => $this->vehicular_accident_report_id,
                'plate_no' => $this->plate_no
            ]);
        }

        if ($model) {
            $this->addError($attribute, 'Already exist');
        }
    }

    public function getVehicularAccidentReport()
    {
        return $this->hasOne(VehicularAccidentReport::class, ['id' => 'vehicular_accident_report_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\VehicleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\VehicleQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'plate_no' => [
                'attribute' => 'plate_no', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->plate_no,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'class' => ['attribute' => 'class', 'format' => 'raw'],
            'color' => ['attribute' => 'color', 'format' => 'raw'],
            'make' => ['attribute' => 'make', 'format' => 'raw'],
            'model' => ['attribute' => 'model', 'format' => 'raw'],
            'year' => ['attribute' => 'year', 'format' => 'raw'],
            'is_commercial' => ['attribute' => 'is_commercial', 'format' => 'raw'],
            'driver_firstname' => ['attribute' => 'driver_firstname', 'format' => 'raw'],
            'driver_middlename' => ['attribute' => 'driver_middlename', 'format' => 'raw'],
            'driver_lastname' => ['attribute' => 'driver_lastname', 'format' => 'raw'],
            'driver_suffix' => ['attribute' => 'driver_suffix', 'format' => 'raw'],
            'driver_address' => ['attribute' => 'driver_address', 'format' => 'raw'],
            'driver_email' => ['attribute' => 'driver_email', 'format' => 'raw'],
            'driver_contact_no' => ['attribute' => 'driver_contact_no', 'format' => 'raw'],
            'driver_alt_contact_no' => ['attribute' => 'driver_alt_contact_no', 'format' => 'raw'],
            'company_name' => ['attribute' => 'company_name', 'format' => 'raw'],
            'company_address' => ['attribute' => 'company_address', 'format' => 'raw'],
            'company_contact_no' => ['attribute' => 'company_contact_no', 'format' => 'raw'],
            'type_of_cargo' => ['attribute' => 'type_of_cargo', 'format' => 'raw'],
            'or_no' => ['attribute' => 'or_no', 'format' => 'raw'],
            'or_no_date_issued' => ['attribute' => 'or_no_date_issued', 'format' => 'raw'],
            'cr_no' => ['attribute' => 'cr_no', 'format' => 'raw'],
            'cr_no_date_issued' => ['attribute' => 'cr_no_date_issued', 'format' => 'raw'],
            'insurance_company' => ['attribute' => 'insurance_company', 'format' => 'raw'],
            'insurance_type' => ['attribute' => 'insurance_type', 'format' => 'raw'],
            'coverage_start_date' => ['attribute' => 'coverage_start_date', 'format' => 'raw'],
            'coverage_end_date' => ['attribute' => 'coverage_end_date', 'format' => 'raw'],
            'insurance_status' => ['attribute' => 'insurance_status', 'format' => 'raw'],
            'passengers' => ['attribute' => 'passengers', 'format' => 'raw'],
            'driver_license_front' => ['attribute' => 'driver_license_front', 'format' => 'raw'],
            'driver_license_back' => ['attribute' => 'driver_license_back', 'format' => 'raw'],
            'or_photo' => ['attribute' => 'or_photo', 'format' => 'raw'],
            'cr_photo' => ['attribute' => 'cr_photo', 'format' => 'raw'],
            'vehicular_accident_report_id' => ['attribute' => 'vehicular_accident_report_id', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'plate_no:raw',
            'class:raw',
            'color:raw',
            'make:raw',
            'model:raw',
            'year:raw',
            'is_commercial:raw',
            'driver_firstname:raw',
            'driver_middlename:raw',
            'driver_lastname:raw',
            'driver_suffix:raw',
            'driver_address:raw',
            'driver_email:raw',
            'driver_contact_no:raw',
            'driver_alt_contact_no:raw',
            'company_name:raw',
            'company_address:raw',
            'company_contact_no:raw',
            'type_of_cargo:raw',
            'or_no:raw',
            'or_no_date_issued:raw',
            'cr_no:raw',
            'cr_no_date_issued:raw',
            'insurance_company:raw',
            'insurance_type:raw',
            'coverage_start_date:raw',
            'coverage_end_date:raw',
            'insurance_status:raw',
            'passengers:raw',
            'driver_license_front:raw',
            'driver_license_back:raw',
            'or_photo:raw',
            'cr_photo:raw',
            'vehicular_accident_report_id:raw',
        ];
    }

    public function getDriverName()
    {
        return ucwords(implode(' ', array_filter([
            $this->driver_firstname,
            $this->driver_lastname,
        ])));
    }

    public function getDriverFullname()
    {
        return ucwords(implode(' ', array_filter([
            $this->driver_firstname,
            $this->driver_middlename,
            $this->driver_lastname,
            $this->driver_suffix
        ])));
    }

    public function getIsCommercial()
    {
        return $this->is_commercial == self::COMMERCIAL;
    }

    public function getIsCommercialLabel()
    {
        return $this->isCommercial ? 'Yes': 'No';
    }

    public function getDriverPlateNo()
    {
        return ucwords(implode(' | ', array_filter([
            $this->driverName,
            "{$this->class} - {$this->plate_no}",
        ])));
    }

    public static function dropdown($key='id', $value='name', $condition=[], $map=true, $limit=false)
    {
        $models = self::find()
            ->andFilterWhere($condition)
            ->orderBy([$value => SORT_ASC])
            ->limit($limit)
            ->all();

        $models = ($map)? ArrayHelper::map($models, $key, 'driverPlateNo'): $models;

        return $models;
    }

    public function getTheSignature()
    {
        return $this->signature ?: Url::image(App::setting('image')->image_holder);
    }

    public function getOrPhotoUrl($w=100)
    {
        return Url::image($this->or_photo, ['w' => $w]);
    }
    public function getCrPhotoUrl($w=100)
    {
        return Url::image($this->cr_photo, ['w' => $w]);
    }

    public function getInsuranceStatusLabel()
    {
        return App::params('var')['insurance_status'][$this->insurance_status] ?? '';
    }

    public function getCheckedInsurance($insurance_status)
    {
        return $this->insurance_status == $insurance_status ? 'checked': '';
    }

    public function getCheckedInsuranceType($insurance_type)
    {
        return $this->insurance_type == $insurance_type ? 'checked': '';
    }

    public function getParamInsuranceType($index)
    {
        return App::params('var')['insurance_type'][$index] ?? '';
    }

    public function getLicensePhotoFrontUrl($w=100)
    {
        return Url::image($this->driver_license_front, ['w' => $w]);
    }

    public function getLicensePhotoBackUrl($w=100)
    {
        return Url::image($this->driver_license_back, ['w' => $w]);
    }

    public function getOtherInsuranceType()
    {
        if (! in_array($this->insurance_type, App::params('var')['insurance_type'])) {
            return $this->insurance_type;
        }
    }
}
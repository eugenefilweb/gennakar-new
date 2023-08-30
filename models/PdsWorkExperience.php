<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%pds_work_experiences}}".
 *
 * @property int $id
 * @property int $pds_id
 * @property string|null $from
 * @property string|null $to
 * @property string $position
 * @property string $company
 * @property float|null $salary
 * @property string|null $salary_increment
 * @property string|null $appointment_status
 * @property int|null $government_service
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class PdsWorkExperience extends ActiveRecord
{
    const GOVERNMENT_NO = 1;
    const GOVERNMENT_YES = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pds_work_experiences}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'pds-work-experience',
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
            [['pds_id', 'position', 'company'], 'required'],
            [['pds_id', 'government_service'], 'integer'],
            ['government_service', 'in', 'range' => [
                null,
                self::GOVERNMENT_NO,
                self::GOVERNMENT_YES,
            ]],
            [['from', 'to'], 'safe'],
            [['salary'], 'number'],
            [['position', 'company', 'salary_increment', 'appointment_status'], 'string', 'max' => 255],
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
            'from' => 'From',
            'to' => 'To',
            'position' => 'Position',
            'company' => 'Company',
            'salary' => 'Salary',
            'salary_increment' => 'Pay Grade / Increment',
            'appointment_status' => 'Appointment Status',
            'government_service' => 'Government Service',
            'governmentServiceLabel' => 'Government Service',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PdsWorkExperienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PdsWorkExperienceQuery(get_called_class());
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
            'from' => ['attribute' => 'from', 'format' => 'raw'],
            'to' => ['attribute' => 'to', 'format' => 'raw'],
            'position' => ['attribute' => 'position', 'format' => 'raw'],
            'company' => ['attribute' => 'company', 'format' => 'raw'],
            'salary' => ['attribute' => 'salary', 'format' => 'raw'],
            'salary_increment' => ['attribute' => 'salary_increment', 'format' => 'raw'],
            'appointment_status' => ['attribute' => 'appointment_status', 'format' => 'raw'],
            'government_service' => ['attribute' => 'government_service', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'from:raw',
            'to:raw',
            'position:raw',
            'company:raw',
            'salary:raw',
            'salary_increment:raw',
            'appointment_status:raw',
            'governmentServiceLabel:raw',
        ];
    }

    public function getGovernmentServiceLabel()
    {
        switch ($this->government_service) {
            case self::GOVERNMENT_YES:
                return 'Yes';
                break;

            case self::GOVERNMENT_NO:
                return 'No';
                break;
            
            default:
                return 'N/A';
                break;
        }
    }

    public function getGovernmentServiceLabelAbb()
    {
        switch ($this->governmentServiceLabel) {
            case 'Yes':
                return 'Y';
                break;

            case 'No':
                return 'N';
                break;
            
            default:
                return 'N/A';
                break;
        }
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
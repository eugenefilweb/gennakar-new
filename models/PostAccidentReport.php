<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Url;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%post_accident_reports}}".
 *
 * @property int $id
 * @property string|null $location
 * @property string $control_no
 * @property string|null $type_of_accident
 * @property int|null $participant_male
 * @property int|null $participant_female
 * @property int|null $local_male
 * @property int|null $local_female
 * @property int|null $national_male
 * @property int|null $national_female
 * @property string|null $other_name
 * @property int|null $other_male
 * @property int|null $other_female
 * @property string|null $date_time
 * @property string|null $weather_condition
 * @property string|null $persons_of_interest
 * @property string|null $responders
 * @property string|null $witnesses
 * @property string|null $accident_report
 * @property string|null $prepared_by
 * @property string|null $verified_by
 * @property string|null $remarks
 * @property string|null $comments_by
 * @property string|null $officer_in_charge
 * @property string|null $noted_by
 * @property string|null $code
 * @property string|null $map
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class PostAccidentReport extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_accident_reports}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'post-accident-report',
            'mainAttribute' => 'control_no',
            'paramName' => 'control_no',
            'dateAttribute' => 'date_time'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['location', 'accident_report', 'remarks', 'map', 'barangay'], 'string'],
            [['control_no', 'name_of_rescuee',], 'required'],
            [['participant_male', 'participant_female', 'local_male', 'local_female', 'national_male', 'national_female', 'other_male', 'other_female', 'age', 'sex'], 'integer'],
            [['date_time', 'persons_of_interest', 'responders', 'witnesses',], 'safe'],
            [['control_no', 'type_of_accident', 'other_name', 'weather_condition', 'prepared_by', 'verified_by', 'comments_by', 'officer_in_charge', 'noted_by', 'code', 'name_of_rescuee', 'date_of_birth', 'street_address', 'barangay_address', 'pre_existing_condition'], 'string', 'max' => 255],
            [['control_no'], 'unique'],
            [['photo1', 'photo2', 'photo3', 'photo4', 'social_media_link', 'name_of_rescuee', 'date_of_birth', 'street_address', 'barangay_address', 'pre_existing_condition', 'latitude', 'longitude'], 'safe'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'location' => 'Location',
            'control_no' => 'Control No',
            'type_of_accident' => 'Type of Response',
            'participant_male' => 'Participant Male',
            'participant_female' => 'Participant Female',
            'local_male' => 'Local Male',
            'local_female' => 'Local Female',
            'national_male' => 'National Male',
            'national_female' => 'National Female',
            'other_name' => 'Other Name',
            'other_male' => 'Other Male',
            'other_female' => 'Other Female',
            'date_time' => 'Date Time',
            'weather_condition' => 'Weather Condition',
            'persons_of_interest' => 'Persons of Interest',
            'responders' => 'Responders',
            'witnesses' => 'Witnesses',
            'accident_report' => 'Accident Report',
            'prepared_by' => 'Prepared By',
            'verified_by' => 'Verified By',
            'remarks' => 'Remarks',
            'comments_by' => 'Comments By',
            'officer_in_charge' => 'Officer In-Charge',
            'noted_by' => 'Noted By',
            'code' => 'Code',
            'map' => 'Map',
            'barangay' => 'Barangay',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PostAccidentReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PostAccidentReportQuery(get_called_class());
    }

    public function getDefaultGridColumns()
    {
        return [
            'serial',
            'checkbox',
            'control_no',
            'location',
            'type_of_accident',
            'officer_in_charge',
            'date_time',
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
            'location' => ['attribute' => 'location', 'format' => 'raw'],
            'type_of_accident' => ['attribute' => 'type_of_accident', 'format' => 'raw'],
            'participant_male' => ['attribute' => 'participant_male', 'format' => 'raw'],
            'participant_female' => ['attribute' => 'participant_female', 'format' => 'raw'],
            'local_male' => ['attribute' => 'local_male', 'format' => 'raw'],
            'local_female' => ['attribute' => 'local_female', 'format' => 'raw'],
            'national_male' => ['attribute' => 'national_male', 'format' => 'raw'],
            'national_female' => ['attribute' => 'national_female', 'format' => 'raw'],
            'other_name' => ['attribute' => 'other_name', 'format' => 'raw'],
            'other_male' => ['attribute' => 'other_male', 'format' => 'raw'],
            'other_female' => ['attribute' => 'other_female', 'format' => 'raw'],
            'weather_condition' => ['attribute' => 'weather_condition', 'format' => 'raw'],
            // 'persons_of_interest' => ['attribute' => 'persons_of_interest', 'format' => 'raw'],
            // 'responders' => ['attribute' => 'responders', 'format' => 'raw'],
            // 'witnesses' => ['attribute' => 'witnesses', 'format' => 'raw'],
            'accident_report' => ['attribute' => 'accident_report', 'format' => 'raw'],
            'prepared_by' => ['attribute' => 'prepared_by', 'format' => 'raw'],
            'verified_by' => ['attribute' => 'verified_by', 'format' => 'raw'],
            'remarks' => ['attribute' => 'remarks', 'format' => 'raw'],
            'comments_by' => ['attribute' => 'comments_by', 'format' => 'raw'],
            'officer_in_charge' => ['attribute' => 'officer_in_charge', 'format' => 'raw'],
            'date_time' => ['attribute' => 'date_time', 'format' => 'raw'],
            'noted_by' => ['attribute' => 'noted_by', 'format' => 'raw'],
            'code' => ['attribute' => 'code', 'format' => 'raw'],
            'map' => ['attribute' => 'map', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'location:raw',
            'control_no:raw',
            'type_of_accident:raw',
            'participant_male:raw',
            'participant_female:raw',
            'local_male:raw',
            'local_female:raw',
            'national_male:raw',
            'national_female:raw',
            'other_name:raw',
            'other_male:raw',
            'other_female:raw',
            'date_time:raw',
            'weather_condition:raw',
            'persons_of_interest:jsonEditor',
            'responders:jsonEditor',
            'witnesses:jsonEditor',
            'accident_report:raw',
            'prepared_by:raw',
            'verified_by:raw',
            'remarks:raw',
            'comments_by:raw',
            'officer_in_charge:raw',
            'noted_by:raw',
            'code:raw',
            'map:raw',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['JsonBehavior']['fields'] = [
            'persons_of_interest',
            'responders',
            'witnesses'
        ];

        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'inFormat' => 'Y-m-d H:i:s',
            'outFormat' => 'm/d/Y h:i A',
            'attributes' => [
                'date_time',
                [
                    'field' => 'date_of_birth',
                    'inFormat' => 'Y-m-d',
                    'outFormat' => 'm/d/Y',
                ]
            ]
        ];

        return $behaviors;
    }

    public function setTheControlNo()
    {
        if ($this->control_no == null) {
            $maxId = self::find()->max('id');

            $this->control_no = implode('-', [
                'MDRRMO',
                'PA',
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
                'PAR',
                App::formatter()->AsStrPad($maxId + 1, 3)
            ]);
        }
    }

    public function getOtherTypeOfAccident()
    {
        return in_array($this->type_of_accident, App::params('type_of_accident')) ? '': $this->type_of_accident;
    }

    public function getDate()
    {
        return date('m/d/Y', strtotime($this->date_time));
    }

    public function getTime()
    {
        return date('h:i A', strtotime($this->date_time));
    }

    public function getGeneratedDate()
    {
        return App::formatter()->asDateToTimezone(null, 'F d, Y');
        // return App::formatter()->asDateToTimezone($this->created_at, 'F d, Y');
    }

    public function getTotalMale()
    {
        return array_sum([
            $this->participant_male,
            $this->local_male,
            $this->national_male,
            $this->other_male,
        ]);
    }

    public function getTotalFemale()
    {
        return array_sum([
            $this->participant_female,
            $this->local_female,
            $this->national_female,
            $this->other_female,
        ]);
    }

    public function getTypeOfAccidentParam($key)
    {
        return App::params('type_of_accident')[$key] ?? '';
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

    public function getPhoto1File()
    {
        return App::if($this->photo1, fn($token) => File::findByToken($token));
    }

    public function getPhoto2File()
    {
        return App::if($this->photo2, fn($token) => File::findByToken($token));
    }

    public function getPhoto3File()
    {
        return App::if($this->photo3, fn($token) => File::findByToken($token));
    }

    public function getPhoto4File()
    {
        return App::if($this->photo4, fn($token) => File::findByToken($token));
    }

    public function getSexLabel()
    {
        return App::if(App::params('gender')[$this->sex] ?? '', fn($param) => $param['label']);
    }

    public function setVerifiedBy()
    {
        $this->verified_by = 'Arberto Astrera';
    }

    public function setCommentsBy()
    {
        $this->comments_by = 'Arberto Astrera';
    }

    public function setInchargeOfActivity()
    {
        $this->officer_in_charge = 'Arberto Astrera';
    }

    public function setInitData()
    {
        $this->setInchargeOfActivity();
        $this->setCommentsBy();
        $this->setVerifiedBy();
        $this->setTheControlNo();
        $this->setTheCode();
    }
}
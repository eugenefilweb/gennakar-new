<?php

namespace app\models;

use Yii;
use app\models\Role;
use app\helpers\App;
use app\helpers\Url;
use app\widgets\Anchor;
use DateTime;
use PhpOffice\PhpSpreadsheet\Shared\TimeZone;

/**
 * This is the model class for table "{{%post_activity_reports}}".
 *
 * @property int $id
 * @property string $control_no
 * @property string $name
 * @property string|null $location
 * @property string|null $type_of_activity
 * @property int|null $beneficiary_stakeholder_male
 * @property int|null $beneficiary_stakeholder_female
 * @property int|null $beneficiary_local_male
 * @property int|null $beneficiary_local_female
 * @property int|null $beneficiary_national_male
 * @property int|null $beneficiary_national_female
 * @property string|null $date_started
 * @property string|null $date_end
 * @property string|null $responsible_head
 * @property string|null $coordinators
 * @property string|null $staff_members
 * @property string|null $other_members
 * @property string|null $activity_brief
 * @property string|null $prepared_by
 * @property string|null $verified_by
 * @property string|null $remarks
 * @property string|null $comments_by
 * @property string|null $in_charge_of_activity
 * @property string|null $noted_by
 * @property string|null $code
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class PostActivityReport extends ActiveRecord
{
    const TYPE_SIAD = 1;
    const TYPE_DRRM = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_activity_reports}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'post-activity-report',
            'mainAttribute' => 'control_no',
            'paramName' => 'control_no',
            'dateAttribute' => 'date_started'
        ];
    }

    public function getIsSiad()
    {
        return $this->type == self::TYPE_SIAD;
    }

    public function getHeaderLabel()
    {
        return $this->isSiad ? 'SIAD PROJECT OFFICE': 'MDDRMO';
    }

    public function setTheControlNo()
    {
        if ($this->control_no == null) {
            $maxId = self::find()->max('id');

            $this->control_no = implode('-', [
                (($this->isSiad) ? 'SIAD': 'MDRRMO'),
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

            $type = $this->isSiad? 'SIAD': 'DRRM';
            $this->code = implode('-', [
                'GN',
                $type,
                'PAR',
                App::formatter()->AsStrPad($maxId + 1, 3)
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['control_no', 'name'], 'required'],
            [['location', 'activity_brief', 'remarks'], 'string'],
            [['beneficiary_stakeholder_male', 'beneficiary_stakeholder_female', 'beneficiary_local_male', 'beneficiary_local_female', 'beneficiary_national_male', 'beneficiary_national_female', 'beneficiary_other_male', 'beneficiary_other_female', 'watershed_id', 'type', 'barangay_id'], 'integer'],
            [['date_started', 'date_end', 'map', 'coordinators', 'staff_members', 'other_members'], 'safe'],
            [['control_no', 'code'], 'string', 'max' => 64],
            [['name', 'type_of_activity', 'responsible_head', 'prepared_by', 'verified_by', 'comments_by', 'in_charge_of_activity', 'noted_by', 'beneficiary_other_name'], 'string', 'max' => 255],
            [['control_no'], 'unique'],
            [['date_started', 'date_end'], 'validateDates'],
            ['type', 'in', 'range' => [
                self::TYPE_SIAD,
                self::TYPE_DRRM,
            ]],
            [['photo1', 'photo2', 'photo3', 'photo4', 'social_media_link', 'latitude', 'longitude', 'additional_photos', 'additional_files'], 'safe'],
            ['barangay_id', 'exist', 'targetRelation' => 'barangay', 'when' => fn($model) => $model->barangay_id],
            ['watershed_id', 'exist', 'targetRelation' => 'watershed', 'when' => fn($model) => $model->watershed_id]
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
            'name' => 'Name of Activity',
            'location' => 'Location / Barangay',
            'type_of_activity' => 'Type of Activity',
            'beneficiary_stakeholder_male' => 'Total Male',
            'beneficiary_stakeholder_female' => 'Total Female',
            'beneficiary_local_male' => 'Total Male',
            'beneficiary_local_female' => 'Total Female',
            'beneficiary_national_male' => 'Total Male',
            'beneficiary_national_female' => 'Total Female',
            'beneficiary_other_male' => 'Total Male',
            'beneficiary_other_female' => 'Total Female',
            'beneficiary_other_name' => 'Beneficiary Other Name',
            'date_started' => 'Date Started',
            'date_end' => 'Date End',
            'responsible_head' => 'Responsible Head',
            'coordinators' => 'Coordinator',
            'staff_members' => 'Staff Members',
            'other_members' => 'Others',
            'activity_brief' => 'Activity Brief',
            'prepared_by' => 'Prepared By',
            'verified_by' => 'Verified By',
            'remarks' => 'Remarks',
            'comments_by' => 'Comments By',
            'in_charge_of_activity' => 'In Charge of Activity',
            'noted_by' => 'Noted By',
            'code' => 'Code',
            'watershed_id' => 'Watershed',
            'map' => 'Map',
            'type' => 'Type',
            'barangay_id' => 'Barangay'
        ]);
    }

    public function getBarangay()
    {
        return $this->hasOne(HazardMap::class, ['id' => 'barangay_id'])
            ->onCondition(['type' => HazardMap::BARANGAY]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PostActivityReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PostActivityReportQuery(get_called_class());
    }

    public function getWatershed()
    {
        return $this->hasOne(HazardMap::class, ['id' => 'watershed_id'])
            ->onCondition(['type' => HazardMap::WATERSHED]);
    }

    public function getBarangayName()
    {
        return App::if($this->barangay, fn($barangay) => $barangay->name);
    }

    public function getWatershedName()
    {
        return App::if($this->watershed, fn($watershed) => $watershed->name);
    }

    public function validateDates($attr, $params)
    {
        $date_started = strtotime($this->date_started);
        $date_end = strtotime($this->date_end);

        if ($date_started > $date_end) {
            $this->addError($attr, 'Date Started must be before Date Ended');
        }
    }
    
    public function getDefaultGridColumns()
    {
        return [
            'serial',
            'checkbox',
            'control_no',
            'name',
            'location',
            'type_of_activity',
            'in_charge_of_activity',
            'date_started',
            'date_end',
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
            'name' => ['attribute' => 'name', 'format' => 'raw'],
            'location' => ['attribute' => 'location', 'format' => 'raw'],
            'type_of_activity' => ['attribute' => 'type_of_activity', 'format' => 'raw'],
            'beneficiary_stakeholder_male' => ['attribute' => 'beneficiary_stakeholder_male', 'format' => 'raw'],
            'beneficiary_stakeholder_female' => ['attribute' => 'beneficiary_stakeholder_female', 'format' => 'raw'],
            'beneficiary_local_male' => ['attribute' => 'beneficiary_local_male', 'format' => 'raw'],
            'beneficiary_local_female' => ['attribute' => 'beneficiary_local_female', 'format' => 'raw'],
            'beneficiary_national_male' => ['attribute' => 'beneficiary_national_male', 'format' => 'raw'],
            'beneficiary_national_female' => ['attribute' => 'beneficiary_national_female', 'format' => 'raw'],
            'beneficiary_other_male' => ['attribute' => 'beneficiary_other_male', 'format' => 'raw'],
            'beneficiary_other_female' => ['attribute' => 'beneficiary_other_female', 'format' => 'raw'],
            'beneficiary_other_name' => ['attribute' => 'beneficiary_other_female', 'format' => 'raw'],
            'in_charge_of_activity' => ['attribute' => 'in_charge_of_activity', 'format' => 'raw'],
            'date_started' => ['attribute' => 'date_started', 'format' => 'raw'],
            'date_end' => ['attribute' => 'date_end', 'format' => 'raw'],
            'responsible_head' => ['attribute' => 'responsible_head', 'format' => 'raw'],
            // 'coordinators' => ['attribute' => 'coordinators', 'format' => 'raw'],
            // 'staff_members' => ['attribute' => 'staff_members', 'format' => 'raw'],
            // 'other_members' => ['attribute' => 'other_members', 'format' => 'raw'],
            'activity_brief' => ['attribute' => 'activity_brief', 'format' => 'raw'],
            'prepared_by' => ['attribute' => 'prepared_by', 'format' => 'raw'],
            'verified_by' => ['attribute' => 'verified_by', 'format' => 'raw'],
            'remarks' => ['attribute' => 'remarks', 'format' => 'raw'],
            'comments_by' => ['attribute' => 'comments_by', 'format' => 'raw'],
            'noted_by' => ['attribute' => 'noted_by', 'format' => 'raw'],
            'code' => ['attribute' => 'code', 'format' => 'raw'],
            'watershed_id' => ['attribute' => 'watershed_id', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'control_no:raw',
            'name:raw',
            'location:raw',
            'type_of_activity:raw',
            'beneficiary_stakeholder_male:raw',
            'beneficiary_stakeholder_female:raw',
            'beneficiary_local_male:raw',
            'beneficiary_local_female:raw',
            'beneficiary_national_male:raw',
            'beneficiary_national_female:raw',
            'beneficiary_other_male:raw',
            'beneficiary_other_female:raw',
            'beneficiary_other_name:raw',
            'date_started:raw',
            'date_end:raw',
            'responsible_head:raw',
            'coordinators:jsonEditor',
            'staff_members:jsonEditor',
            'other_members:jsonEditor',
            'activity_brief:raw',
            'prepared_by:raw',
            'verified_by:raw',
            'remarks:raw',
            'comments_by:raw',
            'in_charge_of_activity:raw',
            'noted_by:raw',
            'code:raw',
            'watershed_id:raw',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['JsonBehavior']['fields'] = [
            'coordinators',
            'staff_members',
            'other_members',
            'additional_photos',
            'additional_files',
        ];
        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'inFormat' => 'Y-m-d H:i:s',
            'outFormat' => 'm/d/Y h:i A',
            'attributes' => [
                'date_started',
                'date_end',
            ]
        ];

        return $behaviors;
    }

    public function beforeSave($insert)
    {
        if (! parent::beforeSave($insert)) {
            return false;
        }

        return true;
    }

    public function getTypeOfActivityList()
    {
        return $this->isSiad ? App::params('type_of_activity')['siad']: App::params('type_of_activity')['drrm'];

        return $data;
    }

    public function getSumOfBeneficiaryMale()
    {
        return array_sum([
            $this->beneficiary_stakeholder_male,
            $this->beneficiary_local_male,
            $this->beneficiary_national_male, 
            $this->beneficiary_other_male]
        );
    }
    
    public function getSumOfBeneficiaryFemale()
    {
        return array_sum([
            $this->beneficiary_stakeholder_female,
            $this->beneficiary_local_female,
            $this->beneficiary_national_female,
            $this->beneficiary_other_female
        ]);
    }

    public function getDateTimeZone() 
    {
        return App::formatter()->asDateToTimezone(null, 'F d, Y');
    }

    public function getOtherTypeOfActivity()
    {
        $data = App::params('type_of_activity')['siad'];

        if (App::isLogin()) {
            if (App::identity('isDrrm')) {
                $data = App::params('type_of_activity')['drrm'];
            }
        }

        return in_array($this->type_of_activity, $data) ? '': $this->type_of_activity;
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

    public function getAdditionalPhotos()
    {
        return File::findAll(['token' => $this->additional_photos]);
    }

    public function getAdditionalFiles()
    {
        return File::findAll(['token' => $this->additional_files]);
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

    public static function recent()
    {
        return self::find()
            ->limit(5)
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

    public function getSiadIndexUrl($fullpath=true)
    {
        if ($this->checkLinkAccess('siad')) {
            $paramName = $this->paramName();
            $url = [
                implode('/', [$this->controllerID(), 'siad']),
            ];
            return ($fullpath)? Url::toRoute($url, true): $url;
        }
    }

    public function getMdrrmoIndexUrl($fullpath=true)
    {
        if ($this->checkLinkAccess('mdrrmo')) {
            $paramName = $this->paramName();
            $url = [
                implode('/', [$this->controllerID(), 'mdrrmo']),
            ];
            return ($fullpath)? Url::toRoute($url, true): $url;
        }
    }

    public function getIndexUrl($fullpath=true)
    {
        return ($this->isSiad) ? $this->siadIndexUrl: $this->mdrrmoIndexUrl;
    }

    public function getActiveMenuLink()
    {
        $controllerId = $this->controllerID();

        return ($this->isSiad)? "/{$controllerId}/siad": "/{$controllerId}/mdrrmo";
    }

    public function setVerifiedBy()
    {
        $this->verified_by = ($this->isSiad)? 'Liwayway Espetero': 'Arberto Astrera';
    }

    public function setCommentsBy()
    {
        $this->comments_by = ($this->isSiad)? 'Liwayway Espetero': 'Arberto Astrera';
    }

    public function setInchargeOfActivity()
    {
        $this->in_charge_of_activity = ($this->isSiad)? 'Liwayway Espetero': 'Arberto Astrera';
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
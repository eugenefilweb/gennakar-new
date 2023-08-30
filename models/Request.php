<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\Anchor;
use yii\db\Expression;
use app\models\form\CustomEmailForm;

/**
 * This is the model class for table "{{%requests}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $files
 * @property string|null $token
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Request extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DECLINED = 2;
    const STATUS_CANCELLED = 3;

    const WAITING = 0;
    const NOT_DISPATCHED = 1;
    const DISPATCHED = 2;

    const MALE = 0;
    const FEMALE = 1;

    const EMERGENCY = 0;
    const PATIENT_TRANSFER = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%requests}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'request',
            'mainAttribute' => 'chief_complaint',
            'paramName' => 'id',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['name', 'chief_complaint', 'address', 'barangay'], 'required'],
            [['description'], 'string'],
            ['pickup_address', 'required', 'when' => function($model) {
                return $model->address == null;
            }],
            [['name', 'chief_complaint', 'other_complaints', 'driver', 'barangay'], 'string', 'max' => 255],
            [['files', 'address', 'pickup_address', 'other_complaints', 'destination', 'driver', 'responders', 'patient_companions', 'date_time'], 'safe'],
            [['date_time'], 'required', 'when' => fn($model) => $model->type == self::PATIENT_TRANSFER],
            [['status', 'sex', 'type', 'ambulance_dispatched'], 'integer'],
            ['ambulance_dispatched', 'default', 'value' => self::WAITING],
            ['ambulance_dispatched', 'in', 'range' => [
                self::DISPATCHED,
                self::NOT_DISPATCHED,
                self::WAITING,
            ]],

            ['status', 'in', 'range' => [
                self::STATUS_PENDING,
                self::STATUS_APPROVED,
                self::STATUS_DECLINED,
                self::STATUS_CANCELLED,
            ]],
            ['sex', 'in', 'range' => [
                self::MALE,
                self::FEMALE,
            ]],
            ['type', 'in', 'range' => [
                self::EMERGENCY,
                self::PATIENT_TRANSFER,
            ]],
            ['date_time', 'validateDatetime'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'name' => 'Name of Patient',
            'address' => 'Home Address',
            'description' => 'Remarks',
            'files' => 'Files',
            'statusBadge' => 'Status',
            'sexLabel' => 'Sex',
            'typeLabel' => 'Type',
            'ambulanceStatusBadge' => 'Ambulance Status'
        ]);
    }

    public function validateDatetime($attribute, $params)
    {
        $current = strtotime(App::formatter()->asDateToTimezone());
        $date_time = strtotime($this->date_time);

        if ($current > $date_time && $this->type == self::PATIENT_TRANSFER) {
            $this->addError($attribute, 'Date and Time is invalid');
        }
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RequestQuery(get_called_class());
    }

    public function getDefaultGridColumns()
    {
        return [
            'serial',
            'checkbox',
            'chief_complaint',
            'name',
            'pickup_address',
            'destination',
            'date_time',
            'status',
            'created_at',
            // 'last_updated',
            // 'active'
        ];
    }
     
    public function gridColumns()
    {
        return [
            'chief_complaint' => [
                'attribute' => 'chief_complaint', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->chief_complaint,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'name' => [
                'attribute' => 'name', 
                'format' => 'raw',
                'value' => fn($model) => implode('<br>', [$model->name, Html::tag('small', $model->sexLabel, ['class' => 'text-muted font-weight-bold'])])
            ],
            'type' => [
                'attribute' => 'type', 
                'value' => 'typeLabel', 
                'format' => 'raw'
            ],
            'barangay' => ['attribute' => 'barangay', 'format' => 'raw'],
            'date_time' => ['attribute' => 'date_time', 'format' => 'raw'],
            'pickup_address' => ['attribute' => 'pickup_address', 'format' => 'raw'],
            'destination' => ['attribute' => 'destination', 'format' => 'raw'],
            'status' => [
                'attribute' => 'status', 
                'format' => 'raw',
                'value' => 'statusBadge'
            ],
            'driver' => ['attribute' => 'driver', 'format' => 'raw'],
            'responders' => ['attribute' => 'responders', 'format' => 'ul'],
            'patient_companions' => ['attribute' => 'patient_companions', 'format' => 'ul'],
        ];
    }

    public function getStatusBadge()
    {
        return App::if(
            App::params('request_status')[$this->status] ?? '', 
            fn($data) => Html::tag('label', $data['label'], [
                'class' => 'badge badge-' . $data['class']
            ])
        );
    }

    public function detailColumns()
    {
        return [
            'statusBadge:raw',
            'ambulanceStatusBadge:raw',
            'typeLabel:raw',
            'chief_complaint:raw',
            'name:raw',
            'sexLabel:raw',
            'barangay:raw',
            'address:raw',
            'pickup_address:raw',
            'other_complaints:raw',
            'destination:raw',
            'date_time:raw',
        ];
    }

    public function getImages()
    {
        if (($files = File::findAll(['token' => $this->files])) != null) {
            $images = [];

            foreach ($files as $file) {
                $images[] = Html::image($file, ['w' => 100, 'h' => 100, 'ratio' => 'false'], [
                    'class' => 'img-thumbnail'
                ]);
            }

            return implode(' ', $images);
        }
    }

    public function getSexLabel()
    {
        return $this->sex == self::MALE ? 'Male': 'Female';
    }

    public function getTypeLabel()
    {
        if ($this->type == 'EMERGENCY') {
            return Html::tag('label', 'EMERGENCY', ['class' => 'badge badge-danger']);
        }
        else {
            return Html::tag('label', 'PATIENT TRANSFER', ['class' => 'badge badge-primary']);
        }
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['JsonBehavior']['fields'] = [
            'files', 
            'responders', 
            'patient_companions'
        ];


        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'inFormat' => 'Y-m-d H:i:s',
            'outFormat' =>' m/d/Y h:i A',
            'attributes' => [
                'date_time',
            ]
        ];

        return $behaviors;
    }

    public function getRequestLogs()
    {
        return $this->hasMany(RequestLog::class, ['request_id' => 'id'])
            ->orderBy(['id' => SORT_DESC]);
    }

    public function afterDelete()
    {
        parent::afterDelete();

        RequestLog::deleteAll(['request_id' => $this->id]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->status = self::STATUS_PENDING;
        }
        
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            RequestLog::created($this);
            Notification::request($this);
        }
        else {
            RequestLog::updated($this);
            Notification::approvedRequestEmail($this);
        }
    }

    public function getCanCancelled()
    {
        return App::identity()->can('cancelled', 'request') && $this->status == self::STATUS_PENDING;
    }

    public function getCanApproved()
    {
        return App::identity()->can('approved', 'request') && $this->status == self::STATUS_PENDING;
    }

    public function getCanDeclined()
    {
        return App::identity()->can('declined', 'request') && $this->status == self::STATUS_PENDING;
    }


    public function getStatusLabel()
    {
        return App::if(
            App::params('request_status')[$this->status] ?? '', 
            fn($data) => $data['label']
        );
    }

    public function getStatusClass()
    {
        return App::if(
            App::params('request_status')[$this->status] ?? '', 
            fn($data) => $data['class']
        );
    }

    public function getAmbulanceStatusBadge()
    {
        return App::if(
            App::params('ambulance_dispatched_status')[$this->ambulance_dispatched] ?? '', 
            fn($data) => Html::tag('label', $data['label'], [
                'class' => 'badge badge-' . $data['class']
            ])
        );
    }

    public function getStatusToolbar()
    {
        $data = [];

        if ($this->canApproved) {
            $data[] = App::params('request_status')[self::STATUS_APPROVED];
        }

        if ($this->canDeclined) {
            $data[] = App::params('request_status')[self::STATUS_DECLINED];
        }

        if ($this->canCancelled) {
            $data[] = App::params('request_status')[self::STATUS_CANCELLED];
        }

        $links = App::foreach($data, 
            fn($d) => Html::a($d['actionLabel'], '#', [
                'class' => 'dropdown-item btn-change-status', 
                'data-status' => $d['id'],
            ])
        );

        if (!$links) {
            return;
        }

        return <<< HTML
            <div class="btn-group">
                <button class="text-uppercase btn btn-success font-weight-bold dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Change Status
                </button>
              
                <div class="dropdown-menu">
                    {$links}
                </div>
            </div>
        HTML;
    }

    public function getBeforeCanDelete()
    {
        return $this->status == self::STATUS_PENDING;
    }


    public function getBeforeCanUpdate()
    {
            return true;
        if ($this->status == self::STATUS_APPROVED && $this->ambulance_dispatched == self::WAITING) {
            return true;
        }
        return $this->status == self::STATUS_PENDING;
    }

    public function getBeforeCanDuplicate()
    {
        return $this->status == self::STATUS_PENDING;
    }

    public function getDispatchedAmbulanceButton()
    {
        if ($this->status == self::STATUS_APPROVED && $this->ambulance_dispatched != self::DISPATCHED) {
            return Html::a('Dispatch Ambulance', ['request/update', 'id' => $this->id, 'ambulance_dispatched' => self::DISPATCHED], [
                'class' => 'btn btn-primary font-weight-bold',
                'data-confirm' => 'Dispatch Ambulance',
                'data-method'=> 'POST'
            ]);
        }
    }
}
<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%request_logs}}".
 *
 * @property int $id
 * @property int $request_id
 * @property string|null $description
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class RequestLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%request_logs}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'request-log',
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
            [['request_id', 'title', 'description'], 'required'],
            [['request_id'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 225],
            ['request_id', 'exist', 'targetRelation' => 'request'],
            [['status'], 'integer'],
            ['status', 'in', 'range' => [
                Request::STATUS_PENDING,
                Request::STATUS_APPROVED,
                Request::STATUS_DECLINED,
                Request::STATUS_CANCELLED,
            ]]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'request_id' => 'Request ID',
            'description' => 'Description',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RequestLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RequestLogQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'request_id' => [
                'attribute' => 'request_id', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->request_id,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'description' => ['attribute' => 'description', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'request_id:raw',
            'description:raw',
        ];
    }

    public function getRequest()
    {
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }

    public static function created($request)
    {
        $model = new self([
            'request_id' => $request->id,
            'title' => 'New Request',
            'description' => implode("<br>", [
                "{$request->createdByName} created a request.", 
                "Ambulance Status: {$request->ambulanceStatusBadge}"
            ]),
            'status' => $request->status
        ]);

        $model->save();
    }

    public static function updated($request)
    {
        $model = new self([
            'request_id' => $request->id,
            'title' => 'Request Updated',
            'description' => implode("<br>", [
                $request->description,
                "Ambulance Status: {$request->ambulanceStatusBadge}"
            ]),
            'status' => $request->status
        ]);

        $model->save();
    }

    public function getStatusBadge()
    {
        return App::if(App::params('request_status')[$this->status] ?? '', 
            fn($data) => Html::tag('span', $data['label'], [
                'class' => 'badge badge-' . $data['class']
            ])
        );
    }

    public function getTimeSent()
    {
        $start = date("Y-m-d", strtotime(App::formatter()->asDateToTimezone('', 'Y-m-d H:i:s'))); 
        $end = date("Y-m-d", strtotime($this->created_at)); 

        $day   = App::component('general')->dateDiff($start, $end);
        $month = App::component('general')->dateDiff($start, $end, 'm');
        $year  = App::component('general')->dateDiff($start, $end, 'y');

        if ($year > 1) {
            return implode(' AT ', [
                date('M d, Y', strtotime($this->createdAt)),
                date('h:i A', strtotime($this->createdAt)),
            ]);
        }
        elseif ($month > 1 || $day > 7) {
            return implode(' AT ', [
                date('M d', strtotime($this->createdAt)),
                date('h:i A', strtotime($this->createdAt)),
            ]);
        }
        elseif ($day > 1) {
            return implode(' AT ', [
                date('D', strtotime($this->createdAt)),
                date('h:i A', strtotime($this->createdAt)),
            ]);
        }
        else {
            if ($start != $end) {
                return implode(' AT ', [
                    date('D', strtotime($this->createdAt)),
                    date('h:i A', strtotime($this->createdAt)),
                ]);
            }
            return date('h:i A', strtotime($this->createdAt));
        }
    }

    public function getIsSameDay()
    {
        $start = date("Y-m-d", strtotime(App::formatter()->asDateToTimezone('', 'Y-m-d H:i:s'))); 
        $end = date("Y-m-d", strtotime($this->created_at)); 

        return $start == $end;
    }

    public function getNewTag()
    {
        if ($this->isSameDay) {
            return Html::tag('span', 'new', [
                'class' => 'label label-light-success font-weight-bolder label-inline ml-2'
            ]);
        }
    }

    public function getUserImageUrl()
    {
        if (($createdBy = $this->createdBy) != null) {
            return Url::image($createdBy->photo, ['w' => 50]);
        }
    }
}
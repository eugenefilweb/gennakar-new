<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%meetings}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $remarks
 * @property string|null $minutes
 * @property string|null $minutes_files
 * @property string|null $attendance
 * @property string|null $attendance_files
 * @property string|null $resolutions
 * @property string|null $resolutions_file
 * @property string|null $photos
 * @property string|null $slug
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Meeting extends ActiveRecord
{
    const TYPE_NORMAL = 0;
    const TYPE_SPECIAL = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%meetings}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'meeting',
            'mainAttribute' => 'name',
            'paramName' => 'slug',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['name'], 'required'],
            [['description', 'remarks', 'minutes', 'attendance', 'resolutions'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['date_from', 'date_to', 'minutes_files', 'attendance_files', 'resolutions_file', 'photos'], 'safe'],
            ['date_to', 'validateDateTo'],
            ['type', 'in', 'range' => [
                self::TYPE_NORMAL,
                self::TYPE_SPECIAL,
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
            'name' => 'Name',
            'description' => 'Description',
            'remarks' => 'Remarks',
            'minutes' => 'Minutes',
            'minutes_files' => 'Minutes Files',
            'attendance' => 'Attendance',
            'attendance_files' => 'Attendance Files',
            'resolutions' => 'Resolutions',
            'resolutions_file' => 'Resolutions File',
            'photos' => 'Photos',
        ]);
    }

    public function validateDateTo($attribute, $params)
    {
        if ($this->date_to) {
            $to = strtotime($this->date_to);
            $from = strtotime($this->date_from);

            if ($to <= $from) {
                $this->addError($attribute, 'Date To must be greater than date from');
            }
        }
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\MeetingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\MeetingQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'name' => [
                'attribute' => 'name', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->name,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'description' => ['attribute' => 'description', 'format' => 'raw'],
            'remarks' => ['attribute' => 'remarks', 'format' => 'raw'],
            // 'minutes' => ['attribute' => 'minutes', 'format' => 'raw'],
            // 'minutes_files' => ['attribute' => 'minutes_files', 'format' => 'raw'],
            // 'attendance' => ['attribute' => 'attendance', 'format' => 'raw'],
            // 'attendance_files' => ['attribute' => 'attendance_files', 'format' => 'raw'],
            // 'resolutions' => ['attribute' => 'resolutions', 'format' => 'raw'],
            // 'resolutions_file' => ['attribute' => 'resolutions_file', 'format' => 'raw'],
            // 'photos' => ['attribute' => 'photos', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'name:raw',
            'description:raw',
            'remarks:raw',
            'date_from:raw',
            'date_to:raw',
            [
                'attribute' => 'minutes_files',
                'label' => 'Minutes',
                'value' => fn($model) => $model->filePreviews($model->minutesFiles),
                'format' => 'raw',
            ],
            [
                'attribute' => 'attendance_files',
                'label' => 'Attendance',
                'value' => fn($model) => $model->filePreviews($model->attendanceFiles),
                'format' => 'raw',
            ],
            [
                'attribute' => 'resolutions_file',
                'label' => 'Attendance',
                'value' => fn($model) => $model->filePreviews($model->resolutionsFiles),
                'format' => 'raw',
            ],


            [
                'attribute' => 'photos',
                'label' => 'Photos',
                'value' => fn($model) => $model->filePreviews($model->photosFiles),
                'format' => 'raw',
            ],
        ];
    }

    public function filePreviews($files)
    {
        $files = App::foreach($files, 
            fn ($file) => Html::tag('div', Html::a($file->show([
                'class' => 'img-thumbnail symbol',
                'title' => 'View ' . $file->nameWithExtension,
                'data-toggle' => 'tooltip'
            ], 100), $file->viewerUrl, ['target' => '_blank']) 
            . Html::tag('div', $file->nameWithExtension), [
                'class' => 'col-md-2 mb-10'
            ])
        );

        return Html::tag('div', $files, ['class' => 'row']);
    }

    public function getMinutesFiles()
    {
        return File::findAll(['token' => $this->minutes_files]);
    }

    public function getAttendanceFiles()
    {
        return File::findAll(['token' => $this->attendance_files]);
    }

    public function getResolutionsFiles()
    {
        return File::findAll(['token' => $this->resolutions_file]);
    }

    public function getPhotosFiles()
    {
        return File::findAll(['token' => $this->photos]);
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['JsonBehavior']['fields'] = [
            'minutes_files', 
            'attendance_files',
            'resolutions_file',
            'photos',
        ];
        $behaviors['SluggableBehavior'] = [
            'class' => 'yii\behaviors\SluggableBehavior',
            'attribute' => 'name',
            'ensureUnique' => true,
        ];

        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'inFormat' => 'Y-m-d H:i:s',
            'outFormat' => 'm/d/Y h:i A',
            'attributes' => [
                'date_from',
                'date_to',
            ]
        ];

        return $behaviors;
    }

    public function getIsSpecial()
    {
        return $this->type == self::TYPE_SPECIAL;
    }

    public function getTypeBadge()
    {
        switch ($this->type) {
            case self::TYPE_SPECIAL:
                $badge = Html::tag('label', 'Special', ['class' => 'badge badge-success']);
                break;
            
            case self::TYPE_NORMAL:
                $badge = Html::tag('label', 'Regular', ['class' => 'badge badge-primary']);
                break;
            default:
                $badge = '';
                break;
        }

        return $badge;
    }
}
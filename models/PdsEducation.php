<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%pds_educations}}".
 *
 * @property int $id
 * @property int $pds_id
 * @property string $level
 * @property string $name
 * @property string|null $course
 * @property string $from
 * @property string|null $to
 * @property string|null $highest_level
 * @property string|null $year_graduated
 * @property string|null $academic_honor
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class PdsEducation extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pds_educations}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'pds-education',
            'mainAttribute' => 'name',
            'paramName' => 'id',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['pds_id', 'level', 'name', 'from'], 'required'],
            [['pds_id', 'year_graduated'], 'integer'],
            [['from', 'to'], 'safe'],
            [['level', 'name', 'course', 'highest_level', 'year_graduated', 'academic_honor'], 'string', 'max' => 255],
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
            'level' => 'Level',
            'name' => 'School Name',
            'course' => 'Degree / Course',
            'from' => 'From',
            'to' => 'To',
            'highest_level' => 'Highest Level / Units Earn (if not graduated)',
            'year_graduated' => 'Year Graduated',
            'academic_honor' => 'Scholarship / Academic Honor',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PdsEducationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PdsEducationQuery(get_called_class());
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
            'level' => ['attribute' => 'level', 'format' => 'raw'],
            'name' => ['attribute' => 'name', 'format' => 'raw'],
            'course' => ['attribute' => 'course', 'format' => 'raw'],
            'from' => ['attribute' => 'from', 'format' => 'raw'],
            'to' => ['attribute' => 'to', 'format' => 'raw'],
            'highest_level' => ['attribute' => 'highest_level', 'format' => 'raw'],
            'year_graduated' => ['attribute' => 'year_graduated', 'format' => 'raw'],
            'academic_honor' => ['attribute' => 'academic_honor', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'level:raw',
            'name:raw',
            'course:raw',
            'from:raw',
            'to:raw',
            'highest_level:raw',
            'year_graduated:raw',
            'academic_honor:raw',
        ];
    }

    public function getFromYear()
    {
        return $this->from ? date('Y', strtotime($this->from)): '';
    }

    public function getToYear()
    {
        return $this->to ? date('Y', strtotime($this->to)): '';
    }

    public function getFromYearMonth()
    {
        return $this->from ? date('m/Y', strtotime($this->from)): '';
    }

    public function getToYearMonth()
    {
        return $this->to ? date('m/Y', strtotime($this->to)): '';
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

    public function getLevelCourse()
    {
        return implode(' | ', array_filter([
            $this->level,
            $this->course,
        ]));
    }
}
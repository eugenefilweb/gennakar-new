<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Url;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%local_government_units}}".
 *
 * @property int $id
 * @property string $lgu_name
 * @property string|null $lgu_address
 * @property string $lgu_classification
 * @property string $lgu_region
 * @property string $name
 * @property string $position
 * @property string $contact_no
 * @property string|null $email
 * @property string $date_of_assessment
 * @property string|null $date_submitted
 * @property string|null $slug
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class LocalGovernmentUnit extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%local_government_units}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'local-government-unit',
            'mainAttribute' => 'lgu_name',
            'paramName' => 'slug',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['lgu_name', 'lgu_classification', 'lgu_region', 'name', 'position', 'contact_no', 'date_of_assessment'], 'required'],
            [['lgu_address'], 'string'],
            [['date_of_assessment', 'date_submitted'], 'safe'],
            [['lgu_name', 'lgu_classification', 'lgu_region', 'name', 'position', 'contact_no', 'email'], 'string', 'max' => 255],
            [['email'], 'trim'],
            ['email', 'email']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'lgu_name' => 'LGU Name',
            'lgu_address' => 'LGU Address (Province (for City / Municipality)',
            'lgu_classification' => 'LGU Classification',
            'lgu_region' => 'LGU Region',
            'name' => 'Name',
            'position' => 'Position',
            'contact_no' => 'Contact No',
            'email' => 'Email',
            'date_of_assessment' => 'Date Of Assessment',
            'date_submitted' => 'Date Submitted',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\LocalGovernmentUnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LocalGovernmentUnitQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'lgu_name' => [
                'attribute' => 'lgu_name', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->lgu_name,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'lgu_address' => ['attribute' => 'lgu_address', 'format' => 'raw'],
            'lgu_classification' => ['attribute' => 'lgu_classification', 'format' => 'raw'],
            'lgu_region' => ['attribute' => 'lgu_region', 'format' => 'raw'],
            'name' => ['attribute' => 'name', 'format' => 'raw'],
            'position' => ['attribute' => 'position', 'format' => 'raw'],
            'contact_no' => ['attribute' => 'contact_no', 'format' => 'raw'],
            'email' => ['attribute' => 'email', 'format' => 'raw'],
            'date_of_assessment' => ['attribute' => 'date_of_assessment', 'format' => 'raw'],
            'date_submitted' => ['attribute' => 'date_submitted', 'format' => 'raw'],
        ];
    }

    public function getDefaultGridColumns()
    {
        return [
            'serial',
            'checkbox',
            'lgu_name',
            'lgu_address',
            'lgu_classification',
            'lgu_region',
            'date_of_assessment',
            'created_at',
            'last_updated',
            'active',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'inFormat' => 'Y-m-d H:i:s',
            'outFormat' => 'm/d/Y h:i A',
            'attributes' => [
                'date_submitted',
                [
                    'field' => 'date_of_assessment',
                    'inFormat' => 'Y-m-d',
                    'outFormat' => 'm/d/Y',
                ]
            ]
        ];

        $behaviors['SluggableBehavior'] = [
            'class' => 'yii\behaviors\SluggableBehavior',
            'attribute' => 'lgu_name',
            'ensureUnique' => true,
        ];

        return $behaviors;
    }

    public function detailColumns()
    {
        return [
            'lgu_name:raw',
            'lgu_address:raw',
            'lgu_classification:raw',
            'lgu_region:raw',
            'name:raw',
            'position:raw',
            'contact_no:raw',
            'email:raw',
            'date_of_assessment:raw',
            'date_submitted:raw',
        ];
    }

    public function getPrintableUrl($fullpath=true)
    {
        if ($this->checkLinkAccess('print-report')) {
            $paramName = $this->paramName();
            $url = [
                implode('/', [$this->controllerID(), 'print-report']),
                $paramName => $this->{$paramName}
            ];
            return ($fullpath)? Url::to($url, true): $url;
        }
    }
}
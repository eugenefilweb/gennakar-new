<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%pds_organizations}}".
 *
 * @property int $id
 * @property int $pds_id
 * @property string $name
 * @property string|null $address
 * @property string|null $from
 * @property string|null $to
 * @property int|null $no_of_hours
 * @property string|null $position
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class PdsOrganization extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pds_organizations}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'pds-organization',
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
            [['pds_id', 'name'], 'required'],
            [['pds_id', 'no_of_hours'], 'integer'],
            [['address'], 'string'],
            [['from', 'to'], 'safe'],
            [['name', 'position'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'address' => 'Address',
            'from' => 'From',
            'to' => 'To',
            'no_of_hours' => 'No of Hours',
            'position' => 'Position',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PdsOrganizationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PdsOrganizationQuery(get_called_class());
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
            'name' => ['attribute' => 'name', 'format' => 'raw'],
            'address' => ['attribute' => 'address', 'format' => 'raw'],
            'from' => ['attribute' => 'from', 'format' => 'raw'],
            'to' => ['attribute' => 'to', 'format' => 'raw'],
            'no_of_hours' => ['attribute' => 'no_of_hours', 'format' => 'raw'],
            'position' => ['attribute' => 'position', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'name:raw',
            'address:raw',
            'from:raw',
            'to:raw',
            'no_of_hours:raw',
            'position:raw',
        ];
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

    public function getNameAddress()
    {
        return implode(' | ', array_filter([
            $this->name,
            $this->address,
        ]));
    }
}
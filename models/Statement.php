<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%statements}}".
 *
 * @property int $id
 * @property int $vehicular_accident_report_id
 * @property int $type
 * @property string $name
 * @property string|null $statement
 * @property string|null $date
 * @property string|null $plate_no
 * @property string $signature
 * @property string|null $position
 * @property string|null $address
 * @property string|null $contact_info
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Statement extends ActiveRecord
{
    const TYPE_RESPONDER = 0;
    const TYPE_WITNESS = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%statements}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'statement',
            'mainAttribute' => 'id',
            'paramName' => 'id',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['updateUrl'] = 'updateUrl';

        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['vehicular_accident_report_id', 'type'], 'integer'],
            [['name', 'statement', 'type', 'date'], 'required'],
            [['statement'], 'string'],
            [['name', 'plate_no', 'position', 'address', 'contact_info'], 'string', 'max' => 255],
            ['signature', 'safe'],
            ['type', 'in', 'range' => [
                self::TYPE_RESPONDER,
                self::TYPE_WITNESS,
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
            'vehicular_accident_report_id' => 'Vehicular Accident Report ID',
            'type' => 'Type',
            'name' => 'Name',
            'statement' => 'Statement',
            'date' => 'Date',
            'plate_no' => 'Plate No',
            'signature' => 'Signature',
            'position' => 'Position/Office',
            'address' => 'Address',
            'contact_info' => 'Contact Information',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\StatementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\StatementQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'vehicular_accident_report_id' => [
                'attribute' => 'vehicular_accident_report_id', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->vehicular_accident_report_id,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'type' => ['attribute' => 'type', 'format' => 'raw'],
            'name' => ['attribute' => 'name', 'format' => 'raw'],
            'statement' => ['attribute' => 'statement', 'format' => 'raw'],
            'date' => ['attribute' => 'date', 'format' => 'raw'],
            'plate_no' => ['attribute' => 'plate_no', 'format' => 'raw'],
            'signature' => ['attribute' => 'signature', 'format' => 'raw'],
            'position' => ['attribute' => 'position', 'format' => 'raw'],
            'address' => ['attribute' => 'address', 'format' => 'raw'],
            'contact_info' => ['attribute' => 'contact_info', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'vehicular_accident_report_id:raw',
            'type:raw',
            'name:raw',
            'statement:raw',
            'date:raw',
            'plate_no:raw',
            'signature:raw',
            'position:raw',
            'address:raw',
            'contact_info:raw',
        ];
    }

    public function getFormattedName()
    {
        return ucwords($this->name);
    }

    public function getTypeLabel()
    {
        return App::params('var')['statement_types'][$this->type] ?? '';
    }
}
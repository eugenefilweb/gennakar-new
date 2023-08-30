<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%directories}}".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string|null $address
 * @property string|null $contact_no
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Directory extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%directories}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'directory',
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
            [['name', 'type'], 'required'],
            [['address'], 'string'],
            ['email', 'email'],
            ['email', 'trim'],
            [['notes'], 'safe'],
            [['name', 'type', 'contact_no', 'position', 'photo', 'email'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'address' => 'Address',
            'contact_no' => 'Contact No',
            'tablePhoto' => 'Photo'
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\DirectoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\DirectoryQuery(get_called_class());
    }

    public function getTheName()
    {
        $name = Anchor::widget([
            'title' => $this->name,
            'link' => $this->viewUrl,
            'text' => true
        ]);

        if (in_array('position', $this->dynamicFields)) {
            return implode('<br>', [$name, Html::tag('label', $this->position, ['class' => 'badge badge-primary'])]);
        }

        return $name;
    }
     
    public function gridColumns()
    {
        return [
            'tablePhoto' => ['attribute' => 'name', 'format' => 'raw', 'value' => 'tablePhoto', 'label' => 'photo'],

            'name' => [
                'attribute' => 'name', 
                'format' => 'raw',
                'value' => 'theName'
            ],
            // 'type' => ['attribute' => 'type', 'format' => 'raw'],
            'address' => [
                'attribute' => 'address', 
                'format' => 'raw',
                'value' => fn ($model) => $model->address ?: 'N/A'
            ],
            'email' => ['attribute' => 'email', 'format' => 'raw'],
            'contact_no' => ['attribute' => 'contact_no', 'format' => 'raw'],
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->type = strtoupper($this->type);
        $this->position = strtoupper($this->position);
        $this->address = strtoupper($this->address);
        $this->name = strtoupper($this->name);

        return true;
    }

    public function showFormField($attribute)
    {
        return in_array($attribute, $this->dynamicFields);
    }

    public function getDynamicFields()
    {
        $fields = [
            'photo' => 'photo',
            'name' => 'name',
            'type' => 'type',
            'address' => 'address',
            'email' => 'email',
            'contact_no' => 'contact_no',
            'position' => 'position',
            'notes' => 'notes'
        ];

        if (in_array($this->type, ['DE-CLOGGERS', 'EMERGENCY RESPONSE TEAM', 'DRIVERS/SUPPORT SERVICES', 'NATIONAL AGENCIES', 'OTHERS'])) {
            unset($fields['position']);
        }

        if (in_array($this->type, ['NATIONAL AGENCIES', 'OTHERS'])) {
            unset($fields['address']);
        }

        return $fields;
    }

    public function getTablePhoto()
    {
        return Html::image($this->photo, ['w' => 50], [
            'class' => 'img-fluid symbol'
        ]);
    }

    public function detailColumns()
    {
        $columns = [
            'tablePhoto:raw',
            'type:raw',
            'name:raw',
            'address:raw',
            'email:raw',
            'contact_no:raw',
            'position:raw',
            'notes:raw',
        ];

        $data = [];
        foreach ($columns as $column) {
            list($attribute, $format) = explode(':', $column);

            if (in_array($attribute, $this->dynamicFields)) {
                $data[] = $column;
            }
        }

        return $data;
    }

    public static function createButton()
    {
        if (!App::isLogin()) {
            return;
        }

        if (!App::identity()->can('create', 'directory')) {
            return;
        }
        
        $links = App::foreach(
            self::filter('type'), 
            fn ($type) => Html::a($type, ['directory/create', 'type' => $type], ['class' => 'dropdown-item'])
        );
        $new_link = Html::a('- NEW TYPE -', ['directory/create'], ['class' => 'dropdown-item']);
        return <<< HTML
            <div class="dropdown">
                <button class="btn btn-success font-weight-bold dropdown-toggle" type="button" id="btn-create-new-directory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Create New Directory
                </button>
                <div class="dropdown-menu" aria-labelledby="btn-create-new-directory">
                    {$links} {$new_link}
                </div>
            </div>
        HTML;
    }

    public static function viewButton()
    {
        $detail = Html::a('Detail View', ['directory/index', 'list' => 'detail'], ['class' => 'dropdown-item']);
        $table = Html::a('Table View', ['directory/index', 'list' => 'table'], ['class' => 'dropdown-item']);
        return <<< HTML
            <div class="dropdown mr-3">
                <button class="btn btn-primary font-weight-bold dropdown-toggle" type="button" id="btn-create-new-directory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    View All Records
                </button>
                <div class="dropdown-menu" aria-labelledby="btn-create-new-directory">
                    {$detail} {$table}
                </div>
            </div>
        HTML;
    }
}
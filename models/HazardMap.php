<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%hazard_maps}}".
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property string|null $photo
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class HazardMap extends ActiveRecord
{
    const BARANGAY = 1;
    const MUNICIPAL = 2;
    const WATERSHED = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hazard_maps}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'hazard-map',
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
            [['name'], 'required'],
            [['type'], 'integer'],
            [['description'], 'string'],
            [['name', 'photo'], 'string', 'max' => 255],
            ['type', 'in', 'range' => [
                self::WATERSHED,
                self::BARANGAY,
                self::MUNICIPAL,
            ]],
            [['gallery'], 'safe']
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
            'description' => 'Description',
            'photo' => 'Photo',
            'typeLabel' => 'Type',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\HazardMapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\HazardMapQuery(get_called_class());
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
            // 'type' => ['attribute' => 'type', 'format' => 'raw'],
            'description' => ['attribute' => 'description', 'format' => 'raw'],
            // 'photo' => ['attribute' => 'photo', 'format' => 'raw'],
        ];
    }

    public function getGalleryPhotos()
    {
        return App::foreach($this->files, fn ($file) => Html::image($file, ['w' => 100], ['class' => 'img-fluid symbol']));
    }

    public function detailColumns()
    {
        return [
            'name:raw',
            'typeLabel:raw',
            'description:raw',
            // 'galleryPhotos:raw',
        ];
    }

    public static function createButton()
    {
        if (!App::isLogin()) {
            return;
        }

        if (!App::identity()->can('create', 'hazard-map')) {
            return;
        }

        $links = App::foreach(
            self::filter('type'), 
            fn ($type) => Html::a(App::if(App::params('hazard_map_types')[$type] ?? '', fn($arr) => $arr['label']), ['hazard-map/create', 'type' => $type], ['class' => 'dropdown-item'])
        );
        return <<< HTML
            <div class="dropdown">
                <button class="btn btn-success font-weight-bold dropdown-toggle" type="button" id="btn-create-new-hazard-map" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Add New Map
                </button>
                <div class="dropdown-menu" aria-labelledby="btn-create-new-hazard-map">
                    {$links}
                </div>
            </div>
        HTML;
    }

    public function getFile()
    {
        return $this->hasOne(File::class, ['token' => 'photo']);
    }

    public function getFileS()
    {
        return File::findAll(['token' => $this->gallery]);
    }

    public function getTypeLabel()
    {
        return $this->getTypeData('label');
    }

    public function getTypeData($key='')
    {
        return App::if(App::params('hazard_map_types')[$this->type] ?? '', fn ($arr) => $arr[$key] ?? '');
    }

    public static function getRoute($type)
    {
        switch ($type) {
            case self::BARANGAY:
                $list_link = Url::toRoute(['hazard-map/barangay']);
                break;

            case self::MUNICIPAL:
                $list_link = Url::toRoute(['hazard-map/municipal']);
                break;

            case self::WATERSHED:
                $list_link = Url::toRoute(['hazard-map/watershed']);
                break;
            
            default:
                $list_link = Url::toRoute(['hazard-map/barangay']);
                break;
        }
        return $list_link;
    }

    public static function getTypeParam($type, $key)
    {
        return App::if(App::params('hazard_map_types')[$type] ?? '', fn ($arr) => $arr[$key]);
    }

    public function getActiveMenuLink()
    {
        switch ($this->type) {
            case self::BARANGAY:
                $list_link = '/hazard-map/barangay';
                break;

            case self::MUNICIPAL:
                $list_link = '/hazard-map/municipal';
                break;

            case self::WATERSHED:
                $list_link = '/hazard-map/watershed';
                break;
            
            default:
                $list_link = '/hazard-map/barangay';
                break;
        }
        return $list_link;
    }

    public static function toArrayData($condition=[])
    {
        $models = self::find()
            ->andFilterWhere($condition)
            ->all();

        return ArrayHelper::toArray($models, [
            self::class => [
                'id',
                'name',
                'description',
                'type',
                'photo',
                'imageUrl' => fn ($model) => Url::image($model->photo, ['w' => 500]),
            ],
        ]);
    }

    public static function toJsonData()
    {
        return json_encode(self::toArrayData());
    }

    public static function watershedJsonData()
    {
        return json_encode(self::toArrayData(['type' => self::WATERSHED]));
    }

    public static function barangayJsonData()
    {
        return json_encode(self::toArrayData(['type' => self::BARANGAY]));
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['JsonBehavior']['fields'] = [
            'gallery', 
        ];
        return $behaviors;
    }
}
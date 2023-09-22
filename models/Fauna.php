<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%faunas}}".
 *
 * @property int $id
 * @property string|null $common_name
 * @property string|null $kingdom
 * @property string|null $family
 * @property string|null $genus
 * @property string|null $species
 * @property string|null $sub_species
 * @property string|null $varieta_and_infra_var_name
 * @property string|null $taxonomic_group
 * @property string|null $growth_habit
 * @property int|null $category_id
 * @property string|null $conservation_status
 * @property string|null $diameter
 * @property string|null $photos
 * @property string|null $date_encoded
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Fauna extends ActiveRecord
{
    const NOT_VALIDATED = 0;
    const VALIDATED = 1;

    const PHOTO_KEYS = [
        'fullheight' => 'Full Height',
        'immediate_vicinity' => 'Immediate Vicinity',
        'leaves' => 'Leaves',
        'fruit' => 'Fruit',
        'trunk' => 'Trunk',
        'roots' => 'Roots',
        'west_left' => 'Sideview - West Left',
        'east_right' => 'Sideview - East Right',
    ];

    public $fullheight = [];
    public $immediate_vicinity = [];
    public $leaves = [];
    public $fruit = [];
    public $trunk = [];
    public $roots = [];
    public $west_left = [];
    public $east_right = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%faunas}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'fauna',
            'mainAttribute' => 'common_name',
            'paramName' => 'id',
        ];
    }

    public function getCreateLabel()
    {
        return 'Add Fauna Item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['date_encoded'], 'safe'],
            [['common_name', 'kingdom', 'family', 'genus', 'species', 'sub_species', 'varieta_and_infra_var_name'/* , 'taxonomic_group' */, 'growth_habit', 'conservation_status', 'diameter', 'latitude', 'longitude', 'app_id'], 'string', 'max' => 255],
            [['photos', 'description', 'notes'/* , 'taxonomic_group' */, 'growth_habit', 'conservation_status', 'diameter'], 'safe'],
            [['status', 'validated_by_id', 'patrol_id', 'patroller_id', 'category_id'], 'integer'],
            ['status', 'in', 'range' => [
                self::VALIDATED,
                self::NOT_VALIDATED,
            ]],
            [['fullheight', 'immediate_vicinity', 'leaves', 'fruit', 'trunk', 'roots', 'west_left', 'east_right','barangay','sitio'], 'safe']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'common_name' => 'Common Name',
            'kingdom' => 'Kingdom',
            'family' => 'Family',
            'genus' => 'Genus',
            'species' => 'Specific Epithet',
            'sub_species' => 'Sub Species',
            'varieta_and_infra_var_name' => 'Varieta & Infra Name',
            // 'taxonomic_group' => 'Taxonomic Group',
            'growth_habit' => 'Growth Habit',
            'category_id' => 'Category',
            'conservation_status' => 'Conservation Status',
            'diameter' => 'Diameter',
            'photos' => 'Photo',
            'date_encoded' => 'Date Encoded',
            'statusLabel' => 'Status',
            'validatedByName' => 'Validated By',
            'patrollerName' => 'Patroller'
        ]);
    }

    public function getPatrol()
    {
        return $this->hasOne(Patrol::class, ['id' => 'patrol_id']);
    }

    public function getPatrolViewUrl()
    {
        return App::if($this->patrol, fn ($patrol) => $patrol->viewUrl);
    }

    public function getPatrolTripId()
    {
        return App::if($this->patrol, fn ($patrol) => $patrol->tripId);
    }

    public function getFaunaNumber()
    {
        return implode('', [
            strtotime($this->created_at),
            $this->id
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\FaunaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\FaunaQuery(get_called_class());
    }

    public function getTripId()
    {
        return App::if($this->patrol, fn($patrol) => $patrol->tripId);
    }
     
    public function gridColumns()
    {
        return [
            'fauna_id' => [
                'label' => 'Fauna ID',
                'attribute' => 'id', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->faunaNumber,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'trip_id' => [
                'attribute' => 'id', 
                'format' => 'raw', 
                'value' => 'tripId',
                'label' => 'trip id'
            ],
            'common_name' => ['attribute' => 'common_name', 'format' => 'raw'],
            'kingdom' => ['attribute' => 'kingdom', 'format' => 'raw'],
            'family' => ['attribute' => 'family', 'format' => 'raw'],
            'genus' => ['attribute' => 'genus', 'format' => 'raw'],
            'species' => ['attribute' => 'species', 'format' => 'raw'],
            'sub_species' => ['attribute' => 'sub_species', 'format' => 'raw'],
            'varieta_and_infra_var_name' => ['attribute' => 'varieta_and_infra_var_name', 'format' => 'raw'],
            // 'taxonomic_group' => ['attribute' => 'taxonomic_group', 'format' => 'raw'],
            'growth_habit' => ['attribute' => 'growth_habit', 'format' => 'raw'],
            'category_id' => [
                'attribute' => 'category_id', 
                'format' => 'raw',
                'value' => function($model){
                    $category_id = $model->category_id;
                    $category = array_search($category_id, array_column(App::params('faunas'), 'id'));
                    return $category !== false ? App::params('faunas')[$category]['label'] : $model->category_id;
                }
            ],
            'conservation_status' => ['attribute' => 'conservation_status', 'format' => 'raw'],
            'diameter' => ['attribute' => 'diameter', 'format' => 'raw'],
            'barangay' => ['attribute' => 'barangay', 'format' => 'raw'],
            'sitio' => ['attribute' => 'sitio', 'format' => 'raw'],
            // 'photos' => ['attribute' => 'photos', 'format' => 'raw'],
            'date_encoded' => ['attribute' => 'date_encoded', 'format' => 'raw'],
            'patroller' => [
                'attribute' => 'id', 
                'label' => 'Patroller',
                'value' => 'patrollerName',
                'format' => 'raw'
            ],

            'created_by' => [
                'attribute' => 'created_by', 
                'label' => 'Encoded By',
                'value' => 'createdByName',
                'format' => 'raw'
            ],
            'status' => [
                'label' => 'Status',
                'attribute' => 'id', 
                'value' => 'statusLabel',
                'format' => 'raw'
            ],
        ];
    }

    public function detailColumns()
    {
        return [
            'statusLabel:raw',
            'common_name:raw',
            'description:raw',
            'kingdom:raw',
            'family:raw',
            'genus:raw',
            'species:raw',
            'sub_species:raw',
            'varieta_and_infra_var_name:raw',
            // 'taxonomic_group:raw',
            'growth_habit:raw',
            'category_id' => [
                'attribute' => 'category_id', 
                'format' => 'raw',
                // 'value' => function($model){
                //     $category_id = $model->category_id;
                //     $category = array_search($category_id, array_column(App::params('faunas'), 'id'));
                //     return $category !== false ? App::params('faunas')[$category]['label'] : $model->category_id;
                // }
                'value' => function($model){
                  
                    return $model->category_id;
                }
            ],
            'conservation_status:raw',
            'diameter:raw',
            // 'photos:raw',
            'date_encoded:raw',
            'latitude:raw',
            'longitude:raw',
            'patrollerName:raw',
            'validatedByName:raw',
            'notes:raw',
            'barangay:raw',
            'sitio:raw',
        ];
    }

    public function getValidatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'validated_by_id']);
    }

    public function getValidatedByName()
    {
        return App::if($this->validatedBy, fn ($user) => $user->fullname);
    }

    public function getStatusLabel()
    {
        return $this->isValidated ? Html::tag('label', 'Validated', ['class' => 'badge badge-success']): Html::tag('label', 'For Validation', ['class' => 'badge badge-primary']);
    }

    public function getImageFiles($key='') //fullheight
    {
        if ($key) {
            return App::foreach($this->photos[$key] ?? [], fn ($token) => File::findByToken($token), false);
        }
        $photos = (array)$this->photos;
        if (count(array_filter($photos,'is_array')) > 0) {
            $photos = array_merge([], ...array_values($photos));
            return App::foreach($photos ?? [], fn ($token) => File::findByToken($token), false);
        }
        return App::foreach($this->photos ?? [], fn ($token) => File::findByToken($token), false);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['JsonBehavior']['fields'] = [
            'photos',
        ];
        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'inFormat' => 'Y-m-d H:i:s',
            'outFormat' => 'm/d/Y h:i A',
            'attributes' => [
                'date_encoded',
            ]
        ];
        return $behaviors;
    }

    /* public function formatPhotos()
    {
        $this->photos = [
            'fullheight' => $this->fullheight ?: [],
            'immediate_vicinity' => $this->immediate_vicinity ?: [],
            'leaves' => $this->leaves ?: [],
            'fruit' => $this->fruit ?: [],
            'trunk' => $this->trunk ?: [],
            'roots' => $this->roots ?: [],
            'west_left' => $this->west_left ?: [],
            'east_right' => $this->east_right ?: [],
        ];
    } */

    public function getIsValidated()
    {
        return $this->status == self::VALIDATED;
    }

    public function getIsNotValidated()
    {
        return $this->status == self::NOT_VALIDATED;
    }

    public function validateFauna($validated_by_id='')
    {
        $this->validated_by_id = $validated_by_id;
        if (App::isLogin()) {
            $this->validated_by_id = App::identity('id');
        }
        $this->status = self::VALIDATED;
    }

    public function getIndexUrl($fullpath=true)
    {
        if ($this->isValidated) {
            return parent::getIndexUrl($fullpath);
        }
        if ($this->checkLinkAccess('for-validation')) {
            $paramName = $this->paramName();
            $url = [
                implode('/', [$this->controllerID(), 'for-validation']),
            ];
            return ($fullpath)? Url::to($url, true): $url;
        }
    }

    public function getIndexLabel()
    {
        return $this->isValidated ? 'Validated Faunas': 'For Validation Faunas';
    }

    public function getActiveMenuLink()
    {
        return $this->isValidated ? '/fauna': '/fauna/for-validation';
    }

    public static function coordinates($models, $controller='')
    {
        return App::foreach($models, function ($model) use($controller) {
            $data = [];

            if ($model->latitude || $model->longitude) {
                $data['lat'] = (float)$model->latitude;
                $data['lon'] = (float)$model->longitude;
            }

            if ($controller) {
                $data['description'] = $controller->renderPartial('/fauna/_fauna-map-view', [
                    'model' => $model
                ]);
            }
            return $data;
        }, false);
    }

    public function getPatroller()
    {
        return $this->hasOne(User::Class, ['id' => 'patrol_id']);
    }

    public function getPatrollerName()
    {
        return App::ifElse($this->patroller, fn ($patroller) => $patroller->username, App::if($this->patrol, fn ($patrol) => $patrol->patrollerName));
    }
}
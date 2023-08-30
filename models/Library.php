<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%libraries}}".
 *
 * @property int $id
 * @property string|null $family
 * @property string|null $genus
 * @property string|null $species
 * @property string|null $sub_species
 * @property string|null $varieta_and_infra_var_name
 * @property string|null $common_name
 * @property string|null $taxonomic_group
 * @property string|null $conservation_status
 * @property string|null $residency_status
 * @property string|null $distribution
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Library extends ActiveRecord
{
    const LOCATION_DATA = [
        ["text" => "LUZON", "id" => "1", 'type'=> 'island_group', "children" => true, 'data' => ['type' => 'island_group']],
        ["text" => "VISAYAS", "id" => "2", 'type'=> 'island_group', "children" => true, 'data' => ['type' => 'island_group']],
        ["text" => "MINDANAO", "id" => "3", 'type'=> 'island_group', "children" => true, 'data' => ['type' => 'island_group']],
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%libraries}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'library',
            'mainAttribute' => 'species',
            'paramName' => 'id',
        ];
    }

    public function getCreateLabel()
    {
        return 'Add Library Item';
    }

    public function getLibraryNumber()
    {
        return implode('', [
            strtotime($this->created_at),
            $this->id
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['family', 'genus', 'species', 'conservation_status', 'residency_status', 'common_name', 'sub_species', 'varieta_and_infra_var_name', 'distribution', 'taxonomic_group'], 'required'],
            [['distribution'], 'string'],
            [['watershed_id'], 'integer'],
            [['family', 'genus', 'species', 'sub_species', 'varieta_and_infra_var_name', 'common_name', 'taxonomic_group', 'conservation_status', 'residency_status'], 'string', 'max' => 255],
            [['photo', 'gallery', 'notes', 'province', 'municipality', 'specific_area', 'location_data', 'brgy', 'region'], 'safe']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'family' => 'Family',
            'genus' => 'Genus',
            'species' => 'Species',
            'sub_species' => 'Sub Species',
            'varieta_and_infra_var_name' => 'Varieta And Infra Var Name',
            'common_name' => 'Common Name',
            'taxonomic_group' => 'Taxonomic Group',
            'conservation_status' => 'Conservation Status',
            'residency_status' => 'Residency Status',
            'distribution' => 'Distribution',
            'watershed_id' => 'Watershed',
            // 'watershedName' => 'Watershed'
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\LibraryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LibraryQuery(get_called_class());
    }

    public function getDefaultGridColumns()
    {
        return [
            'serial',
            'checkbox',
            'photo',
            'family',
            'genus',
            'species',
            'common_name',
            'taxonomic_group',
            'conservation_status',
            'residency_status',
            'active',
            'created_at',
        ];
    }

    protected function decode($data)
    {
        return is_array($data)? $data: json_decode($data, true);
    }

    public function beforeSave($insert)
    {
        if (! parent::beforeSave($insert)) {
            return false;
        }

        return true;

        /*$island_group = $this->decode($this->island_group);
        $region = $this->decode($this->region);
        $province = $this->decode($this->province);
        $municipality = $this->decode($this->municipality);
        $brgy = $this->decode($this->brgy);

        $data = $island_group;

        if ($data) {
            foreach ($data as $index => &$d) {
                $d[$index]['children'] = App::foreach($region, function($r) use($d) {
                    if ($r['island_group'] == $d['id']) {
                        $r['children'] = App::foreach($province, function($p) use($r) {
                            if ($p['regCode'] == $r['regCode']) {
                                $p['children'] = App::foreach($municipality, function($m) use($p) {
                                    if ($m['provCode'] == $p['provCode']) {
                                        $m['children'] = App::foreach($brgy, function($b) use($m) {
                                            if ($b['citymunCode'] == $b['citymunCode']) {
                                                return $b;
                                            }
                                        }, false);

                                        return $m;
                                    }
                                }, false);
                                return $p;
                            }
                        }, false);
                        return $r;
                    }
                }, false);
            }
            $this->location_data = json_encode($data);
        }

        return true;*/
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['JsonBehavior']['fields'] = [
            'gallery',
            'island_group',
            'province',
            'municipality',
            'brgy',
            'region',
            'location_data',
        ];

        return $behaviors;
    }

    public function getImageFiles()
    {
        return File::findAll(['token' => $this->gallery]);
    }

    public function getTablePhoto()
    {
        return Html::image($this->photo, ['w' => 50], [
            'class' => 'img-fluid symbol'
        ]);
    }

    public function getWatershed()
    {
        return $this->hasOne(HazardMap::class, ['id' => 'watershed_id'])
            ->onCondition(['type' => HazardMap::WATERSHED]);
    }

    public function getWatershedName()
    {
        return App::if($this->watershed, fn($watershed) => $watershed->name);
    }

    public function gridColumns()
    {
        return [
            'photo' => [
                'attribute' => 'photo', 
                'format' => 'raw',
                'value' => 'tablePhoto'
            ],
            // 'watershed' => [
            //     'attribute' => 'watershed_id', 
            //     'value' => 'watershedName',
            //     'format' => 'raw'
            // ],

            'library_id' => [
                'label' => 'Library ID',
                'attribute' => 'id', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->libraryNumber,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'family' => ['attribute' => 'family', 'format' => 'raw'],
            'genus' => ['attribute' => 'genus', 'format' => 'raw'],
            'species' => ['attribute' => 'species', 'format' => 'raw'],
            'sub_species' => ['attribute' => 'sub_species', 'format' => 'raw'],
            'varieta_and_infra_var_name' => ['attribute' => 'varieta_and_infra_var_name', 'format' => 'raw'],
            'common_name' => ['attribute' => 'common_name', 'format' => 'raw'],
            'taxonomic_group' => ['attribute' => 'taxonomic_group', 'format' => 'raw'],
            'conservation_status' => ['attribute' => 'conservation_status', 'format' => 'raw'],
            'residency_status' => ['attribute' => 'residency_status', 'format' => 'raw'],
            'distribution' => ['attribute' => 'distribution', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'tablePhoto:raw',
            // 'watershedName:raw',
            'family:raw',
            'genus:raw',
            'species:raw',
            'sub_species:raw',
            'varieta_and_infra_var_name:raw',
            'common_name:raw',
            'taxonomic_group:raw',
            'conservation_status:raw',
            'residency_status:raw',
            'distribution:raw',
        ];
    }

    public function getEncodedLocationData()
    {
        $data = $this->location_data ?: self::LOCATION_DATA;
        return json_encode($data);
    }
}
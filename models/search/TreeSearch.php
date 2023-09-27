<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Tree;
use app\helpers\App;

/**
 * TreeSearch represents the model behind the search form of `app\models\Tree`.
 */
class TreeSearch extends Tree
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'tree/_search';
    public $searchAction = ['tree/index'];
    public $searchLabel = 'Tree';

    public $map_zoom_level;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'patrol_id'], 'integer'],
            [['common_name', 'kingdom', 'family', 'genus', 'species', 'sub_species', 'varieta_and_infra_var_name', 'taxonomic_group', 'photos', 'date_encoded', 'created_at', 'updated_at'], 'safe'],
            [['keywords', 'pagination', 'date_range', 'record_status', 'status', 'map_zoom_level'], 'safe'],
            [['keywords'], 'trim'],
        ];
    }

    public function init()
    {
        $this->pagination = App::setting('system')->pagination;
    }

    public function totalFilterTag($attribute)
    {
        if ($this->{$attribute} && is_countable($this->{$attribute})) {
            return implode('', [
                '(',
                App::formatter('asNumber', count($this->{$attribute})),
                ')'
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tree::find();

        // add conditions that should always apply here
        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => 
            [
                'pageSize' => $this->pagination
            ]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_encoded' => $this->date_encoded,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'family' => $this->family,
            'genus' => $this->genus,
            'species' => $this->species,
            'sub_species' => $this->sub_species,
            'taxonomic_group' => $this->taxonomic_group,
        ]);
        
        $query->andFilterWhere(['or', 
            ['like', 'common_name', $this->keywords],  
            ['like', 'kingdom', $this->keywords],  
            ['like', 'family', $this->keywords],  
            ['like', 'genus', $this->keywords],  
            ['like', 'species', $this->keywords],  
            ['like', 'sub_species', $this->keywords],  
            ['like', 'varieta_and_infra_var_name', $this->keywords],  
            ['like', 'taxonomic_group', $this->keywords],  
            ['like', 'photos', $this->keywords],  
            ['like', 'date_encoded', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }

    public function getAdvancedFilterAttributes()
    {
        return [
            'family',
            'genus',
            'species',
            'sub_species',
            'taxonomic_group',
        ];
    }

    public static function mapQuery($queryParams=[])
    {
        return parent::find()
            ->andFilterWhere([
                'family' => $queryParams['family'] ?? '',
                'genus' => $queryParams['genus'] ?? '',
                'species' => $queryParams['species'] ?? '',
                'sub_species' => $queryParams['sub_species'] ?? '',
                'taxonomic_group' => $queryParams['taxonomic_group'] ?? '',
                'status' => $queryParams['status'] ?? '',
            ]);
    }
}
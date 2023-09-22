<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Fauna;
use app\helpers\App;

/**
 * FaunaSearch represents the model behind the search form of `app\models\Fauna`.
 */
class FaunaSearch extends Fauna
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'fauna/_search';
    public $searchAction = ['fauna/index'];
    public $searchLabel = 'Fauna';

    public $map_zoom_level;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['common_name', 'kingdom', 'family', 'genus', 'species', 'sub_species', 'varieta_and_infra_var_name'/* , 'taxonomic_group' */, 'growth_habit', 'category_id', 'conservation_status', 'diameter', 'photos', 'date_encoded', 'created_at', 'updated_at'], 'safe'],
            [['keywords', 'pagination', 'date_range', 'record_status', 'status', 'map_zoom_level','patrol_id'], 'safe'],
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
        $query = Fauna::find();

        // add conditions that should always apply here
        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => false
            // [
            //     'pageSize' => $this->pagination
            // ]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'patrol_id' => $this->patrol_id,
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
            // 'taxonomic_group' => $this->taxonomic_group,
            'growth_habit' => $this->growth_habit,
            'category_id' => $this->category_id,
            'conservation_status' => $this->conservation_status,
            'diameter' => $this->diameter,
        ]);
        
        $query->andFilterWhere(['or', 
            ['like', 'common_name', $this->keywords],  
            ['like', 'kingdom', $this->keywords],  
            ['like', 'family', $this->keywords],  
            ['like', 'genus', $this->keywords],  
            ['like', 'species', $this->keywords],  
            ['like', 'sub_species', $this->keywords],  
            ['like', 'varieta_and_infra_var_name', $this->keywords],  
            // ['like', 'taxonomic_group', $this->keywords],  
            ['like', 'growth_habit', $this->keywords],  
            ['like', 'category_id', $this->keywords],  
            ['like', 'conservation_status', $this->keywords],  
            ['like', 'diameter', $this->keywords],  
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
            // 'taxonomic_group',
            'growth_habit',
            'category_id',
            'conservation_status',
            'diameter',
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
                // 'taxonomic_group' => $queryParams['taxonomic_group'] ?? '',
                'growth_habit' => $queryParams['growth_habit'] ?? '',
                'category_id' => $queryParams['category_id'] ?? '',
                'conservation_status' => $queryParams['conservation_status'] ?? '',
                'diameter' => $queryParams['diameter'] ?? '',
                'status' => $queryParams['status'] ?? '',
            ]);
    }
}
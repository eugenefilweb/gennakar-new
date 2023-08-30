<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Library;
use app\helpers\App;

/**
 * LibrarySearch represents the model behind the search form of `app\models\Library`.
 */
class LibrarySearch extends Library
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'library/_search';
    public $searchAction = ['library/index'];
    public $searchLabel = 'Library';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['family', 'genus', 'species', 'sub_species', 'varieta_and_infra_var_name', 'common_name', 'taxonomic_group', 'conservation_status', 'residency_status', 'distribution', 'created_at', 'updated_at'], 'safe'],
            [['keywords', 'pagination', 'date_range', 'record_status'], 'safe'],
            [['keywords'], 'trim'],
        ];
    }

    public function init()
    {
        $this->pagination = App::setting('system')->pagination;
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
        $query = Library::find();

        // add conditions that should always apply here
        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
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
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'family', $this->family])
            ->andFilterWhere(['like', 'genus', $this->genus])
            ->andFilterWhere(['like', 'species', $this->species])
            ->andFilterWhere(['like', 'sub_species', $this->sub_species])
            ->andFilterWhere(['like', 'varieta_and_infra_var_name', $this->varieta_and_infra_var_name])
            ->andFilterWhere(['like', 'common_name', $this->common_name])
            ->andFilterWhere(['like', 'taxonomic_group', $this->taxonomic_group])
            ->andFilterWhere(['like', 'conservation_status', $this->conservation_status])
            ->andFilterWhere(['like', 'residency_status', $this->residency_status])
            ->andFilterWhere(['like', 'distribution', $this->distribution]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'family', $this->keywords],  
            ['like', 'genus', $this->keywords],  
            ['like', 'species', $this->keywords],  
            ['like', 'sub_species', $this->keywords],  
            ['like', 'varieta_and_infra_var_name', $this->keywords],  
            ['like', 'common_name', $this->keywords],  
            ['like', 'taxonomic_group', $this->keywords],  
            ['like', 'conservation_status', $this->keywords],  
            ['like', 'residency_status', $this->keywords],  
            ['like', 'distribution', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
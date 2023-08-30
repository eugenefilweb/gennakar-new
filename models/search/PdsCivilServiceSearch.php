<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\PdsCivilService;
use app\helpers\App;

/**
 * PdsCivilServiceSearch represents the model behind the search form of `app\models\PdsCivilService`.
 */
class PdsCivilServiceSearch extends PdsCivilService
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'pds-civil-service/_search';
    public $searchAction = ['pds-civil-service/index'];
    public $searchLabel = 'PdsCivilService';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pds_id', 'created_by', 'updated_by'], 'integer'],
            [['career_service', 'rating', 'date_of_examination', 'place_of_examination', 'license', 'created_at', 'updated_at'], 'safe'],
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
        $query = PdsCivilService::find();

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
            'pds_id' => $this->pds_id,
            'date_of_examination' => $this->date_of_examination,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'career_service', $this->career_service])
            ->andFilterWhere(['like', 'rating', $this->rating])
            ->andFilterWhere(['like', 'place_of_examination', $this->place_of_examination])
            ->andFilterWhere(['like', 'license', $this->license]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'pds_id', $this->keywords],  
            ['like', 'career_service', $this->keywords],  
            ['like', 'rating', $this->keywords],  
            ['like', 'date_of_examination', $this->keywords],  
            ['like', 'place_of_examination', $this->keywords],  
            ['like', 'license', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
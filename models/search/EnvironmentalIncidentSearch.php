<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\EnvironmentalIncident;
use app\helpers\App;

/**
 * EnvironmentalIncidentSearch represents the model behind the search form of `app\models\EnvironmentalIncident`.
 */
class EnvironmentalIncidentSearch extends EnvironmentalIncident
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'environmental-incident/_search';
    public $searchAction = ['environmental-incident/index'];
    public $searchLabel = 'EnvironmentalIncident';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_by', 'updated_by'], 'integer'],
            [['date_time', 'longitude', 'latitude', 'watershed', 'description', 'additional_details', 'photos', 'created_at', 'updated_at'], 'safe'],
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
        $query = EnvironmentalIncident::find();

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
            'user_id' => $this->user_id,
            'date_time' => $this->date_time,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'watershed', $this->watershed])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'additional_details', $this->additional_details])
            ->andFilterWhere(['like', 'photos', $this->photos]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'user_id', $this->keywords],  
            ['like', 'date_time', $this->keywords],  
            ['like', 'longitude', $this->keywords],  
            ['like', 'latitude', $this->keywords],  
            ['like', 'watershed', $this->keywords],  
            ['like', 'description', $this->keywords],  
            ['like', 'additional_details', $this->keywords],  
            ['like', 'photos', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
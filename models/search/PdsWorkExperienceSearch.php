<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\PdsWorkExperience;
use app\helpers\App;

/**
 * PdsWorkExperienceSearch represents the model behind the search form of `app\models\PdsWorkExperience`.
 */
class PdsWorkExperienceSearch extends PdsWorkExperience
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'pds-work-experience/_search';
    public $searchAction = ['pds-work-experience/index'];
    public $searchLabel = 'PdsWorkExperience';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pds_id', 'government_service', 'created_by', 'updated_by'], 'integer'],
            [['from', 'to', 'position', 'company', 'salary_increment', 'appointment_status', 'created_at', 'updated_at'], 'safe'],
            [['salary'], 'number'],
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
        $query = PdsWorkExperience::find();

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
            'from' => $this->from,
            'to' => $this->to,
            'salary' => $this->salary,
            'government_service' => $this->government_service,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'salary_increment', $this->salary_increment])
            ->andFilterWhere(['like', 'appointment_status', $this->appointment_status]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'pds_id', $this->keywords],  
            ['like', 'from', $this->keywords],  
            ['like', 'to', $this->keywords],  
            ['like', 'position', $this->keywords],  
            ['like', 'company', $this->keywords],  
            ['like', 'salary', $this->keywords],  
            ['like', 'salary_increment', $this->keywords],  
            ['like', 'appointment_status', $this->keywords],  
            ['like', 'government_service', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
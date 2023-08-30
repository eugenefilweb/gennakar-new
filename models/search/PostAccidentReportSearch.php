<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\PostAccidentReport;
use app\helpers\App;

/**
 * PostAccidentReportSearch represents the model behind the search form of `app\models\PostAccidentReport`.
 */
class PostAccidentReportSearch extends PostAccidentReport
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'post-accident-report/_search';
    public $searchAction = ['post-accident-report/index'];
    public $searchLabel = 'Post Accident Report';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'participant_male', 'participant_female', 'local_male', 'local_female', 'national_male', 'national_female', 'other_male', 'other_female', 'created_by', 'updated_by'], 'integer'],
            [['location', 'control_no', 'type_of_accident', 'other_name', 'date_time', 'weather_condition', 'persons_of_interest', 'responders', 'witnesses', 'accident_report', 'prepared_by', 'verified_by', 'remarks', 'comments_by', 'officer_in_charge', 'noted_by', 'code', 'map', 'created_at', 'updated_at'], 'safe'],
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
        $query = PostAccidentReport::find();

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
            'participant_male' => $this->participant_male,
            'participant_female' => $this->participant_female,
            'local_male' => $this->local_male,
            'local_female' => $this->local_female,
            'national_male' => $this->national_male,
            'national_female' => $this->national_female,
            'other_male' => $this->other_male,
            'other_female' => $this->other_female,
            'date_time' => $this->date_time,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'control_no', $this->control_no])
            ->andFilterWhere(['like', 'type_of_accident', $this->type_of_accident])
            ->andFilterWhere(['like', 'other_name', $this->other_name])
            ->andFilterWhere(['like', 'weather_condition', $this->weather_condition])
            ->andFilterWhere(['like', 'persons_of_interest', $this->persons_of_interest])
            ->andFilterWhere(['like', 'responders', $this->responders])
            ->andFilterWhere(['like', 'witnesses', $this->witnesses])
            ->andFilterWhere(['like', 'accident_report', $this->accident_report])
            ->andFilterWhere(['like', 'prepared_by', $this->prepared_by])
            ->andFilterWhere(['like', 'verified_by', $this->verified_by])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'comments_by', $this->comments_by])
            ->andFilterWhere(['like', 'officer_in_charge', $this->officer_in_charge])
            ->andFilterWhere(['like', 'noted_by', $this->noted_by])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'map', $this->map]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'location', $this->keywords],  
            ['like', 'control_no', $this->keywords],  
            ['like', 'type_of_accident', $this->keywords],  
            ['like', 'participant_male', $this->keywords],  
            ['like', 'participant_female', $this->keywords],  
            ['like', 'local_male', $this->keywords],  
            ['like', 'local_female', $this->keywords],  
            ['like', 'national_male', $this->keywords],  
            ['like', 'national_female', $this->keywords],  
            ['like', 'other_name', $this->keywords],  
            ['like', 'other_male', $this->keywords],  
            ['like', 'other_female', $this->keywords],  
            ['like', 'date_time', $this->keywords],  
            ['like', 'weather_condition', $this->keywords],  
            ['like', 'persons_of_interest', $this->keywords],  
            ['like', 'responders', $this->keywords],  
            ['like', 'witnesses', $this->keywords],  
            ['like', 'accident_report', $this->keywords],  
            ['like', 'prepared_by', $this->keywords],  
            ['like', 'verified_by', $this->keywords],  
            ['like', 'remarks', $this->keywords],  
            ['like', 'comments_by', $this->keywords],  
            ['like', 'officer_in_charge', $this->keywords],  
            ['like', 'noted_by', $this->keywords],  
            ['like', 'code', $this->keywords],  
            ['like', 'map', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
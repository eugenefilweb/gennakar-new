<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\VehicularAccidentReport;
use app\helpers\App;

/**
 * VehicularAccidentReportSearch represents the model behind the search form of `app\models\VehicularAccidentReport`.
 */
class VehicularAccidentReportSearch extends VehicularAccidentReport
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'vehicular-accident-report/_search';
    public $searchAction = ['vehicular-accident-report/index'];
    public $searchLabel = 'Vehicular Accident Report';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['control_no', 'code', 'latitude', 'longitude', 'main_cause', 'vehicles_involved', 'photos', 'other_damages', 'collision_type', 'weather_condition', 'road_condition', 'barangay', 'landmarks', 'road_type', 'remarks', 'preferred_by', 'noted_by', 'date', 'sketch', 'created_at', 'updated_at'], 'safe'],
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
        $query = VehicularAccidentReport::find();

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
        
        $query->andFilterWhere(['like', 'control_no', $this->control_no])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'main_cause', $this->main_cause])
            ->andFilterWhere(['like', 'vehicles_involved', $this->vehicles_involved])
            ->andFilterWhere(['like', 'photos', $this->photos])
            ->andFilterWhere(['like', 'other_damages', $this->other_damages])
            ->andFilterWhere(['like', 'collision_type', $this->collision_type])
            ->andFilterWhere(['like', 'weather_condition', $this->weather_condition])
            ->andFilterWhere(['like', 'road_condition', $this->road_condition])
            ->andFilterWhere(['like', 'barangay', $this->barangay])
            ->andFilterWhere(['like', 'landmarks', $this->landmarks])
            ->andFilterWhere(['like', 'road_type', $this->road_type])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'preferred_by', $this->preferred_by])
            ->andFilterWhere(['like', 'noted_by', $this->noted_by])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'sketch', $this->sketch]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'control_no', $this->keywords],  
            ['like', 'code', $this->keywords],  
            ['like', 'latitude', $this->keywords],  
            ['like', 'longitude', $this->keywords],  
            ['like', 'main_cause', $this->keywords],  
            ['like', 'vehicles_involved', $this->keywords],  
            ['like', 'photos', $this->keywords],  
            ['like', 'other_damages', $this->keywords],  
            ['like', 'collision_type', $this->keywords],  
            ['like', 'weather_condition', $this->keywords],  
            ['like', 'road_condition', $this->keywords],  
            ['like', 'barangay', $this->keywords],  
            ['like', 'landmarks', $this->keywords],  
            ['like', 'road_type', $this->keywords],  
            ['like', 'remarks', $this->keywords],  
            ['like', 'preferred_by', $this->keywords],  
            ['like', 'noted_by', $this->keywords],  
            ['like', 'date', $this->keywords],  
            ['like', 'sketch', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
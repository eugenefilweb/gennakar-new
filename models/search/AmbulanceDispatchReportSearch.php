<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\AmbulanceDispatchReport;
use app\helpers\App;

/**
 * AmbulanceDispatchReportSearch represents the model behind the search form of `app\models\AmbulanceDispatchReport`.
 */
class AmbulanceDispatchReportSearch extends AmbulanceDispatchReport
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'ambulance-dispatch-report/_search';
    public $searchAction = ['ambulance-dispatch-report/index'];
    public $searchLabel = 'Ambulance Dispatch Report';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'patient_age', 'patient_gender', 'created_by', 'updated_by'], 'integer'],
            [['date_time', 'requester_name', 'requester_contact', 'requester_relation', 'patient_name', 'patient_contact', 'incident_location', 'incident_nature', 'incident_level', 'unit_id', 'dispatched_time', 'arrival_time', 'departure_time', 'arrival_time_facility', 'patient_condition', 'heart_rate', 'blood_pressure', 'spo2', 'description_of_symptoms', 'treatment_administered', 'facility_name', 'facility_contact', 'facility_receiver', 'ert_names', 'roles', 'vehicle_id', 'vehicle_type', 'vehicle_mileage', 'notes', 'prepared_by', 'noted_by', 'photos', 'attachments', 'token', 'created_at', 'updated_at'], 'safe'],
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
        $query = AmbulanceDispatchReport::find();

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
            'date_time' => $this->date_time,
            'patient_age' => $this->patient_age,
            'patient_gender' => $this->patient_gender,
            'dispatched_time' => $this->dispatched_time,
            'arrival_time' => $this->arrival_time,
            'departure_time' => $this->departure_time,
            'arrival_time_facility' => $this->arrival_time_facility,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'requester_name', $this->requester_name])
            ->andFilterWhere(['like', 'requester_contact', $this->requester_contact])
            ->andFilterWhere(['like', 'requester_relation', $this->requester_relation])
            ->andFilterWhere(['like', 'patient_name', $this->patient_name])
            ->andFilterWhere(['like', 'patient_contact', $this->patient_contact])
            ->andFilterWhere(['like', 'incident_location', $this->incident_location])
            ->andFilterWhere(['like', 'incident_nature', $this->incident_nature])
            ->andFilterWhere(['like', 'incident_level', $this->incident_level])
            ->andFilterWhere(['like', 'unit_id', $this->unit_id])
            ->andFilterWhere(['like', 'patient_condition', $this->patient_condition])
            ->andFilterWhere(['like', 'heart_rate', $this->heart_rate])
            ->andFilterWhere(['like', 'blood_pressure', $this->blood_pressure])
            ->andFilterWhere(['like', 'spo2', $this->spo2])
            ->andFilterWhere(['like', 'description_of_symptoms', $this->description_of_symptoms])
            ->andFilterWhere(['like', 'treatment_administered', $this->treatment_administered])
            ->andFilterWhere(['like', 'facility_name', $this->facility_name])
            ->andFilterWhere(['like', 'facility_contact', $this->facility_contact])
            ->andFilterWhere(['like', 'facility_receiver', $this->facility_receiver])
            ->andFilterWhere(['like', 'ert_names', $this->ert_names])
            ->andFilterWhere(['like', 'roles', $this->roles])
            ->andFilterWhere(['like', 'vehicle_id', $this->vehicle_id])
            ->andFilterWhere(['like', 'vehicle_type', $this->vehicle_type])
            ->andFilterWhere(['like', 'vehicle_mileage', $this->vehicle_mileage])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'prepared_by', $this->prepared_by])
            ->andFilterWhere(['like', 'noted_by', $this->noted_by])
            ->andFilterWhere(['like', 'photos', $this->photos])
            ->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'token', $this->token]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'requester_name', $this->keywords],  
            ['like', 'requester_contact', $this->keywords],  
            ['like', 'requester_relation', $this->keywords],  
            ['like', 'patient_name', $this->keywords],  
            ['like', 'patient_contact', $this->keywords],  
            ['like', 'patient_age', $this->keywords],  
            ['like', 'patient_gender', $this->keywords],  
            ['like', 'incident_location', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
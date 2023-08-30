<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Passenger;
use app\helpers\App;

/**
 * PassengerSearch represents the model behind the search form of `app\models\Passenger`.
 */
class PassengerSearch extends Passenger
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'passenger/_search';
    public $searchAction = ['passenger/index'];
    public $searchLabel = 'Passenger';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age', 'sex', 'condition', 'created_by', 'updated_by', 'vehicular_accident_report_id', 'vehicle_id'], 'integer'],
            [['last_name', 'middle_name', 'first_name', 'address', 'email', 'contact_no', 'alternate_contact_no', 'health_condition', 'medical_complaint', 'created_at', 'updated_at'], 'safe'],
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
        $query = Passenger::find();

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
            'age' => $this->age,
            'sex' => $this->sex,
            'condition' => $this->condition,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'vehicular_accident_report_id' => $this->vehicular_accident_report_id,
            'vehicle_id' => $this->vehicle_id,
        ]);
        
        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'alternate_contact_no', $this->alternate_contact_no])
            ->andFilterWhere(['like', 'health_condition', $this->health_condition])
            ->andFilterWhere(['like', 'medical_complaint', $this->medical_complaint]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'last_name', $this->keywords],  
            ['like', 'middle_name', $this->keywords],  
            ['like', 'first_name', $this->keywords],  
            ['like', 'address', $this->keywords],  
            ['like', 'email', $this->keywords],  
            ['like', 'contact_no', $this->keywords],  
            ['like', 'alternate_contact_no', $this->keywords],  
            ['like', 'age', $this->keywords],  
            ['like', 'sex', $this->keywords],  
            ['like', 'health_condition', $this->keywords],  
            ['like', 'medical_complaint', $this->keywords],  
            ['like', 'condition', $this->keywords],  
            ['like', 'vehicular_accident_report_id', $this->keywords],  
            ['like', 'vehicle_id', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
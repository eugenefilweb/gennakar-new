<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Vehicle;
use app\helpers\App;

/**
 * VehicleSearch represents the model behind the search form of `app\models\Vehicle`.
 */
class VehicleSearch extends Vehicle
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'vehicle/_search';
    public $searchAction = ['vehicle/index'];
    public $searchLabel = 'Vehicle';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year', 'is_commercial', 'type_of_cargo', 'insurance_status', 'created_by', 'updated_by', 'vehicular_accident_report_id'], 'integer'],
            [['plate_no', 'class', 'color', 'make', 'model', 'driver_firstname', 'driver_middlename', 'driver_lastname', 'driver_suffix', 'driver_address', 'driver_email', 'driver_contact_no', 'driver_alt_contact_no', 'company_name', 'company_address', 'company_contact_no', 'or_no', 'or_no_date_issued', 'cr_no', 'cr_no_date_issued', 'insurance_company', 'insurance_type', 'coverage_start_date', 'coverage_end_date', 'passengers', 'driver_license_front', 'driver_license_back', 'or_photo', 'cr_photo', 'created_at', 'updated_at'], 'safe'],
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
        $query = Vehicle::find();

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
            'year' => $this->year,
            'is_commercial' => $this->is_commercial,
            'type_of_cargo' => $this->type_of_cargo,
            'insurance_status' => $this->insurance_status,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'vehicular_accident_report_id' => $this->vehicular_accident_report_id,
        ]);
        
        $query->andFilterWhere(['like', 'plate_no', $this->plate_no])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'make', $this->make])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'driver_firstname', $this->driver_firstname])
            ->andFilterWhere(['like', 'driver_middlename', $this->driver_middlename])
            ->andFilterWhere(['like', 'driver_lastname', $this->driver_lastname])
            ->andFilterWhere(['like', 'driver_suffix', $this->driver_suffix])
            ->andFilterWhere(['like', 'driver_address', $this->driver_address])
            ->andFilterWhere(['like', 'driver_email', $this->driver_email])
            ->andFilterWhere(['like', 'driver_contact_no', $this->driver_contact_no])
            ->andFilterWhere(['like', 'driver_alt_contact_no', $this->driver_alt_contact_no])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_address', $this->company_address])
            ->andFilterWhere(['like', 'company_contact_no', $this->company_contact_no])
            ->andFilterWhere(['like', 'or_no', $this->or_no])
            ->andFilterWhere(['like', 'or_no_date_issued', $this->or_no_date_issued])
            ->andFilterWhere(['like', 'cr_no', $this->cr_no])
            ->andFilterWhere(['like', 'cr_no_date_issued', $this->cr_no_date_issued])
            ->andFilterWhere(['like', 'insurance_company', $this->insurance_company])
            ->andFilterWhere(['like', 'insurance_type', $this->insurance_type])
            ->andFilterWhere(['like', 'coverage_start_date', $this->coverage_start_date])
            ->andFilterWhere(['like', 'coverage_end_date', $this->coverage_end_date])
            ->andFilterWhere(['like', 'passengers', $this->passengers])
            ->andFilterWhere(['like', 'driver_license_front', $this->driver_license_front])
            ->andFilterWhere(['like', 'driver_license_back', $this->driver_license_back])
            ->andFilterWhere(['like', 'or_photo', $this->or_photo])
            ->andFilterWhere(['like', 'cr_photo', $this->cr_photo]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'plate_no', $this->keywords],  
            ['like', 'class', $this->keywords],  
            ['like', 'color', $this->keywords],  
            ['like', 'make', $this->keywords],  
            ['like', 'model', $this->keywords],  
            ['like', 'year', $this->keywords],  
            ['like', 'is_commercial', $this->keywords],  
            ['like', 'driver_firstname', $this->keywords],  
            ['like', 'driver_middlename', $this->keywords],  
            ['like', 'driver_lastname', $this->keywords],  
            ['like', 'driver_suffix', $this->keywords],  
            ['like', 'driver_address', $this->keywords],  
            ['like', 'driver_email', $this->keywords],  
            ['like', 'driver_contact_no', $this->keywords],  
            ['like', 'driver_alt_contact_no', $this->keywords],  
            ['like', 'company_name', $this->keywords],  
            ['like', 'company_address', $this->keywords],  
            ['like', 'company_contact_no', $this->keywords],  
            ['like', 'type_of_cargo', $this->keywords],  
            ['like', 'or_no', $this->keywords],  
            ['like', 'or_no_date_issued', $this->keywords],  
            ['like', 'cr_no', $this->keywords],  
            ['like', 'cr_no_date_issued', $this->keywords],  
            ['like', 'insurance_company', $this->keywords],  
            ['like', 'insurance_type', $this->keywords],  
            ['like', 'coverage_start_date', $this->keywords],  
            ['like', 'coverage_end_date', $this->keywords],  
            ['like', 'insurance_status', $this->keywords],  
            ['like', 'passengers', $this->keywords],  
            ['like', 'driver_license_front', $this->keywords],  
            ['like', 'driver_license_back', $this->keywords],  
            ['like', 'or_photo', $this->keywords],  
            ['like', 'cr_photo', $this->keywords],  
            ['like', 'vehicular_accident_report_id', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
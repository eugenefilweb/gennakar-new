<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Specialsurvey;
use app\models\form\setting\AddressSettingForm;
use app\helpers\App;

/**
 * SpecialsurveySearch represents the model behind the search form of `app\models\Specialsurvey`.
 */
class SpecialsurveySearch extends Specialsurvey
{
    public $groupPurok;
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'specialsurvey/_search';
    public $searchAction = ['specialsurvey/index'];
    public $searchLabel = 'Survey';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age', 'criteria1_color_id', 'criteria2_color_id', 'criteria3_color_id', 'criteria4_color_id', 'criteria5_color_id', 'created_by', 'updated_by'], 'integer'],
            [['last_name', 'first_name', 'middle_name', 'gender', 'date_of_birth', 'civil_status', 'house_no', 'sitio', 'barangay', 'municipality', 'province', 'religion', 'date_survey', 'remarks', 'status', 'created_at', 'updated_at', 'groupPurok', 'purok'], 'safe'],
            [['keywords', 'pagination', 'date_range', 'record_status', 'survey_name', 'household_no'], 'safe'],
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
        $query = Specialsurvey::find();

        // add conditions that should always apply here
        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['barangay'=> SORT_ASC, 'purok'=> SORT_ASC, 'created_at' => SORT_DESC]],
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
            'date_of_birth' => $this->date_of_birth,
            'criteria1_color_id' => $this->criteria1_color_id,
            'criteria2_color_id' => $this->criteria2_color_id,
            'criteria3_color_id' => $this->criteria3_color_id,
            'criteria4_color_id' => $this->criteria4_color_id,
            'criteria5_color_id' => $this->criteria5_color_id,
            'date_survey' => $this->date_survey,
            'survey_name' => $this->survey_name,
            'household_no' => $this->household_no,
            'barangay'=>$this->barangay,  
			'purok'=>$this->purok,  
			'gender'=>$this->gender,  
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'civil_status', $this->civil_status])
            ->andFilterWhere(['like', 'house_no', $this->house_no])
            ->andFilterWhere(['like', 'sitio', $this->sitio])
            ->andFilterWhere(['like', 'barangay', $this->barangay])
            ->andFilterWhere(['like', 'municipality', $this->municipality])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'last_name', $this->keywords],  
            ['like', 'first_name', $this->keywords],  
            ['like', 'middle_name', $this->keywords],  
           // ['like', 'gender', $this->keywords],  
            ['like', 'age', $this->keywords],  
            ['like', 'date_of_birth', $this->keywords],  
            ['like', 'civil_status', $this->keywords],  
            ['like', 'house_no', $this->keywords],  
            ['like', 'sitio', $this->keywords],  
           // ['like', 'barangay', $this->keywords],  
            ['like', 'municipality', $this->keywords],  
            ['like', 'province', $this->keywords],  
            ['like', 'religion', $this->keywords],  
            ['like', 'date_survey', $this->keywords],  
            ['like', 'remarks', $this->keywords],  
            ['like', 'house_no', $this->keywords],  
            ['like', 'survey_name', $this->keywords],  
            ['like', 'CONCAT(first_name, " ", last_name)', $this->keywords],  
            ['like', 'CONCAT(last_name, " ", first_name)', $this->keywords],  
            ['like', 'CONCAT(first_name, " ", middle_name, " ", last_name)', $this->keywords],  
            ['like', 'CONCAT(last_name, " ", middle_name, " ", first_name)', $this->keywords]
                ,  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }

    public function searchsummary($params)
    {
        $query = Specialsurvey::find();

        // add conditions that should always apply here
        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['barangay'=> SORT_ASC, 'purok'=> SORT_ASC, 'created_at' => SORT_DESC]],
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
            'date_of_birth' => $this->date_of_birth,
            'criteria1_color_id' => $this->criteria1_color_id,
            'criteria2_color_id' => $this->criteria2_color_id,
            'criteria3_color_id' => $this->criteria3_color_id,
            'criteria4_color_id' => $this->criteria4_color_id,
            'criteria5_color_id' => $this->criteria5_color_id,
            'barangay'=>$this->barangay,  
			'purok'=>$this->purok,  
            'date_survey' => $this->date_survey,
            'survey_name' => $this->survey_name,
            'household_no' => $this->household_no,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'civil_status', $this->civil_status])
            ->andFilterWhere(['like', 'house_no', $this->house_no])
            ->andFilterWhere(['like', 'sitio', $this->sitio])
            ->andFilterWhere(['like', 'barangay', $this->barangay])
            ->andFilterWhere(['like', 'municipality', $this->municipality])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);
                
        $query->andFilterWhere(['or', 
            ['like', 'last_name', $this->keywords],  
            ['like', 'first_name', $this->keywords],  
            ['like', 'middle_name', $this->keywords],  
            ['like', 'gender', $this->keywords],  
            ['like', 'age', $this->keywords],  
            ['like', 'date_of_birth', $this->keywords],  
            ['like', 'civil_status', $this->keywords],  
            ['like', 'house_no', $this->keywords],  
            ['like', 'sitio', $this->keywords],  
            ['like', 'barangay', $this->keywords],  
            ['like', 'municipality', $this->keywords],  
            ['like', 'province', $this->keywords],  
            ['like', 'religion', $this->keywords],  
            ['like', 'date_survey', $this->keywords],  
            ['like', 'remarks', $this->keywords],  
            ['like', 'house_no', $this->keywords],  
            ['like', 'survey_name', $this->keywords],  
            ['like', 'CONCAT(first_name, " ", last_name)', $this->keywords],  
            ['like', 'CONCAT(last_name, " ", first_name)', $this->keywords],  
            ['like', 'CONCAT(first_name, " ", middle_name, " ", last_name)', $this->keywords],  
            ['like', 'CONCAT(last_name, " ", middle_name, " ", first_name)', $this->keywords]
                ,  
        ]);
		
		$query->select([
    		"barangay",
    		"purok",
    		"sum(criteria1_color_id=1) as criteria1_color_black",
    		"sum(criteria1_color_id=2) as criteria1_color_gray",
    		"sum(criteria1_color_id=3) as criteria1_color_green",
    		"sum(criteria1_color_id=4) as criteria1_color_red",
    		
    		"sum(criteria2_color_id=1) as criteria2_color_black",
    		"sum(criteria2_color_id=2) as criteria2_color_gray",
    		"sum(criteria2_color_id=3) as criteria2_color_green",
    		"sum(criteria2_color_id=4) as criteria2_color_red",
    		
    		"sum(criteria3_color_id=1) as criteria3_color_black",
    		"sum(criteria3_color_id=2) as criteria3_color_gray",
    		"sum(criteria3_color_id=3) as criteria3_color_green",
    		"sum(criteria3_color_id=4) as criteria3_color_red",
    		
    		"sum(criteria4_color_id=1) as criteria4_color_black",
    		"sum(criteria4_color_id=2) as criteria4_color_gray",
    		"sum(criteria4_color_id=3) as criteria4_color_green",
    		"sum(criteria4_color_id=4) as criteria4_color_red",
    		
    		"sum(criteria5_color_id=1) as criteria5_color_black",
    		"sum(criteria5_color_id=2) as criteria5_color_gray",
    		"sum(criteria5_color_id=3) as criteria5_color_green",
    		"sum(criteria5_color_id=4) as criteria5_color_red",
		]);

		if(($this->barangay && $this->purok) || $this->groupPurok) {
            $query->groupby(["barangay", "purok"]);	
		}
        else {
            $query->groupby(["barangay"]);
		}

        $query->daterange($this->date_range);
		$query->asArray();

        return $dataProvider;
    }
	

    public function getRowSummary($dataProvider)
    {
        $from = $dataProvider->query->createCommand()->rawSql;

        $rowsummary = Yii::$app->db->createCommand(
            "SELECT
                sum(criteria1_color_black) as criteria1_color_black_total,
                sum(criteria1_color_gray) as criteria1_color_gray_total,
                sum(criteria1_color_green) as criteria1_color_green_total,
                sum(criteria1_color_red) as criteria1_color_red_total,
                
                sum(criteria2_color_black) as criteria2_color_black_total,
                sum(criteria2_color_gray) as criteria2_color_gray_total,
                sum(criteria2_color_green) as criteria2_color_green_total,
                sum(criteria2_color_red) as criteria2_color_red_total,
                
                sum(criteria3_color_black) as criteria3_color_black_total,
                sum(criteria3_color_gray) as criteria3_color_gray_total,
                sum(criteria3_color_green) as criteria3_color_green_total,
                sum(criteria3_color_red) as criteria3_color_red_total,
                
                sum(criteria4_color_black) as criteria4_color_black_total,
                sum(criteria4_color_gray) as criteria4_color_gray_total,
                sum(criteria4_color_green) as criteria4_color_green_total,
                sum(criteria4_color_red) as criteria4_color_red_total,
                
                sum(criteria5_color_black) as criteria5_color_black_total,
                sum(criteria5_color_gray) as criteria5_color_gray_total,
                sum(criteria5_color_green) as criteria5_color_green_total,
                sum(criteria5_color_red) as criteria5_color_red_total
            FROM ($from) sc"
        )
        ->queryOne();

        return $rowsummary;
    }
}
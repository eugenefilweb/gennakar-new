<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\PostActivityReport;
use app\helpers\App;

/**
 * PostActivityReportSearch represents the model behind the search form of `app\models\PostActivityReport`.
 */
class PostActivityReportSearch extends PostActivityReport
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'post-activity-report/_search';
    public $searchAction = ['post-activity-report/index'];
    public $searchLabel = 'Post Activity Report';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'beneficiary_stakeholder_male', 'beneficiary_stakeholder_female', 'beneficiary_local_male', 'beneficiary_local_female', 'beneficiary_national_male', 'beneficiary_national_female', 'beneficiary_other_male', 'beneficiary_other_female', 'created_by', 'updated_by', 'type'], 'integer'],
            [['control_no', 'name', 'location', 'type_of_activity', 'date_started', 'date_end', 'responsible_head', 'coordinators', 'staff_members', 'other_members', 'activity_brief', 'prepared_by', 'verified_by', 'remarks', 'comments_by', 'in_charge_of_activity', 'noted_by', 'code', 'created_at', 'updated_at', 'watershed_id', 'beneficiary_other_name'], 'safe'],
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
        $query = PostActivityReport::find();

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
            'beneficiary_stakeholder_male' => $this->beneficiary_stakeholder_male,
            'beneficiary_stakeholder_female' => $this->beneficiary_stakeholder_female,
            'beneficiary_local_male' => $this->beneficiary_local_male,
            'beneficiary_local_female' => $this->beneficiary_local_female,
            'beneficiary_national_male' => $this->beneficiary_national_male,
            'beneficiary_national_female' => $this->beneficiary_national_female,
            'date_started' => $this->date_started,
            'date_end' => $this->date_end,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'watershed_id' => $this->watershed_id,
            'type' => $this->type,
        ]);
        
        $query->andFilterWhere(['like', 'control_no', $this->control_no])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'type_of_activity', $this->type_of_activity])
            ->andFilterWhere(['like', 'responsible_head', $this->responsible_head])
            ->andFilterWhere(['like', 'coordinators', $this->coordinators])
            ->andFilterWhere(['like', 'staff_members', $this->staff_members])
            ->andFilterWhere(['like', 'other_members', $this->other_members])
            ->andFilterWhere(['like', 'activity_brief', $this->activity_brief])
            ->andFilterWhere(['like', 'prepared_by', $this->prepared_by])
            ->andFilterWhere(['like', 'verified_by', $this->verified_by])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'comments_by', $this->comments_by])
            ->andFilterWhere(['like', 'in_charge_of_activity', $this->in_charge_of_activity])
            ->andFilterWhere(['like', 'noted_by', $this->noted_by])
            ->andFilterWhere(['like', 'code', $this->code]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'control_no', $this->keywords],  
            ['like', 'name', $this->keywords],  
            ['like', 'location', $this->keywords],  
            ['like', 'type_of_activity', $this->keywords],  
            ['like', 'beneficiary_stakeholder_male', $this->keywords],  
            ['like', 'beneficiary_stakeholder_female', $this->keywords],  
            ['like', 'beneficiary_local_male', $this->keywords],  
            ['like', 'beneficiary_local_female', $this->keywords],  
            ['like', 'beneficiary_national_male', $this->keywords],  
            ['like', 'beneficiary_national_female', $this->keywords],  
            ['like', 'responsible_head', $this->keywords],  
            ['like', 'activity_brief', $this->keywords],  
            ['like', 'prepared_by', $this->keywords],  
            ['like', 'verified_by', $this->keywords],  
            ['like', 'remarks', $this->keywords],  
            ['like', 'comments_by', $this->keywords],  
            ['like', 'in_charge_of_activity', $this->keywords],  
            ['like', 'noted_by', $this->keywords],  
            ['like', 'code', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
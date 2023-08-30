<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\PdsEducation;
use app\helpers\App;

/**
 * PdsEducationSearch represents the model behind the search form of `app\models\PdsEducation`.
 */
class PdsEducationSearch extends PdsEducation
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'pds-education/_search';
    public $searchAction = ['pds-education/index'];
    public $searchLabel = 'PdsEducation';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pds_id', 'created_by', 'updated_by'], 'integer'],
            [['level', 'name', 'course', 'from', 'to', 'highest_level', 'year_graduated', 'academic_honor', 'created_at', 'updated_at'], 'safe'],
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
        $query = PdsEducation::find();

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
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'level', $this->level])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'course', $this->course])
            ->andFilterWhere(['like', 'from', $this->from])
            ->andFilterWhere(['like', 'to', $this->to])
            ->andFilterWhere(['like', 'highest_level', $this->highest_level])
            ->andFilterWhere(['like', 'year_graduated', $this->year_graduated])
            ->andFilterWhere(['like', 'academic_honor', $this->academic_honor]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'pds_id', $this->keywords],  
            ['like', 'level', $this->keywords],  
            ['like', 'name', $this->keywords],  
            ['like', 'course', $this->keywords],  
            ['like', 'from', $this->keywords],  
            ['like', 'to', $this->keywords],  
            ['like', 'highest_level', $this->keywords],  
            ['like', 'year_graduated', $this->keywords],  
            ['like', 'academic_honor', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
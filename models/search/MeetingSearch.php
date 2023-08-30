<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Meeting;
use app\helpers\App;

/**
 * MeetingSearch represents the model behind the search form of `app\models\Meeting`.
 */
class MeetingSearch extends Meeting
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'meeting/_search';
    public $searchAction = ['meeting/index'];
    public $searchLabel = 'Meeting';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description', 'remarks', 'minutes', 'minutes_files', 'attendance', 'attendance_files', 'resolutions', 'resolutions_file', 'photos', 'slug', 'created_at', 'updated_at', 'type'], 'safe'],
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
        $query = Meeting::find();

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
            'type' => $this->type,
        ]);
        
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'minutes', $this->minutes])
            ->andFilterWhere(['like', 'minutes_files', $this->minutes_files])
            ->andFilterWhere(['like', 'attendance', $this->attendance])
            ->andFilterWhere(['like', 'attendance_files', $this->attendance_files])
            ->andFilterWhere(['like', 'resolutions', $this->resolutions])
            ->andFilterWhere(['like', 'resolutions_file', $this->resolutions_file])
            ->andFilterWhere(['like', 'photos', $this->photos])
            ->andFilterWhere(['like', 'slug', $this->slug]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'name', $this->keywords],  
            ['like', 'description', $this->keywords],  
            ['like', 'remarks', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
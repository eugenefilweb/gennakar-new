<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\PdsTrainingProgram;
use app\helpers\App;

/**
 * PdsTrainingProgramSearch represents the model behind the search form of `app\models\PdsTrainingProgram`.
 */
class PdsTrainingProgramSearch extends PdsTrainingProgram
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'pds-training-program/_search';
    public $searchAction = ['pds-training-program/index'];
    public $searchLabel = 'PdsTrainingProgram';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pds_id', 'no_of_hours', 'created_by', 'updated_by'], 'integer'],
            [['title', 'from', 'to', 'type', 'conducted', 'created_at', 'updated_at'], 'safe'],
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
        $query = PdsTrainingProgram::find();

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
            'no_of_hours' => $this->no_of_hours,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'conducted', $this->conducted]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'pds_id', $this->keywords],  
            ['like', 'title', $this->keywords],  
            ['like', 'from', $this->keywords],  
            ['like', 'to', $this->keywords],  
            ['like', 'no_of_hours', $this->keywords],  
            ['like', 'type', $this->keywords],  
            ['like', 'conducted', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
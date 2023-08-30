<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Statement;
use app\helpers\App;

/**
 * StatementSearch represents the model behind the search form of `app\models\Statement`.
 */
class StatementSearch extends Statement
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'statement/_search';
    public $searchAction = ['statement/index'];
    public $searchLabel = 'Statement';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vehicular_accident_report_id', 'type', 'created_by', 'updated_by'], 'integer'],
            [['name', 'statement', 'date', 'plate_no', 'signature', 'position', 'address', 'contact_info', 'created_at', 'updated_at'], 'safe'],
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
        $query = Statement::find();

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
            'vehicular_accident_report_id' => $this->vehicular_accident_report_id,
            'type' => $this->type,
            'date' => $this->date,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'statement', $this->statement])
            ->andFilterWhere(['like', 'plate_no', $this->plate_no])
            ->andFilterWhere(['like', 'signature', $this->signature])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'contact_info', $this->contact_info]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'vehicular_accident_report_id', $this->keywords],  
            ['like', 'type', $this->keywords],  
            ['like', 'name', $this->keywords],  
            ['like', 'statement', $this->keywords],  
            ['like', 'date', $this->keywords],  
            ['like', 'plate_no', $this->keywords],  
            ['like', 'signature', $this->keywords],  
            ['like', 'position', $this->keywords],  
            ['like', 'address', $this->keywords],  
            ['like', 'contact_info', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
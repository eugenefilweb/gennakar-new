<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\LocalGovernmentUnit;
use app\helpers\App;

/**
 * LocalGovernmentUnitSearch represents the model behind the search form of `app\models\LocalGovernmentUnit`.
 */
class LocalGovernmentUnitSearch extends LocalGovernmentUnit
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'local-government-unit/_search';
    public $searchAction = ['local-government-unit/index'];
    public $searchLabel = 'LGU';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['lgu_name', 'lgu_address', 'lgu_classification', 'lgu_region', 'name', 'position', 'contact_no', 'email', 'date_of_assessment', 'date_submitted', 'slug', 'created_at', 'updated_at'], 'safe'],
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
        $query = LocalGovernmentUnit::find();

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
            'date_of_assessment' => $this->date_of_assessment,
            'date_submitted' => $this->date_submitted,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['or', 
            ['like', 'lgu_name', $this->keywords],  
            ['like', 'lgu_address', $this->keywords],  
            ['like', 'lgu_classification', $this->keywords],  
            ['like', 'lgu_region', $this->keywords],  
            ['like', 'name', $this->keywords],  
            ['like', 'position', $this->keywords],  
            ['like', 'contact_no', $this->keywords],  
            ['like', 'email', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\PdsOrganization;
use app\helpers\App;

/**
 * PdsOrganizationSearch represents the model behind the search form of `app\models\PdsOrganization`.
 */
class PdsOrganizationSearch extends PdsOrganization
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'pds-organization/_search';
    public $searchAction = ['pds-organization/index'];
    public $searchLabel = 'PdsOrganization';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pds_id', 'no_of_hours', 'created_by', 'updated_by'], 'integer'],
            [['name', 'address', 'from', 'to', 'position', 'created_at', 'updated_at'], 'safe'],
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
        $query = PdsOrganization::find();

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
        
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'position', $this->position]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'pds_id', $this->keywords],  
            ['like', 'name', $this->keywords],  
            ['like', 'address', $this->keywords],  
            ['like', 'from', $this->keywords],  
            ['like', 'to', $this->keywords],  
            ['like', 'no_of_hours', $this->keywords],  
            ['like', 'position', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
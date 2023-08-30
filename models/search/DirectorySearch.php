<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Directory;
use app\helpers\App;

/**
 * DirectorySearch represents the model behind the search form of `app\models\Directory`.
 */
class DirectorySearch extends Directory
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'directory/_search';
    public $searchAction = ['directory/index'];
    public $searchLabel = 'Directory';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['name', 'type', 'address', 'contact_no', 'created_at', 'updated_at', 'position'], 'safe'],
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
        $query = Directory::find();

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
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'name', $this->keywords],  
            ['like', 'type', $this->keywords],  
            ['like', 'address', $this->keywords],  
            ['like', 'contact_no', $this->keywords],  
            ['like', 'position', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\InventoryItem;
use app\helpers\App;

/**
 * InventoryItemSearch represents the model behind the search form of `app\models\InventoryItem`.
 */
class InventoryItemSearch extends InventoryItem
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'inventory-item/_search';
    public $searchAction = ['inventory-item/index'];
    public $searchLabel = 'Inventory Item';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'created_by', 'updated_by'], 'integer'],
            [['name', 'category', 'unit', 'remark', 'created_at', 'updated_at'], 'safe'],
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
        $query = InventoryItem::find();

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
            'quantity' => $this->quantity,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => $this->category,
            'unit' => $this->unit,
        ]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'name', $this->keywords],  
            ['like', 'category', $this->keywords],  
            ['like', 'quantity', $this->keywords],  
            ['like', 'unit', $this->keywords],  
            ['like', 'remark', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
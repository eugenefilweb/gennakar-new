<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\EarlyWarning;
use app\helpers\App;

/**
 * EarlyWarningSearch represents the model behind the search form of `app\models\EarlyWarning`.
 */
class EarlyWarningSearch extends EarlyWarning
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'early-warning/_search';
    public $searchAction = ['early-warning/index'];
    public $searchLabel = 'Early Warning';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'signal_no', 'created_by', 'updated_by'], 'integer'],
            [['subject', 'meteorological_conditions', 'impact_of_winds', 'precautionary_measures', 'bulletin_no', 'category', 'windspeed', 'mayor_firstname', 'mayor_middlename', 'mayor_lastname', 'message', 'entry_text', 'attachment_text', 'other_text', 'attachments', 'token', 'created_at', 'updated_at'], 'safe'],
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
        $query = EarlyWarning::find();

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
            'signal_no' => $this->signal_no,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'meteorological_conditions', $this->meteorological_conditions])
            ->andFilterWhere(['like', 'impact_of_winds', $this->impact_of_winds])
            ->andFilterWhere(['like', 'precautionary_measures', $this->precautionary_measures])
            ->andFilterWhere(['like', 'bulletin_no', $this->bulletin_no])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'windspeed', $this->windspeed])
            ->andFilterWhere(['like', 'mayor_firstname', $this->mayor_firstname])
            ->andFilterWhere(['like', 'mayor_middlename', $this->mayor_middlename])
            ->andFilterWhere(['like', 'mayor_lastname', $this->mayor_lastname])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'entry_text', $this->entry_text])
            ->andFilterWhere(['like', 'attachment_text', $this->attachment_text])
            ->andFilterWhere(['like', 'other_text', $this->other_text])
            ->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'token', $this->token]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'subject', $this->keywords],  
            ['like', 'bulletin_no', $this->keywords],  
            ['like', 'signal_no', $this->keywords],  
            ['like', 'category', $this->keywords],  
            ['like', 'windspeed', $this->keywords],  
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
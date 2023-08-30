<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\PersonalDataSheet;
use app\helpers\App;

/**
 * PersonalDataSheetSearch represents the model behind the search form of `app\models\PersonalDataSheet`.
 */
class PersonalDataSheetSearch extends PersonalDataSheet
{
    public $keywords;
    public $date_range;
    public $pagination;

    public $searchTemplate = 'personal-data-sheet/_search';
    public $searchAction = ['personal-data-sheet/index'];
    public $searchLabel = 'Personal Data Sheet';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'citizenship_type', 'father_id', 'mother_id', 'spouse_id', 'created_by', 'updated_by'], 'integer'],
            [['surname', 'first_name', 'middle_name', 'name_extension', 'date_of_birth', 'place_of_birth', 'civil_status', 'blood_type', 'gsis_id_no', 'pagibig_id_no', 'philhealth_no', 'sss_no', 'tin_no', 'agency_employee_no', 'citizenship', 'dual_citizenship_country', 'dual_citizenship_details', 'ra_house_block_lot_no', 'ra_street', 'ra_subdivision_village', 'ra_barangay', 'ra_city_municipality', 'ra_province', 'ra_zip_code', 'pa_house_block_lot_no', 'pa_street', 'pa_subdivision_village', 'pa_barangay', 'pa_city_municipality', 'pa_province', 'pa_zip_code', 'telephone_no', 'mobile_no', 'email_address', 'spouse_surname', 'spouse_first_name', 'spouse_middle_name', 'spouse_name_extension', 'spouse_occupation', 'spouse_employer', 'spouse_employer_address', 'spouse_employer_telephone_no', 'childrens', 'father_surname', 'father_first_name', 'father_middle_name', 'father_name_extension', 'mother_surname', 'mother_first_name', 'mother_middle_name', 'mother_name_extension', 'signature', 'date', 'skills', 'recognitions', 'organizations', 'consanguinity_related', 'administrative_offense', 'charged_criminally', 'crime_convicted', 'service_separated', 'election_candidate', 'government_resigned', 'other_country_resident', 'indigenous_group', 'pwd', 'solo_parent', 'references', 'photo', 'government_issued_id', 'government_id_no', 'government_id_place_of_issuance', 'right_thumbmark', 'person_administering_oath', 'created_at', 'updated_at'], 'safe'],
            [['height', 'weight'], 'number'],
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
        $query = PersonalDataSheet::find();

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
            'date_of_birth' => $this->date_of_birth,
            'sex' => $this->sex,
            'height' => $this->height,
            'weight' => $this->weight,
            'citizenship_type' => $this->citizenship_type,
            'date' => $this->date,
            'father_id' => $this->father_id,
            'mother_id' => $this->mother_id,
            'spouse_id' => $this->spouse_id,
            'record_status' => $this->record_status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
                
        $query->andFilterWhere(['or', 
            ['like', 'surname', $this->keywords],  
            ['like', 'first_name', $this->keywords],  
            ['like', 'middle_name', $this->keywords],  
            // ['like', 'name_extension', $this->keywords],  
            ['like', 'date_of_birth', $this->keywords],  
            // ['like', 'place_of_birth', $this->keywords],  
            // ['like', 'sex', $this->keywords],  
            // ['like', 'civil_status', $this->keywords],  
            // ['like', 'height', $this->keywords],  
            // ['like', 'weight', $this->keywords],  
            // ['like', 'blood_type', $this->keywords],  
            // ['like', 'gsis_id_no', $this->keywords],  
            // ['like', 'pagibig_id_no', $this->keywords],  
            // ['like', 'philhealth_no', $this->keywords],  
            // ['like', 'sss_no', $this->keywords],  
            // ['like', 'tin_no', $this->keywords],  
            // ['like', 'agency_employee_no', $this->keywords],  
            // ['like', 'citizenship', $this->keywords],  
            // ['like', 'citizenship_type', $this->keywords],  
            // ['like', 'dual_citizenship_country', $this->keywords],  
            // ['like', 'dual_citizenship_details', $this->keywords],  
            // ['like', 'ra_house_block_lot_no', $this->keywords],  
            // ['like', 'ra_street', $this->keywords],  
            // ['like', 'ra_subdivision_village', $this->keywords],  
            // ['like', 'ra_barangay', $this->keywords],  
            // ['like', 'ra_city_municipality', $this->keywords],  
            // ['like', 'ra_province', $this->keywords],  
            // ['like', 'ra_zip_code', $this->keywords],  
            // ['like', 'pa_house_block_lot_no', $this->keywords],  
            // ['like', 'pa_street', $this->keywords],  
            // ['like', 'pa_subdivision_village', $this->keywords],  
            // ['like', 'pa_barangay', $this->keywords],  
            // ['like', 'pa_city_municipality', $this->keywords],  
            // ['like', 'pa_province', $this->keywords],  
            // ['like', 'pa_zip_code', $this->keywords],  
            // ['like', 'telephone_no', $this->keywords],  
            // ['like', 'mobile_no', $this->keywords],  
            // ['like', 'email_address', $this->keywords],  
            // ['like', 'spouse_surname', $this->keywords],  
            // ['like', 'spouse_first_name', $this->keywords],  
            // ['like', 'spouse_middle_name', $this->keywords],  
            // ['like', 'spouse_name_extension', $this->keywords],  
            // ['like', 'spouse_occupation', $this->keywords],  
            // ['like', 'spouse_employer', $this->keywords],  
            // ['like', 'spouse_employer_address', $this->keywords],  
            // ['like', 'spouse_employer_telephone_no', $this->keywords],  
            // ['like', 'childrens', $this->keywords],  
            // ['like', 'father_surname', $this->keywords],  
            // ['like', 'father_first_name', $this->keywords],  
            // ['like', 'father_middle_name', $this->keywords],  
            // ['like', 'father_name_extension', $this->keywords],  
            // ['like', 'mother_surname', $this->keywords],  
            // ['like', 'mother_first_name', $this->keywords],  
            // ['like', 'mother_middle_name', $this->keywords],  
            // ['like', 'mother_name_extension', $this->keywords],  
            // ['like', 'signature', $this->keywords],  
            // ['like', 'date', $this->keywords],  
            // ['like', 'skills', $this->keywords],  
            // ['like', 'recognitions', $this->keywords],  
            // ['like', 'organizations', $this->keywords],  
            // ['like', 'consanguinity_related', $this->keywords],  
            // ['like', 'administrative_offense', $this->keywords],  
            // ['like', 'charged_criminally', $this->keywords],  
            // ['like', 'crime_convicted', $this->keywords],  
            // ['like', 'service_separated', $this->keywords],  
            // ['like', 'election_candidate', $this->keywords],  
            // ['like', 'government_resigned', $this->keywords],  
            // ['like', 'other_country_resident', $this->keywords],  
            // ['like', 'indigenous_group', $this->keywords],  
            // ['like', 'pwd', $this->keywords],  
            // ['like', 'solo_parent', $this->keywords],  
            // ['like', 'references', $this->keywords],  
            // ['like', 'photo', $this->keywords],  
            // ['like', 'government_issued_id', $this->keywords],  
            // ['like', 'government_id_no', $this->keywords],  
            // ['like', 'government_id_place_of_issuance', $this->keywords],  
            // ['like', 'right_thumbmark', $this->keywords],  
            // ['like', 'person_administering_oath', $this->keywords],  
         
        ]);

        $query->daterange($this->date_range);

        return $dataProvider;
    }
}
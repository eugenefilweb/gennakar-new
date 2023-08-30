<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%personal_data_sheets}}".
 *
 * @property int $id
 * @property string $surname
 * @property string $first_name
 * @property string|null $middle_name
 * @property string|null $name_extension
 * @property string|null $date_of_birth
 * @property string|null $place_of_birth
 * @property int|null $sex
 * @property string|null $civil_status
 * @property float|null $height
 * @property float|null $weight
 * @property string|null $blood_type
 * @property string|null $gsis_id_no
 * @property string|null $pagibig_id_no
 * @property string|null $philhealth_no
 * @property string|null $sss_no
 * @property string|null $tin_no
 * @property string|null $agency_employee_no
 * @property string|null $citizenship
 * @property int|null $citizenship_type
 * @property string|null $dual_citizenship_country
 * @property string|null $dual_citizenship_details
 * @property string|null $ra_house_block_lot_no
 * @property string|null $ra_street
 * @property string|null $ra_subdivision_village
 * @property string|null $ra_barangay
 * @property string|null $ra_city_municipality
 * @property string|null $ra_province
 * @property string|null $ra_zip_code
 * @property string|null $pa_house_block_lot_no
 * @property string|null $pa_street
 * @property string|null $pa_subdivision_village
 * @property string|null $pa_barangay
 * @property string|null $pa_city_municipality
 * @property string|null $pa_province
 * @property string|null $pa_zip_code
 * @property string|null $telephone_no
 * @property string|null $mobile_no
 * @property string|null $email_address
 * @property string|null $spouse_surname
 * @property string|null $spouse_first_name
 * @property string|null $spouse_middle_name
 * @property string|null $spouse_name_extension
 * @property string|null $spouse_occupation
 * @property string|null $spouse_employer
 * @property string|null $spouse_employer_address
 * @property string|null $spouse_employer_telephone_no
 * @property string|null $childrens
 * @property string|null $father_surname
 * @property string|null $father_first_name
 * @property string|null $father_middle_name
 * @property string|null $father_name_extension
 * @property string|null $mother_surname
 * @property string|null $mother_first_name
 * @property string|null $mother_middle_name
 * @property string|null $mother_name_extension
 * @property string|null $signature
 * @property string|null $date
 * @property string|null $skills
 * @property string|null $recognitions
 * @property string|null $organizations
 * @property string|null $consanguinity_related
 * @property string|null $administrative_offense
 * @property string|null $charged_criminally
 * @property string|null $crime_convicted
 * @property string|null $service_separated
 * @property string|null $election_candidate
 * @property string|null $government_resigned
 * @property string|null $other_country_resident
 * @property string|null $indigenous_group
 * @property string|null $pwd
 * @property string|null $solo_parent
 * @property string|null $references
 * @property string|null $photo
 * @property string|null $government_issued_id
 * @property string|null $government_id_no
 * @property string|null $government_id_place_of_issuance
 * @property string|null $right_thumbmark
 * @property string|null $person_administering_oath
 * @property int|null $father_id
 * @property int|null $mother_id
 * @property int|null $spouse_id
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class PersonalDataSheet extends ActiveRecord
{
    const MALE = 1;
    const FEMALE = 2;

    const FILIPINO = 1;
    const DUAL_CITIZENSHIP = 2;
    
    const BIRTH = 1;
    const NATURALIZATION = 2;

    const PAGE2_ROWS = 40;

    const STEP_FORM = [
        1 => [
            'id' => 1,
            'slug' => 'personal-information',
            'title' => 'Personal Information',
            'description' => 'Name, Address & Citizenship',
        ],
        2 => [
            'id' => 2,
            'slug' => 'family-background',
            'title' => 'Family Background',
            'description' => 'Spouse, Mother & Father',
        ],
        3 => [
            'id' => 3,
            'slug' => 'educational-background',
            'title' => 'Educational Background',
            'description' => 'School & Course',
        ],
        4 => [
            'id' => 4,
            'slug' => 'civil-service',
            'title' => 'Civil Service',
            'description' => 'Rating & License',
        ],
        5 => [
            'id' => 5,
            'slug' => 'work-experience',
            'title' => 'Work Experience',
            'description' => 'Position & Company',
        ],
        6 => [
            'id' => 6,
            'slug' => 'organization',
            'title' => 'Voluntary Work',
            'description' => 'Name & dates',
        ],
        7 => [
            'id' => 7,
            'slug' => 'training-program',
            'title' => 'Training Program',
            'description' => 'Learning and Development',
        ],
        8 => [
            'id' => 8,
            'slug' => 'other',
            'title' => 'Other Information',
            'description' => 'Skills, Recognition & Association',
        ],
        9 => [
            'id' => 9,
            'slug' => 'questionnaire',
            'title' => 'Questionnaire',
            'description' => '(Yes | No) Questionnaire',
        ],
        10 => [
            'id' => 10,
            'slug' => 'reference',
            'title' => 'Reference',
            'description' => 'Name & Contact',
        ],
        11 => [
            'id' => 11,
            'slug' => 'summary',
            'title' => 'Summary',
            'description' => 'Information Summary',
        ],
    ];

    const QUESTIONNAIRE = [
        'consanguinity_related' => [
            'Are you related by consanguinity or affinity to the appointing or recommending authority, or to the chief of bureau or office or to the person who has immediate supervision over you in the Office, Bureau or Department where you will be apppointed,',
            'a. within the third degree?',
            'b. within the fourth degree (for Local Government Unit - Career Employees)?',
        ],
        'administrative_offense' => 'Have you ever been found guilty of any administrative offense?',
        'charged_criminally' => 'Have you been criminally charged before any court?',
        'crime_convicted' => 'Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?',
        'service_separated' => 'Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?',
        'election_candidate' => 'Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?',
        'government_resigned' => 'Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?',
        'other_country_resident' => 'Have you acquired the status of an immigrant or permanent resident of another country?',
        'other_information' => 'Pursuant to: (a) Indigenous People\'s Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:',
        'indigenous_group' => 'Are you a member of any indigenous group?',
        'pwd' => 'Are you a person with disability?',
        'solo_parent' => 'Are you a solo parent?'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%personal_data_sheets}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'personal-data-sheet',
            'mainAttribute' => 'fullname',
            'paramName' => 'token',
        ];
    }

    public function getCitizenshipTypeLabel()
    {
        switch ($this->citizenship_type) {
            case self::BIRTH:
                return 'Birth';
                break;

            case self::NATURALIZATION:
                return 'Naturalization';
                break;
            
            default:
                // code...
                break;
        }
    }

    public function getCitizenshipLabel()
    {
        switch ($this->citizenship) {
            case self::FILIPINO:
                return 'Filipino';
                break;

            case self::DUAL_CITIZENSHIP:
                return 'Dual Citizenship';
                break;
            
            default:
                // code...
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['surname', 'first_name'], 'required'],

            [['date_of_birth', 'date', 'childrens', 'skills', 'recognitions', 'organizations', 'consanguinity_related', 'administrative_offense', 'charged_criminally', 'crime_convicted', 'service_separated', 'election_candidate', 'government_resigned', 'other_country_resident', 'indigenous_group', 'pwd', 'solo_parent', 'references',], 'safe'],

            [['place_of_birth', 'dual_citizenship_details', 'spouse_employer_address', 'spouse_employer_telephone_no', 'signature', 'right_thumbmark', 'photo'], 'string'],

            [['sex', 'father_id', 'mother_id', 'spouse_id', 'citizenship', 'citizenship_type'], 'integer'],
            ['sex', 'in', 'range' => [
                null,
                self::MALE,
                self::FEMALE,
            ]],

            ['citizenship', 'in', 'range' => [
                null,
                self::FILIPINO,
                self::DUAL_CITIZENSHIP,
            ]],
            ['citizenship_type', 'in', 'range' => [
                null,
                self::BIRTH,
                self::NATURALIZATION,
            ]],
            [['height', 'weight'], 'number'],
            ['email_address', 'trim'],
            ['email_address', 'email'],

            [['spouse_employer_telephone_no', 'surname', 'first_name', 'middle_name', 'name_extension', 'civil_status', 'blood_type', 'gsis_id_no', 'pagibig_id_no', 'philhealth_no', 'sss_no', 'tin_no', 'agency_employee_no', 'dual_citizenship_country', 'ra_house_block_lot_no', 'ra_street', 'ra_subdivision_village', 'ra_barangay', 'ra_city_municipality', 'ra_province', 'ra_zip_code', 'pa_house_block_lot_no', 'pa_street', 'pa_subdivision_village', 'pa_barangay', 'pa_city_municipality', 'pa_province', 'pa_zip_code', 'telephone_no', 'mobile_no', 'email_address', 'spouse_surname', 'spouse_first_name', 'spouse_middle_name', 'spouse_name_extension', 'spouse_occupation', 'spouse_employer', 'father_surname', 'father_first_name', 'father_middle_name', 'father_name_extension', 'mother_surname', 'mother_first_name', 'mother_middle_name', 'mother_name_extension', 'government_issued_id', 'government_id_no', 'government_id_place_of_issuance', 'person_administering_oath'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'citizenshipTypeLabel' => 'Citizenship Type',
            'citizenshipLabel' => 'Citizenship',
            'id' => 'ID',
            'surname' => 'Surname',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'name_extension' => 'Name Extension',
            'date_of_birth' => 'Date of Birth',
            'place_of_birth' => 'Place of Birth',
            'sex' => 'Sex',
            'civil_status' => 'Civil Status',
            'height' => 'Height (m)',
            'weight' => 'Weight (kg)',
            'blood_type' => 'Blood Type',
            'gsis_id_no' => 'GSIS ID No',
            'pagibig_id_no' => 'PAGIBIG ID No',
            'philhealth_no' => 'Philhealth No',
            'sss_no' => 'SSS No',
            'tin_no' => 'TIN No',
            'agency_employee_no' => 'Agency Employee No',
            'citizenship' => 'Citizenship',
            'citizenship_type' => 'Citizenship Type',
            'dual_citizenship_country' => 'Dual Citizenship Country',
            'dual_citizenship_details' => 'Dual Citizenship Details',
            'ra_house_block_lot_no' => 'House / Block / Lot No.',
            'ra_street' => 'Street',
            'ra_subdivision_village' => 'Subdivision / Village',
            'ra_barangay' => 'Barangay',
            'ra_city_municipality' => 'City / Municipality',
            'ra_province' => 'Province',
            'ra_zip_code' => 'Zip Code',
            'pa_house_block_lot_no' => 'House / Block / Lot No.',
            'pa_street' => 'Street',
            'pa_subdivision_village' => 'Subdivision/Village',
            'pa_barangay' => 'Barangay',
            'pa_city_municipality' => 'City / Municipality',
            'pa_province' => 'Province',
            'pa_zip_code' => 'Zip Code',
            'telephone_no' => 'Telephone No',
            'mobile_no' => 'Mobile No',
            'email_address' => 'Email Address',
            'spouse_surname' => 'Surname',
            'spouse_first_name' => 'First Name',
            'spouse_middle_name' => 'Middle Name',
            'spouse_name_extension' => 'Name Extension',
            'spouse_occupation' => 'Occupation',
            'spouse_employer' => 'Employer',
            'spouse_employer_address' => 'Employer Address',
            'spouse_employer_telephone_no' => 'Employer Telephone No',
            'childrens' => 'Childrens',
            'father_surname' => 'Surname',
            'father_first_name' => 'First Name',
            'father_middle_name' => 'Middle Name',
            'father_name_extension' => 'Name Extension',
            'mother_surname' => 'Surname',
            'mother_first_name' => 'First Name',
            'mother_middle_name' => 'Middle Name',
            'mother_name_extension' => 'Name Extension',
            'signature' => 'Signature',
            'date' => 'Date',
            'skills' => 'Skills',
            'recognitions' => 'Recognitions',
            'organizations' => 'Organizations',
            'consanguinity_related' => 'Consanguinity Related',
            'administrative_offense' => 'Administrative Offense',
            'charged_criminally' => 'Charged Criminally',
            'crime_convicted' => 'Crime Convicted',
            'service_separated' => 'Service Separated',
            'election_candidate' => 'Election Candidate',
            'government_resigned' => 'Government Resigned',
            'other_country_resident' => 'Other Country Resident',
            'indigenous_group' => 'Indigenous Group',
            'pwd' => 'Pwd',
            'solo_parent' => 'Solo Parent',
            'references' => 'References',
            'photo' => 'Photo',
            'government_issued_id' => 'Government Issued ID',
            'government_id_no' => 'Government ID No',
            'government_id_place_of_issuance' => 'Government ID Place of Issuance',
            'right_thumbmark' => 'Right Thumbmark',
            'person_administering_oath' => 'Person Administering Oath',
            'father_id' => 'Father ID',
            'mother_id' => 'Mother ID',
            'spouse_id' => 'Spouse ID',
            'sexLabel' => 'Sex',
            'spouseFullname' => 'Fullname',
            'fatherFullname' => 'Fullname',
            'motherFullname' => 'Fullname',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PersonalDataSheetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PersonalDataSheetQuery(get_called_class());
    }

    public function getVoluntaryWorks()
    {
        return $this->hasMany(PdsOrganization::class, ['pds_id' => 'id']);
    }

    public function getTotalVoluntaryWorks()
    {
        return PdsOrganization::find()
            ->where(['pds_id' => $this->id])
            ->count();
    }

    public function getTotalTrainingPrograms()
    {
        return PdsTrainingProgram::find()
            ->where(['pds_id' => $this->id])
            ->count();
    }

    public function getTrainingPrograms()
    {
        return $this->hasMany(PdsTrainingProgram::class, ['pds_id' => 'id']);
    }

    public function getEducations()
    {
        return $this->hasMany(PdsEducation::class, ['pds_id' => 'id']);
    }

    public function getWorkExperiences()
    {
        return $this->hasMany(PdsWorkExperience::class, ['pds_id' => 'id']);
    }

    public function getTotalWorkExperiences()
    {
        return PdsWorkExperience::find()
            ->where(['pds_id' => $this->id])
            ->count();
    }

    public function getCivilServices()
    {
        return $this->hasMany(PdsCivilService::class, ['pds_id' => 'id']);
    }

    public function getTotalCivilServices()
    {
        return PdsCivilService::find()
            ->where(['pds_id' => $this->id])
            ->count();
    }

    public function getCivilServiceRowsToRendered()
    {
        $totalCivilServices = $this->totalCivilServices; // 15
        $totalWorkExperiences = $this->totalWorkExperiences; //1

        $to_render = self::PAGE2_ROWS - ($totalWorkExperiences + $totalCivilServices);

        if ($to_render <= 0) {
            return 0;
        }

        if (App::isEven($to_render)) {
            return $to_render / 2;
        }
        return ($to_render + 1) / 2;
    }

    public function getWorkExperienceRowsToRendered()
    {
        $totalCivilServices = $this->totalCivilServices; // 15
        $totalWorkExperiences = $this->totalWorkExperiences; //1

        $to_render = self::PAGE2_ROWS - ($totalWorkExperiences + $totalCivilServices);

        if ($to_render <= 0) {
            return 0;
        }

        if (App::isEven($to_render)) {
            return $to_render / 2;
        }
        return ($to_render - 1) / 2;
    }

    public function getSpouseFullname()
    {
        return implode(' ', array_filter([
            $this->spouse_first_name,
            $this->spouse_middle_name,
            $this->spouse_surname,
            $this->spouse_name_extension,
        ]));
    }

    public function getFatherFullname()
    {
        return implode(' ', array_filter([
            $this->father_first_name,
            $this->father_middle_name,
            $this->father_surname,
            $this->father_name_extension,
        ]));
    }

    public function getMotherFullname()
    {
        return implode(' ', array_filter([
            $this->mother_first_name,
            $this->mother_middle_name,
            $this->mother_surname,
            $this->mother_name_extension,
        ]));
    }

    public function getFullname()
    {
        return implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->surname,
            $this->name_extension,
        ]));
    }

    public function getPhotoImage()
    {
        return Html::image($this->photo, ['w' => 50], ['class' => 'img-fluid symbol']);
    }
     
    public function gridColumns()
    {
        return [
            'photo' => [
                'attribute' => 'photo', 
                'format' => 'raw',
                'value' => 'photoImage'
            ],
            'fullname' => [
                'label' => 'Fullname',
                'attribute' => 'first_name', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->fullname,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            // 'first_name' => ['attribute' => 'first_name', 'format' => 'raw'],
            // 'middle_name' => ['attribute' => 'middle_name', 'format' => 'raw'],
            // 'name_extension' => ['attribute' => 'name_extension', 'format' => 'raw'],
            'date_of_birth' => ['attribute' => 'date_of_birth', 'format' => 'raw'],
            // 'place_of_birth' => ['attribute' => 'place_of_birth', 'format' => 'raw'],
            'sex' => ['attribute' => 'sex', 'format' => 'raw', 'value' => 'sexLabel'],
            'civil_status' => ['attribute' => 'civil_status', 'format' => 'raw'],
            // 'height' => ['attribute' => 'height', 'format' => 'raw'],
            // 'weight' => ['attribute' => 'weight', 'format' => 'raw'],
            // 'blood_type' => ['attribute' => 'blood_type', 'format' => 'raw'],
            // 'gsis_id_no' => ['attribute' => 'gsis_id_no', 'format' => 'raw'],
            // 'pagibig_id_no' => ['attribute' => 'pagibig_id_no', 'format' => 'raw'],
            // 'philhealth_no' => ['attribute' => 'philhealth_no', 'format' => 'raw'],
            // 'sss_no' => ['attribute' => 'sss_no', 'format' => 'raw'],
            // 'tin_no' => ['attribute' => 'tin_no', 'format' => 'raw'],
            // 'agency_employee_no' => ['attribute' => 'agency_employee_no', 'format' => 'raw'],
            // 'citizenship' => ['attribute' => 'citizenship', 'format' => 'raw'],
            // 'citizenship_type' => ['attribute' => 'citizenship_type', 'format' => 'raw'],
            // 'dual_citizenship_country' => ['attribute' => 'dual_citizenship_country', 'format' => 'raw'],
            // 'dual_citizenship_details' => ['attribute' => 'dual_citizenship_details', 'format' => 'raw'],
            // 'ra_house_block_lot_no' => ['attribute' => 'ra_house_block_lot_no', 'format' => 'raw'],
            // 'ra_street' => ['attribute' => 'ra_street', 'format' => 'raw'],
            // 'ra_subdivision_village' => ['attribute' => 'ra_subdivision_village', 'format' => 'raw'],
            // 'ra_barangay' => ['attribute' => 'ra_barangay', 'format' => 'raw'],
            // 'ra_city_municipality' => ['attribute' => 'ra_city_municipality', 'format' => 'raw'],
            // 'ra_province' => ['attribute' => 'ra_province', 'format' => 'raw'],
            // 'ra_zip_code' => ['attribute' => 'ra_zip_code', 'format' => 'raw'],
            // 'pa_house_block_lot_no' => ['attribute' => 'pa_house_block_lot_no', 'format' => 'raw'],
            // 'pa_street' => ['attribute' => 'pa_street', 'format' => 'raw'],
            // 'pa_subdivision_village' => ['attribute' => 'pa_subdivision_village', 'format' => 'raw'],
            // 'pa_barangay' => ['attribute' => 'pa_barangay', 'format' => 'raw'],
            // 'pa_city_municipality' => ['attribute' => 'pa_city_municipality', 'format' => 'raw'],
            // 'pa_province' => ['attribute' => 'pa_province', 'format' => 'raw'],
            // 'pa_zip_code' => ['attribute' => 'pa_zip_code', 'format' => 'raw'],
            // 'telephone_no' => ['attribute' => 'telephone_no', 'format' => 'raw'],
            // 'mobile_no' => ['attribute' => 'mobile_no', 'format' => 'raw'],
            // 'email_address' => ['attribute' => 'email_address', 'format' => 'raw'],
            // 'spouse_surname' => ['attribute' => 'spouse_surname', 'format' => 'raw'],
            // 'spouse_first_name' => ['attribute' => 'spouse_first_name', 'format' => 'raw'],
            // 'spouse_middle_name' => ['attribute' => 'spouse_middle_name', 'format' => 'raw'],
            // 'spouse_name_extension' => ['attribute' => 'spouse_name_extension', 'format' => 'raw'],
            // 'spouse_occupation' => ['attribute' => 'spouse_occupation', 'format' => 'raw'],
            // 'spouse_employer' => ['attribute' => 'spouse_employer', 'format' => 'raw'],
            // 'spouse_employer_address' => ['attribute' => 'spouse_employer_address', 'format' => 'raw'],
            // 'spouse_employer_telephone_no' => ['attribute' => 'spouse_employer_telephone_no', 'format' => 'raw'],
            // 'childrens' => ['attribute' => 'childrens', 'format' => 'raw'],
            // 'father_surname' => ['attribute' => 'father_surname', 'format' => 'raw'],
            // 'father_first_name' => ['attribute' => 'father_first_name', 'format' => 'raw'],
            // 'father_middle_name' => ['attribute' => 'father_middle_name', 'format' => 'raw'],
            // 'father_name_extension' => ['attribute' => 'father_name_extension', 'format' => 'raw'],
            // 'mother_surname' => ['attribute' => 'mother_surname', 'format' => 'raw'],
            // 'mother_first_name' => ['attribute' => 'mother_first_name', 'format' => 'raw'],
            // 'mother_middle_name' => ['attribute' => 'mother_middle_name', 'format' => 'raw'],
            // 'mother_name_extension' => ['attribute' => 'mother_name_extension', 'format' => 'raw'],
            // 'signature' => ['attribute' => 'signature', 'format' => 'raw'],
            // 'date' => ['attribute' => 'date', 'format' => 'raw'],
            // 'skills' => ['attribute' => 'skills', 'format' => 'raw'],
            // 'recognitions' => ['attribute' => 'recognitions', 'format' => 'raw'],
            // 'organizations' => ['attribute' => 'organizations', 'format' => 'raw'],
            // 'consanguinity_related' => ['attribute' => 'consanguinity_related', 'format' => 'raw'],
            // 'administrative_offense' => ['attribute' => 'administrative_offense', 'format' => 'raw'],
            // 'charged_criminally' => ['attribute' => 'charged_criminally', 'format' => 'raw'],
            // 'crime_convicted' => ['attribute' => 'crime_convicted', 'format' => 'raw'],
            // 'service_separated' => ['attribute' => 'service_separated', 'format' => 'raw'],
            // 'election_candidate' => ['attribute' => 'election_candidate', 'format' => 'raw'],
            // 'government_resigned' => ['attribute' => 'government_resigned', 'format' => 'raw'],
            // 'other_country_resident' => ['attribute' => 'other_country_resident', 'format' => 'raw'],
            // 'indigenous_group' => ['attribute' => 'indigenous_group', 'format' => 'raw'],
            // 'pwd' => ['attribute' => 'pwd', 'format' => 'raw'],
            // 'solo_parent' => ['attribute' => 'solo_parent', 'format' => 'raw'],
            // 'references' => ['attribute' => 'references', 'format' => 'raw'],
            // 'government_issued_id' => ['attribute' => 'government_issued_id', 'format' => 'raw'],
            // 'government_id_no' => ['attribute' => 'government_id_no', 'format' => 'raw'],
            // 'government_id_place_of_issuance' => ['attribute' => 'government_id_place_of_issuance', 'format' => 'raw'],
            // 'right_thumbmark' => ['attribute' => 'right_thumbmark', 'format' => 'raw'],
            // 'person_administering_oath' => ['attribute' => 'person_administering_oath', 'format' => 'raw'],
            // 'father_id' => ['attribute' => 'father_id', 'format' => 'raw'],
            // 'mother_id' => ['attribute' => 'mother_id', 'format' => 'raw'],
            // 'spouse_id' => ['attribute' => 'spouse_id', 'format' => 'raw'],
        ];
    }

    public function getSexLabel()
    {
        switch ($this->sex) {
            case self::MALE:
                return 'Male';
                break;

            case self::FEMALE:
                return 'Female';
                break;
            
            default:
                return;
                break;
        }
    }

    public function detailColumns()
    {
        return [
            'surname:raw',
            'first_name:raw',
            'middle_name:raw',
            'name_extension:raw',
            'date_of_birth:raw',
            'place_of_birth:raw',
            'sex:raw',
            'civil_status:raw',
            'height:raw',
            'weight:raw',
            'blood_type:raw',
            'gsis_id_no:raw',
            'pagibig_id_no:raw',
            'philhealth_no:raw',
            'sss_no:raw',
            'tin_no:raw',
            'agency_employee_no:raw',
            'citizenship:raw',
            'citizenship_type:raw',
            'dual_citizenship_country:raw',
            'dual_citizenship_details:raw',
            'ra_house_block_lot_no:raw',
            'ra_street:raw',
            'ra_subdivision_village:raw',
            'ra_barangay:raw',
            'ra_city_municipality:raw',
            'ra_province:raw',
            'ra_zip_code:raw',
            'pa_house_block_lot_no:raw',
            'pa_street:raw',
            'pa_subdivision_village:raw',
            'pa_barangay:raw',
            'pa_city_municipality:raw',
            'pa_province:raw',
            'pa_zip_code:raw',
            'telephone_no:raw',
            'mobile_no:raw',
            'email_address:raw',
            'spouse_surname:raw',
            'spouse_first_name:raw',
            'spouse_middle_name:raw',
            'spouse_name_extension:raw',
            'spouse_occupation:raw',
            'spouse_employer:raw',
            'spouse_employer_address:raw',
            'spouse_employer_telephone_no:raw',
            'childrens:jsonEditor',
            'father_surname:raw',
            'father_first_name:raw',
            'father_middle_name:raw',
            'father_name_extension:raw',
            'mother_surname:raw',
            'mother_first_name:raw',
            'mother_middle_name:raw',
            'mother_name_extension:raw',
            'signature:raw',
            'date:raw',
            'skills:jsonEditor',
            'recognitions:jsonEditor',
            'organizations:jsonEditor',
            'consanguinity_related:jsonEditor',
            'administrative_offense:jsonEditor',
            'charged_criminally:jsonEditor',
            'crime_convicted:jsonEditor',
            'service_separated:jsonEditor',
            'election_candidate:jsonEditor',
            'government_resigned:jsonEditor',
            'other_country_resident:jsonEditor',
            'indigenous_group:jsonEditor',
            'pwd:jsonEditor',
            'solo_parent:jsonEditor',
            'references:jsonEditor',
            'photo:jsonEditor',
            'government_issued_id:raw',
            'government_id_no:raw',
            'government_id_place_of_issuance:raw',
            'right_thumbmark:raw',
            'person_administering_oath:raw',
            'father_id:raw',
            'mother_id:raw',
            'spouse_id:raw',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
      

        $behaviors['DateBehavior'] = [
            'class' => 'app\behaviors\DateBehavior',
            'attributes' => [
                'date_of_birth',
            ]
        ];

        $behaviors['JsonBehavior']['fields'] = [
            'childrens',
            'skills',
            'recognitions',
            'organizations',
            'consanguinity_related', 
            'administrative_offense', 
            'charged_criminally', 
            'crime_convicted', 
            'service_separated', 
            'election_candidate', 
            'government_resigned', 
            'other_country_resident', 
            'indigenous_group', 
            'pwd', 
            'solo_parent',
            'references'
        ];

        return $behaviors;
    }

    public function getEducationModel()
    {
        return new PdsEducation(['pds_id' => $this->id]);
    }

    public function getCivilServiceModel()
    {
        return new PdsCivilService(['pds_id' => $this->id]);
    }

    public function getWorkExperienceModel()
    {
        return new PdsWorkExperience(['pds_id' => $this->id]);
    }

    public function getOrganizationModel()
    {
        return new PdsOrganization(['pds_id' => $this->id]);
    }

    public function getTrainingProgramModel()
    {
        return new PdsTrainingProgram(['pds_id' => $this->id]);
    }

    public function getPrintableUrl($fullpath=true)
    {
        if ($this->checkLinkAccess('printable')) {
            $paramName = $this->paramName();
            $url = [
                implode('/', [$this->controllerID(), 'printable']),
                $paramName => $this->{$paramName}
            ];
            return ($fullpath)? Url::to($url, true): $url;
        }
    }

    public function getChildrenData($key, $attribute = 'name')
    {
        $childrens = array_values($this->childrens);

        if (($children = $childrens[$key] ?? '') != null) {
            $data = $children[$attribute] ?? '';

            if ($attribute == 'birthdate') {
                return date('m/d/Y', strtotime($data));
            }

            return $data;
        }
    }

    public function getIsOtherCivilStatus()
    {
        return !in_array($this->civil_status, ['Single', 'Widowed', 'Married', 'Separated']);
    }

    public function getOtherCivilStatus()
    {
        return $this->isOtherCivilStatus ? $this->civil_status: '';
    }

    public function getElementaryEducations()
    {
        return $this->hasMany(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'Elementary']);
    }

    public function getElementaryEducation()
    {
        return $this->hasOne(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'Elementary']);
    }

    public function getSecondaryEducations()
    {
        return $this->hasMany(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'Secondary']);
    }

    public function getSecondaryEducation()
    {
        return $this->hasOne(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'Secondary']);
    }

    public function getVocationalEducations()
    {
        return $this->hasMany(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'Vocational / Training Course']);
    }

    public function getVocationalEducation()
    {
        return $this->hasOne(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'Vocational / Training Course']);
    }

    public function getCollegeEducations()
    {
        return $this->hasMany(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'College']);
    }

    public function getCollegeEducation()
    {
        return $this->hasOne(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'College']);
    }

    public function getGraduateStudiesEducations()
    {
        return $this->hasMany(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'Graduate Studies']);
    }

    public function getGraduateStudiesEducation()
    {
        return $this->hasOne(PdsEducation::class, ['pds_id' => 'id'])
            ->onCondition(['level' => 'Graduate Studies']);
    }

    public function getOtherInformations()
    {
        $highestData = max([
            count($this->skills), 
            count($this->recognitions), 
            count($this->organizations), 
        ]);

        $data = [];

        if ($highestData > 0) {
            for ($i=0; $i < $highestData; $i++) { 
                $data[] = [
                    'skill' => $this->skills[$i] ?? null,
                    'recognition' => $this->recognitions[$i] ?? null,
                    'organization' => $this->organizations[$i] ?? null,
                ];
            }
        }

        return [
            'data' => $data,
            'highestData' => $highestData,
        ];
    }

    public function dateFormat($format = 'm/d/Y', $attribute = 'created_at')
    {
        return date($format, strtotime($this->{$attribute}));
    }

    public function getExtendedChildrens()
    {
        $childrens = [];
        $breakpoint = 13;

        if (count($this->childrens) > $breakpoint) {
            $childrens = array_slice($this->childrens, $breakpoint);
        }

        return $childrens;
    }
}
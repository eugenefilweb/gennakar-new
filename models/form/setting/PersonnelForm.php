<?php

namespace app\models\form\setting;

use Yii;

class PersonnelForm extends SettingForm
{
    const NAME = 'personnel';

    public $mswdo;
    public $mayor;
    public $mho;
    public $budget_officer;
    public $disbursing_officer;
    public $senior_citizen_president;
    public $osca_chairperson;

    public $ldrrmo_iii_name;
    public $ldrrmo_iii_contact;

    public $mdrrmo_name;
    public $mdrrmo_contact;

    public $mayor_firstname;
    public $mayor_middlename;
    public $mayor_lastname;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['mswdo', 'mayor', 'mho', 'budget_officer', 'disbursing_officer', 'senior_citizen_president', 'osca_chairperson', 'ldrrmo_iii_name', 'ldrrmo_iii_contact', 'mdrrmo_name', 'mdrrmo_contact', 'mayor_firstname', 'mayor_middlename', 'mayor_lastname'], 'required'],

            [['mswdo', 'mayor', 'mho', 'budget_officer', 'disbursing_officer', 'senior_citizen_president', 'osca_chairperson', 'ldrrmo_iii_name', 'ldrrmo_iii_contact', 'mdrrmo_name', 'mdrrmo_contact', 'mayor_firstname', 'mayor_middlename', 'mayor_lastname'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ldrrmo_iii_name' => 'Name',
            'ldrrmo_iii_contact' => 'Contact',
            'mdrrmo_name' => 'Name',
            'mdrrmo_contact' => 'Contact',
            'mayor_firstname' => 'First Name',
            'mayor_middlename' => 'Middle Name',
            'mayor_lastname' => 'Last Name',
        ];
    }

    public function getMayorMiddleInitial()
    {
        return $this->mayor_middlename[0] ?? null;
    }

    public function getMayorName()
    {
        return implode(' ', array_filter([
            $this->mayor_firstname,
            (($this->mayorMiddleInitial) ? $this->mayorMiddleInitial . '.': null),
            $this->mayor_lastname,
        ]));
    }

    public function default()
    {
        return [
            ['name' => 'mayor_firstname', 'default' => 'Eliseo'],
            ['name' => 'mayor_middlename', 'default' => 'Romeo'],
            ['name' => 'mayor_lastname', 'default' => 'Ruzol'],
            ['name' => 'ldrrmo_iii_name', 'default' => 'J.P. Rizal'],
            ['name' => 'ldrrmo_iii_contact', 'default' => '0917-814-2405'],
            ['name' => 'mdrrmo_name', 'default' => 'A.Mabini'],
            ['name' => 'mdrrmo_contact', 'default' => '0917-814-2406'],
            ['name' => 'mswdo', 'default' => 'LEO JAMES M. PORTALES, RSW'],
            ['name' => 'mayor', 'default' => 'DIANA ABIGAIL D. AQUINO'],
            ['name' => 'mho', 'default' => 'Maricris M. Uy, RN, MD'],
            ['name' => 'budget_officer', 'default' => 'CYNTHIA P. DIAMANTE-CPA'],
            ['name' => 'disbursing_officer', 'default' => 'FE P. CORALDE'],
            ['name' => 'senior_citizen_president', 'default' => '[SENIOR_CITIZEN_PRESIDENT]'],
            ['name' => 'osca_chairperson', 'default' => 'VIRGILIO M. CALZADO'],
        ];
    }
}
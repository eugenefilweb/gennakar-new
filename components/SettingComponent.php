<?php

namespace app\components;

use app\helpers\App;
use app\models\Budget;
use app\models\File;
use app\models\form\setting\AddressSettingForm;
use app\models\form\setting\BudgetForm;
use app\models\form\setting\DocumentSettingForm;
use app\models\form\setting\EmailSettingForm;
use app\models\form\setting\ImageSettingForm;
use app\models\form\setting\MapSettingForm;
use app\models\form\setting\MobileAppSettingForm;
use app\models\form\setting\NotificationSettingForm;
use app\models\form\setting\PersonnelForm;
use app\models\form\setting\ReportTemplateForm;
use app\models\form\setting\SurveySettingForm;
use app\models\form\setting\SystemSettingForm;

class SettingComponent extends \yii\base\Component
{
    public $system;
    public $document;
    public $email;
    public $image;
    public $notification;
 	public $map;
    public $address;
    public $reportTemplate;
    public $personnel;
    public $budget;
    public $surveyColor;
    public $mobileApp;

    public $currentYear;

    public $_qrcodePath;

 	public $bgUrl;
    
	public function init()
    {
        parent::init();

        $this->system = new SystemSettingForm();
        $this->email = new EmailSettingForm();
        $this->image = new ImageSettingForm();
        $this->notification = new NotificationSettingForm();
        $this->map = new MapSettingForm();
        $this->address = new AddressSettingForm();
        $this->reportTemplate = new ReportTemplateForm();
        $this->personnel = new PersonnelForm();
        $this->surveyColor = new SurveySettingForm();
        $this->mobileApp = new MobileAppSettingForm();
        $this->document = new DocumentSettingForm();

        $this->currentYear = date('Y', strtotime(App::formatter()->asDateToTimezone('', 'Y-m-d H:i:s', $this->system->timezone)));
        $this->budget = Budget::findOne(['year' => $this->currentYear]) ?: new Budget();

        $this->bgUrl = App::baseUrl('default/watershed-management-background.jpg');
    }

    public function getQrCodePath()
    {
        if ($this->_qrcodePath == null) {
            $i = $this->image;
            $file = File::findByToken($i->municipality_logo) ?: File::findByToken($i->image_holder);
            $this->_qrcodePath = $file ? $file->displayRootPath: '';
        }

        return $this->_qrcodePath;
    }
}
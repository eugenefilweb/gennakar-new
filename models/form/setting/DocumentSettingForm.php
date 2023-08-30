<?php

namespace app\models\form\setting;

use Yii;
use app\helpers\Html;
use app\models\File;

class DocumentSettingForm extends SettingForm
{
    const NAME = 'document-settings';

    public $data_privacy;
    public $camp_management;
    public $org_chart;
    public $lccap;
    public $ldrrmp;

    public function rules()
    {
        return [
           [['data_privacy', 'camp_management', 'org_chart', 'lccap', 'ldrrmp'], 'string'],
           [['data_privacy', 'camp_management', 'org_chart', 'lccap', 'ldrrmp'], 'safe'],
        ];
    }

    public function default()
    {
        return [
            ['name' => 'data_privacy', 'default' => ''],
            ['name' => 'camp_management', 'default' => ''],
            ['name' => 'org_chart', 'default' => ''],
            ['name' => 'lccap', 'default' => ''],
            ['name' => 'ldrrmp', 'default' => ''],
        ];
    }

    public function getFile($attribute)
    {
        $token = $this->{$attribute};

        return File::findByToken($token);
    }

    public function getDataPrivacyFile()
    {
        return $this->getFile('data_privacy');
    }

    public function getDataPrivacyDownloadButton()
    {
        if (($file = $this->getFile('data_privacy')) != null) {
            return Html::a('Download Data Privacy Form', $file->downloadUrl, [
                'class' => 'btn btn-outline-secondary font-weight-bolder btn-sm'
            ]);
        }
    }
}
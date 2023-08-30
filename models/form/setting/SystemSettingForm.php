<?php

namespace app\models\form\setting;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\models\File;
use app\models\Theme;

class SystemSettingForm extends SettingForm
{
    const NAME = 'system-settings';
    const ASIA_MANILA = 'Asia/Manila';

    const OFF = 0;
    const ON = 1;

    const ALERT_LEVEL_WHITE = 0;
    const ALERT_LEVEL_BLUE = 1;
    const ALERT_LEVEL_RED = 2;

    const ORG_CHART_TEMPLATE = [
        'olivia',
        'diva',
        'mila',
        'polina',
        'mery',
        'rony',
        'belinda',
        'ula',
        'ana',
        'isla',
        'deborah',
    ];

    public $timezone;
    public $pagination;
    public $auto_logout_timer;
    public $theme;
    public $whitelist_ip_only;
    public $enable_visitor;
    public $organizational_chart;
    public $organizational_chart_template;
    public $organizational_chart_subscribe;
    public $data_privacy;

    public $alert_level;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['timezone', 'pagination', 'theme', 'auto_logout_timer', 'alert_level'], 'required'],
	        [['timezone',], 'string'],
	        [['whitelist_ip_only', 'enable_visitor', 'organizational_chart', 'organizational_chart_template', 'organizational_chart_subscribe', 'data_privacy'], 'safe'],
	        [['pagination', 'auto_logout_timer', 'theme', 'whitelist_ip_only', 'enable_visitor', 'organizational_chart_subscribe', 'alert_level'], 'integer'],
            ['alert_level', 'in', 'range' => [
                self::ALERT_LEVEL_WHITE,
                self::ALERT_LEVEL_BLUE,
                self::ALERT_LEVEL_RED,
            ]],

	        ['pagination', 'in', 'range' => array_keys(App::params('pagination'))],
	        ['whitelist_ip_only', 'in', 'range' => array_keys(App::params('whitelist_ip_only'))],
	        ['enable_visitor', 'in', 'range' => array_keys(App::params('enable_visitor'))],
	        ['theme', 'exist', 'targetClass' => 'app\models\Theme', 'targetAttribute' => 'id'],
	        ['timezone', 'in', 'range' => array_keys(App::component('general')->timezoneList())],
        ];
    }

    public function getThemeModel()
    {
        return Theme::findOne($this->theme);
    }

    public function default()
    {
        return [
            'alert_level' => [
                'name' => 'alert_level',
                'default' => self::ALERT_LEVEL_WHITE,
            ],
            'timezone' => [
                'name' => 'timezone',
                'default' => self::ASIA_MANILA,
            ],
            'pagination' => [
                'name' => 'pagination',
                'default' => 25,
            ],
            'auto_logout_timer' => [
                'name' => 'auto_logout_timer',
                'default' => 60 * 60 * 24
            ],
            'theme' => [
                'name' => 'theme',
                'default' => Theme::LIGHT_FLUID,
            ],
            'whitelist_ip_only' => [
                'name' => 'whitelist_ip_only',
                'default' => self::OFF,
            ],
            'enable_visitor' => [
                'name' => 'enable_visitor',
                'default' => self::OFF,
            ],
            'organizational_chart' => [
                'name' => 'organizational_chart',
                'default' => '',
            ],
            'organizational_chart_template' => [
                'name' => 'organizational_chart_template',
                'default' => 'isla',
            ],
            'organizational_chart_subscribe' => [
                'name' => 'organizational_chart_subscribe',
                'default' => self::OFF,
            ],
            'data_privacy' => [
                'name' => 'data_privacy',
                'default' => '',
            ],
        ];
    }

    public function getDataPrivacyFile()
    {
        return File::findByToken($this->data_privacy);
    }

    public function getDataPrivacyDownloadButton()
    {
        if (($file = $this->dataPrivacyFile) != null) {
            return Html::a('Download Data Privacy Form', $file->downloadUrl, [
                'class' => 'btn btn-light-primary font-weight-bolder btn-sm'
            ]);
        }
    }

    public function getAlertLevelLabel()
    {
        return App::params('alert_level')[$this->alert_level]['label'] ?? '';
    }

    public function getAlertLevelClass()
    {
        return App::params('alert_level')[$this->alert_level]['class'] ?? '';
    }
}
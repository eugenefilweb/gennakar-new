<?php

namespace app\models\form\user;

use Yii;
use app\helpers\App;
use app\models\Role;
use app\models\Theme;
use app\models\User;
use app\models\UserMeta;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class MySettingForm extends UserForm
{
    const META_NAME = 'my-settings';
    
    public $theme_id;
    public $system_change_password = 1;
    public $email_change_password = 1;
    public $new_patrol = 1;
    public $new_request = 1;
    public $approved_request = 1;
    public $email_approved_request = 1;
    public $new_tech_issue = 1;

    private $_theme;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return $this->setRules([
            // [['theme_id'], 'required'],
            [['theme_id', 'system_change_password', 'email_change_password', 'new_patrol', 'new_request', 'email_approved_request', 'approved_request', 'new_tech_issue'], 'integer'],
            ['theme_id', 'exist', 'targetClass' => 'app\models\Theme', 'targetAttribute' => 'id'],
        ]);
    }

    public function attributeLabels()
    {
        return [
            'theme_id' => 'Theme',
            'user_id' => 'User ID',
            'system_change_password' => 'Change Password',
            'email_change_password' => 'Change Password',
            'new_request' => 'New Ambulance Request',
            'approved_request' => 'Approved Ambulance Request',
            'new_tech_issue' => 'New Technical Issue'
        ];
    }

    public function validateThemeId($attribute, $params)
    {
        if (($theme = $this->getTheme()) == null) {
            $this->addError($attribute, 'Theme don\'t exist.');
        }
    }

    public function getDetailColumns()
    {
        return [
            'user_id:raw',
            'first_name:raw',
            'last_name:raw',
        ];
    }

    public function getTheme()
    {
        if ($this->_theme === null) {
            $this->_theme = Theme::findOne($this->theme_id) ?: App::setting('system')->themeModel;
        }
        return $this->_theme;
    }

    public function getSystemNotificationSettings()
    {
        switch (App::identity('role_id')) {
            case Role::DEVELOPER:
            case Role::SUPERADMIN:
            case Role::ADMIN:
                $settings = [
                    'system_change_password',
                    'new_patrol',
                    'new_request',
                    'approved_request',
                    'new_tech_issue',
                ];
                break;

            case Role::BIODIVERSITY_MANAGER:
                $settings = [
                    'system_change_password',
                    'new_patrol',
                ];
                break;

            case Role::REQUEST_APPROVER:
                $settings = [
                    'system_change_password',
                    'new_request',
                    'approved_request',
                ];
                break;
            
            default:
                $settings = [
                    'system_change_password',
                ];
                break;
        }

        return $settings;
    }

    public function getEmailNotificationSettings()
    {
        switch (App::identity('role_id')) {
            case Role::DEVELOPER:
            case Role::SUPERADMIN:
            case Role::ADMIN:
                $settings = [
                    'email_change_password',
                    'email_approved_request',
                ];
                break;

            case Role::REQUEST_APPROVER:
                $settings = [
                    'email_change_password',
                    'email_approved_request',
                ];
                break;
            
            default:
                $settings = [
                    'email_change_password',
                ];
                break;
        }

        return $settings;
    }
}
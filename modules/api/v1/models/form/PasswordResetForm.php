<?php

namespace app\modules\api\v1\models\form;

use Yii;
use app\modules\api\v1\helpers\App;
use app\modules\api\v1\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class PasswordResetForm extends \yii\base\Model
{
    public $password_reset_token; 
    public $new_password; 
    public $confirm_password; 

    public $_user; 

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password_reset_token', 'new_password', 'confirm_password'], 'required'],
            ['password_reset_token', 'trim'],
            ['password_reset_token', 'exist', 'targetClass' => 'app\modules\api\v1\models\User', 'targetAttribute' => 'password_reset_token'],
            ['password_reset_token', 'validatePasswordResetToken'],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password'],
        ];
    }

    public function validatePasswordResetToken($attribute, $params)
    {
        if (($user = $this->getUser()) != null) {
            if ($user->is_blocked == User::BLOCKED) {
                $this->addError($attribute, 'User is blocked.');
            }

            if ($user->status == User::STATUS_DELETED) {
                $this->addError($attribute, 'User is deleted.');
            }

            if ($user->status == User::STATUS_INACTIVE) {
                $this->addError($attribute, 'User is inactive.');
            }

            if ($user->record_status == User::RECORD_INACTIVE) {
                $this->addError($attribute, 'User record is inactive.');
            }
        }
        else {
            $this->addError($attribute, 'token invalid');
        }
    }

    public function getUser()
    {
        if ($this->_user == null) {
            $this->_user = User::findByPasswordResetToken($this->password_reset_token);
        }

        return $this->_user;
    }
    
    public function changePassword()
    {
        if ($this->validate()) {
            $user = $this->getUser();

            $user->setPassword($this->new_password);
            $user->generatePasswordResetToken();

            if ($user->save()) {

                return $user;
            }
            else {
                $this->addError('user', $user->errors);
            }
        }

        return false;
    }
}
<?php

namespace app\models\form;

use Yii;
use app\helpers\App;
use app\helpers\Url;
use app\jobs\EmailJob;
use app\jobs\NotificationJob;
use app\models\Notification;
use app\models\Queue;
use app\models\Token;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ChangePasswordForm extends \yii\base\Model
{
    public $user_id;
    public $old_password;
    public $new_password; 
    public $confirm_password; 
    public $password_hint; 

    public $code; 

    public $_user; 
    public $_token; 

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['old_password', 'new_password', 'confirm_password', 'user_id', 'password_hint', 'code'], 'required'],
            ['old_password', 'validateOldPassword'],
            ['new_password', 'validateNewPassword'],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password'],
            ['user_id', 'validateUser'],
            ['code', 'trim'],
            ['code', 'validateCode'],
        ];
    }

    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findOne($this->user_id);
        }

        return $this->_user;
    }

    public function getToken()
    {
        if ($this->_token === null) {
            if (($user = $this->getUser()) != null) {
                $this->_token = Token::find()
                    ->where([
                        'code' => $this->code,
                        'user_id' => $user->id,
                        'record_status' => Token::RECORD_ACTIVE,
                        'type' => Token::TYPE_PASSWORD_RESET
                    ])
                    ->orderBy(['id' => SORT_DESC])
                    ->one();
            }
        }

        return $this->_token;
    }

    public function validateCode($attribute, $params)
    {
        if (($token = $this->getToken()) != null) {
            if ($token->isExpired) {
                $this->addError($attribute, 'Authentication code expired');
            }
        }
        else {
            $this->addError($attribute, 'Invalid authentication code');
        }
    }

    public function validateUser($attribute, $params)
    {
        if (($user = $this->getUser()) == null) {
            $this->addError($attribute, 'User don\'t exist');
        }
    }

    public function validateOldPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->old_password)) {
                $this->addError($attribute, 'Incorrect old password.');
            }
        }
    }

    public function validateNewPassword($attribute, $params)
    {
        if ($this->old_password == $this->new_password) {
            $this->addError($attribute, 'New password cannot be the same with old password.');
        }
    }

    public function changePassword()
    {
        if ($this->validate()) {
            $user = $this->getUser();

            $user->setPassword($this->new_password);
            $user->password_hint = $this->password_hint;

            if ($user->save()) {

                $token = $this->getToken();
                Token::updateAll(['record_status' => Token::RECORD_INACTIVE], [
                    'id' => $token->id
                ]);

                Notification::changePassword($user);
                Notification::changePasswordEmail($user);

                return $user;
            }
            else {
                $this->addError('user', $user->errors);
            }
        }

        return false;
    }
}
<?php

namespace app\modules\api\v1\models\form;

use Yii;
use app\modules\api\v1\models\User;
use app\modules\api\v1\helpers\App;

class ForgotPasswordForm extends \yii\base\Model
{
    public $email;

    private $_user;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'trim'],
            ['email', 'exist', 'targetClass' => 'app\modules\api\v1\models\User', 'targetAttribute' => 'email'],
            ['email', 'validateEmail'],
        ];
    }

    public function validateEmail($attribute, $params)
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

            if ($user->role->isInactive) {
                $this->addError($attribute, 'Role is inactive');
            }
        }
    }

    public function sendEmail()
    {
        if ($this->validate()) {
            $user = $this->getUser();

            $mail = new CustomEmailForm([
                'template' => '@app/modules/api/v1/mail/forgot-password',
                'subject' => 'Forgot Password',
                'to' => $this->email
            ]);
            
            if ($mail->send()) {
                return $user;
            }
            else {
                $this->addError('mail', $mail->errors);
            }

            return $user;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findOne(['email' => $this->email]);
        }

        return $this->_user;
    }
}
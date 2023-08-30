<?php

namespace app\modules\api\v1\models\form;

use Yii;
use app\modules\api\v1\models\VisitLog;
use app\modules\api\v1\models\User;

class LogoutForm extends \yii\base\Model
{
    public $access_token;

    private $_user = false;

    public function rules()
    {
        return [
            [['access_token'], 'required'],
            ['access_token', 'validateAccessToken'],
        ];
    }


    public function validateAccessToken($attribute, $params)
    {
        $user = $this->getUser();

        if ($user) {
            if ($user->isInactive) {
                $this->addError($attribute, 'User is inactive');
            }

            if ($user->isNotVerified) {
                $this->addError($attribute, 'User is not verified');
            }

            if ($user->isBlocked) {
                $this->addError($attribute, 'User is blocked');
            }

            if ($user->role->isInactive) {
                $this->addError($attribute, 'Role is inactive');
            }
        }
        else {
            $this->addError($attribute, 'No user found');
        }
    }

  
    public function logout()
    {
        if ($this->validate()) {
            $user = $this->getUser();

            VisitLog::logout($user);

            return $user;
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user =  User::findIdentityByAccessToken($this->access_token);
        }

        return $this->_user;
    }
}
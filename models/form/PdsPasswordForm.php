<?php

namespace app\models\form;

use Yii;
use app\helpers\App;
use app\models\Token;

class PdsPasswordForm extends \yii\base\Model
{
    public $password;
    public $expiration;

    public function rules()
    {
        return [
            [['password'], 'string', 'max' => 225],
            [['password', 'expiration'], 'required'],
            [['password'], 'validatePassword'],
            ['expiration', 'integer', 'min' => 60]
        ];
    }

    public function confirm()
    {
        if ($this->validate()) {
            $token = new Token();
            $token->user_id = App::identity('id');
            $token->type = Token::PDS;
            $token->code = $token->generateUniqueCode();
            $token->generateExpiration($this->expiration);
            $token->save();

            if ($token->save()) {
                return $token;
            }
            else {
                $this->addError('token', $token->errors);
            }
        }
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = App::identity();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
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
        }
    }
}
<?php

namespace modules\api\v1\tests\unit\models\form;

use app\modules\api\v1\models\form\LoginForm;

class LoginFormTest extends \Codeception\Test\Unit
{
    public function testLoginNotExistingUser()
    {
        $model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        expect_not($model->login());
    }

    public function testLoginWithWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'demo',
            'password' => 'wrong_password',
        ]);

        expect_not($model->login());
        expect($model->errors)->hasKey('password');
    }


    public function testLoginBlockedUser()
    {
        $model = new LoginForm([
            'username' => 'blockeduser',
            'password' => 'blockeduser@blockeduser.com',
        ]);

        expect_not($model->login());
    }

    public function testLoginNotVerifiedUser()
    {
        $model = new LoginForm([
            'username' => 'notverifieduser',
            'password' => 'notverifieduser@notverifieduser.com',
        ]);

        expect_not($model->login());
    }

    public function testLoginInactiveUser()
    {
        $model = new LoginForm([
            'username' => 'inactiveuser',
            'password' => 'inactiveuser@inactiveuser.com',
        ]);

        expect_not($model->login());
    }

    public function testLoginInactiveRoleUser()
    {
        $model = new LoginForm([
            'username' => 'inactiveroleuser',
            'password' => 'inactiveroleuser@inactiveroleuser.com',
        ]);

        expect_not($model->login());
    }

    public function testLoginCorrectCredential()
    {
        $model = new LoginForm([
            'username' => 'developer@developer.com',
            'password' => 'developer@developer.com',
        ]);

        expect_that($model->login());
    }
}
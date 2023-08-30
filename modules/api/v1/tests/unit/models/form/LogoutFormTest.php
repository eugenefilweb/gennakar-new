<?php

namespace modules\api\v1\tests\unit\models\form;

use app\modules\api\v1\models\form\LogoutForm;

class LogoutFormTest extends \Codeception\Test\Unit
{
    public function testLogoutNotExistingUser()
    {
        $model = new LogoutForm([
            'access_token' => 'not_existing_access_token',
        ]);

        expect_not($model->logout());
    }


    public function testLogoutBlockedUser()
    {
        $this->model = new LogoutForm([
            'access_token' => 'blockeduser-access_token',
        ]);

        expect_not($this->model->logout());
    }

    public function testLogoutNotVerifiedUser()
    {
        $this->model = new LogoutForm([
            'access_token' => 'notverifieduser-access_token',
        ]);

        expect_not($this->model->logout());
    }

    public function testLogoutInactiveUser()
    {
        $this->model = new LogoutForm([
            'access_token' => 'inactiveuser-access_token',
        ]);

        expect_not($this->model->logout());
    }

    public function testLogoutInactiveRoleUser()
    {
        $this->model = new LogoutForm([
            'access_token' => 'inactiveroleuser-access_token',
        ]);

        expect_not($this->model->logout());
    }

    public function testLogoutCorrectCredential()
    {
        $this->model = new LogoutForm([
            'access_token' => 'developer-access_token',
        ]);

        expect_that($this->model->logout());
    }
}
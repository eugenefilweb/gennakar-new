<?php

namespace modules\api\v1\tests\unit\models\form;

use app\modules\api\v1\models\form\ForgotPasswordForm;

class ForgotPasswordFormTest extends \Codeception\Test\Unit
{
    public function testNotExistingUser()
    {
        $model = new ForgotPasswordForm([
            'email' => 'not_existing_password@not_existing_password.com',
        ]);

        expect_not($model->sendEmail());
    }

    public function testBlockedUser()
    {
        $model = new ForgotPasswordForm([
            'email' => 'blockeduser@blockeduser.com',
        ]);

        expect_not($model->sendEmail());
    }

    public function testNotVerifiedUser()
    {
        $model = new ForgotPasswordForm([
            'email' => 'notverifieduser@notverifieduser.com',
        ]);

        expect_not($model->sendEmail());
    }

    public function testInactiveUser()
    {
        $model = new ForgotPasswordForm([
            'email' => 'inactiveuser@inactiveuser.com',
        ]);

        expect_not($model->sendEmail());
    }

    public function testInactiveRoleUser()
    {
        $model = new ForgotPasswordForm([
            'email' => 'inactiveroleuser@inactiveroleuser.com',
        ]);

        expect_not($model->sendEmail());
    }

    public function testCorrectEmail()
    {
        $model = new ForgotPasswordForm([
            'email' => 'developer@developer.com',
        ]);

        expect_that($model->sendEmail());

        $this->tester->seeEmailIsSent();

        /** @var MessageInterface $emailMessage */
        $emailMessage = $this->tester->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey('developer@developer.com');
        expect($emailMessage->getFrom())->hasKey('noreply@example.com');
        expect($emailMessage->getSubject())->equals('Forgot Password');
    }
}
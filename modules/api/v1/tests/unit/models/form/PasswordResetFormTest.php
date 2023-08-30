<?php

namespace modules\api\v1\tests\unit\models\form;

use app\modules\api\v1\models\form\PasswordResetForm;

class PasswordResetFormTest extends \Codeception\Test\Unit
{
    public function testSuccess()
    {
        $user = $this->tester->grabRecord('app\modules\api\v1\models\User', [
            'username' => 'developer'
        ]);

        $user->generatePasswordResetToken();
        $user->save();

        $model = new PasswordResetForm([
            'password_reset_token' => $user->password_reset_token,
            'new_password' => '123456',
            'confirm_password' => '123456',
        ]);

        expect_that($model->changePassword());
    }

    public function testBlockedUser()
    {
        $user = $this->tester->grabRecord('app\modules\api\v1\models\User', [
            'username' => 'blockeduser'
        ]);
        $user->generatePasswordResetToken();
        $user->save();
        $model = new PasswordResetForm([
            'password_reset_token' => $user->password_reset_token,
            'new_password' => '123456',
            'confirm_password' => '123456',
        ]);

        expect_not($model->changePassword());
        expect($model->errors)->hasKey('password_reset_token');
        expect($model->errors['password_reset_token'][0])->equals('User is blocked.');
    }

    // public function testNotVerifiedUser()
    // {
    //     $model = new PasswordResetForm([
    //         'email' => 'notverifieduser@notverifieduser.com',
    //     ]);

    //     expect_not($model->sendEmail());
    // }

    // public function testInactiveUser()
    // {
    //     $model = new PasswordResetForm([
    //         'email' => 'inactiveuser@inactiveuser.com',
    //     ]);

    //     expect_not($model->sendEmail());
    // }

    // public function testInactiveRoleUser()
    // {
    //     $model = new PasswordResetForm([
    //         'email' => 'inactiveroleuser@inactiveroleuser.com',
    //     ]);

    //     expect_not($model->sendEmail());
    // }

    // public function testCorrectEmail()
    // {
    //     $model = new PasswordResetForm([
    //         'email' => 'developer@developer.com',
    //     ]);

    //     expect_that($model->sendEmail());

    //     $this->tester->seeEmailIsSent();

    //     /** @var MessageInterface $emailMessage */
    //     $emailMessage = $this->tester->grabLastSentEmail();
    //     expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
    //     expect($emailMessage->getTo())->hasKey('developer@developer.com');
    //     expect($emailMessage->getFrom())->hasKey('noreply@example.com');
    //     expect($emailMessage->getSubject())->equals('Forgot Password');
    // }
}
<?php

namespace app\behaviors;

use app\helpers\App;
use app\models\Email;
use yii\symfonymailer\Mailer;

class MailerBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Mailer::EVENT_AFTER_SEND  => 'afterSend',
        ];
    }

    public function afterSend($event)
    {
        $message = $event->message;

        $to_email = array_key_first($message->to);
        $from_email = array_key_first($message->from);
        $from_name = $message->from[$from_email];

        $email = new Email([
            'to' => $to_email,
            'from_email' => $from_email,
            'from_name' => $from_name,
            'subject' => $message->subject,
            'body' => $message->getHtmlBody(),
        ]);

        $email->save();
    }
}
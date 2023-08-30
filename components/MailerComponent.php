<?php

namespace app\components;

class MailerComponent extends \yii\symfonymailer\Mailer
{
    public $useFileTransport = true;
	const TRANSPORT = [
		// LIVE
		'scheme' => 'smtp',
		'host' => 'mail.accessgov.ph',
		'username' => 'notification@accessgov.ph',
		'password' => 'IR$dUv=KzEuU',
		'port' => 587,
		// 465
		// 587




        // LOCAL - notworking
        // 'scheme' => 'smtps',
        // 'host' => 'smtp.gmail.com',
        // 'username' => 'chatbot.naive@gmail.com',
        // 'password' => 'Chatbot#2a',
        // 'port' => 465,
        // 'encryption' => 'tls',
        // 'streamOptions' => [
        // 	'ssl' => [
        // 		'allow_self_signed' => true,
	       //      'verify_peer' => false,
	       //      'verify_peer_name' => false,
	       //  ],
        // ]
	];

	public function init()
	{
		parent::init();
		$this->setTransport(self::TRANSPORT);
	}

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['MailerBehavior'] = [
            'class' => 'app\behaviors\MailerBehavior'
        ];

        return $behaviors;
    }
}
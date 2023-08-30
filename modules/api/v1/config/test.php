<?php

$config = require __DIR__ .'/../../../../config/test.php';

$config['components']['mailer'] = ['class' => 'app\modules\api\v1\components\MailerComponent'];

return $config;
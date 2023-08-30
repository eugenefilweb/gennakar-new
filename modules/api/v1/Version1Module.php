<?php

namespace app\modules\api\v1;

use Yii;
use yii\web\Response;

/**
 * api module definition class
 */
class Version1Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\v1\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::$app->setComponents([
            'mailer' => 'app\modules\api\v1\components\MailerComponent',
            'user' => [
                'class' => 'app\modules\api\v1\components\UserComponent',
                'enableSession' => false
            ],
            'request' => 'app\modules\api\v1\components\RequestComponent',
            'response' => 'app\modules\api\v1\components\ResponseComponent',
        ]);
    }
}
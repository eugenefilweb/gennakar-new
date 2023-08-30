<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\helpers\App;
use app\modules\api\v1\models\User;
use app\modules\api\v1\models\VisitLog;
use app\modules\api\v1\models\form\LoginForm;
use app\modules\api\v1\models\form\LogoutForm;
use app\modules\api\v1\models\form\ForgotPasswordForm;

/**
 * Default controller for the `api` module
 */
class SiteController extends RestController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['verbFilter'] = [
            'class' => 'yii\filters\VerbFilter',
            'actions' => [
                'logout' => ['post'],
                'login' => ['post'],
                'forgot-password' => ['post'],
            ]
        ];

        return $behaviors;
    }

    public function actionTest()
    {
        return App::post();
    }

    public function beforeAction($action)
    {
        switch ($action->id) {
            case 'logout':
                $this->attachBehavior('authenticator', [
                    'class' => 'yii\filters\auth\CompositeAuth',
                    'authMethods' => [
                        'yii\filters\auth\HttpBasicAuth',
                        'yii\filters\auth\HttpBearerAuth',
                        'yii\filters\auth\QueryParamAuth',
                    ],
                ]);
                break;
            
            default:
                # code...
                break;
        }

        return parent::beforeAction($action);
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(['LoginForm' => App::post()]) 
            && ($user = $model->login()) != null) {
            return [
                'status' => true,
                'user' => $user
            ];
        }

        return [
            'status' => false,
            'error' => $model->errors
        ];
    } 

    public function actionLogout()
    {
        $identity = App::identity();

        if ($identity) {
            $model = new LogoutForm(['access_token' => $identity->access_token]);

            if (($user = $model->logout()) != null) {
                return [
                    'status' => true,
                    'user' => $identity
                ];
            }

            return [
                'status' => false,
                'error' => $model->errors
            ];
        }

        return [
            'status' => false,
            'error' => 'Invalid access token'
        ];
    }

    public function actionForgotPassword()
    {
        $model = new ForgotPasswordForm();
        if ($model->load(['ForgotPasswordForm' => App::post()]) 
            && ($user = $model->sendEmail()) != null) {
            return [
                'status' => true,
                'user' => $user
            ];
        }

        return [
            'status' => false,
            'error' => $model->errors
        ];
    }
}
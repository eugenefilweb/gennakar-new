<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\Bandwidth;
use app\models\Token;
use app\models\User;
use app\models\VisitLog;
use app\models\form\ContactForm;
use app\models\form\CustomEmailForm;
use app\models\form\LoginForm;
use app\models\form\PasswordResetForm;
use yii\web\Response;

class SiteController extends Controller
{
    const PUBLIC_ACTIONS = [
        'secure-login', 
        'login', 
        'reset-password', 
        'contact', 
        'index', 
        'about', 
        'home', 
        'file-directory', 
        'test-email',
        'transfer-size',
        'coming-soon',
        'iframe-map',
        'two-factor-verification',
        'verify-certificate',
    ];

    public function actionComingSoon()
    {
        return $this->render('coming-soon');
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['AccessControl'] = [
            'class' => 'app\filters\AccessControl',
            'publicActions' => self::PUBLIC_ACTIONS
        ];
        $behaviors['VerbFilter'] = [
            'class' => 'app\filters\VerbFilter',
            'verbActions' => [
                'logout' => ['post'],
                'two-factor-verification' => ['post']
            ]
        ];

        unset($behaviors['SettingFilter']);

        return $behaviors;
    }

    public function actionTwoFactorVerification($vt)
    {
        if (($user = User::findByVerificationToken($vt)) != null) {
            $token = Token::find()
                ->where([
                    'code' => trim(App::post('code')),
                    'user_id' => $user->id,
                    'record_status' => Token::RECORD_ACTIVE,
                    'type' => Token::TYPE_TWO_FACTOR_EMAIL
                ])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            if ($token && $token->isNotExpired) {
                Yii::$app->user->login($user, 0);
                Token::updateAll(['record_status' => Token::RECORD_INACTIVE], [
                    'id' => $token->id
                ]);

                return $this->asJson([
                    'status' => 'success',
                    'message' => 'Successfully logged in',
                    'link' => Url::toRoute(['dashboard/index'], true)
                ]);
            }

            return $this->asJson([
                'status' => 'failed',
                'errorSummary' => 'Code invalid'
            ]);
        }

        return $this->asJson([
            'status' => 'failed',
            'errorSummary' => 'No user found'
        ]);

        return $this->asJson([
            'vt' => $vt,
            'post' => App::post()
        ]);
    }

    public function actionTransferSize()
    {
        try {
            if (App::post()) {
                $totalTransferSize = (int) App::post('totalTransferSize');
                if ($totalTransferSize && App::isLogin()) {
                    $bandwidth = new Bandwidth([
                        'user_id' => App::identity('id'),
                        'bytes' => $totalTransferSize
                    ]);

                    if ($bandwidth->save()) {
                        return $this->asJson([
                            'status' => 'success',
                            'message' => 'Bandwidth saved'
                        ]);
                    }

                    return $this->asJson([
                        'status' => 'failed',
                        'errorSummary' => $bandwidth->errorSummary
                    ]);
                }
            }
            return $this->asJson([
                'status' => 'failed',
                'errorSummary' => 'No post data'
            ]);
        } catch (\yii\db\Exception $e) {
            return $this->asJson([
                'status' => 'failed',
                'errorSummary' => 'Error'
            ]);
        }
    }

    public function actionTestEmail()
    {
        $messages = App::foreach(\app\models\User::findAll(['role_id' => 1]), function($user) {
            $model = new \app\models\form\CustomEmailForm([
                'to' => 'roel.filweb@gmail.com',
                'subject' => 'Approved Ambulance Request',
                'template' => 'approved-ambulance-request',
                'parameters' => [
                    'user' => $user,
                    'model' => \app\models\Request::findOne(7)
                ],
            ]);
            return $model->send('multiple');
        }, false);

        $result = Yii::$app->mailer->sendMultiple($messages);

        var_dump($result); die;
    }

    public function beforeAction($action)
    {
        switch ($action->id) {
            case 'about':
            case 'index':
            case 'home':
                $this->layout = 'home';
                break;
            case 'login':
            case 'reset-password':
            case 'contact':
                $this->layout = 'login';
                break;
            
            default:
                # code...
                break;
        }
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionResetPassword($password_reset_token='')
    {
        if ($password_reset_token) {
            $user = User::findOne(['password_reset_token' => $password_reset_token]);

            if (!$user) {
                App::danger('Password reset link is expired.');
                return $this->redirect(['login']);
            }

            $model = new PasswordResetForm([
                'email' => $user->email,
                'scenario' => 'reset'
            ]);


            if ($model->load(App::post())) {
                if (($user = $model->changePassword()) != null) {
                    App::success("Password was reset.");
                    return $this->redirect(['login']);
                }
                else {
                    App::danger(Html::errorSummary($model));
                    return $this->redirect(['reset-password', 'password_reset_token' => $password_reset_token]);
                }
            }

            return $this->render('reset-password', [
                'model' => $model,
                'user' => $user,
            ]);

        }


        $model = new PasswordResetForm();
        if ($model->load(App::post())) {
            if (($user = $model->process()) != null) {
                if ($model->hint) {
                    App::success("Your password hint is: '{$user->password_hint}'.");
                }
                else {
                    App::success("Email sent.");
                }
            }
            else {
                App::danger(Html::errorSummary($model));
            }
        }

        return $this->redirect(['login']);
    }

    public function actionVerifyCertificate($token='')
    {
        $this->layout = false;

        return $this->render('verify-certificate');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (App::isLogin()) {
            return $this->redirect(['dashboard/index']);
        }

        return $this->redirect(['login']);
        return $this->render('index');
    }

    public function actionHome()
    {
        return $this->render('index');
    }

    public function actionSecureLogin()
    {
        $model = new LoginForm();
        if (($post = App::post()) != null) {
            if ($model->load($post) && $model->validate()) {
                $user = $model->getUser();

                if ($user->isLoginEmailAuth) {
                    $condition = [
                        'user_id' => $user->id,
                        'type' => Token::TYPE_TWO_FACTOR_EMAIL
                    ];
                    Token::updateAll(['record_status' => Token::RECORD_INACTIVE], $condition);
                    $token = new Token($condition);
                    $token->generateCode();
                    $token->generateExpiration(60 * 60);
                    if ($token->save()) {
                        $mail = new CustomEmailForm([
                            'subject' => 'Two Factor Authentication Code',
                            'template' => 'two_factor',
                            'parameters' => [
                                'user' => $user,
                                'token' => $token,
                            ],
                            'to' => $user->email
                        ]);

                        if ($mail->send()) {
                            return $this->asJson([
                                'status' => 'email_auth',
                                'message' => 'Has two factor email authentication',
                                'email' => $user->email,
                                'verificationLink' => Url::toRoute(['site/two-factor-verification', 'vt' => $user->verification_token])
                            ]);
                        }

                        return $this->asJson([
                            'status' => 'failed',
                            'process' => '$mail->send()',
                            'errorSummary' => 'Email not sent',
                        ]);
                    }
                    return $this->asJson([
                        'status' => 'failed',
                        'process' => '$token->save()',
                        'errorSummary' => $token->errorSummary,
                    ]);
                }
                
                if ($model->login()) {
                    return $this->asJson([
                        'status' => 'success',
                        'message' => 'Successfully logged in',
                        'link' => Url::toRoute(['dashboard/index'], true)
                    ]);
                }

            }
            return $this->asJson([
                'status' => 'failed',
                'process' => 'loginform validate',
                'errorSummary' => Html::errorSummary($model)
            ]);
        }

        return $this->asJson([
            'status' => 'failed',
            'errorSummary' => 'No post data'
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!App::isGuest()) {
            return $this->redirect(['dashboard/index']);
        }

        $model = new LoginForm();
        $PSR = new PasswordResetForm();
        if ($model->load(App::post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
            'PSR' => $PSR,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        App::logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(App::post()) && $model->contact()) {
            App::success('Thank you for contacting us. We will respond to you as soon as possible.');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionIframeMap()
    {
        $this->layout = 'blank';
        return $this->render('iframe-map', [
            'model' => \app\models\Patrol::find()->one()
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionFileDirectory()
    {
        $path = App::post('path');

        $filesAndDirectories = [
            'directories' => \yii\helpers\FileHelper::findDirectories($path, [
                'recursive' => false,
            ]),
            'files' => \yii\helpers\FileHelper::findFiles($path, [
                'recursive' => false,
            ]),
        ];

        return $this->asJson($filesAndDirectories);
    }
}
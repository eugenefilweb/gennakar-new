<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\models\Role;
use app\models\Token;
use app\models\User;
use app\models\VisitLog;
use app\models\form\ChangePasswordForm;
use app\models\form\CustomEmailForm;
use app\models\search\UserSearch;
use yii\helpers\ArrayHelper;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function actionFindByKeywords($keywords='', $role_id='')
    { 
        return $this->asJson(
            User::findByKeywords($keywords, ['u.username', 'u.email', 'r.name'], 10, [
                'u.role_id' => $role_id
            ])
        );
    }
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(['UserSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPatroller()
    {
        $searchModel = new UserSearch([
            'searchTemplate' => 'user/_search-patroller',
            'searchAction' => ['user/index'],
            'searchLabel' => 'Patroller'
        ]);
        $dataProvider = $searchModel->search(['UserSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['u.role_id' => Role::PATROLLER]);

        return $this->render('patroller', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        $model = User::controllerFind($slug, 'slug');
        $model->setGoogleAuthenticator();
        
        $model->setTheProfile();
        return $this->render(($model->isPatroller ? 'view-patroller': 'view'), [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User(['scenario' => User::SCENARIO_ADMIN_CREATE]);

        if ($model->load(App::post()) && $model->validate()) {
            $model->setPassword($model->password);
            if ($model->save()) {
                App::success('Successfully Created');
                return $this->redirect($model->viewUrl);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates an existing User model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDuplicate($slug)
    {
        $originalModel = User::controllerFind($slug, 'slug');
        $model = new User(['scenario' => User::SCENARIO_ADMIN_CREATE]);
        $model->attributes = $originalModel->attributes;
        $model->setTheProfile($originalModel->profile);
        

        if ($model->load(App::post()) && $model->validate()) {
            $model->setPassword($model->password);
            if ($model->save()) {
                App::success('Successfully Duplicated');
                return $this->redirect($model->viewUrl);
            }
        }

        return $this->render(($model->isPatroller ? 'duplicate-patroller': 'duplicate'), [
            'model' => $model,
            'originalModel' => $originalModel,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = User::controllerFind($slug, 'slug'); 
        $model->setTheProfile();
        if ($model->load(App::post()) && $model->validate()) {
            if ($model->password) {
                $model->setPassword($model->password);
            }
            if ($model->save()) {
                App::success('Successfully Updated');
                return $this->redirect($model->viewUrl);
            }
        }

        return $this->render(($model->isPatroller ? 'update-patroller': 'update'), [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        $model = User::controllerFind($slug, 'slug');

        if($model->delete()) {
            App::success('Successfully Deleted');
        }
        else {
            App::danger(json_encode($model->errors));
        }

        return $this->redirect($model->indexUrl);
    }

    public function actionChangeRecordStatus()
    {
        return $this->changeRecordStatus();
    }

    public function actionBulkAction()
    {
        return $this->bulkAction();
    }

    public function actionPrint()
    {
        return $this->exportPrint();
    }

    public function actionExportPdf()
    {
        return $this->exportPdf();
    }

    public function actionExportCsv()
    {
        return $this->exportCsv();
    }

    // public function _ctionExportXls()
    // {
    //     return $this->exportXls();
    // }

    public function actionExportXlsx()
    {
        return $this->exportXlsx();
    }

    public function actionSendChangePasswordCode()
    {
        if (($user = User::controllerFind(App::post('token'), 'password_reset_token')) != null) {
            $condition = [
                'user_id' => $user->id,
                'type' => Token::TYPE_PASSWORD_RESET
            ];
            Token::updateAll(['record_status' => Token::RECORD_INACTIVE], $condition);
            $token = new Token($condition);
            $token->generateCode();
            $token->generateExpiration(60 * 60);
            if ($token->save()) {
                $mail = new CustomEmailForm([
                    'subject' => 'Forgot Password Authentication Code',
                    'template' => 'two_factor_password',
                    'parameters' => [
                        'user' => $user,
                        'token' => $token,
                    ],
                    'to' => $user->email
                ]);

                if ($mail->send()) {
                    return $this->asJson([
                        'status' => 'success',
                        'message' => "We've sent an email to <b>{$user->email}</b> with your two factor authentication code"
                    ]);
                }
                else {
                    return $this->asJson([
                        'status' => 'failed',
                        'errorSummary' => 'Email Authentication not sent'
                    ]);
                }
            }
            else {
                return $this->asJson([
                    'status' => 'failed',
                    'errorSummary' => $token->errorSummary
                ]);
            }
        }

        return $this->asJson([
            'status' => 'failed',
            'errorSummary' => 'User not found'
        ]);
    }

    public function actionMyPassword($token='')
    {
        $user = ($token)? User::controllerFind($token, 'password_reset_token'): App::identity();

        $model = new ChangePasswordForm([
            'user_id' => $user->id,
            'password_hint' => $user->password_hint
        ]);

        if ($model->load(App::post())) {
            if ($model->changePassword()) {
                App::success('Password Change.');
            }
            else {
                App::danger(Html::errorSummary($model));
            }
            return $this->redirect(['user/my-password']);
        }

        $user->setGoogleAuthenticator();

        return $this->render('my_password', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function actionProfile($slug)
    {
        $user = User::controllerFind($slug, 'slug'); 
        $model = $user->profile;

        if ($model->load(App::post()) && $model->save()) {
            App::success('Profile Updated');
            return $this->redirect(['profile', 'slug' => $user->slug]);
        }

        return $this->render('profile', [
            'user' => $user,
            'model' => $model,
        ]);
    }

    public function actionMyAccount()
    {
        $model = App::identity();
        $model->setTheProfile();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');
            return $this->refresh();
        } 

        $model->flashErrors();

        return $this->render('my_account', [
            'model' => $model,
        ]);
    }

    public function actionDashboard($slug)
    {
        $model = User::find()
            ->where([
                'slug' => $slug,
                'status' => 10,
                'is_blocked' => 0,
                'record_status' => 1
            ])
            ->one();

        if ($model) {
            App::user()->logout();

            App::user()->login($model, 0);

            return $this->redirect(['dashboard/index']);
        }
        else {
            App::danger('No user found or user is cannot be log in.');
        }

        return $this->redirect(App::referrer());
    }

    public function actionInActiveData()
    {
        # dont delete; use in condition if user has access to in-active data
    }

    public function actionCreatePatroller()
    {
        $model = new User([
            'password_hint' => 'None',
            'scenario' => User::SCENARIO_ADMIN_CREATE
        ]);

        if ($model->load(App::post())) {
            $model->role_id = Role::PATROLLER;
            if ($model->validate()) {
                $model->setPassword($model->password);
                if ($model->save()) {
                    App::success('Successfully Created');
                    return $this->redirect($model->viewUrl);
                }
            }
        }

        $model->flashErrors();

        return $this->render('create-patroller', [
            'model' => $model,
        ]);
    }

    public function actionChangeLoginType($slug, $type=User::LOGIN_TYPE_DEFAULT)
    {
        $model = User::controllerFind($slug, 'slug');
        $model->login_type = $type;
        if ($model->save()) {
            App::success('Login Type Changed.');
        }
        else {
            App::danger($mdoel->errorSummary);
        }

        return $this->redirect(App::referrer());
    }
}
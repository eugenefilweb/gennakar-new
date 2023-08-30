<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\models\PersonalDataSheet;
use app\models\Token;
use app\models\form\PdsPasswordForm;
use app\models\search\PersonalDataSheetSearch;


/**
 * PersonalDataSheetController implements the CRUD actions for PersonalDataSheet model.
 */
class PersonalDataSheetController extends Controller 
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['VerbFilter'] = [
            'class' => 'app\filters\VerbFilter',
            'verbActions' => [
                'index'  => ['get', 'post'],
                'view'   => ['get', 'post'],
                'create' => ['get', 'post'],
                'update' => ['get', 'put', 'post'],
                'delete' => ['post', 'delete'],
                'change-record-status' => ['post'],
                'bulk-action' => ['post'],
            ]
        ];
        return $behaviors;
    }

    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            PersonalDataSheet::findByKeywords($keywords, ['surname', 'first_name', 'middle_name'])
        );
    }

    /**
     * Lists all PersonalDataSheet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonalDataSheetSearch();
        $dataProvider = $searchModel->search(['PersonalDataSheetSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonalDataSheet model.
     * @param integer $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($token, $code='')
    {
        $form = new PdsPasswordForm(['expiration' => 60 * 5]);
        if ($form->load(App::post())) {
            if (($tokenModel = $form->confirm()) !=  null) {
                // App::success('Password Accepted for ' . $tokenModel->expire - time() . ' seconds');
                return $this->redirect(['view', 'token' => $token, 'code' => $tokenModel->code]);
            }
            else {
                App::danger(Html::errorSummary($form));
            }
        }

        $tokenModel = Token::findOne(['code' => $code]);
        if ($tokenModel && $tokenModel->isNotExpired) {
            $model = PersonalDataSheet::controllerFind($token, 'token');
            App::success('Password Accepted for ' . Html::tag('span', number_format($tokenModel->remaining), ['class' => 'password-time font-weight-bolder']) . ' seconds');
            return $this->render('view', [
                'model' => $model,
                'tokenModel' => $tokenModel,
            ]);
        }

        return $this->render('password', [
            'formModel' => $form,
            'model' => new PersonalDataSheet()
        ]);
    }

    protected function getModel($token = '', $step = '', $action = 'create')
    {
        $model = PersonalDataSheet::findOne(['token' => $token]) ?: new PersonalDataSheet();

        switch ($step) {
            case 'personal-information':

                break;
            case 'family-background': 
            case 'educational-background': 
            case 'civil-service': 
            case 'work-experience': 
            case 'organization': 
            case 'learning-and-development': 
            case 'other': 
            case 'questionnaire': 
            case 'summary':
                if (!$model->surname) {
                    return [
                        'message' => 'Please fill up Personal Information first!',
                        'url' => ['create']
                    ];
                }
                break;
            default:
                break;
        }

        return $model;
    }

    /**
     * Creates a new PersonalDataSheet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($token = '', $step = 'personal-information')
    {
        $model = $this->getModel($token, $step);
        $step_forms = PersonalDataSheet::STEP_FORM;
        $stepId = ArrayHelper::map($step_forms, 'slug', 'id')[$step];

        if (is_array($model)) {
            App::warning($model['message']);
            return $this->redirect($model['url']);
        }

        if (($post = App::post()) != null) {
            if ($step == 'summary') {
                if ($model->save()) {
                    App::success('Successfully Created');
                    return $this->redirect($model->viewUrl);
                }
                else {
                    App::danger($model->errors);
                    return $this->redirect([
                        'create', 
                        'token' => $model->token, 
                        'step' => $step
                    ]);
                }
            }

            if ($step == 'family-background') {
                $post['PersonalDataSheet']['childrens'] = array_values($post['PersonalDataSheet']['childrens'] ?? []);
            }

            if ($step == 'other') {
                $post['PersonalDataSheet']['skills'] = $post['PersonalDataSheet']['skills'] ?? [];
                $post['PersonalDataSheet']['recognitions'] = $post['PersonalDataSheet']['recognitions'] ?? [];
                $post['PersonalDataSheet']['organizations'] = $post['PersonalDataSheet']['organizations'] ?? [];
            }

            if ($step == 'reference') {
                $post['PersonalDataSheet']['references'] = $post['PersonalDataSheet']['references'] ?? [];
            }

            if ($model->load($post) && $model->save()) {
                App::success('Successfully Saved');
                return $this->redirect([
                    'create', 
                    'token' => $model->token,
                    'step' => ArrayHelper::map($step_forms, 'id', 'slug')[$stepId + 1]
                ]);
            }

            $model->flashErrors();
        }

        return $this->render('create', [
            'model' => $model,
            'step' => $stepId,
            'step_forms' => $step_forms,
            'current_step' => $step_forms[$stepId],
        ]);
    }
 
    /**
     * Updates an existing PersonalDataSheet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($token, $step = 'personal-information')
    {
        $model = $this->getModel($token, $step, 'update');
        $step_forms = PersonalDataSheet::STEP_FORM;
        $stepId = ArrayHelper::map($step_forms, 'slug', 'id')[$step];

        if (is_array($model)) {
            App::warning($model['message']);
            return $this->redirect($model['url']);
        }

        if (($post = App::post()) != null) {
            if ($step == 'summary') {
                if ($model->save()) {
                    App::success('Successfully Update');
                    return $this->redirect($model->viewUrl);
                }
                else {
                    App::danger($model->errors);
                    return $this->redirect([
                        'update', 
                        'token' => $model->token, 
                        'step' => $step
                    ]);
                }
            }

            if ($step == 'family-background') {
                $post['PersonalDataSheet']['childrens'] = array_values($post['PersonalDataSheet']['childrens'] ?? []);
            }

            if ($step == 'other') {
                $post['PersonalDataSheet']['skills'] = $post['PersonalDataSheet']['skills'] ?? [];
                $post['PersonalDataSheet']['recognitions'] = $post['PersonalDataSheet']['recognitions'] ?? [];
                $post['PersonalDataSheet']['organizations'] = $post['PersonalDataSheet']['organizations'] ?? [];
            }

            if ($step == 'reference') {
                $post['PersonalDataSheet']['references'] = $post['PersonalDataSheet']['references'] ?? [];
            }

            if ($model->load($post) && $model->save()) {
                App::success('Successfully Saved');
                return $this->redirect([
                    'update', 
                    'token' => $model->token,
                    'step' => ArrayHelper::map($step_forms, 'id', 'slug')[$stepId + 1]
                ]);
            }

            $model->flashErrors();
        }

        return $this->render('update', [
            'model' => $model,
            'step' => $stepId,
            'step_forms' => $step_forms,
            'current_step' => $step_forms[$stepId],
        ]);
    }

    /**
     * Deletes an existing PersonalDataSheet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($token)
    {
        $model = PersonalDataSheet::controllerFind($token, 'token');

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

    public function actionExportXls()
    {
        return $this->exportXls();
    }

    public function actionExportXlsx()
    {
        return $this->exportXlsx();
    }

    public function actionInActiveData()
    {
        # dont delete; use in condition if user has access to in-active data
    }

    public function actionPrintable($token)
    {
        $model = PersonalDataSheet::controllerFind($token, 'token');

        $this->layout = 'print';

        return $this->render('printable2', ['model' => $model]);
    }
}
<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\models\EarlyWarning;
use app\models\search\EarlyWarningSearch;

/**
 * EarlyWarningController implements the CRUD actions for EarlyWarning model.
 */
class EarlyWarningController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            EarlyWarning::findByKeywords($keywords, [
                'subject',
                'bulletin_no',
                'signal_no',
                'category',
            ])
        );
    }

    public function actionOverview()
    {
        $searchModel = new EarlyWarningSearch();

        return $this->render('overview', [
            'searchModel' => $searchModel,
        ]); 
    }

    /**
     * Lists all EarlyWarning models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EarlyWarningSearch();
        $dataProvider = $searchModel->search(['EarlyWarningSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EarlyWarning model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($token, $tab = 'detail')
    {
        $model = EarlyWarning::controllerFind($token, 'token');
        $view_tabs = EarlyWarning::VIEW_TABS;

        return $this->render('view', [
            'model' => $model,
            'view_tabs' => $view_tabs,
            'tab' => $tab,
        ]);
    }

    /**
     * Creates a new EarlyWarning model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = EarlyWarning::withDefaultValues();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new EarlyWarning model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($token)
    {
        $originalModel = EarlyWarning::controllerFind($token, 'token');
        $model = new EarlyWarning();
        $model->attributes = $originalModel->attributes;

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Duplicated');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('duplicate', [
            'model' => $model,
            'originalModel' => $originalModel,
        ]);
    }

    /**
     * Updates an existing EarlyWarning model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($token)
    {
        $model = EarlyWarning::controllerFind($token, 'token');

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EarlyWarning model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($token)
    {
        $model = EarlyWarning::controllerFind($token, 'token');

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

    public function actionPrintReport($token)
    {
        $model = EarlyWarning::controllerFind($token, 'token');
        $this->layout = 'print';
        return $this->render('view/weather-report', [
            'model' => $model,
        ]);
    }
}
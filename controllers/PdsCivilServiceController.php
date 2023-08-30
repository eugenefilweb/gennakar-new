<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\PdsCivilService;
use app\models\search\PdsCivilServiceSearch;

/**
 * PdsCivilServiceController implements the CRUD actions for PdsCivilService model.
 */
class PdsCivilServiceController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            PdsCivilService::findByKeywords($keywords, ['id'])
        );
    }

    /**
     * Lists all PdsCivilService models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PdsCivilServiceSearch();
        $dataProvider = $searchModel->search(['PdsCivilServiceSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PdsCivilService model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => PdsCivilService::controllerFind($id),
        ]);
    }

    /**
     * Creates a new PdsCivilService model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($successRedirect = '', $failedRedirect = '')
    {
        $model = new PdsCivilService();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($successRedirect ?: $model->viewUrl);
        }

        if ($failedRedirect) {
            App::danger($model->errorSummary);
            return $this->redirect($failedRedirect);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new PdsCivilService model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = PdsCivilService::controllerFind($id);
        $model = new PdsCivilService();
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
     * Updates an existing PdsCivilService model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id, $successRedirect = '', $failedRedirect = '')
    {
        $model = PdsCivilService::controllerFind($id);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');

            return $this->redirect($successRedirect ?: $model->viewUrl);
        }

        if ($failedRedirect) {
            App::danger($model->errorSummary);
            return $this->redirect($failedRedirect);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PdsCivilService model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id, $redirect = '')
    {
        $model = PdsCivilService::controllerFind($id);

        if($model->delete()) {
            App::success('Successfully Deleted');
        }
        else {
            App::danger(json_encode($model->errors));
        }

        return $this->redirect($redirect ?: $model->indexUrl);
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
}
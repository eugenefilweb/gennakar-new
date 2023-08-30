<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\PdsEducation;
use app\models\search\PdsEducationSearch;

/**
 * PdsEducationController implements the CRUD actions for PdsEducation model.
 */
class PdsEducationController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            PdsEducation::findByKeywords($keywords, ['id'])
        );
    }

    /**
     * Lists all PdsEducation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PdsEducationSearch();
        $dataProvider = $searchModel->search(['PdsEducationSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PdsEducation model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => PdsEducation::controllerFind($id),
        ]);
    }

    /**
     * Creates a new PdsEducation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($successRedirect = '', $failedRedirect = '')
    {
        $model = new PdsEducation();

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
     * Duplicates a new PdsEducation model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = PdsEducation::controllerFind($id);
        $model = new PdsEducation();
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
     * Updates an existing PdsEducation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id, $successRedirect = '', $failedRedirect = '')
    {
        $model = PdsEducation::controllerFind($id);

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
     * Deletes an existing PdsEducation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id, $redirect = '')
    {
        $model = PdsEducation::controllerFind($id);

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
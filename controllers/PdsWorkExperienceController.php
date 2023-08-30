<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\PdsWorkExperience;
use app\models\search\PdsWorkExperienceSearch;

/**
 * PdsWorkExperienceController implements the CRUD actions for PdsWorkExperience model.
 */
class PdsWorkExperienceController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            PdsWorkExperience::findByKeywords($keywords, ['id'])
        );
    }

    /**
     * Lists all PdsWorkExperience models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PdsWorkExperienceSearch();
        $dataProvider = $searchModel->search(['PdsWorkExperienceSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PdsWorkExperience model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => PdsWorkExperience::controllerFind($id),
        ]);
    }

    /**
     * Creates a new PdsWorkExperience model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($successRedirect = '', $failedRedirect = '')
    {
        $model = new PdsWorkExperience();

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
     * Duplicates a new PdsWorkExperience model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = PdsWorkExperience::controllerFind($id);
        $model = new PdsWorkExperience();
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
     * Updates an existing PdsWorkExperience model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id, $successRedirect = '', $failedRedirect = '')
    {
        $model = PdsWorkExperience::controllerFind($id);

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
     * Deletes an existing PdsWorkExperience model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id, $redirect = '')
    {
        $model = PdsWorkExperience::controllerFind($id);

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
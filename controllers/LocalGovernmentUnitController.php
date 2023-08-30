<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\LocalGovernmentUnit;
use app\models\search\LocalGovernmentUnitSearch;

/**
 * LocalGovernmentUnitController implements the CRUD actions for LocalGovernmentUnit model.
 */
class LocalGovernmentUnitController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            LocalGovernmentUnit::findByKeywords($keywords, ['lgu_name', 'lgu_classification', 'lgu_address', 'lgu_region', 'name', 'position', 'contact_no'])
        );
    }

    /**
     * Lists all LocalGovernmentUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LocalGovernmentUnitSearch();
        $dataProvider = $searchModel->search(['LocalGovernmentUnitSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LocalGovernmentUnit model.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        return $this->render('view', [
            'model' => LocalGovernmentUnit::controllerFind($slug, 'slug'),
        ]);
    }

    /**
     * Creates a new LocalGovernmentUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LocalGovernmentUnit();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new LocalGovernmentUnit model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($slug)
    {
        $originalModel = LocalGovernmentUnit::controllerFind($slug, 'slug');
        $model = new LocalGovernmentUnit();
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
     * Updates an existing LocalGovernmentUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = LocalGovernmentUnit::controllerFind($slug, 'slug');

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LocalGovernmentUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        $model = LocalGovernmentUnit::controllerFind($slug, 'slug');

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

    public function actionPrintReport($slug='')
    {
        $this->layout = 'print';

        if ($slug) {
            return $this->render('print-report', [
                'model' => LocalGovernmentUnit::controllerFind($slug, 'slug'),
            ]);
        }

        $searchModel = new LocalGovernmentUnitSearch();
        $dataProvider = $searchModel->search(['LocalGovernmentUnitSearch' => App::queryParams()]);

        return $this->render('print-report-multiple', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\Passenger;
use app\models\search\PassengerSearch;

/**
 * PassengerController implements the CRUD actions for Passenger model.
 */
class PassengerController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            Passenger::findByKeywords($keywords, ['id'])
        );
    }

    /**
     * Lists all Passenger models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PassengerSearch();
        $dataProvider = $searchModel->search(['PassengerSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Passenger model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Passenger::controllerFind($id);

        if (App::isAjax()) {
            return $this->asJson([
                'status' => 'success',
                'model' => $model
            ]);
        }
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new Passenger model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($redirect='')
    {
        $model = new Passenger();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            if ($redirect == 'referrer') {
                return $this->redirect(App::referrer());
            }

            return $this->redirect($model->viewUrl);
        }

        $model->flashErrors();
        if ($redirect == 'referrer') {
            return $this->redirect(App::referrer());
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new Passenger model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = Passenger::controllerFind($id);
        $model = new Passenger();
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
     * Updates an existing Passenger model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id, $redirect='')
    {
        $model = Passenger::controllerFind($id);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');

            if ($redirect == 'referrer') {
                return $this->redirect(App::referrer());
            }

            return $this->redirect($model->viewUrl);
        }

        $model->flashErrors();
        if ($redirect == 'referrer') {
            return $this->redirect(App::referrer());
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Passenger model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id, $redirect='')
    {
        $model = Passenger::controllerFind($id);

        if($model->delete()) {
            App::success('Successfully Deleted');
        }
        else {
            App::danger(json_encode($model->errors));
        }

        if ($redirect == 'referrer') {
            return $this->redirect(App::referrer());
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
}
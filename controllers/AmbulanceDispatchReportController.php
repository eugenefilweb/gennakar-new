<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\AmbulanceDispatchReport;
use app\models\search\AmbulanceDispatchReportSearch;

/**
 * AmbulanceDispatchReportController implements the CRUD actions for AmbulanceDispatchReport model.
 */
class AmbulanceDispatchReportController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            AmbulanceDispatchReport::findByKeywords($keywords, ['requester_name', 'patient_name', 'incident_location'])
        );
    }

    /**
     * Lists all AmbulanceDispatchReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AmbulanceDispatchReportSearch();
        $dataProvider = $searchModel->search(['AmbulanceDispatchReportSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AmbulanceDispatchReport model.
     * @param string $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($token)
    {
        return $this->render('view', [
            'model' => AmbulanceDispatchReport::controllerFind($token, 'token'),
        ]);
    }

    /**
     * Creates a new AmbulanceDispatchReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AmbulanceDispatchReport();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new AmbulanceDispatchReport model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($token)
    {
        $originalModel = AmbulanceDispatchReport::controllerFind($token, 'token');
        $model = new AmbulanceDispatchReport();
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
     * Updates an existing AmbulanceDispatchReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($token)
    {
        $model = AmbulanceDispatchReport::controllerFind($token, 'token');

        if (($post = App::post()) != null) {
            $post['AmbulanceDispatchReport']['ert_names'] = $post['AmbulanceDispatchReport']['ert_names'] ?? [];
            $post['AmbulanceDispatchReport']['photos'] = $post['AmbulanceDispatchReport']['photos'] ?? [];
            $post['AmbulanceDispatchReport']['attachments'] = $post['AmbulanceDispatchReport']['attachments'] ?? [];

            if ($model->load($post) && $model->save()) {
                App::success('Successfully Updated');

                return $this->redirect($model->viewUrl);
            }

            $model->flashErrors();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AmbulanceDispatchReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($token)
    {
        $model = AmbulanceDispatchReport::controllerFind($token, 'token');

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

    // public function actionPrint()
    // {
    //     return $this->exportPrint();
    // }

    // public function actionExportPdf()
    // {
    //     return $this->exportPdf();
    // }

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
        $model = AmbulanceDispatchReport::controllerFind($token, 'token');

        $this->layout = 'print';

        return $this->render('printable', ['model' => $model]);
    }
}
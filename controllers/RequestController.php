<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\Request;
use app\models\search\RequestSearch;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            Request::findByKeywords($keywords, ['name', 'address', 'pickup_address', 'chief_complaint'])
        );
    }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(['RequestSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Request::controllerFind($id),
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Request();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($model->viewUrl);
        }

        $model->flashErrors();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new Request model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = Request::controllerFind($id);
        $model = new Request();
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
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id, $ambulance_dispatched = null)
    {
        $model = Request::controllerFind($id);
        $post = App::post();

        if ($ambulance_dispatched !== null) {
            $post['Request']['ambulance_dispatched'] = $ambulance_dispatched;
        }

        if ($model->load($post) && $model->save()) {
            App::success('Successfully Updated');
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Request::controllerFind($id);

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

    public function actionCancelled()
    {
    }
    public function actionApproved()
    {
    }
    public function actionDeclined()
    {
    }

    public function actionFindMyRequestByKeywords($keywords='')
    {
        return $this->asJson(
            Request::findByKeywords($keywords, ['name', 'address', 'pickup_address', 'chief_complaint'], 10, [
                'created_by' => App::identity()
            ])
        );
    }

    public function actionMyRequest()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(['RequestSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['created_by' => App::identity()]);

        return $this->render('my-request', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
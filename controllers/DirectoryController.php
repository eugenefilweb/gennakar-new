<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\Directory;
use app\models\search\DirectorySearch;

/**
 * DirectoryController implements the CRUD actions for Directory model.
 */
class DirectoryController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            Directory::findByKeywords($keywords, ['name', 'type', 'address', 'contact_no', 'position'])
        );
    }

    public function actionCard()
    {
        $searchModel = new DirectorySearch();

        $directories = Directory::find()
            ->select(['id', 'type', 'COUNT("*") AS total', 'MAX(updated_at) AS updated_at'])
            ->orderBy(['type' => SORT_ASC])
            ->groupBy('type')
            ->asArray()
            ->all();

        return $this->render('card', [
            'directories' => $directories,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Lists all Directory models.
     * @return mixed
     */
    public function actionIndex($list='table')
    {
        $searchModel = new DirectorySearch();
        $searchModel->searchAction = ['directory/index', 'list' => $list];

        if ($list == 'detail') {
            $dataProviders = App::foreach(Directory::filter('type'), function ($type) use($searchModel) {
                $dataProvider = $searchModel->search(['DirectorySearch' => App::queryParams()]);
                $dataProvider->query->andWhere(['type' => $type]);

                return $dataProvider;
            }, false);
            
            return $this->render('detail-view', [
                'searchModel' => $searchModel,
                'dataProviders' => $dataProviders,
            ]);
        }

        $dataProvider = $searchModel->search(['DirectorySearch' => App::queryParams()]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Directory model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Directory::controllerFind($id),
        ]);
    }

    /**
     * Creates a new Directory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type='')
    {
        $model = new Directory(['type' => $type]);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new Directory model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = Directory::controllerFind($id);
        $model = new Directory();
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
     * Updates an existing Directory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Directory::controllerFind($id);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Directory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Directory::controllerFind($id);

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
}
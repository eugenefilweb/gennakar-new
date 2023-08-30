<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\HazardMap;
use app\models\search\HazardMapSearch;

/**
 * HazardMapController implements the CRUD actions for HazardMap model.
 */
class HazardMapController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            HazardMap::findByKeywords($keywords, ['name'])
        );
    }

    /**
     * Lists all HazardMap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HazardMapSearch();
        $dataProvider = $searchModel->search(['HazardMapSearch' => App::queryParams()]);
        $dataProvider->query->orderBy([
            'type' => SORT_ASC,
            'name' => SORT_ASC
        ]);

        App::view()->params['controllerLink'] = Url::toRoute(['hazard-map/card']);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'List',
            'headerButtons' => HazardMap::createButton()
        ]);
    }

    public function actionBarangay()
    {
        $searchModel = new HazardMapSearch();
        $dataProvider = $searchModel->search(['HazardMapSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['type' => HazardMap::BARANGAY]);
        $dataProvider->query->orderBy(['name' => SORT_ASC]);

        App::view()->params['controllerLink'] = Url::toRoute(['hazard-map/barangay']);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'Barangay',
            'headerButtons' => Html::a('Add New Map', ['hazard-map/create', 'type' => HazardMap::BARANGAY], ['class' => 'btn btn-success font-weight-bold'])
        ]);
    }

    public function actionMunicipal()
    {
        $searchModel = new HazardMapSearch();
        $dataProvider = $searchModel->search(['HazardMapSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['type' => HazardMap::MUNICIPAL]);
        $dataProvider->query->orderBy(['name' => SORT_ASC]);

        App::view()->params['controllerLink'] = Url::toRoute(['hazard-map/municipal']);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'Municipal',
            'headerButtons' => Html::a('Add New Map', ['hazard-map/create', 'type' => HazardMap::MUNICIPAL], ['class' => 'btn btn-success font-weight-bold'])
        ]);
    }

    public function actionWatershed()
    {
        $searchModel = new HazardMapSearch();
        $dataProvider = $searchModel->search(['HazardMapSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['type' => HazardMap::WATERSHED]);
        $dataProvider->query->orderBy(['name' => SORT_ASC]);

        App::view()->params['controllerLink'] = Url::toRoute(['hazard-map/watershed']);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'Watershed',
            'headerButtons' => Html::a('Add New Map', ['hazard-map/create', 'type' => HazardMap::WATERSHED], ['class' => 'btn btn-success font-weight-bold'])
        ]);
    }

    /**
     * Displays a single HazardMap model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => HazardMap::controllerFind($id),
        ]);
    }

    /**
     * Creates a new HazardMap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type='')
    {
        $model = new HazardMap(['type' => $type]);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new HazardMap model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = HazardMap::controllerFind($id);
        $model = new HazardMap();
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
     * Updates an existing HazardMap model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = HazardMap::controllerFind($id);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HazardMap model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = HazardMap::controllerFind($id);

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

    public function actionCard()
    {
        $hazardMaps = HazardMap::find()
            ->select(['id', 'type', 'COUNT("*") AS total', 'MAX(updated_at) AS updated_at'])
            ->orderBy(['type' => SORT_ASC])
            ->groupBy('type')
            ->asArray()
            ->all();

        return $this->render('card', [
            'hazardMaps' => $hazardMaps,
            'searchModel' => new HazardMapSearch(),
        ]);
    }

    public function actionMapbox()
    {
        $searchModel = new HazardMapSearch();
        $dataProvider = $searchModel->search(['HazardMapSearch' => App::queryParams()]);
        return $this->render('mapbox', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAssessor()
    {
        $searchModel = new HazardMapSearch();
        $dataProvider = $searchModel->search(['HazardMapSearch' => App::queryParams()]);
        return $this->render('assessor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
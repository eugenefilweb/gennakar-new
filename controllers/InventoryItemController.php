<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\InventoryItem;
use app\models\search\InventoryItemSearch;

/**
 * InventoryItemController implements the CRUD actions for InventoryItem model.
 */
class InventoryItemController extends Controller
{
    public function actionFindByKeywords($keywords = '')
    {
        return $this->asJson(
            InventoryItem::findByKeywords($keywords, [
                'id',
                'name',
                'category',
                'quantity',
                'unit',
                'remark',
            ])
        );
    }

    /**
     * Lists all InventoryItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InventoryItemSearch();
        $dataProvider = $searchModel->search(['InventoryItemSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOverview()
    {
        $searchModel = new InventoryItemSearch([
            'date_range' => App::get('date_range')
        ]);
        $searchModel->date_range  = $searchModel->date_range ?: $searchModel->defaultDaterange;
        $inventories = InventoryItem::find()
            ->select(['id', 'category', 'COUNT("*") AS total', 'MAX(updated_at) AS updated_at'])
            ->orderBy(['category' => SORT_ASC])
            ->daterange($searchModel->date_range)
            ->groupBy('category')
            ->asArray()
            ->all();

        return $this->render('overview', [
            'inventories' => $inventories,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single InventoryItem model.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        return $this->render('view', [
            'model' => InventoryItem::controllerFind($slug, 'slug'),
        ]);
    }

    /**
     * Creates a new InventoryItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category = '')
    {
        $model = new InventoryItem(['category' => $category]);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new InventoryItem model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($slug)
    {
        $originalModel = InventoryItem::controllerFind($slug, 'slug');
        $model = new InventoryItem();
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
     * Updates an existing InventoryItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = InventoryItem::controllerFind($slug, 'slug');

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InventoryItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        $model = InventoryItem::controllerFind($slug, 'slug');

        if ($model->delete()) {
            App::success('Successfully Deleted');
        } else {
            App::danger($model->errors);
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

    public function actionPrintReport()
    {
        $queryParams = App::queryParams();
        $inventory_item = new InventoryItem();

        $date_range = $queryParams['date_range'] ?? $inventory_item->defaultDaterange;
        $filterKeys = [
            'date_range',
            'pagination',
            'keywords',
            'sort',
        ];

        foreach ($filterKeys as $key) {
            if (isset($queryParams[$key])) {
                unset($queryParams[$key]);
            }
        }
        

        list($start, $end) = explode(' - ', $date_range);

        $categories = InventoryItem::find()
            ->orderBy(['category' => SORT_ASC])
            ->andFilterWhere($queryParams)
            ->daterange($date_range)
            ->with('inventories')
            ->groupBy('category')
            ->all();

        $inventories = [];

        if ($categories) {
            foreach ($categories as $category) {
                $inventories[$category->category] = InventoryItem::find()
                    ->andFilterWhere($queryParams)
                    ->where(['category' => $category])
                    ->daterange($date_range)
                    ->all();
            }
        }

        $this->layout = 'print';
        return $this->render('print-report', [
            'inventories' => $inventories,
            'date_range' => $date_range,
            'start' => $start,
            'end' => $end,
        ]);
    }
}

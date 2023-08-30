<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\models\Log;
use app\models\search\LogSearch;
use yii\helpers\Inflector;

/**
 * LogController implements the CRUD actions for Log model.
 */
class LogController extends Controller
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            Log::findByKeywords($keywords, [
                'method', 
                'action', 
                'controller',
                'table_name',
                'model_name',
            ])
        );
    }
    
    /**
     * Lists all Log models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search(['LogSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['and',
            ['<>', 'l.action', 'transfer-size'],
            ['<>', 'l.controller', 'site'],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Log model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Log::controllerFind($id),
        ]);
    }
 
    /**
     * Deletes an existing Log model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Log::controllerFind($id);

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

    // public function _ctionExportXls()
    // {
    //     return $this->exportXls();
    // }

    public function actionExportXlsx()
    {
        return $this->exportXlsx();
    }

    public function actionInActiveData()
    {
        # dont delete; use in condition if user has access to in-active data
    }

    public function actionChart()
    {
        $searchModel = new LogSearch(['searchAction' => ['log/chart']]);
        $dataProvider = $searchModel->search(['LogSearch' => App::queryParams()]);

        $query = clone $dataProvider->query;

        $results = $query->select(['model_name', 'COUNT("*") AS total'])
            ->groupBy('model_name')
            ->andFilterWhere(['model_name' => $searchModel->model_name])
            ->orderBy(['model_name' => SORT_ASC])
            ->asArray()
            ->all();

        $data = ArrayHelper::map($results, 'total', 'model_name');
        $models = array_map(fn ($value) => Inflector::camel2words($value), array_values($data));

        return $this->render('chart', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,
            'totals' => json_encode(array_keys($data)),
            'models' => json_encode($models),
            'allModels' => Log::filter('model_name')
        ]);
    }
}
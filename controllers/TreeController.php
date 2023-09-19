<?php

namespace app\controllers;

use app\helpers\Url;
use Yii;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\models\Tree;
use app\models\search\TreeSearch;
use app\widgets\OpenLayer;

/**
 * TreeController implements the CRUD actions for Tree model.
 */
class TreeController extends Controller 
{
    public function actionFindByKeywords($keywords='', $status=Tree::VALIDATED)
    {
        return $this->asJson(
            Tree::findByKeywords($keywords, ['common_name', 'kingdom', 'family', 'genus', 'species', 'sub_species', 'varieta_and_infra_var_name', 'taxonomic_group'], 10, [
                'status' => $status
            ])
        );
    }

    /**
     * Lists all Tree models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TreeSearch();
        $dataProvider = $searchModel->search(['TreeSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['status' => Tree::VALIDATED]);
        $searchModel->status= Tree::VALIDATED;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionForValidation()
    {
        $searchModel = new TreeSearch();
        $dataProvider = $searchModel->search(['TreeSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['status' => Tree::NOT_VALIDATED]);
        
         $searchModel->status= Tree::NOT_VALIDATED;

        return $this->render('for-validation', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tree model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Tree::controllerFind($id),
        ]);
    }

    /**
     * Creates a new Tree model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($status = Tree::VALIDATED, $patrol_id=0, $referrer = false)
    {
        $model = new Tree([
            'latitude' => OpenLayer::LATITUDE,
            'longitude' => OpenLayer::LONGITUDE,
            'status' => $status,
            'patrol_id' => $patrol_id,
            'date_encoded' => App::formatter()->asDateToTimezone('', 'm/d/Y h:i A')
        ]);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Add Tree Item');

            $referrer = $referrer ?: $model->viewUrl;
            return $this->redirect($referrer);
        }

        $model->flashErrors();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new Tree model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = Tree::controllerFind($id);
        $model = new Tree();
        $model->attributes = $originalModel->attributes;

        if ($model->load(App::post()) && $model->validate()) {
            $model->formatPhotos();
            $model->save();
            App::success('Successfully Duplicated');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('duplicate', [
            'model' => $model,
            'originalModel' => $originalModel,
        ]);
    }

    /**
     * Updates an existing Tree model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Tree::controllerFind($id);
        if (($post = App::post()) != null) {

            foreach (Tree::PHOTO_KEYS as $attribute => $label) {
                $post['Tree'][$attribute] = $post['Tree'][$attribute] ?? [];
            }
            if ($model->load($post) && $model->validate()) {
                $model->formatPhotos();
                $model->save();
                App::success('Successfully Updated');
                return $this->redirect($model->viewUrl);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tree model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Tree::controllerFind($id);

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

    public function actionValidate($id)
    {
        $model = Tree::controllerFind($id);
        if ($model->load(App::post()) && $model->validate()) {
            $model->validateTree();
            if ($model->save()) {
                App::success('Tree was validated');
            }
        }
        $model->flashErrors();

        return $this->redirect(App::referrer());
    }

    public function actionMap()
    {
        $searchModel = new TreeSearch();
        $dataProvider = $searchModel->search(['TreeSearch' => App::queryParams()]);
        // $coordinates = array_values(Tree::coordinates($dataProvider->models, $this) ?: []);

        $data = $dataProvider->models;
        $coordinates = ArrayHelper::toArray($data, [
            'Patrol' => []
        ]);

        foreach ($coordinates as &$value) {
            if (isset($value['photos'][0])) {
                $value['photo_url'] = Url::image($value['photos'][0], ['width' => 500, 'height' => 500], true);
            } else {
                $value['photo_url'] = '';
            }
        }

        return $this->render('map', [
            'searchModel' => $searchModel,
            'total' => $dataProvider->totalCount,
            'coordinates' => $coordinates,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPrintMapReport()
    {
        $searchModel = new TreeSearch();
        $searchModel->load(['TreeSearch' => App::queryParams()]);

        $query = TreeSearch::mapQuery(App::queryParams());
        $models = $query->all();
        $coordinates = array_values(Tree::coordinates($models) ?: []);

        $this->layout = 'print';
        return $this->render('print-map-report', [
            'searchModel' => $searchModel,
            'total' => $query->count(),
            'models' => $models,
            'coordinates' => $coordinates,
        ]);
    }
}
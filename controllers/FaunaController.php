<?php

namespace app\controllers;

use app\helpers\Url;
use Yii;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\models\Fauna;
use app\models\search\FaunaSearch;
use app\widgets\OpenLayer;


/**
 * FaunaController implements the CRUD actions for Fauna model.
 */
class FaunaController extends Controller 
{
    public function actionFindByKeywords($keywords='', $status=Fauna::VALIDATED)
    {
        return $this->asJson(
            Fauna::findByKeywords($keywords, ['common_name', 'kingdom', 'family', 'genus', 'species', 'sub_species', 'varieta_and_infra_var_name'/* , ''taxonomic_group */, 'growth_habit', 'category_id', 'conservation_status', 'diameter'], 10, [
                'status' => $status
            ])
        );
    }

    /**
     * Lists all Fauna models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FaunaSearch();
        $dataProvider = $searchModel->search(['FaunaSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['status' => Fauna::VALIDATED]);
        $searchModel->status= Fauna::VALIDATED;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionForValidation()
    {
        $searchModel = new FaunaSearch();
        $dataProvider = $searchModel->search(['FaunaSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['status' => Fauna::NOT_VALIDATED]);
        
         $searchModel->status= Fauna::NOT_VALIDATED;

        return $this->render('for-validation', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fauna model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = Fauna::controllerFind($id);
        $coordinates = $model->attributes;

        if (isset($coordinates['photos'][0])) {
            $coordinates['photo_url'] = Url::image($coordinates['photos'][0], ['width' => 500, 'height' => 500], true);
            $coordinates['token'] = $coordinates['photos'][0];
        }else if(isset($coordinates['photos']['fullheight'][0])){        
            $coordinates['photo_url'] = Url::image($coordinates['photos']['fullheight'][0], ['width' => 500, 'height' => 500], true);
            $coordinates['token'] = $coordinates['photos']['fullheight'][0];
        } else {
            $coordinates['photo_url'] = '';
            $coordinates['token'] = '';
        }

        return $this->render('view', [
            'model' => $model,
            'coordinates' => $coordinates
        ]);
    }

    /**
     * Creates a new Fauna model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($status = Fauna::VALIDATED, $patrol_id=0, $referrer = false)
    {
        $model = new Fauna([
            'latitude' => OpenLayer::LATITUDE,
            'longitude' => OpenLayer::LONGITUDE,
            'status' => $status,
            'patrol_id' => $patrol_id,
            'date_encoded' => App::formatter()->asDateToTimezone('', 'm/d/Y h:i A')
        ]);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Add Fauna Item');

            $referrer = $referrer ?: $model->viewUrl;
            return $this->redirect($referrer);
        }

        $model->flashErrors();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new Fauna model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = Fauna::controllerFind($id);
        $model = new Fauna();
        $model->attributes = $originalModel->attributes;

        if ($model->load(App::post()) && $model->validate()) {
            // $model->formatPhotos();
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
     * Updates an existing Fauna model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Fauna::controllerFind($id);
        if (($post = App::post()) != null) {

            foreach (Fauna::PHOTO_KEYS as $attribute => $label) {
                $post['Fauna'][$attribute] = $post['Fauna'][$attribute] ?? [];
            }
            if ($model->load($post) && $model->validate()) {
                // $model->formatPhotos();
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
     * Deletes an existing Fauna model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Fauna::controllerFind($id);

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
        $model = Fauna::controllerFind($id);
        if ($model->load(App::post()) && $model->validate()) {
            $model->validateFauna();
            if ($model->save()) {
                App::success('Fauna was validated');
            }
        }
        $model->flashErrors();

        return $this->redirect(App::referrer());
    }

    public function actionMap()
    {
        $searchModel = new FaunaSearch();
        $dataProvider = $searchModel->search(['FaunaSearch' => App::queryParams()]);

        // $coordinates = array_values(Fauna::coordinates($dataProvider->models, $this) ?: []);

        $data = $dataProvider->models;
        $coordinates = ArrayHelper::toArray($data, ['Fauna' => []]);

        foreach ($coordinates as &$value) {
            if (isset($value['photos'][0])) {
                $value['photo_url'] = Url::image($value['photos'][0], ['width' => 500, 'height' => 500], true);
            }else if(isset($value['photos']['fullheight'][0])){        
                $value['photo_url'] = Url::image($value['photos']['fullheight'][0], ['width' => 500, 'height' => 500], true);
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
        $searchModel = new FaunaSearch();
        $searchModel->load(['FaunaSearch' => App::queryParams()]);

        $query = FaunaSearch::mapQuery(App::queryParams());
        $models = $query->all();
        $coordinates = array_values(Fauna::coordinates($models) ?: []);

        $this->layout = 'print';
        return $this->render('print-map-report', [
            'searchModel' => $searchModel,
            'total' => $query->count(),
            'models' => $models,
            'coordinates' => $coordinates,
        ]);
    }
}